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
#   claude-install.sh --no-cli   claude CLI の導入を試みない

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
# claude CLI（コンテナ内には入っていないことが多い）
#------------------------------------------------------------------
install_cli() {
  if command -v claude >/dev/null 2>&1; then
    log "claude CLI は既にある: $(command -v claude)"
    return 0
  fi

  if command -v npm >/dev/null 2>&1; then
    log "npm で claude CLI を導入"
    npm install -g @anthropic-ai/claude-code
  elif command -v apt-get >/dev/null 2>&1 && command -v curl >/dev/null 2>&1; then
    log "npm が無いので apt で Node.js を導入"
    curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
    sudo apt-get install -y nodejs
    npm install -g @anthropic-ai/claude-code
  elif command -v brew >/dev/null 2>&1; then
    log "npm が無いので brew で Node.js を導入"
    brew install node
    npm install -g @anthropic-ai/claude-code
  else
    warn "claude CLI を導入できなかった (npm/apt/brew が無い)。設定の配置だけ行う。"
    return 1
  fi
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

for item in CLAUDE.md settings.json skills agents; do
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
