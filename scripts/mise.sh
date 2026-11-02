#!/usr/bin/env bash
#
# mise を ~/.local/bin に導入し、グローバル設定のツールを入れる。
#
# 方針: 言語ランタイムと CLI ツールは基本的に mise で管理し、
#       mise で賄えないもの（GUIアプリ / cask / ビルド依存ライブラリ等）を
#       Homebrew の担当とする。
#
# mise は単体バイナリなので Homebrew 経由にせず公式インストーラで入れる。
# 非標準prefixの Homebrew でソースビルドが走るのを避ける意図もある。

. "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/lib/common.sh"

MISE_CONFIG="$HOME/.config/mise/config.toml"

log_header "mise ($(tilde "$MISE_BIN"))"

# ---- 本体の導入 ----
if [ -x "$MISE_BIN" ]; then
  log_ok "mise は既にインストール済み ($("$MISE_BIN" --version 2>/dev/null | head -1))"
else
  has curl || die "curl が必要です"
  log_do "https://mise.run からインストール"
  # インストーラを一旦落としてから実行する（何が走るか確認できるようにする）
  installer="$(mktemp)"
  trap 'rm -f "$installer"' EXIT
  curl -fsSL https://mise.run -o "$installer"
  MISE_INSTALL_PATH="$MISE_BIN" sh "$installer"
  [ -x "$MISE_BIN" ] || die "インストールしたが $MISE_BIN が見つかりません"
fi

# ---- ツールの導入 ----
if [ ! -f "$MISE_CONFIG" ]; then
  log_skip "$(tilde "$MISE_CONFIG") が無いため install をスキップ (make deploy 済みか確認)"
else
  # `mise install` は未導入のバージョンだけ入れるので、そのまま毎回呼んでよい。
  # 「入れる必要があるか」を先に判定しようとすると mise 側のフラグ仕様に依存して
  # 誤判定したときに黙って導入を飛ばすことになるので、判定はせず mise に任せる。
  # changed かどうかは実行前後の導入済み一覧の差分で判断する（冪等性の確認用）。
  before="$("$MISE_BIN" ls --installed 2>/dev/null || true)"
  "$MISE_BIN" install
  after="$("$MISE_BIN" ls --installed 2>/dev/null || true)"
  if [ "$before" = "$after" ]; then
    log_ok "設定されたツールは全て導入済み"
  else
    log_do "mise install"
  fi
fi

# ---- zsh の補完 ----
# mise activate は補完を入れないので、20-completion.zsh が fpath に足している
# ディレクトリへ書き出す。中身が同じなら書き換えない（冪等）。
# compinit -C は古い dump を読み続けるので、書き換えたら dump を消す。
# ツールの導入（usage / ghq）より後に置く。
COMPLETION_DIR="${XDG_CONFIG_HOME:-$HOME/.config}/zsh/completions"
ZCOMPDUMP="${XDG_CACHE_HOME:-$HOME/.cache}/zsh/zcompdump"

# install_completion <ファイル名> <中身>
install_completion() {
  local file="$COMPLETION_DIR/$1"
  if [ -f "$file" ] && [ "$(cat "$file")" = "$2" ]; then
    log_ok "$(tilde "$file") は最新"
  else
    mkdir -p "$COMPLETION_DIR"
    printf '%s\n' "$2" > "$file"
    rm -f "$ZCOMPDUMP"
    log_do "$(tilde "$file") を生成"
  fi
}

# 候補は実行時に `mise __complete_word__` が出すので、mise を上げても
# ファイルはほぼ変わらない。出力は usage の有無で変わる。
install_completion _mise "$("$MISE_BIN" completion zsh)"

# ghq は生成コマンドを持たず、配布物に misc/zsh/_ghq が同梱されている。
# インストール先はバージョンを含み、古い版は自動で消えるので、
# fpath に足したりリンクしたりせずコピーする。
ghq_completion="$(mise_ghq_completion)"
if [ -n "$ghq_completion" ]; then
  install_completion _ghq "$(cat "$ghq_completion")"
else
  log_skip "ghq の補完が見つからない (ghq が未導入)"
fi
