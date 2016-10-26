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

# Homebrewが無ければ終了
if ! has "brew"; then
    log_fail "error: require: brew"
    exit
fi

# masインストール
brew install mas

# サインイン
mas signout
mas signin "alfr0475@gmail.com"

log_pass "mas: installed successfully"
