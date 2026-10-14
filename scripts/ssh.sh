#!/usr/bin/env bash
#
# 1Password から ssh の公開鍵と ~/.ssh/config.local を取り出して配置する。
#
# 秘密鍵は 1Password にあり、ディスクには置かない。ssh が鍵を選ぶのに使う公開鍵と、
# 取引先のホストを書いた config.local（公開リポジトリには置けない）を 1Password から得る。
#
#   ssh.sh          公開鍵を ~/.ssh/keys/<アイテム名>.pub に書き出し、
#                   config.local が無ければ 1Password から取得する（make install 用）。
#                   config.local が既にあれば上書きせず、1Password との差分だけ知らせる
#   ssh.sh --save   ~/.ssh/config.local を 1Password に保存する
#
# 1Password の SSH エージェントが無いマシン（貸与PC）では何もしない。詳細は docs/ssh.md。

. "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/lib/common.sh"

OP_AGENT_SOCK="$HOME/Library/Group Containers/2BUA8C4S2C.com.1password/t/agent.sock"
KEYS_DIR="$HOME/.ssh/keys"
CONFIG_LOCAL="$HOME/.ssh/config.local"
# config.local を保存している 1Password のドキュメント名。
# アカウント名はここに書かず、サインイン済みの全アカウントから探す（公開リポジトリのため）。
CONFIG_LOCAL_DOC="ssh config.local"

MODE=load
while [ $# -gt 0 ]; do
  case "$1" in
    --save) MODE=save ;;
    *) die "unknown option: $1" ;;
  esac
  shift
done

log_header "ssh (1Password)"

if [ ! -S "$OP_AGENT_SOCK" ]; then
  log_skip "1Password の SSH エージェントが無い (~/.ssh/config.local は手で置く)"
  exit 0
fi

OP="$("$MISE_BIN" which op 2>/dev/null)" || die "op が無い -> make mise"

tmp="$(mktemp)"
trap 'rm -f "$tmp"' EXIT

# config.local のドキュメントを探し、中身を $tmp に書いてアカウントを返す
find_config_local_doc() {
  local acct
  for acct in $("$OP" account list | awk 'NR > 1 { print $1 }'); do
    if "$OP" document get "$CONFIG_LOCAL_DOC" --account "$acct" > "$tmp" 2>/dev/null; then
      printf '%s\n' "$acct"
      return 0
    fi
  done
  return 1
}

#------------------------------------------------------------------------------
# --save: config.local を 1Password へ
#------------------------------------------------------------------------------
if [ "$MODE" = save ]; then
  [ -f "$CONFIG_LOCAL" ] || die "$(tilde "$CONFIG_LOCAL") が無い"
  if ! acct="$(find_config_local_doc)"; then
    log_fail "1Password に「$CONFIG_LOCAL_DOC」が無い。初回は保存先を指定して作る:"
    log_info "        op document create $(tilde "$CONFIG_LOCAL") --title '$CONFIG_LOCAL_DOC' --vault <保管庫> --account <アカウント>"
    exit 1
  fi
  if cmp -s "$tmp" "$CONFIG_LOCAL"; then
    log_ok "config.local は 1Password と同じ ($acct)"
  else
    log_do "config.local を 1Password に保存 ($acct)"
    "$OP" document edit "$CONFIG_LOCAL_DOC" "$CONFIG_LOCAL" --account "$acct" >/dev/null
  fi
  exit 0
fi

#------------------------------------------------------------------------------
# 公開鍵: エージェントから書き出す
#------------------------------------------------------------------------------
# ssh-add -L はエージェントが出している鍵の公開鍵を、1Password のアイテム名を
# コメントにして返す。op item get は取り込んだ .pem によっては解釈に失敗するので使わない。
# 承認（Touch ID）も要らない。
mkdir -p "$KEYS_DIR"
chmod 700 "$KEYS_DIR"
SSH_AUTH_SOCK="$OP_AGENT_SOCK" ssh-add -L > "$tmp" 2>/dev/null \
  || die "1Password のエージェントから鍵を取得できない (鍵が 1 本も無い / agent.toml の保管庫名の誤り)"

titles=""
while read -r type body title; do
  if [ -z "$title" ]; then
    log_warn "アイテム名の無い鍵があるためスキップ ($type)"
    continue
  fi
  # アイテム名をそのままファイル名にするので、/ と空白は使えない
  case "$title" in
    */*|*' '*)
      log_warn "「$title」は / や空白を含むのでファイル名にできない (1Password で改名する)"
      continue
      ;;
  esac
  titles="$titles
$title"
  dest="$KEYS_DIR/$title.pub"
  line="$type $body $title"
  if [ -f "$dest" ] && [ "$(cat "$dest")" = "$line" ]; then
    log_ok "$(tilde "$dest")"
  else
    log_do "$(tilde "$dest")"
    printf '%s\n' "$line" > "$dest"
  fi
done < "$tmp"

# 1Password から消した鍵の公開鍵が残っていたら知らせる（消すのは手で）
for f in "$KEYS_DIR"/*.pub; do
  [ -e "$f" ] || continue
  name="$(basename "$f" .pub)"
  printf '%s\n' "$titles" | grep -qxF "$name" \
    || log_warn "$(tilde "$f") は 1Password に無い鍵 (不要なら消す)"
done

#------------------------------------------------------------------------------
# config.local: 無ければ 1Password から取得する
#------------------------------------------------------------------------------
if ! acct="$(find_config_local_doc)"; then
  log_warn "1Password に「$CONFIG_LOCAL_DOC」が無い (docs/ssh.md の手順で作る)"
elif [ ! -f "$CONFIG_LOCAL" ]; then
  log_do "$(tilde "$CONFIG_LOCAL") を 1Password から取得 ($acct)"
  install -m 600 "$tmp" "$CONFIG_LOCAL"
elif cmp -s "$tmp" "$CONFIG_LOCAL"; then
  log_ok "$(tilde "$CONFIG_LOCAL") は 1Password と同じ"
else
  # 手元の編集を消さないよう、既存のファイルは上書きしない
  log_warn "$(tilde "$CONFIG_LOCAL") が 1Password と違う"
  log_info "        手元が新しい -> make ssh-save"
  log_info "        1Password が新しい -> 手元を消してから make ssh"
fi
