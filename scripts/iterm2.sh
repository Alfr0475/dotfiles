#!/usr/bin/env bash
#
# iTerm2 の設定をリポジトリと ~/.config/iterm2 の間でやり取りする。
#
# iTerm2 の PrefsCustomFolder は「plist を含むディレクトリ」を指定する方式で、
# iTerm2 自身がそのディレクトリへ書き戻す。ここでは XDG に寄せて
# ~/.config/iterm2 を本番の場所とし、リポジトリはその複製を持つ。
#
# plist をシンボリックリンクにはしない。plist の書き込みは一時ファイル +
# rename で行われることが多く、リンクが実ファイルに置き換わって静かに
# 切れるため。そのため明示的なコピーで同期する。
#
#   iterm2.sh           ブートストラップ。~/.config/iterm2 に plist が無ければ
#                       リポジトリから復元する。あれば何も変更しない（make install 用）
#   iterm2.sh --save    ~/.config/iterm2 -> リポジトリ（設定変更を取り込む）
#   iterm2.sh --load    リポジトリ -> ~/.config/iterm2（設定を復元する）
#   iterm2.sh --status  差分の有無を表示するだけ

. "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/lib/common.sh"

PLIST_NAME="com.googlecode.iterm2.plist"
REPO_DIR="$SRC_DIR/iterm2"
LIVE_DIR="$HOME/.config/iterm2"
REPO_PLIST="$REPO_DIR/$PLIST_NAME"
LIVE_PLIST="$LIVE_DIR/$PLIST_NAME"

MODE=bootstrap
while [ $# -gt 0 ]; do
  case "$1" in
    --save)   MODE=save ;;
    --load)   MODE=load ;;
    --status) MODE=status ;;
    *) die "unknown option: $1" ;;
  esac
  shift
done

log_header "iTerm2 設定 ($(tilde "$LIVE_DIR"))"

is_macos || { log_skip "macOS 以外は対象外"; exit 0; }

# plist として妥当か検証する（壊れたものを取り込まない / 配らないため）
check_plist() {
  plutil -lint "$1" >/dev/null 2>&1
}

warn_if_running() {
  if pgrep -x iTerm2 >/dev/null 2>&1; then
    log_warn "iTerm2 が起動中です。終了時にメモリ上の設定で上書きされる可能性があります"
    log_info "        確実に反映するには iTerm2 を終了してから実行してください"
  fi
}

case "$MODE" in
  save)
    [ -f "$LIVE_PLIST" ] || die "$(tilde "$LIVE_PLIST") が無い"
    check_plist "$LIVE_PLIST" || die "$(tilde "$LIVE_PLIST") が plist として不正"
    mkdir -p "$REPO_DIR"
    if [ -f "$REPO_PLIST" ] && cmp -s "$LIVE_PLIST" "$REPO_PLIST"; then
      log_ok "差分なし（取り込む変更はありません）"
    else
      cp "$LIVE_PLIST" "$REPO_PLIST"
      log_do "リポジトリに取り込みました: git diff で確認してください"
    fi
    ;;

  load)
    [ -f "$REPO_PLIST" ] || die "$(tilde "$REPO_PLIST") が無い"
    check_plist "$REPO_PLIST" || die "$(tilde "$REPO_PLIST") が plist として不正"
    warn_if_running
    mkdir -p "$LIVE_DIR"
    if [ -f "$LIVE_PLIST" ] && cmp -s "$REPO_PLIST" "$LIVE_PLIST"; then
      log_ok "差分なし（復元は不要です）"
    else
      if [ -f "$LIVE_PLIST" ]; then
        backup="$LIVE_PLIST.bak.$(date +%Y%m%d%H%M%S)"
        log_warn "既存の設定を $(basename "$backup") へ退避します"
        cp "$LIVE_PLIST" "$backup"
      fi
      cp "$REPO_PLIST" "$LIVE_PLIST"
      log_do "リポジトリから復元しました"
    fi
    ;;

  bootstrap)
    # make install から呼ばれる。既存の設定を勝手に上書きしないよう、
    # plist が無いときだけ復元する。
    if [ ! -f "$REPO_PLIST" ]; then
      log_skip "$(tilde "$REPO_PLIST") が無いためスキップ"
    elif [ ! -f "$LIVE_PLIST" ]; then
      check_plist "$REPO_PLIST" || die "$(tilde "$REPO_PLIST") が plist として不正"
      mkdir -p "$LIVE_DIR"
      cp "$REPO_PLIST" "$LIVE_PLIST"
      log_do "初回のため設定を復元しました"
    elif cmp -s "$LIVE_PLIST" "$REPO_PLIST"; then
      log_ok "リポジトリと一致"
    else
      # どちらが新しいか自動判断はしない（設定を失う方向に倒れるため）
      log_warn "リポジトリと内容が異なります（自動では変更しません）"
      log_info "        変更を取り込む: make iterm2-save"
      log_info "        設定を戻す    : make iterm2-load"
    fi
    ;;

  status)
    if [ ! -f "$LIVE_PLIST" ]; then
      log_warn "$(tilde "$LIVE_PLIST") が無い"
    elif [ ! -f "$REPO_PLIST" ]; then
      log_warn "$(tilde "$REPO_PLIST") が無い"
    elif cmp -s "$LIVE_PLIST" "$REPO_PLIST"; then
      log_ok "一致しています"
    else
      log_warn "差分があります"
      log_info "        live: $(wc -c < "$LIVE_PLIST" | tr -d ' ') bytes  $(/bin/ls -l "$LIVE_PLIST" | awk '{print $6, $7, $8}')"
      log_info "        repo: $(wc -c < "$REPO_PLIST" | tr -d ' ') bytes  $(/bin/ls -l "$REPO_PLIST" | awk '{print $6, $7, $8}')"
    fi
    ;;
esac
