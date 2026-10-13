#------------------------------------------------------------------------------
# プロンプト
#
# starship 等に載せ替える場合はここで eval する。
#------------------------------------------------------------------------------

setopt PROMPT_SUBST       # プロンプト内の変数・コマンド置換を有効化

# 日時を実文字列に確定させるために使う（strftime / EPOCHSECONDS）
zmodload zsh/datetime

autoload -Uz colors && colors

# git のブランチ名などをプロンプトに出す
autoload -Uz vcs_info
zstyle ':vcs_info:*' enable git svn hg cvs bzr
zstyle ':vcs_info:*' max-exports 3
zstyle ':vcs_info:*' check-for-changes true
zstyle ':vcs_info:git:*' formats '(%s)-[%b]' '%c%u %m'
zstyle ':vcs_info:git:*' actionformats '(%s)-[%b]' '%c%u %m' '<!%a>'
zstyle ':vcs_info:(svn|bzr|cvs):*' branchformat '%b:r%r'
zstyle ':vcs_info:bzr:*' use-simple true
zstyle ':vcs_info:git:*' stagedstr     '+'
zstyle ':vcs_info:git:*' unstagedstr   '-'

autoload -Uz add-zsh-hook

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

    # 既定ブランチ以外（作業ブランチ）は未 push が普通なので対象外にする。
    # 新しいリポジトリは main、過去に作ったものは master なので両方見る。
    case "${hook_com[branch]}" in
        main|master) ;;
        *) return 0 ;;
    esac

    # push していないコミット数を取得する。
    # origin 決め打ちにせず、そのブランチに設定された upstream と比較する
    # （upstream 未設定なら rev-list が失敗するので何も表示しない）。
    # rev-list --count を使うと wc / tr のプロセスを省ける。
    local ahead
    ahead=$(command git rev-list --count "@{upstream}..HEAD" 2>/dev/null)

    if [[ -n "$ahead" ]] && (( ahead > 0 )); then
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


# プロンプトを構成する関数
#
# 1行目は左に AWS プロファイルとカレントディレクトリ、右端に VCS 情報と日時。
# 2行目は user@host と tmux のペイン番号、プロンプトマーク。
function __left_prompt {
    local upper_left="`__prompt_get_awsprof``__prompt_get_path`"

    local upper_right="`__prompt_get_exec_time`"
    local vcs_info_msg="`__prompt_get_vcs_info_msg`"
    if [ -n "$vcs_info_msg" ]; then
        upper_right="$vcs_info_msg $upper_right"
    fi

    # 幅を持たないプロンプトエスケープ（%F{...} や %B などの色・装飾）を
    # 取り除いてから表示幅を測る。(S%%) はプロンプト展開を伴う置換。
    local zero='%([BSUbfksu]|([FK]|){*})'
    local -i upper_left_width=${#${(S%%)upper_left//$~zero/}}
    local -i upper_right_width=${#${(S%%)upper_right//$~zero/}}

    # 先頭のスペース1つと、右端に触れないためのマージン1つを差し引く。
    # パスが長くて収まらない場合はスペース1つで繋ぐ（折り返させない）。
    local -i pad=$(( COLUMNS - 2 - upper_left_width - upper_right_width ))
    (( pad < 1 )) && pad=1

    local formatted_upper_prompt="${upper_left}${(l:$pad:):-}${upper_right}"$'\n'
    local formatted_under_prompt="`__prompt_get_user`@`__prompt_get_host`"

    # なぜかここがエラーになる
    local formatted_tmux_display="`__prompt_get_tmux_display`"
    if [ -n "$formatted_tmux_display" ]; then
        formatted_under_prompt="$formatted_under_prompt $formatted_tmux_display"
    fi

    formatted_under_prompt="$formatted_under_prompt `__prompt_get_mark`"
    local formatted_prompt=" $formatted_upper_prompt$formatted_under_prompt "

    # 左側のプロンプト
    PROMPT="$formatted_prompt"
}


# 右側のプロンプトは使わない。
# VCS 情報と日時は1行目の右端に寄せたので、コマンド入力行には何も出さない。
RPROMPT=''


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

# AWS Profile情報
function __prompt_get_awsprof {
    local profile="${AWS_PROFILE}"
    if [[ -z "${profile}" ]]; then
        echo ""
    else
        echo "AWS:%F{magenta}${profile}%f "
    fi
}

# コマンドの実行時刻
#
# 右端揃えのために表示幅を測る必要がある。プロンプトの %D{...} のまま渡すと、
# 幅ゼロのエスケープを取り除くパターンが秒指定の %S を色装飾の %S と誤認して
# 消してしまうため、ここで実文字列に確定させてから埋め込む。
function __prompt_get_exec_time {
    local now
    strftime -s now '%Y/%m/%d %H:%M:%S' $EPOCHSECONDS
    echo "%F{green}${now}%f"
}


add-zsh-hook precmd __left_prompt
