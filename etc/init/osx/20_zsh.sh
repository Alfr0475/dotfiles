#!/bin/bash

# Stop script if errors occur
trap 'echo Error: $0:$LINENO stopped; exit 1' ERR INT
set -eu

# common ライブラリ
. "$DOTPATH"/etc/lib/common.sh

if ! is_brew_install "zsh"; then

    # Install zsh
    case "$(get_os)" in
        # Case of OS X
        osx)
            if has "brew"; then
                log_echo "Install zsh with Homebrew"
                brew install zsh
            else
                log_fail "error: require: Homebrew"
                exit 1
            fi

            # ログインシェルがzshじゃない場合は設定する
            if ! contains "${SHELL:-}" "zsh"; then
                zsh_path="$(which zsh)"

                if ! grep -xq "${zsh_path:=/bin/zsh}" /etc/shells; then
                    sudo echo "${zsh_path}" >> /etc/shells
                    if [ $? -eq 0 ]; then
                        log_pass "Add shell to /etc/shells for $zsh_path"
                    else
                        log_fail "Do not add shell to /etc/shells for $zsh_path"
                        exit 1
                    fi
                fi

                if [ -x "$zsh_path" ]; then
                    # Changing for a general user
                    if chsh -s "$zsh_path" "${USER:-root}"; then
                        log_pass "Change shell to $zsh_path for ${USER:-root} successfully"
                    else
                        log_fail "cannot set '$path' as \$SHELL"
                        log_fail "Is '$path' described in /etc/shells?"
                        log_fail "you should run 'chsh -l' now"
                        exit 1
                    fi
                else
                    log_fail "$zsh_path: invalid path"
                    exit 1
                fi
            fi
            ;;

        # Case of Linux
        linux)
            if has "yum"; then
                log_echo "Install zsh with Yellowdog Updater Modified"
                sudo yum -y install zsh
            elif has "apt-get"; then
                log_echo "Install zsh with Advanced Packaging Tool"
                sudo apt-get -y install zsh
            else
                log_fail "error: require: YUM or APT"
                exit 1
            fi
            ;;

        # Other platforms such as BSD are supported
        *)
            log_fail "error: this script is only supported osx and linux"
            exit 1
            ;;
    esac
fi

# Run the forced termination with a last exit code
exit $?
