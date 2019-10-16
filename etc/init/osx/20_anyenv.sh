#!/bin/bash

# Stop script if errors occur
trap 'echo Error: $0:$LINENO stopped; exit 1' ERR INT
set -eu

# common ライブラリ
. "$DOTPATH"/etc/lib/common.sh

if has "anyenv"; then
    log_pass "anyenv: already installed"
    exit
fi

if [ -e "${HOME}/.anyenv" ]; then
    log_pass "${HOME}/.anyenv: already exists"
    exit
fi

git clone https://github.com/riywo/anyenv "${HOME}"/.anyenv

log_echo "Install anyenv-update"
mkdir -p "${HOME}"/.anyenv/plugins
git clone https://github.com/znz/anyenv-update.git "${HOME}"/.anyenv/plugins/anyenv-update

log_pass "anyenv: installed successfully"

# Run the forced termination with a last exit code
exit $?
