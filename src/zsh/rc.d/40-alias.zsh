#------------------------------------------------------------------------------
# エイリアス / 関数
#------------------------------------------------------------------------------

if which gls > /dev/null 2>&1; then
    # GNU ls があればそれを使う
    alias ls='gls --color=tty'
else
    # macOS の ls は -G で色付けする
    alias ls='ls -G'
fi

alias ll='ls -l'
alias la='ls -la'
alias ..='cd ..'
alias ...='cd ../..'

# rm をゴミ箱送りに置き換える。
#
# hasseg 版 trash は rm のオプションを一切受け付けず `rm -rf dir` が失敗するため、
# rm 互換のインタフェースを持つ rmtrash を使う。
# 本物の rm が必要なときは `command rm`。
(( $+commands[rmtrash] )) && alias rm='rmtrash'

(( $+commands[dfc] )) && alias df='dfc'

# dotfiles リポジトリへ移動する
alias dot='cd "$(ghq root)/github.com/koga-s-cr/dotfiles"'

# 状況ボード（board-agent）。常駐しているボードに積む・片付ける。
#
# alias ではなく関数にしているのは、引数をそのまま渡したいため
# （`board 経費精算` のようにサブコマンドを省いて積める）。
# mise exec を通しているのは、node を board-agent 側の mise.toml で固定しており、
# グローバルには node を置いていないため。
function board() {
    local root="$(ghq root)/github.com/koga-s-cr/board-agent"

    # リポジトリを消した／移した後に、意味の分からないエラーで悩まないようにする
    if [[ ! -f $root/src/cli.js ]]; then
        echo "board-agent が見つからない: $root" >&2
        return 1
    fi

    mise exec --cd "$root" -- node "$root/src/cli.js" "$@"
}

# peco
if which peco > /dev/null; then
    alias pg='cd $(ghq list -p | peco --prompt "REPOSITORY >" --query "$LBUFFER")'

    # awsp in peco
    if which aws > /dev/null; then
        function awsp() {
            if [ $# -ge 1 ]; then
                export AWS_PROFILE="$1"
                echo "Set AWS_PROFILE=$AWS_PROFILE."
            else
                local profiles=$(aws configure list-profiles)
                local -a profiles_array=(${(f)profiles})
                local selected_profile=$(echo $profiles | peco)

                # peco をキャンセルした場合、または一覧に無い値が返ってきた場合は
                # AWS_PROFILE を変更せず、成功メッセージも出さない。
                #
                # ここを `[[ ... ]] && export ...; echo ...` と書くと `;` で連鎖が
                # 切れるため、選択していなくても常に成功メッセージが出てしまう。
                if [[ -n $selected_profile ]] && [[ -n ${profiles_array[(re)$selected_profile]} ]]; then
                    export AWS_PROFILE="$selected_profile"
                    echo "Set AWS_PROFILE=$AWS_PROFILE."
                fi
            fi

            # 空のまま export すると aws CLI が空名のプロファイルを探してしまうので、
            # 値があるときだけ設定する。
            if [[ -n $AWS_PROFILE ]]; then
                export AWS_DEFAULT_PROFILE="$AWS_PROFILE"
            fi
        }
    fi
fi
