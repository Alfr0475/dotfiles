#------------------------------------------------------------------------------
# キーバインド
#
# 旧 .zsh.d の bindkey / zle 定義はここへ移す。
#   確認: bindkey / bindkey -l
#------------------------------------------------------------------------------

bindkey -e   # emacs キーバインド

# 履歴を前方一致で検索する
autoload -Uz history-search-end
zle -N history-beginning-search-backward-end history-search-end
zle -N history-beginning-search-forward-end  history-search-end
bindkey '^P' history-beginning-search-backward-end
bindkey '^N' history-beginning-search-forward-end

# 単語単位の移動・削除で / や . を区切りとして扱う
autoload -Uz select-word-style
select-word-style bash
