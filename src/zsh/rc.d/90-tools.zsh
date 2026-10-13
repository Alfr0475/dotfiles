#------------------------------------------------------------------------------
# 各種ツールのシェル連携
#
# `eval "$(cmd init)"` 系はここに集約する。順序依存があるので最後に読む。
#------------------------------------------------------------------------------

# mise の有効化は 05-mise.zsh にある。
# alias 定義（40）より先に PATH を通す必要があるため。

# ---- gh (GitHub CLI) ----
# 補完スクリプトは配布されないのでバイナリから生成する。生成は 10ms 程度なので
# ファイルに落とさず毎回 eval している。compdef を使うため、compinit を済ませた
# 20-completion.zsh より後（＝このファイル）で読む必要がある。
(( $+commands[gh] )) && eval "$(gh completion -s zsh)"

# ---- その他（導入したら有効化する） ----
# (( $+commands[starship] )) && eval "$(starship init zsh)"
# (( $+commands[zoxide] ))   && eval "$(zoxide init zsh)"
# (( $+commands[direnv] ))   && eval "$(direnv hook zsh)"
# (( $+commands[fzf] ))      && source <(fzf --zsh)
