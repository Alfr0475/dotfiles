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

run() {
  if [ "$DRY_RUN" -eq 1 ]; then
    return 0
  fi
  "$@"
}

link_one() {
  local src="$1" dest="$2"
  local abs_src="$SRC_DIR/$src"

  if [ ! -e "$abs_src" ]; then
    log_warn "$(tilde "$dest") <- src/$src が存在しないためスキップ"
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
