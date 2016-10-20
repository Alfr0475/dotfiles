#------------------------------------------------------------------------------
# パス設定
#------------------------------------------------------------------------------
#   typeset
#    -U 重複パスを登録しない
#    -x exportも同時に行う
#    -T 環境変数へ紐付け
#
#   path=xxxx(N-/)
#     (N-/): 存在しないディレクトリは登録しない
#     パス(...): ...という条件にマッチするパスのみ残す
#        N: NULL_GLOBオプションを設定。
#           globがマッチしなかったり存在しないパスを無視する
#        -: シンボリックリンク先のパスを評価
#        /: ディレクトリのみ残す
#        .: 通常のファイルのみ残す

# 重複パスを登録しない
typeset -U path cdpath fpath manpath

if [ `uname` = "Linux" ]; then
elif [ `uname` = "Darwin" ]; then
    fpath=($(brew --prefix)/share/zsh/site-functions ~/.zsh.d/completions(N-/) ~/.tmuxinator/completions(N-/) $fpath)
    #path=($(brew --prefix coreutils)/libexec/gnubin(N-/) $GOPATH/bin(N-/) ~/bin(N-/) /usr/local/bin(N-/) $COCOS_CONSOLE_ROOT $COCOS_TEMPLATES_ROOT $path)
    path=($GOPATH/bin(N-/) ~/bin(N-/) ~/localbin(N-/) /usr/local/bin(N-/) $COCOS_CONSOLE_ROOT $COCOS_TEMPLATES_ROOT $JAVA_HOME/bin(N-/) $path)
fi



#---------------------------------------
# zplug
#---------------------------------------
if [ -f $ZPLUG_HOME/init.zsh ]; then
    source $ZPLUG_HOME/init.zsh
fi

# zsh-completions
zplug "zsh-users/zsh-completions"

# enhancd
zplug "b4b4r07/enhancd", use:init.sh

# zsh-syntax-highlighting
zplug "zsh-users/zsh-syntax-highlighting", nice:10

if ! zplug check --verbose; then
    printf "Install? [y/N]: "
    if read -q; then
        echo; zplug install
    fi
fi

zplug load --verbose

#------------------------------------------------------------------------------
# 基本
#------------------------------------------------------------------------------
# zshのバージョン判定を使う
autoload -Uz is-at-least

# Emacsライクな操作を有効にする
# Vi ライクな操作の場合は`bindkey -v`とする
bindkey -e

# ビープ音を鳴らさない
setopt nobeep

# Ctrl+S/Ctrl+Qを無効化
setopt NO_flow_control

#------------------------------------------------------------------------------
# ヒストリ
#------------------------------------------------------------------------------
# ヒストリのファイル名
HISTFILE=~/.zsh_history

# 現在の履歴数
HISTSIZE=1000000

# 保存する履歴数
SAVEHIST=1000000

# コマンドがスペースで始まる場合、コマンド履歴に追加しない
setopt hist_ignore_space

# 入力したコマンドが既にコマンド履歴に含まれる場合、履歴から古い方のコマンドを削除する
setopt hist_ignore_all_dups

# ヒストリを共有
setopt share_history

# historyコマンドをヒストリから取り除く
setopt hist_no_store

# historyからコマンドを検索する
# git add[Ctrl+P or Ctrl+N]でgit addから始まるコマンドをhistoryから順に検索する
autoload history-search-end
zle -N history-beginning-search-backward-end history-search-end
zle -N history-beginning-search-forward-end history-search-end
bindkey "^P" history-beginning-search-backward-end
bindkey "^N" history-beginning-search-forward-end

# Ctrl + r のhistoryをpeco対応にする
function __peco-select-history() {
    local tac
    if which tac > /dev/null; then
        tac="tac"
    else
        tac="tail -r"
    fi
    BUFFER=$(\history -n 1 | eval $tac | peco --query "$LBUFFER")
    CURSOR=$#BUFFER
    zle clear-screen
}
zle -N __peco-select-history
bindkey '^r' __peco-select-history

#------------------------------------------------------------------------------
# 補完
#------------------------------------------------------------------------------
# 入力しているコマンド名が間違っている場合にもしかして：を出す。
#setopt correct

# タブによるファイルの順番切り替えをしない
unsetopt auto_menu

# 入力したコマンドが存在せず、かつディレクトリ名と一致するなら、ディレクトリにcdする
setopt auto_cd

# cd した先のディレクトリをディレクトリスタックに追加する
setopt auto_pushd

# pushd した時に、ディレクトリが既にスタックに含まれていればスタックに追加しない
setopt pushd_ignore_dups

# 拡張 glob を有効にする
setopt extended_glob

# ディレクトリ名の補完で末尾の / を自動的に付加し、次の補完に備える
#setopt auto_param_slash

# カッコの対応などを自動的に補完
setopt auto_param_keys

# ファイル名の展開でディレクトリにマッチした場合 末尾に / を付加
setopt mark_dirs

# 補完候補一覧でファイルの種別を識別マーク表示 (訳注:ls -F の記号)
setopt list_types

# コマンドラインでも # 以降をコメントと見なす
#setopt interactive_comments

# コマンドラインの引数で --prefix=/usr などの = 以降でも補完できる
setopt magic_equal_subst

# 語の途中でもカーソル位置で補完
setopt complete_in_word

# カーソル位置は保持したままファイル名一覧を順次その場で表示
setopt always_last_prompt

# 日本語ファイル名等8ビットを通す
setopt print_eight_bit

# 明確なドットの指定なしで.から始まるファイルをマッチ
setopt globdots

# 補完候補を詰めて表示する設定
setopt list_packed

# 補完候補表示の時にbeep音を鳴らさない
setopt nolistbeep

# 先方予測機能を有効に
# autoload -U predict-on
# predict-on

# カーソルによる補完候補の選択を有効化
zstyle ':completion:*:default' menu select=2

# 色指定にLS_COLORSを使用
zstyle ':completion:*:default' list-colors ${(s.:.)LS_COLORS}

# 除外設定
zstyle ':completion:*:*files' ignored-patterns '*?~' '*\#'

# 補完候補のキャッシュ
zstyle ':completion:*' use-cache true


# #---------------------------------------
# # auto-fu.zsh
# #---------------------------------------
# if [ -f $HOME/.zsh.d/modules/auto-fu.zsh/auto-fu.zsh ]; then
#     source $HOME/.zsh.d/modules/auto-fu.zsh/auto-fu.zsh
#     function zle-line-init () {
#         auto-fu-init
#     }
#     zle -N zle-line-init
#     zstyle ':completion:*' completer _oldlist _complete
#     # 「-azfu-」を表示させない
#     zstyle ':auto-fu:var' postdisplay $''
# fi

# # http://d.hatena.ne.jp/tarao/20100823/1282543408
# # delete unambiguous prefix when accepting line
# function afu+delete-unambiguous-prefix () {
#     afu-clearing-maybe
#     local buf; buf="$BUFFER"
#     local bufc; bufc="$buffer_cur"
#     [[ -z "$cursor_new" ]] && cursor_new=-1
#     [[ "$buf[$cursor_new]" == ' ' ]] && return
#     [[ "$buf[$cursor_new]" == '/' ]] && return
#     ((afu_in_p == 1)) && [[ "$buf" != "$bufc" ]] && {
#         # there are more than one completion candidates
#         zle afu+complete-word
#         [[ "$buf" == "$BUFFER" ]] && {
#             # the completion suffix was an unambiguous prefix
#             afu_in_p=0; buf="$bufc"
#         }
#         BUFFER="$buf"
#         buffer_cur="$bufc"
#     }
# }
# zle -N afu+delete-unambiguous-prefix
# function afu-ad-delete-unambiguous-prefix () {
#     local afufun="$1"
#     local code; code=$functions[$afufun]
#     eval "function $afufun () { zle afu+delete-unambiguous-prefix; $code }"
# }
# afu-ad-delete-unambiguous-prefix afu+accept-line
# afu-ad-delete-unambiguous-prefix afu+accept-line-and-down-history
# afu-ad-delete-unambiguous-prefix afu+accept-and-hold


#---------------------------------------
# 補完候補の追加
#---------------------------------------
# rbenv
if is-at-least 4.3.10 && [ -d $HOME/.rbenv/completions/rbenv.zsh ]; then
    fpath=($HOME/.rbenv/completions/rbenv.zsh $fpath)
fi

# 補完機能の初期化
autoload -Uz compinit
compinit -d $HOME/.zsh.d/tmp/$USER-zcompdump

#------------------------------------------------------------------------------
# プロンプト
#------------------------------------------------------------------------------
# 色を使う
# 基本色: 0:black、1:red、2:green、3:yellow、4:blue、5:magenta、6:cyan、7:white
# 8以降は数値指定
autoload -Uz colors

# zshのvcs_infoを使う
autoload -Uz vcs_info

# zshのhookを使う
autoload -Uz add-zsh-hook


# 以下の3つのメッセージをエクスポートする
#   $vcs_info_msg_0_ : 通常メッセージ用 (緑)
#   $vcs_info_msg_1_ : 警告メッセージ用 (黄色)
#   $vcs_info_msg_2_ : エラーメッセージ用 (赤)
zstyle ':vcs_info:*' max-exports 3


# 対応するVCSを定義
zstyle ':vcs_info:*' enable git svn hg cvs bzr


# 標準のフォーマット(git 以外で使用する)
zstyle ':vcs_info:*' formats '(%s)-[%b]'
zstyle ':vcs_info:*' actionformats '(%s)-[%b]' '%m' '<!%a>'
zstyle ':vcs_info:(svn|bzr|cvs):*' branchformat '%b:r%r'
zstyle ':vcs_info:bzr:*' use-simple true

if is-at-least 4.3.10; then
    # git用のフォーマット
    # gitの時はステージしているかどうかを表示
    zstyle ':vcs_info:git:*' formats '(%s)-[%b]' '%c%u %m'
    zstyle ':vcs_info:git:*' actionformats '(%s)-[%b]' '%c%u %m' '<!%a>'
    zstyle ':vcs_info:git:*' check-for-changes true
    zstyle ':vcs_info:git:*' stagedstr "+"    # %c で表示する文字列
    zstyle ':vcs_info:git:*' unstagedstr "-"  # %u で表示する文字列
fi

# hooks 設定
if is-at-least 4.3.11; then
    # git のときはフック関数を設定する

    # formats '(%s)-[%b]' '%c%u %m' , actionformats '(%s)-[%b]' '%c%u %m' '<!%a>'
    # のメッセージを設定する直前のフック関数
    # 今回の設定の場合はformat の時は2つ, actionformats の時は3つメッセージがあるので
    # 各関数が最大3回呼び出される。
    zstyle ':vcs_info:git+set-message:*' hooks \
                                            git-hook-begin \
                                            git-untracked \
                                            git-push-status \
                                            git-stash-count

    # フックの最初の関数
    # git の作業コピーのあるディレクトリのみフック関数を呼び出すようにする
    # (.git ディレクトリ内にいるときは呼び出さない)
    # .git ディレクトリ内では git status --porcelain などがエラーになるため
    function +vi-git-hook-begin() {
        if [[ $(command git rev-parse --is-inside-work-tree 2> /dev/null) != 'true' ]]; then
            # 0以外を返すとそれ以降のフック関数は呼び出されない
            return 1
        fi

        return 0
    }

    # untracked ファイル表示
    #
    # untracked ファイル(バージョン管理されていないファイル)がある場合は
    # unstaged (%u) に ? を表示
    function +vi-git-untracked() {
        # zstyle formats, actionformats の2番目のメッセージのみ対象にする
        if [[ "$1" != "1" ]]; then
            return 0
        fi

        if command git status --porcelain 2> /dev/null \
            | awk '{print $1}' \
            | command grep -F '??' > /dev/null 2>&1 ; then

            # unstaged (%u) に追加
            hook_com[unstaged]+='?'
        fi
    }

    # push していないコミットの件数表示
    #
    # リモートリポジトリに push していないコミットの件数を
    # pN という形式で misc (%m) に表示する
    function +vi-git-push-status() {
        # zstyle formats, actionformats の2番目のメッセージのみ対象にする
        if [[ "$1" != "1" ]]; then
            return 0
        fi

        if [[ "${hook_com[branch]}" != "master" ]]; then
            # master ブランチでない場合は何もしない
            return 0
        fi

        # push していないコミット数を取得する
        local ahead
        ahead=$(command git rev-list origin/master..master 2>/dev/null \
            | wc -l \
            | tr -d ' ')

        if [[ "$ahead" -gt 0 ]]; then
            # misc (%m) に追加
            hook_com[misc]+="(p${ahead})"
        fi
    }


    # stash 件数表示
    #
    # stash している場合は :SN という形式で misc (%m) に表示
    function +vi-git-stash-count() {
        # zstyle formats, actionformats の2番目のメッセージのみ対象にする
        if [[ "$1" != "1" ]]; then
            return 0
        fi

        local stash
        stash=$(command git stash list 2>/dev/null | wc -l | tr -d ' ')
        if [[ "${stash}" -gt 0 ]]; then
            # misc (%m) に追加
            hook_com[misc]+=":S${stash}"
        fi
    }
fi


# 表示毎にPROMPTで設定されている文字列を評価する
setopt prompt_subst

# 常に最後の行のみ右プロンプトを表示する
setopt transient_rprompt

# 左側のプロンプトを構成する関数
function __left_prompt {
    local formatted_upper_prompt="`__prompt_get_path`"$'\n'
    local formatted_under_prompt="`__prompt_get_user`@`__prompt_get_host`"

    local formatted_tmux_display="`__prompt_get_tmux_display`"
    if [ -n "$formatted_tmux_display" ]; then
        formatted_under_prompt="$formatted_under_prompt $formatted_tmux_display"
    fi

    formatted_under_prompt="$formatted_under_prompt `__prompt_get_mark`"
    local formatted_prompt=" $formatted_upper_prompt$formatted_under_prompt "

    # 左側のプロンプト
    PROMPT="$formatted_prompt"
}

# 右側のプロンプトを構成する関数
function __right_prompt {
    local formatted_prompt="`__prompt_get_vcs_info_msg`"

    # 右側のプロンプト
    RPROMPT="$formatted_prompt"
}

#---------------------------------------
# 各種要素を構成する関数
#---------------------------------------
# カレントディレクトリ
function __prompt_get_path {
    echo "%F{012}[%~]%f"
}

# ユーザー名
function __prompt_get_user {
    echo "%n"
}

# ホスト名
function __prompt_get_host {
    echo "%m"
}

# プロンプトマーク
function __prompt_get_mark {
    # %(,,)はif...then...else..の意味
    # !はここでは特権ユーザーの判定
    # %B...%bは太字
    # ?はここでは直前のコマンドの返り値
    # %F{color}...%fは色の変更
    echo "%B%(?,%F{green},%F{red})%(!,#,$)%f%b"
}

# VCS情報
function __prompt_get_vcs_info_msg {
    local -a messages

    LANG=en_US.UTF-8 vcs_info

    if [[ -z ${vcs_info_msg_0_} ]]; then
        # vcs_info で何も取得していない場合はプロンプトを表示しない
        echo ""
    else
        # vcs_info で情報を取得した場合
        # $vcs_info_msg_0_ , $vcs_info_msg_1_ , $vcs_info_msg_2_ を
        # それぞれ緑、黄色、赤で表示する
        [[ -n "$vcs_info_msg_0_" ]] && messages+=( "%F{green}${vcs_info_msg_0_}%f" )
        [[ -n "$vcs_info_msg_1_" ]] && messages+=( "%F{yellow}${vcs_info_msg_1_}%f" )
        [[ -n "$vcs_info_msg_2_" ]] && messages+=( "%F{red}${vcs_info_msg_2_}%f" )

        # 間にスペースを入れて連結する
        echo "${(j: :)messages}"
    fi
}

# tmux情報
function __prompt_get_tmux_display {
    if [ -n "$TMUX" ]; then
        echo "%F{blue}`tmux display -p "#I-#P"`%f"
    fi
}

add-zsh-hook precmd __left_prompt
add-zsh-hook precmd __right_prompt

#------------------------------------------------------------------------------
# ユーティリティ
#------------------------------------------------------------------------------
if [ -e $HOME/.zsh.d/zshfunction ]; then
    source $HOME/.zsh.d/zshfunction
fi

#------------------------------------------------------------------------------
# エイリアス
#------------------------------------------------------------------------------
if [ `uname` = "Linux" ]; then
    alias ll="ls -l --color=tty"
    alias la="ls -al --color=tty"
elif [ `uname` = "Darwin" ]; then
    if which gls > /dev/null; then
        alias ls="gls"
        alias ll="ls -l --color=tty"
        alias la="ls -al --color=tty"
    else
        alias ll="ls -lG"
        alias la="ls -alG"
    fi

    alias emacs='emacsclient -nw -a ""'
    alias emacskill='emacsclient -e "(kill-emacs)"'

    alias vi="vim"
    alias grep="grep --color"
    alias updatedb="sudo /usr/libexec/locate.updatedb"

    if which dfc > /dev/null; then
        alias df="dfc"
    fi

    if which trash > /dev/null; then
        alias rm="trash"
    fi

    # anyenvの設定
    if [ -d $HOME/.anyenv ]; then
        path=($HOME/.anyenv/bin(N-/) $path)
        eval "$(anyenv init -)"
        for D in `ls $HOME/.anyenv/envs`
        do
            path=($HOME/.anyenv/envs/$D/shims(N-/) $path)
        done
    fi

    if which peco > /dev/null; then
        alias pg='cd $(ghq list -p | peco --prompt "REPOSITORY >" --query "$LBUFFER")'

        # Git系便利コマンド peco Ver.
        alias -g B='`git branch -a | peco --prompt "GIT BRANCH >" | head -n 1 | sed -e "s/^\*\s*//g"`'
        alias -g R='`git remote | peco --prompt "GIT REMOTE >" | head -n 1`'
    fi

    #---------------------------------------
    # ssh
    #---------------------------------------
    # 背景を変える
    # if [ -f $HOME/bin/ssh_change_bgcolor ]; then
    #     alias ssh="ssh_change_bgcolor"
    # fi

    # プロファイルを変える
    # if [ -f $HOME/bin/ssh_change_profile ]; then
    #     alias ssh="ssh_change_profile"
    # fi

    # Utilityのalias
    alias look="__look"
    alias title="__title"
    alias tmux_powerline_theme="__tmux_powerline_theme"
    alias printpath="__printpath"
    alias loopwatch="__loopwatch"
    alias update-fork-repository-git="__update-fork-repository-git"
    alias tmux-pbcopy="__tmux_pbcopy"
    alias showzshoptions="__showzshoptions"
    alias color256="__color256"
    alias color16="__color16"
    alias snowfall="__snowfall"
    alias matrix="__matrix"
    alias tramp='emacsclient -n /ssh:$(grep -iE "^Host[[:space:]]+[^*]" ~/.ssh/config|peco|awk "{print \$2}"):~/'
    alias sudotramp='emacsclient -n /sudo:$(grep -iE "^Host[[:space:]]+[^*]" ~/.ssh/config|peco|awk "{print \$2}"):~/'
fi
