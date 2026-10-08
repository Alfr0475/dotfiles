#!/usr/bin/env bash
#
# src/claude/ の内容を ~/.claude/ に配置する。
#
# 用途は 2 つ:
#   1. Dev Container の dotfiles として（VS Code の
#      remote.containers.dotfiles.installCommand から呼ばれる）
#   2. 新しい Mac で Claude Code の設定を復元するとき
#
# ~/.claude は Claude Code 自身が会話ログやセッション状態を書き込む
# ディレクトリなので、ディレクトリ全体はリンクにせず中身を個別にリンクする。
# make install からは呼ばない（実環境への適用は明示的に行う）。
#
#   claude-install.sh            設定を配置する
#   claude-install.sh --no-cli   claude CLI（ネイティブ版）の導入を試みない

set -euo pipefail

# Dev Container では clone 先が ~/dotfiles になるため、common.sh に頼らず
# このスクリプトの位置から辿る（common.sh は macOS 前提の変数を持つため）。
DOTFILES_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
CLAUDE_SRC="$DOTFILES_ROOT/src/claude"
CLAUDE_DIR="$HOME/.claude"
INSTALL_CLI=1

while [ $# -gt 0 ]; do
  case "$1" in
    --no-cli) INSTALL_CLI=0 ;;
    *) echo "unknown option: $1" >&2; exit 1 ;;
  esac
  shift
done

log() { printf '[claude-install] %s\n' "$*"; }
warn() { printf '[claude-install] %s\n' "$*" >&2; }

[ -d "$CLAUDE_SRC" ] || { warn "not found: $CLAUDE_SRC"; exit 1; }

#------------------------------------------------------------------
# claude CLI（ネイティブインストール）
#------------------------------------------------------------------
# 公式インストーラで ~/.local/bin/claude に入れる。Node.js が不要で、
# 本体が自分で自動更新するため brew / npm 経由にはしない。
# 判定は ~/.local/bin/claude の有無で行う。command -v だと brew / npm 版が
# 残っているだけで「導入済み」と誤判定し、移行が進まないため。
CLAUDE_BIN="$HOME/.local/bin/claude"

install_cli() {
  if [ -x "$CLAUDE_BIN" ]; then
    log "claude CLI は既にある: $CLAUDE_BIN"
  else
    command -v curl >/dev/null 2>&1 || { warn "curl が無いため claude CLI を導入できない。設定の配置だけ行う。"; return 1; }
    log "https://claude.ai/install.sh からネイティブ版を導入"
    # インストーラを一旦落としてから実行する（何が走るか確認できるようにする）
    local installer
    installer="$(mktemp)"
    curl -fsSL https://claude.ai/install.sh -o "$installer"
    bash "$installer"
    rm -f "$installer"
    [ -x "$CLAUDE_BIN" ] || { warn "導入したが $CLAUDE_BIN が見つからない"; return 1; }
  fi

  # brew / npm 版が残っていると、PATH の順や自動更新の衝突で混乱するので知らせる。
  # アンインストールは利用中のセッションを壊しうるので自動ではやらない。
  local other
  for other in $(type -ap claude | awk '!seen[$0]++'); do
    [ "$other" = "$CLAUDE_BIN" ] && continue
    warn "ネイティブ版以外の claude が残っている: $other"
    case "$other" in
      */.homebrew/*|*/homebrew/*) warn "  -> brew uninstall --cask claude-code" ;;
      *) warn "  -> npm uninstall -g @anthropic-ai/claude-code" ;;
    esac
  done
}

if [ "$INSTALL_CLI" -eq 1 ]; then
  install_cli || true
fi

#------------------------------------------------------------------
# 設定の配置
#------------------------------------------------------------------
# ~/.claude 自体がシンボリックリンクだと、リンク先（別のリポジトリなど）の
# 中身を書き換えてしまうので配置しない。
if [ -L "$CLAUDE_DIR" ]; then
  warn "$CLAUDE_DIR はシンボリックリンクです -> $(readlink "$CLAUDE_DIR")"
  warn "リンク先の中身を書き換えてしまうため配置しません。"
  warn "実ディレクトリにしてから再実行してください:"
  warn "  rm $CLAUDE_DIR && mkdir -p $CLAUDE_DIR"
  exit 1
fi

mkdir -p "$CLAUDE_DIR"

for item in CLAUDE.md settings.json skills agents hooks; do
  src="$CLAUDE_SRC/$item"
  dest="$CLAUDE_DIR/$item"
  [ -e "$src" ] || continue

  if [ -L "$dest" ] && [ "$(readlink "$dest")" = "$src" ]; then
    log "ok      ~/.claude/$item"
    continue
  fi

  # 実体があれば退避してから張る（会話ログ等を壊さないため上書きはしない）
  if [ ! -L "$dest" ] && [ -e "$dest" ]; then
    backup="$dest.bak.$(date +%Y%m%d%H%M%S)"
    warn "~/.claude/$item は実体があるため $(basename "$backup") へ退避"
    mv "$dest" "$backup"
  fi

  ln -sfn "$src" "$dest"
  log "linked  ~/.claude/$item"
done

log "完了。Claude Code を再起動すると反映される。"
