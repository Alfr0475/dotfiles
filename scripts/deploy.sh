#!/usr/bin/env bash
#
# etc/links.conf に従って src/ 以下のファイルをシンボリックリンクとして配置する。
#
#   deploy.sh              配置する
#   deploy.sh --dry-run    何が起きるか表示するだけ
#   deploy.sh --unlink     このリポジトリが張ったリンクだけを削除する
#
# 冪等性:
#   - 既に正しい先を指すシンボリックリンクなら何もしない
#   - 別の先を指すシンボリックリンクなら張り替える
#   - 実ファイル / 実ディレクトリがあれば退避してから張る（退避は初回のみ発生）

. "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/lib/common.sh"

LINKS_CONF="$ETC_DIR/links.conf"
DRY_RUN=0
UNLINK=0

while [ $# -gt 0 ]; do
  case "$1" in
    --dry-run) DRY_RUN=1 ;;
    --unlink)  UNLINK=1 ;;
    *) die "unknown option: $1" ;;
  esac
  shift
done

[ -f "$LINKS_CONF" ] || die "not found: $LINKS_CONF"

BACKUP_SUFFIX="bak.$(date +%Y%m%d%H%M%S)"
PROBLEMS=0

run() {
  if [ "$DRY_RUN" -eq 1 ]; then
    return 0
  fi
  "$@"
}

# 配置先の親ディレクトリ階層にシンボリックリンクが含まれていれば、その位置を返す。
#
# 含まれていると mkdir -p や ln がリンク先に書き込むため、意図しない場所
# （例: 別のリポジトリ）の中身を書き換えてしまう。
# 実際に ~/.vim が別リポジトリへのリンクだったとき、~/.vim/vimrc の配置で
# そのリポジトリ内のファイルを退避・置換してしまったことがある。
symlinked_ancestor() {
  local p
  p="$(dirname "$1")"
  while [ "$p" != "/" ] && [ "$p" != "." ]; do
    if [ -L "$p" ]; then
      printf '%s\n' "$p"
      return 0
    fi
    [ "$p" = "$HOME" ] && break
    p="$(dirname "$p")"
  done
  return 1
}

link_one() {
  local src="$1" dest="$2"
  local abs_src="$SRC_DIR/$src"

  if [ ! -e "$abs_src" ]; then
    log_warn "$(tilde "$dest") <- src/$src が存在しないためスキップ"
    return 0
  fi

  # 親がシンボリックリンクならリンク先を書き換えてしまうので配置しない
  local bad
  if bad="$(symlinked_ancestor "$dest")"; then
    log_fail "$(tilde "$dest") の親 $(tilde "$bad") がシンボリックリンクのため配置しません"
    log_info "        $(tilde "$bad") -> $(readlink "$bad")"
    log_info "        リンク先の中身を書き換えてしまいます。実ディレクトリにしてから再実行してください:"
    log_info "        rm $(tilde "$bad") && mkdir -p $(tilde "$bad")"
    PROBLEMS=$((PROBLEMS + 1))
    return 0
  fi

  # 既存のシンボリックリンクを確認
  if [ -L "$dest" ]; then
    if [ "$(readlink "$dest")" = "$abs_src" ]; then
      log_ok "$(tilde "$dest")"
      return 0
    fi
    log_do "$(tilde "$dest") (リンク先を張り替え)"
    run rm -f "$dest"
  elif [ -e "$dest" ]; then
    # 実ファイル / 実ディレクトリ -> 退避
    log_warn "$(tilde "$dest") は実体があるため $(tilde "$dest").$BACKUP_SUFFIX へ退避"
    run mv "$dest" "$dest.$BACKUP_SUFFIX"
    log_do "$(tilde "$dest")"
  else
    log_do "$(tilde "$dest")"
  fi

  run mkdir -p "$(dirname "$dest")"
  # -n: dest が既存ディレクトリへのシンボリックリンクでも中に潜らず置き換える
  run ln -sfn "$abs_src" "$dest"
}

unlink_one() {
  local src="$1" dest="$2"
  local abs_src="$SRC_DIR/$src"

  local bad
  if bad="$(symlinked_ancestor "$dest")"; then
    log_skip "$(tilde "$dest") (親 $(tilde "$bad") がシンボリックリンク)"
    return 0
  fi

  if [ ! -L "$dest" ]; then
    log_skip "$(tilde "$dest") (シンボリックリンクではない)"
    return 0
  fi
  if [ "$(readlink "$dest")" != "$abs_src" ]; then
    log_skip "$(tilde "$dest") (このリポジトリのリンクではない)"
    return 0
  fi
  log_do "$(tilde "$dest") を削除"
  run rm -f "$dest"
}

if [ "$UNLINK" -eq 1 ]; then
  log_header "シンボリックリンクを削除します"
else
  log_header "シンボリックリンクを配置します ($(tilde "$SRC_DIR"))"
fi
[ "$DRY_RUN" -eq 1 ] && log_info "(dry-run: 実際には変更しません)"

count=0
while read -r src dest _rest; do
  # 空行 / コメント行を飛ばす
  case "${src:-}" in
    ''|'#'*) continue ;;
  esac
  if [ -z "${dest:-}" ]; then
    log_warn "配置先が無い行を無視しました: $src"
    continue
  fi

  dest="$(expand_home "$dest")"
  if [ "$UNLINK" -eq 1 ]; then
    unlink_one "$src" "$dest"
  else
    link_one "$src" "$dest"
  fi
  count=$((count + 1))
done < "$LINKS_CONF"

log_info "$count 件を処理しました"

if [ "$PROBLEMS" -gt 0 ]; then
  log_fail "$PROBLEMS 件を配置できませんでした"
  exit 1
fi
