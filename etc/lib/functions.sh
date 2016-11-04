#!/bin/sh

if [ "${LOADED_COMMON:-0}" = 0 ]; then
    echo "cannot load common.sh" 1>&2
    return 1
fi

function composer() {
    if has "php"; then
        local composer_bin="$(which composer.phar)"
        local exec_status

        if has "phpenv"; then
            local xdebug_ini="$(phpenv root)/versions/$(phpenv version-name)/etc/conf.d/xdebug.ini"

            if [ ! -f $xdebug_ini ]; then
                $composer_bin "$@"
                exec_status=$?
            else
                mv $xdebug_ini ~/xdebug.ini
                $composer_bin "$@"
                exec_status=$?
                mv ~/xdebug.ini $xdebug_ini
            fi
        else
            # phpenv使ってなかったらどうしようか考え中
            # とりあえずはそのまま実行
            $composer_bin "$@"
            exec_status=$?
        fi

        return $exec_status
    fi

    log_fail "not install php"
    return 1
}
