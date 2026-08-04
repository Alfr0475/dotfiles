#!/usr/bin/env bash
#
# etc/tmux-plugins.txt に書かれた tmux プラグインを ~/.tmux/plugins/ に導入する。
#
# 冪等性:
#   - 既に clone 済みなら何もしない（更新は --update を付けたときだけ）
#   - 本体はホーム側に置くので、このリポジトリには入らない
#
#   tmux-plugins.sh              未導入のものだけ clone する
#   tmux-plugins.sh --update     導入済みのものも git pull する

. "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/lib/common.sh"

PLUGIN_LIST="$ETC_DIR/tmux-plugins.txt"
PLUGIN_DIR="$HOME/.tmux/plugins"
UPDATE=0

while [ $# -gt 0 ]; do
  case "$1" in
    --update) UPDATE=1 ;;
    *) die "unknown option: $1" ;;
  esac
  shift
done

log_header "tmux プラグイン ($(tilde "$PLUGIN_DIR"))"

[ -f "$PLUGIN_LIST" ] || die "not found: $PLUGIN_LIST"
has git || die "git が必要です"

mkdir -p "$PLUGIN_DIR"

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
  dest="$PLUGIN_DIR/$name"

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

log_info "$count 件を処理しました"
