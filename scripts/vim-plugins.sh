#!/usr/bin/env bash
#
# etc/vim-plugins.txt に書かれた vim プラグインを
# ~/.vim/pack/plugins/start/ に導入する（vim 標準の packages 機能）。
#
# 冪等性:
#   - 既に clone 済みなら何もしない（更新は --update を付けたときだけ）
#   - リポジトリの中身はホーム側に置くので、このリポジトリには入らない
#
#   vim-plugins.sh              未導入のものだけ clone する
#   vim-plugins.sh --update     導入済みのものも git pull する

. "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/lib/common.sh"

PLUGIN_LIST="$ETC_DIR/vim-plugins.txt"
PACK_DIR="$HOME/.vim/pack/plugins/start"
UPDATE=0

while [ $# -gt 0 ]; do
  case "$1" in
    --update) UPDATE=1 ;;
    *) die "unknown option: $1" ;;
  esac
  shift
done

log_header "vim プラグイン ($(tilde "$PACK_DIR"))"

[ -f "$PLUGIN_LIST" ] || die "not found: $PLUGIN_LIST"
has git || die "git が必要です"

mkdir -p "$PACK_DIR"

count=0
while read -r name url _rest; do
  case "${name:-}" in
    ''|'#'*) continue ;;
  esac
  if [ -z "${url:-}" ]; then
    log_warn "URL が無い行を無視しました: $name"
    continue
  fi

  count=$((count + 1))
  dest="$PACK_DIR/$name"

  if [ -d "$dest/.git" ]; then
    if [ "$UPDATE" -eq 1 ]; then
      log_do "$name を更新"
      git -C "$dest" pull --ff-only --quiet
    else
      log_ok "$name"
    fi
  elif [ -e "$dest" ]; then
    log_warn "$name: $(tilde "$dest") が git リポジトリではないためスキップ"
  else
    log_do "$name を clone"
    git clone --quiet --depth 1 "$url" "$dest"
  fi
done < "$PLUGIN_LIST"

# ヘルプタグを貼り直す（プラグインの doc/ を :help から引けるようにする）
if has vim && [ "$count" -gt 0 ]; then
  for doc in "$PACK_DIR"/*/doc; do
    [ -d "$doc" ] || continue
    vim -u NONE --not-a-term -c "helptags $doc" -c 'qa!' >/dev/null 2>&1 || true
  done
fi

log_info "$count 件を処理しました"
