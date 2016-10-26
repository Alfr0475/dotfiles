#!/bin/bash

# Stop script if errors occur
trap 'echo Error: $0:$LINENO stopped; exit 1' ERR INT
set -eu

# common ライブラリ
. "$DOTPATH"/etc/lib/common.sh

# OSXのみ
if ! is_osx; then
    log_fail "error: this script is only supported with osx"
    exit 1
fi

# Homebrewがインストールされてなければ終了
if ! has "brew"; then
    log_fail "error: require: brew"
    exit 1
fi

brew bundle --file="${ASSETPATH}"/homebrew/Brewfile

log_pass "brew bundle: installed successfully"
