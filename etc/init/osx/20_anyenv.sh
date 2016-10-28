#!/bin/bash

# Stop script if errors occur
trap 'echo Error: $0:$LINENO stopped; exit 1' ERR INT
set -eu

# common ライブラリ
. "$DOTPATH"/etc/lib/common.sh

if ! has "anyenv"; then
    if [ -e "${HOME}/.anyenv" ]; then
        log_fail "${HOME}/.anyenv: already exists"
        exit 1
    fi

    git clone https://github.com/riywo/anyenv "${HOME}"/.anyenv

    log_echo "Install anyenv-update"
    mkdir -p "$(anyenv root)"/plugins
    git clone https://github.com/znz/anyenv-update.git "$(anyenv root)"/plugins/anyenv-update

    log_pass "anyenv: installed successfully"
fi

# Run the forced termination with a last exit code
exit $?
