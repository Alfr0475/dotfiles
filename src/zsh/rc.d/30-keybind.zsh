#------------------------------------------------------------------------------
# キーバインド
#
#   確認: bindkey / bindkey -l
#------------------------------------------------------------------------------

bindkey -e   # emacs キーバインド

# 履歴を前方一致で検索する
autoload -Uz history-search-end
zle -N history-beginning-search-backward-end history-search-end
zle -N history-beginning-search-forward-end  history-search-end
bindkey '^P' history-beginning-search-backward-end
bindkey '^N' history-beginning-search-forward-end

# Ctrl-R のヒストリ検索を peco 対応にする。
# peco が無い環境では zsh 既定の逐次検索のままにする。
if (( $+commands[peco] )); then
    function __peco-select-history() {
        local tac
        if (( $+commands[tac] )); then
            tac="tac"
        else
            tac="tail -r"
        fi
        BUFFER=$(\history -n 1 | eval $tac | peco --query "$LBUFFER")
        CURSOR=$#BUFFER
        zle clear-screen
    }
    zle -N __peco-select-history
    bindkey '^R' __peco-select-history
fi

# 単語境界は zsh 既定のまま（select-word-style / WORDCHARS は設定しない）。
# Ctrl-W はパス全体を削除する。
# / や . を区切りとして扱いたい場合は次を有効にする:
#   autoload -Uz select-word-style
#   select-word-style bash
