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

# masがインストールされてなければインストール
if ! has "mas"; then
    brew install mas
    log_pass "mas: installed successfully"
fi

mas signin 'alfr0475@gmail.com'

# App Storeでインストールする一覧を読み込む
. "$ASSETSPATH"/appstore/applist.sh

for app_id in "${APPSTORE_INSTALL_LIST[@]}"
do
    mas install $app_id
done

log_pass "App Store Apps: installed successfully"
