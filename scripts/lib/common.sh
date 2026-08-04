#!/usr/bin/env bash
# 各スクリプトから source される共通ライブラリ。
# macOS 標準の bash 3.2 で動くこと（連想配列・mapfile 等は使わない）。

set -euo pipefail

# ------------------------------------------------------------------
# パス
# ------------------------------------------------------------------
# このファイルは <リポジトリ>/scripts/lib/common.sh に置かれている前提。
#
# 環境変数を初期値に使わず必ずここで導出する。
# DOTPATH のような外から与えられた値を信用すると
# 別のリポジトリを指してしまうため。
DOTFILES_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/../.." && pwd)"
export DOTFILES_ROOT

SRC_DIR="$DOTFILES_ROOT/src"
ETC_DIR="$DOTFILES_ROOT/etc"
export SRC_DIR ETC_DIR

# ------------------------------------------------------------------
# 出力
# ------------------------------------------------------------------
if [ -t 1 ]; then
  _C_RESET=$'\033[0m'
  _C_RED=$'\033[31m'
  _C_GREEN=$'\033[32m'
  _C_YELLOW=$'\033[33m'
  _C_BLUE=$'\033[34m'
  _C_DIM=$'\033[2m'
  _C_BOLD=$'\033[1m'
else
  _C_RESET='' _C_RED='' _C_GREEN='' _C_YELLOW='' _C_BLUE='' _C_DIM='' _C_BOLD=''
fi

log_header() { printf '%s==> %s%s\n' "$_C_BOLD$_C_BLUE" "$*" "$_C_RESET"; }
log_ok()     { printf '  %sok%s      %s\n' "$_C_GREEN" "$_C_RESET" "$*"; }
log_do()     { printf '  %schanged%s %s\n' "$_C_YELLOW" "$_C_RESET" "$*"; }
log_skip()   { printf '  %sskip%s    %s\n' "$_C_DIM" "$_C_RESET" "$*"; }
log_info()   { printf '  %s\n' "$*"; }
log_warn()   { printf '  %swarn%s    %s\n' "$_C_YELLOW" "$_C_RESET" "$*" >&2; }
log_fail()   { printf '  %sfail%s    %s\n' "$_C_RED" "$_C_RESET" "$*" >&2; }
die()        { log_fail "$*"; exit 1; }

# ------------------------------------------------------------------
# ユーティリティ
# ------------------------------------------------------------------
has() { command -v "$1" >/dev/null 2>&1; }

is_macos() { [ "$(uname -s)" = "Darwin" ]; }

# `~` と `$HOME` を展開する（eval を使わない）
expand_home() {
  case "$1" in
    '~')      printf '%s\n' "$HOME" ;;
    '~/'*)    printf '%s\n' "$HOME/${1#\~/}" ;;
    '$HOME')  printf '%s\n' "$HOME" ;;
    '$HOME/'*) printf '%s\n' "$HOME/${1#\$HOME/}" ;;
    *)        printf '%s\n' "$1" ;;
  esac
}

# $HOME 配下のパスを `~/...` 表記に縮める（ログ用）
tilde() {
  case "$1" in
    "$HOME"/*) printf '~/%s\n' "${1#"$HOME"/}" ;;
    "$HOME")   printf '~\n' ;;
    *)         printf '%s\n' "$1" ;;
  esac
}

# Homebrew のインストール先（固定）
HOMEBREW_PREFIX="${HOMEBREW_PREFIX:-$HOME/.homebrew}"
BREW_BIN="$HOMEBREW_PREFIX/bin/brew"
export HOMEBREW_PREFIX BREW_BIN

# mise のインストール先（固定）
MISE_BIN="${MISE_BIN:-$HOME/.local/bin/mise}"
export MISE_BIN
