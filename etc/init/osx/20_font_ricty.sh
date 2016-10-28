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

# formulaがインストール済みなら終了
if is_brew_tap_install "sanemat/font"; then
    log_pass "sanemat/font: already installed"
    exit
fi


# formulaインストール
brew tap 'sanemat/font'

# Rictyフォントインストール
brew install sanemat/font/ricty --vim-powerline

# フォントをコピーしてキャッシュクリア
cp -f $(brew --prefix ricty)/share/fonts/Ricty*.ttf ~/Library/Fonts/
fc-cache -vf

log_pass "Ricty font: installed successfully"
