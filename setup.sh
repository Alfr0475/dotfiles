#!/bin/bash

#----------------------------------------------------------------------------
# Configure
#----------------------------------------------------------------------------
RES_COL=60
COMMENT_COL=70
MOVE_TO_COL="echo -en \\033[${RES_COL}G"
SETCOLOR_SUCCESS="echo -en \\033[1;32m"
SETCOLOR_FAILURE="echo -en \\033[1;31m"
SETCOLOR_WARNING="echo -en \\033[1;33m"
SETCOLOR_NORMAL="echo -en \\033[0;39m"
MOVE_TO_COMMENT_COL="echo -en \\033[${COMMENT_COL}G"
DOTFILES=( '.bashrc' '.bash_profile' '.gitconfig' '.vimrc' '.tigrc' '.zshrc' '.zshenv' '.tmux.conf' '.tmux-powerlinerc')

#----------------------------------------------------------------------------
# Common関数群
#----------------------------------------------------------------------------
function echo_success() {
    $MOVE_TO_COL
    echo -n "["
    $SETCOLOR_SUCCESS
    echo -n $"  OK  "
    $SETCOLOR_NORMAL
    echo -n "]"
    echo -ne "\r"
    return 0
}

function echo_failure() {
    $MOVE_TO_COL
    echo -n "["
    $SETCOLOR_FAILURE
    echo -n $"FAILED"
    $SETCOLOR_NORMAL
    echo -n "]"
    echo -ne "\r"
    return 0
}

function echo_passed() {
    $MOVE_TO_COL
    echo -n "["
    $SETCOLOR_WARNING
    echo -n $"PASSED"
    $SETCOLOR_NORMAL
    echo -n "]"
    echo -ne "\r"
    return 0
}

function echo_warning() {
    $MOVE_TO_COL
    echo -n "["
    $SETCOLOR_WARNING
    echo -n $"WARNING"
    $SETCOLOR_NORMAL
    echo -n "]"
    echo -ne "\r"
    return 0
}

function echo_comment() {
    $MOVE_TO_COMMENT_COL
    echo -n $1
    echo -ne "\r"
    return 0
}

#----------------------------------------------------------------------------
# 引数解析
#----------------------------------------------------------------------------
USAGE="Usage: `basename $0` [clear]"
SUBCOMMAND=0

if [ $1 ]; then
    SUBCOMMAND=1
fi


#----------------------------------------------------------------------------
# 初期化処理
#----------------------------------------------------------------------------
function clear_files() {
    for file in ${DOTFILES[@]}
    do
        echo -n "remove: $file"
        if [ -L $HOME/$file ]; then
            rm -f $HOME/$file
            echo_success
            echo
        elif [ -L $HOME/$file.dot ]; then
            rm -f $HOME/$file.dot
            echo_success
            echo
        else
            echo_passed
            echo
        fi
    done

    echo -n "remove: $HOME/.vim"
    if [ -e $HOME/.vim ]; then
        rm -rf $HOME/.vim
        echo_success
        echo
    else
        echo_passed
        echo
    fi

    echo -n "remove: $HOME/.zsh.d"
    if [ -e $HOME/.zsh.d ]; then
        rm -rf $HOME/.zsh.d
        echo_success
        echo
    else
        echo_passed
        echo
    fi

    echo -n "remove: $HOME/.tmux.d"
    if [ -e $HOME/.tmux.d ]; then
        rm -rf $HOME/.tmux.d
        echo_success
        echo
    else
        echo_passed
        echo
    fi

    echo -n "remove: $HOME/.tmuxinator"
    if [ -e $HOME/.tmuxinator ]; then
        rm -rf $HOME/.tmuxinator
        echo_success
        echo
    else
        echo_passed
        echo
    fi

    echo -n "remove: $HOME/.emacs.d"
    if [ -e $HOME/.emacs.d ]; then
        rm -rf $HOME/.emacs.d
        echo_success
        echo
    else
        echo_passed
        echo
    fi

    echo -n "remove: $HOME/contrib"
    if [ -e $HOME/contrib ]; then
        rm -rf $HOME/contrib
        echo_success
        echo
    else
        echo_passed
        echo
    fi

    echo -n "remove: $HOME/data"
    if [ -e $HOME/data ]; then
        rm -rf $HOME/data
        echo_success
        echo
    else
        echo_passed
        echo
    fi
}


#----------------------------------------------------------------------------
# dotファイル設定
#----------------------------------------------------------------------------
function setup_dotfiles() {
    for file in ${DOTFILES[@]}
    do
        echo -n $file
        if [ -e $HOME/$file ]; then
            if ! [ -L $HOME/$file ]; then
                if ! [ -e $HOME/$file.dot ]; then
                    echo_passed
                    ln -s $HOME/dotfiles/$file $HOME/$file.dot
                    echo_comment "Exists file. So much so that create .dot file.: $file.dot"
                    echo
                else
                    echo_passed
                    echo_comment "Exists file."
                    echo
                fi
            else
                echo_passed
                echo_comment "Exists file."
                echo
            fi
        else
            echo_success
            echo
            ln -s $HOME/dotfiles/$file $HOME/$file
        fi
    done
}


#----------------------------------------------------------------------------
# Git設定
#----------------------------------------------------------------------------
function setup_git_completion() {
    echo -n "git-completion.bash"

    if ! [ -x "`which wget`" ]; then
        echo_passed
        echo_comment "Not install wget."
        echo
        return
    fi

    # 外部提供のスクリプト置き場作成
    if ! [ -e $HOME/contrib ]; then
        mkdir $HOME/contrib
    fi

    if ! [ -e $HOME/contrib/git-completion.bash ]; then
        wget -O $HOME/contrib/git-completion.bash https://raw.githubusercontent.com/git/git/master/contrib/completion/git-completion.bash --no-check-certificate 2>/dev/null
        if [ $? -eq 0 ]; then
            echo_success
            echo
        else
            echo_failure
            echo
        fi
    else
        echo_passed
        echo_comment "Exists file."
        echo
    fi
}


#----------------------------------------------------------------------------
# Bash拡張設定
#----------------------------------------------------------------------------
function setup_preexec() {
    echo -n "preexec.bash"

    if ! [ -x "`which wget`" ]; then
        echo_passed
        echo_comment "Not install wget."
        echo
        return
    fi

    # 外部提供のスクリプト置き場作成
    if ! [ -e $HOME/contrib ]; then
        mkdir $HOME/contrib
    fi

    if ! [ -e $HOME/contrib/preexec.bash ]; then
        wget -O $HOME/contrib/preexec.bash http://www.twistedmatrix.com/users/glyph/preexec.bash.txt 2>/dev/null
        if [ $? -eq 0 ]; then
            echo_success
            echo
        else
            echo_failure
            echo
        fi
    else
        echo_passed
        echo_comment "Exists file."
        echo
    fi
}


#----------------------------------------------------------------------------
# zsh設定
#----------------------------------------------------------------------------
function setup_zsh() {
    echo -n "Cloning into '$HOME/.zsh.d'..."

    if ! [ -x "`which git`" ]; then
        echo_passed
        echo_comment "Not install git."
        echo
        return
    fi

    if [ -e $HOME/.zsh.d ]; then
        if ! [ -e $HOME/.zsh.d/.git ]; then
            rm -rf $HOME/.zsh.d
        else
            echo_passed
            echo_comment "$HOME/.zsh.d was clone already."
            echo
            return
        fi
    fi

    # GitHubからzsh設定をclone
    if ! [ -e $HOME/.zsh.d ]; then
        git clone https://github.com/Alfr0475/zsh.d.git $HOME/.zsh.d 1>/dev/null 2>/dev/null
        if [ $? -eq 0 ]; then
            echo_success
            echo
        else
            echo_failure
            echo
        fi
    else
        echo_passed
        echo_comment "Exists file."
        echo
    fi
}


#----------------------------------------------------------------------------
# tmux設定
#----------------------------------------------------------------------------
function setup_tmux() {
    echo -n "Cloning into '$HOME/.tmux.d'..."

    if ! [ -x "`which git`" ]; then
        echo_passed
        echo_comment "Not install git."
        echo
        return
    fi

    if [ -e $HOME/.tmux.d ]; then
        if ! [ -e $HOME/.tmux.d/.git ]; then
            rm -rf $HOME/.tmux.d
        else
            echo_passed
            echo_comment "$HOME/.tmux.d was clone already."
            echo
            initialize_tmux
            return
        fi
    fi

    # GitHubからtmux設定をclone
    if ! [ -e $HOME/.tmux.d ]; then
        git clone https://github.com/Alfr0475/tmux.d.git $HOME/.tmux.d 1>/dev/null 2>/dev/null
        if [ $? -eq 0 ]; then
            echo_success
            echo
            initialize_tmux
        else
            echo_failure
            echo
        fi
    else
        echo_passed
        echo_comment "Exists file."
        echo
    fi
}


function initialize_tmux() {
    echo -n "Initialize tmux..."

    if ! [ -x "`which git`" ]; then
        echo_passed
        echo_comment "Not install git."
        echo
        return
    fi

    if [ -e $HOME/.tmux.d/tmux-powerline/.git ]; then
        echo_passed
        echo_comment "$HOME/.tmux.d/tmux-powerline was clone already."
        echo
    else
        (cd $HOME/.tmux.d/tmux-powerline && git submodule update --init) 1>/dev/null 2>/dev/null
        echo_success
        echo
    fi
}


#----------------------------------------------------------------------------
# tmuxinator設定
#----------------------------------------------------------------------------
function setup_tmuxinator() {
    echo -n "Cloning into '$HOME/.tmuxinator'..."

    if ! [ -x "`which git`" ]; then
        echo_passed
        echo_comment "Not install git."
        echo
        return
    fi

    if [ -e $HOME/.tmuxinator ]; then
        if ! [ -e $HOME/.tmuxinator/.git ]; then
            rm -rf $HOME/.tmuxinator
        else
            echo_passed
            echo_comment "$HOME/.tmuxinator was clone already."
            echo
            initialize_tmuxinator
            return
        fi
    fi

    # GitHubからtmuxinator設定をclone
    if ! [ -e $HOME/.tmuxinator ]; then
        git clone https://github.com/Alfr0475/tmuxinator.d.git $HOME/.tmuxinator 1>/dev/null 2>/dev/null
        if [ $? -eq 0 ]; then
            echo_success
            echo
            initialize_tmuxinator
        else
            echo_failure
            echo
        fi
    else
        echo_passed
        echo_comment "Exists file."
        echo
    fi
}


function initialize_tmuxinator() {
    echo -n "Initialize tmuxinator..."

    if ! [ -x "`which git`" ]; then
        echo_passed
        echo_comment "Not install git."
        echo
        return
    fi

    if [ -e $HOME/.tmuxinator/tmuxinator/.git ]; then
        echo_passed
        echo_comment "$HOME/.tmuxinator/tmuxinator was clone already."
        echo
    else
        (cd $HOME/.tmuxinator/tmuxinator && git submodule update --init) 1>/dev/null 2>/dev/null
        echo_success
        echo
    fi
}


#----------------------------------------------------------------------------
# Emacs設定
#----------------------------------------------------------------------------
function setup_emacs() {
    echo -n "Cloning into '$HOME/.emacs.d'..."

    if ! [ -x "`which git`" ]; then
        echo_passed
        echo_comment "Not install git."
        echo
        return
    fi

    # 既に設定ファイルが存在していたら削除
    if [ -e $HOME/.emacs ]; then
        rm -f $HOME/.emacs
    fi

    if [ -e $HOME/.emacs.d ]; then
        if ! [ -e $HOME/.emacs.d/.git ]; then
            rm -rf $HOME/.emacs.d
        else
            echo_passed
            echo_comment "$HOME/.emacs.d was clone already."
            echo
            return
        fi
    fi

    # GitHubからEmacs設定をclone
    if ! [ -e $HOME/.emacs.d ]; then
        git clone https://github.com/Alfr0475/Emacs.git $HOME/.emacs.d 1>/dev/null 2>/dev/null
        if [ $? -eq 0 ]; then
            echo_success
            echo
        else
            echo_failure
            echo
        fi
    else
        echo_passed
        echo_comment "Exists file."
        echo
    fi
}


#----------------------------------------------------------------------------
# Vim設定
#----------------------------------------------------------------------------
function setup_vim() {
    echo -n "Cloning into '$HOME/.vim'..."

    if ! [ -x "`which git`" ]; then
        echo_passed
        echo_comment "Not install git."
        echo
        return
    fi

    if [ -e $HOME/.vim ]; then
        if ! [ -e $HOME/.vim/.git ]; then
            rm -rf $HOME/.vim
        else
            echo_passed
            echo_comment "$HOME/.vim was clone already."
            echo
            return
        fi
    fi

    # GitHubからVim設定をclone
    if ! [ -e $HOME/.vim ]; then
        git clone https://github.com/Alfr0475/Vim.git $HOME/.vim 1>/dev/null 2>/dev/null
        if [ $? -eq 0 ]; then
            (cd $HOME/.vim && git submodule init 1>/dev/null 2>/dev/null)
            (cd $HOME/.vim && git submodule update 1>/dev/null 2>/dev/null)
            echo_success
            echo
        else
            echo_failure
            echo
        fi
    else
        echo_passed
        echo_comment "Exists file."
        echo
    fi
}


#----------------------------------------------------------------------------
# Ruby設定
#----------------------------------------------------------------------------
function setup_rsense() {
    echo -n "Setup rsense ..."

    if ! [ -x "`which wget`" ]; then
        echo_passed
        echo_comment "Not install wget."
        echo
        return
    fi

    # RSense
    if ! [ -e $HOME/contrib/rsense ]; then
        wget -O $HOME/contrib/rsense-0.3.tar.bz2 http://cx4a.org/pub/rsense/rsense-0.3.tar.bz2 2>/dev/null
        if [ $? -ne 0 ]; then
            echo_failure
            echo
            return
        fi

        (cd $HOME/contrib && tar jxfp $HOME/contrib/rsense-0.3.tar.bz2) 1>/dev/null
        if [ $? -ne 0 ]; then
            echo_failure
            echo
            return
        fi

        mv $HOME/contrib/rsense-0.3 $HOME/contrib/rsense
        rm -rf $HOME/contrib/rsense-0.3.tar.bz2

        echo_success
        echo
    else
        echo_passed
        echo_comment "Exists file."
        echo
    fi
}


#----------------------------------------------------------------------------
# rurema設定
#----------------------------------------------------------------------------
function setup_rurema() {
    echo -n "Setup rurema ..."

    if ! [ -x "`which wget`" ]; then
        echo_passed
        echo_comment "Not install wget."
        echo
        return
    fi

    # Rubyリファレンスのダウンロード
    if ! [ -e $HOME/data/rurema ]; then
        mkdir -p $HOME/data/rurema
    fi

    if ! [ -e $HOME/data/rurema/ruby-refm-1.9.3-dynamic-20120829 ]; then
        wget -O $HOME/data/rurema/ruby-refm-1.9.3-dynamic-20120829.tar.gz http://cache.ruby-lang.org/pub/ruby/doc/ruby-refm-1.9.3-dynamic-20120829.tar.gz 2>/dev/null
        if [ $? -ne 0 ]; then
            echo_failure
            echo
            return
        fi

        (cd $HOME/data/rurema && tar zxfp $HOME/data/rurema/ruby-refm-1.9.3-dynamic-20120829.tar.gz) 1>/dev/null
        if [ $? -ne 0 ]; then
            echo_failure
            echo
            return
        fi

        rm -rf $HOME/data/rurema/ruby-refm-1.9.3-dynamic-20120829.tar.gz 2>/dev/null

        echo_success
        echo
    else
        echo_passed
        echo_comment "Exists file."
        echo
    fi
}


#----------------------------------------------------------------------------
# サブコマンド処理
#----------------------------------------------------------------------------
function clear() {
    clear_files
}

function default() {
    setup_dotfiles
    setup_git_completion
    setup_preexec
    setup_zsh
    setup_tmux
    setup_tmuxinator
    setup_emacs
    setup_vim
    setup_rsense
    setup_rurema
}


#----------------------------------------------------------------------------
# サブコマンド分岐
#----------------------------------------------------------------------------
if [ $SUBCOMMAND -eq 1 ]; then
    case $1 in
        "clear" )
            clear
            exit 0
            ;;
        * )
            echo "$USAGE"
            exit 1
            ;;
    esac
else
    default
    exit 0
fi
