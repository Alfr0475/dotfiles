# Emacsライクな操作を有効にする
# Vi ライクな操作の場合は`bindkey -v`とする
bindkey -e

# 自動補完を有効にする
autoload -Uz compinit

# 入力したコマンドが存在せず、かつディレクトリ名と一致するなら、ディレクトリにcdする
setopt auto_cd

# cd した先のディレクトリをディレクトリスタックに追加する
setopt auto_pushd

# pushd した時に、ディレクトリが既にスタックに含まれていればスタックに追加しない
setopt pushd_ignore_dups

# 拡張 glob を有効にする
setopt extended_glob

#------------------------------------------------------------------------------
# 基本
#------------------------------------------------------------------------------
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

#------------------------------------------------------------------------------
# 補完
#------------------------------------------------------------------------------
# 入力しているコマンド名が間違っている場合にもしかして：を出す。
setopt correct

# タブによるファイルの順番切り替えをしない
unsetopt auto_menu

#------------------------------------------------------------------------------
# プロンプト
#------------------------------------------------------------------------------
# 色を使う
autoload -Uz colors

# zshのvcs_infoを使う
autoload -Uz vcs_info

# zshのhookを使う
autoload -Uz add-zsh-hook

# zshのバージョン判定を使う
autoload -Uz is-at-least


# 以下の3つのメッセージをエクスポートする
#   $vcs_info_msg_0_ : 通常メッセージ用 (緑)
#   $vcs_info_msg_1_ : 警告メッセージ用 (黄色)
#   $vcs_info_msg_2_ : エラーメッセージ用 (赤)
zstyle ':vcs_info:*' max-exports 3


# 対応するVCSを定義
zstyle ':vcs_info:*' enable git svn hg cvs bzr


# 標準のフォーマット(git 以外で使用する)
zstyle ':vcs_info:*' formats '(%a)-[%b]'
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

# 左側のプロンプトを構成する関数
function left_prompt {
    local formatted_upper_prompt="[`prompt_get_path`]"$'\n'
    local formatted_under_prompt="`prompt_get_user`@`prompt_get_host` `prompt_get_mark`"
    local formatted_prompt=" $formatted_upper_prompt$formatted_under_prompt "

    # 左側のプロンプト
    PROMPT="$formatted_prompt"
}

# 右側のプロンプトを構成する関数
function right_prompt {
    local formatted_prompt="`prompt_get_vcs_info_msg`"

    # 右側のプロンプト
    RPROMPT="$formatted_prompt"
}

#---------------------------------------
# 各種要素を構成する関数
#---------------------------------------
# カレントディレクトリ
function prompt_get_path {
    echo "%~"
}

# ユーザー名
function prompt_get_user {
    echo "%n"
}

# ホスト名
function prompt_get_host {
    echo "%m"
}

# プロンプトマーク
function prompt_get_mark {
    # %(,,)はif...then...else..の意味
    # !はここでは特権ユーザーの判定
    # %B...%bは太字
    # ?はここでは直前のコマンドの返り値
    # %F{color}...%fは色の変更
    echo "%B%(?,%F{green},%F{red})%(!,#,$)%f%b"
}

# VCS情報
function prompt_get_vcs_info_msg {
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

left_prompt
add-zsh-hook precmd right_prompt

#------------------------------------------------------------------------------
# ユーティリティ
#------------------------------------------------------------------------------
# iTerm2のタブ名を変更する
function title {
    echo -ne "\033]0;"$* "\007"
}