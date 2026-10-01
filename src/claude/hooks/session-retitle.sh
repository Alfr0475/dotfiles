#!/usr/bin/env bash
#
# セッションのタイトルを、直近の会話内容に合わせて付け替える Stop hook。
#
# Claude Code の自動タイトル生成は 1 セッション 1 回だけで、最初のプロンプトが
# そのままタイトルになる。会話中に話題が変わると /resume の一覧から目的の
# セッションを見つけられなくなるため、外から付け替える。
#
# タイトルは会話ログ（transcript）への追記で表現される。優先順位は
#   custom-title > ai-title > summary > 最初のプロンプト
# で、custom-title は Claude Code 側も追記を読み直して採用するため、
# 実行中のセッションのプロンプト表示にも反映される。
#
# Stop hook は応答ごとに発火するので、判定だけ同期で行い、実際の生成
# （claude の呼び出しで数秒かかる）はバックグラウンドへ逃がす。
#
#   CLAUDE_RETITLE_INTERVAL   前回更新からの最小間隔（秒, 既定 600）
#   CLAUDE_RETITLE_MODEL      タイトル生成に使うモデル
#   CLAUDE_RETITLE_DISABLE    1 なら何もしない

set -euo pipefail

STATE_DIR="$HOME/.claude/session-titles"
LOG="$STATE_DIR/retitle.log"

# 生成のために起動した claude から Stop hook が発火しても再帰しない
if [ -n "${CLAUDE_SESSION_RETITLE:-}" ] || [ "${CLAUDE_RETITLE_DISABLE:-0}" = "1" ]; then
  exit 0
fi

# mise が入れた python に依存しないよう、システムの python3 を優先する
PYTHON=python3
if [ -x /usr/bin/python3 ]; then
  PYTHON=/usr/bin/python3
fi
command -v "$PYTHON" >/dev/null 2>&1 || exit 0

#------------------------------------------------------------------
# 親: hook の入力を控えて worker を投げるだけ（応答を待たせない）
#------------------------------------------------------------------
if [ "${1:-}" != "--worker" ]; then
  mkdir -p "$STATE_DIR"

  # ログが膨らんだら切る
  if [ -f "$LOG" ] && [ "$(wc -c <"$LOG")" -gt 262144 ]; then
    tail -c 65536 "$LOG" >"$LOG.tmp" && mv "$LOG.tmp" "$LOG"
  fi

  # worker が起動できなかった場合の控えは残るので、古いものは掃除する
  find "$STATE_DIR" -maxdepth 1 -name 'payload.*' -mmin +60 -delete 2>/dev/null || true

  payload="$(mktemp "$STATE_DIR/payload.XXXXXX")"
  cat >"$payload"
  if [ ! -s "$payload" ]; then
    rm -f "$payload"
    exit 0
  fi

  # CLAUDE_SESSION_RETITLE は worker が起動する claude 側に立てる印なので、
  # ここで立ててはいけない（worker 自身が冒頭のガードで落ちる）。
  nohup "$0" --worker "$payload" >>"$LOG" 2>&1 &
  exit 0
fi

#------------------------------------------------------------------
# worker
#------------------------------------------------------------------
exec "$PYTHON" - "$2" <<'PY'
import json
import os
import re
import shutil
import subprocess
import sys
import time
import uuid
from datetime import datetime, timezone

MIN_INTERVAL = int(os.environ.get("CLAUDE_RETITLE_INTERVAL") or 600)
MODEL = os.environ.get("CLAUDE_RETITLE_MODEL") or "claude-haiku-4-5-20251001"
MIN_TURNS = 3          # 最初に付け替えるまでに必要なユーザー発言数
MIN_NEW_TURNS = 2      # 前回更新以降に必要なユーザー発言数
EXCERPT_CHARS = 2000   # モデルに渡す会話末尾の文字数
MAX_TITLE = 80

# セッション一覧は転写ログの先頭 64KB と末尾 64KB しか読まない（$I = 65536）。
# 追記したタイトルはその後の会話でこの窓から押し出されるため、離れすぎたら
# 同じタイトルを再追記して窓の中に戻す（Claude Code 自身も同じことをしている）。
REFRESH_MARGIN = 32768

CUSTOM_TITLE_RE = re.compile(br'"customTitle":\s*"((?:[^"\\]|\\.)*)"')

STATE_DIR = os.path.join(os.path.expanduser("~"), ".claude", "session-titles")

SYSTEM_PROMPT = """\
あなたは長いセッション一覧からユーザーが目的のセッションを見つけられるように、
コーディングセッションへ名前を付ける。出力はタイトル 1 行だけで、引用符・前置き・
説明・記号による装飾を付けない。

- タイトルは「何についてのセッションか」を表す短い名詞句にする。タスクを説明する
  文にはしない。動詞で始めず、日本語なら動詞で終わらせない。長さは日本語なら
  10〜25 文字、英語なら 2〜5 語を目安にする。
- 短くしすぎない。単語を並べただけの断片ではなく、読んで意味の通る名詞句にする。
  日本語では助詞（の、での、における など）で語をつないでよい。
- 長くなりすぎたときに削るのは、一般名詞・助詞・二次的な詳細から。固有名詞、
  製品名、ツール名、識別子は絶対に削らない。それがタイトルを見分けられるものに
  している。
- ユーザーが名指しした最も具体的なもの（コンポーネント、機能、ファイル、関数、
  サービス、エラー、チケット番号、概念）を先頭に置き、識別子は原文のまま保つ。
  フルパスではなくファイル名、URL ではなく番号など、口に出して言う短い形を使う。
- 依頼の動詞（修正、追加、確認、調査、実装、対応、リファクタ など）は落とす。
  一覧のセッションはすべて何かを作るか直すものなので、動詞は情報を持たない。
  「〜の調査」「〜の対応」「〜の実装」のような抽象名詞で終わらせるのも同じく駄目で、
  調査・対応されている対象そのものを名前にして止める。ただし対象の名前だけでは
  意味が通らないときは、意味を担う語（導入、移行、リネーム、バージョン更新 など）を
  名詞として後ろに添えてよい。
- ダッシュやコロンの後に説明を付け足さない。数十のセッションに当てはまる一般的な
  ラベルは名前ではない。逆に、既に固有の名前として読める数語はそのままでよい。
- 質問や相談のセッションなら、尋ねられている話題そのものをタイトルにする。
  ユーザーが頼んでいない作業を勝手に作り出さない。
- セッションの主要言語で書く。技術用語やコード識別子は原文のまま残す。
- セッションの途中で話題が変わっている場合は、末尾の話題を優先する。
"""

# ユーザーの発言に混ざる環境由来のタグ（IDE の状態やスラッシュコマンドの展開）は
# 話題ではないので落とす。残すとファイル名などを話題と誤認する。
TAG_RE = re.compile(
    r"<(system-reminder|ide_[a-z_]+|command-[a-z-]+|local-command-[a-z]+)"
    r"\b[^>]*>.*?</\1>",
    re.DOTALL,
)


def log(msg):
    stamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    sys.stderr.write("[%s] %s\n" % (stamp, msg))


def text_blocks(entry):
    """user / assistant エントリから本文テキストだけを取り出す。"""
    content = (entry.get("message") or {}).get("content")
    if isinstance(content, str):
        return content
    if not isinstance(content, list):
        return ""
    parts = []
    for block in content:
        if isinstance(block, dict) and block.get("type") == "text":
            parts.append(block.get("text") or "")
    return "\n".join(parts)


def clean(text):
    text = TAG_RE.sub("", text)
    return re.sub(r"\n{3,}", "\n\n", text).strip()


def read_transcript(path):
    """(モデルに渡す会話の抜粋, ユーザー発言数) を返す。"""
    turns = []
    user_turns = 0

    with open(path, "r", encoding="utf-8", errors="replace") as fh:
        for line in fh:
            line = line.strip()
            if not line:
                continue
            try:
                entry = json.loads(line)
            except ValueError:
                continue
            if not isinstance(entry, dict):
                continue

            kind = entry.get("type")
            if kind not in ("user", "assistant"):
                continue
            if entry.get("isMeta") or entry.get("isSidechain"):
                continue

            if kind == "user":
                # ツールの実行結果も user エントリとして記録されるので落とす
                content = (entry.get("message") or {}).get("content")
                if isinstance(content, list) and any(
                    isinstance(b, dict) and b.get("type") == "tool_result"
                    for b in content
                ):
                    continue
                # origin が明示されていて human 以外なら、人の発言ではない
                origin = entry.get("origin")
                if isinstance(origin, dict) and origin.get("kind") != "human":
                    continue
                body = clean(text_blocks(entry))
                if not body:
                    continue
                user_turns += 1
                turns.append(("user", body))
            else:
                body = clean(text_blocks(entry))
                if body:
                    turns.append(("assistant", body))

    # 末尾から予算内に収まるだけ詰める（新しい話題を優先する）
    picked = []
    budget = EXCERPT_CHARS
    for role, body in reversed(turns):
        chunk = "%s: %s" % (role, body)
        if len(chunk) > budget:
            chunk = chunk[:budget]
        picked.append(chunk)
        budget -= len(chunk)
        if budget <= 0:
            break

    return "\n\n".join(reversed(picked)).strip(), user_turns


def load_state(session_id):
    path = os.path.join(STATE_DIR, "%s.json" % session_id)
    try:
        with open(path, "r", encoding="utf-8") as fh:
            state = json.load(fh)
        return state if isinstance(state, dict) else {}
    except (IOError, OSError, ValueError):
        return {}


def save_state(session_id, state):
    path = os.path.join(STATE_DIR, "%s.json" % session_id)
    tmp = "%s.tmp.%d" % (path, os.getpid())
    with open(tmp, "w", encoding="utf-8") as fh:
        json.dump(state, fh, ensure_ascii=False)
    os.rename(tmp, path)


def claude_bin():
    found = shutil.which("claude")
    if found:
        return found
    fallback = os.path.join(os.path.expanduser("~"), ".homebrew", "bin", "claude")
    return fallback if os.path.exists(fallback) else None


def generate_title(excerpt):
    binary = claude_bin()
    if not binary:
        log("claude が PATH に無い")
        return None

    prompt = "<session>\n%s\n</session>\n\nこのセッションのタイトルを付けてください。" % excerpt
    env = dict(os.environ)
    env["CLAUDE_SESSION_RETITLE"] = "1"

    # --setting-sources '' で hook と設定を読ませない（再帰と副作用を避ける）
    cmd = [
        binary, "-p",
        "--model", MODEL,
        "--tools", "",
        "--no-session-persistence",
        "--setting-sources", "",
        "--system-prompt", SYSTEM_PROMPT,
        prompt,
    ]
    try:
        proc = subprocess.Popen(
            cmd, stdout=subprocess.PIPE, stderr=subprocess.PIPE,
            env=env, cwd=os.path.expanduser("~"),
        )
        out, err = proc.communicate()
    except (OSError, ValueError) as exc:
        log("claude の起動に失敗: %s" % exc)
        return None

    if proc.returncode != 0:
        log("claude が %s で終了: %s" % (proc.returncode, err.decode("utf-8", "replace").strip()[:200]))
        return None

    return sanitize(out.decode("utf-8", "replace"))


PREFIX_RE = re.compile(r"^(タイトル|title|セッション名)\s*[:：]\s*", re.IGNORECASE)

# 「フィード の在庫」のように和文の間へ空白が入ることがあるので詰める。
# 和文と欧文の境目（Criteo フィード）は読みやすさのため残す。
CJK = r"぀-ヿ㐀-䶿一-鿿ｦ-ﾟ"
CJK_SPACE_RE = re.compile(r"(?<=[%s]) +(?=[%s])" % (CJK, CJK))


def sanitize(raw):
    for line in raw.splitlines():
        line = PREFIX_RE.sub("", line.strip())
        line = line.strip("\"'`「」『』【】 \t")
        line = re.sub(r"\s+", " ", line)
        line = "".join(ch for ch in line if ch >= " ")
        line = CJK_SPACE_RE.sub("", line).strip()
        if line:
            return line[:MAX_TITLE]
    return None


def append_title(transcript, session_id, title):
    entry = {
        "type": "custom-title",
        "customTitle": title,
        "sessionId": session_id,
        "uuid": str(uuid.uuid4()),
        "timestamp": datetime.now(timezone.utc).strftime("%Y-%m-%dT%H:%M:%S.000Z"),
    }
    line = json.dumps(entry, ensure_ascii=False) + "\n"
    # O_APPEND への 1 回の write なので、実行中のセッションの追記と混ざらない
    with open(transcript, "a", encoding="utf-8") as fh:
        fh.write(line)


LOCK_STALE = 300


def acquire_lock(session_id):
    """同じセッションで worker が二重に走って課金だけ増えるのを防ぐ。"""
    path = os.path.join(STATE_DIR, "%s.lock" % session_id)
    try:
        fd = os.open(path, os.O_CREAT | os.O_EXCL | os.O_WRONLY, 0o600)
        os.close(fd)
        return path
    except OSError:
        pass

    # 前回の worker が落ちて残ったロックは一定時間で無効にする
    try:
        if time.time() - os.path.getmtime(path) > LOCK_STALE:
            os.unlink(path)
            fd = os.open(path, os.O_CREAT | os.O_EXCL | os.O_WRONLY, 0o600)
            os.close(fd)
            return path
    except OSError:
        pass
    return None


def main():
    payload_path = sys.argv[1]
    try:
        with open(payload_path, "r", encoding="utf-8") as fh:
            payload = json.load(fh)
    except (IOError, OSError, ValueError) as exc:
        log("hook の入力を読めない: %s" % exc)
        return
    finally:
        try:
            os.unlink(payload_path)
        except OSError:
            pass

    if payload.get("hook_event_name") not in (None, "Stop"):
        return

    session_id = payload.get("session_id")
    transcript = payload.get("transcript_path")
    if not session_id or not transcript or not os.path.exists(transcript):
        return

    state = load_state(session_id)
    if state.get("manual"):
        return

    now = int(time.time())

    lock = acquire_lock(session_id)
    if not lock:
        return
    try:
        retitle(session_id, transcript, state, now)
    finally:
        try:
            os.unlink(lock)
        except OSError:
            pass


def title_in_file(path):
    """最後の customTitle と、その位置から末尾までのバイト数を返す。"""
    try:
        with open(path, "rb") as fh:
            data = fh.read()
    except (IOError, OSError):
        return None, None

    found = None
    for found in CUSTOM_TITLE_RE.finditer(data):
        pass
    if found is None:
        return None, None

    raw = found.group(1).decode("utf-8", "replace")
    try:
        title = json.loads('"%s"' % raw)
    except ValueError:
        title = raw
    return title, len(data) - found.end()


def retitle(session_id, transcript, state, now):
    known = state.get("title")
    current, distance = title_in_file(transcript)

    # /rename で人が付けた名前は尊重し、以降このセッションには触らない
    if current and current != known:
        save_state(session_id, {"manual": True, "title": current, "at": now})
        log("%s: 手動タイトル %r を検出したので以降は触らない" % (session_id[:8], current))
        return

    # 表示窓から押し出されていたら、モデルを呼ばずに同じタイトルを戻す
    if known and (current is None or distance > REFRESH_MARGIN):
        append_title(transcript, session_id, known)
        log("%s: %r を末尾へ再追記（末尾から %s）"
            % (session_id[:8], known,
               "%d bytes" % distance if distance is not None else "消えていた"))

    if now - int(state.get("at") or 0) < MIN_INTERVAL:
        return

    excerpt, user_turns = read_transcript(transcript)

    if user_turns < MIN_TURNS:
        return
    if state.get("title") and user_turns - int(state.get("turns") or 0) < MIN_NEW_TURNS:
        return
    if len(excerpt) < 40:
        return

    title = generate_title(excerpt)
    if not title:
        return

    if title == state.get("title"):
        # 話題が変わっていない。次の判定まで間隔を置く
        save_state(session_id, {"title": title, "at": now, "turns": user_turns})
        return

    append_title(transcript, session_id, title)
    save_state(session_id, {"title": title, "at": now, "turns": user_turns})
    log("%s: %r -> %r" % (session_id[:8], state.get("title"), title))


main()
PY
