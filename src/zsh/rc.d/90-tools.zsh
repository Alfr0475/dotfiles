#------------------------------------------------------------------------------
# 各種ツールのシェル連携
#
# `eval "$(cmd init)"` 系はここに集約する。順序依存があるので最後に読む。
#------------------------------------------------------------------------------

# mise の有効化は 05-mise.zsh にある。
# alias 定義（40）より先に PATH を通す必要があるため。

# ---- その他（導入したら有効化する） ----
# (( $+commands[starship] )) && eval "$(starship init zsh)"
# (( $+commands[zoxide] ))   && eval "$(zoxide init zsh)"
# (( $+commands[direnv] ))   && eval "$(direnv hook zsh)"
# (( $+commands[fzf] ))      && source <(fzf --zsh)
