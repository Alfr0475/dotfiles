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

# 既にHomebrewがインストールされてたら終了
if has "brew"; then
    log_pass "brew: already installed"
    exit
fi

# Rubyが無ければ終了
if ! has "ruby"; then
    log_fail "error: require: ruby"
    exit 1
fi

# Homebrewインストール
# たまにURLが変わるので要メンテ
/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"

if has "brew"; then
    brew doctor
else
    log_fail "error: brew: failed to install"
    exit 1
fi

log_pass "brew: installed successfully"

brew tap caskroom/cask

if is_brew_tap_install "caskroom/cask"; then
    log_pass "brew cask: installed successfully"
else
    log_fail "error: brew cask: failed to install"
    exit 1
fi
