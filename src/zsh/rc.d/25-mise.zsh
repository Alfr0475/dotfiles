#------------------------------------------------------------------------------
# mise の有効化
#
# ここが 25（20-completion と 30-keybind の間）にあるのは意図的。
#
# - 30-keybind.zsh / 40-alias.zsh より前: mise 管理のツール（peco / ghq など）は
#   activate するまで PATH に現れない。`$+commands[<cmd>]` で存在を確認してから
#   キーバインドや alias を定義するファイルより先に実行しないと、コマンドは
#   入っているのに定義されない。
# - 20-completion.zsh の compinit より後: mise activate は mise 管理のツール
#   （usage など）の補完を compdef で登録し、compdef が無ければ自分で
#   `compinit -i` を既定の dump（~/.zcompdump）で走らせる。前に置くと
#   compinit が二重に走る（make doctor が ~/.zcompdump を検出する）。
#------------------------------------------------------------------------------

if (( $+commands[mise] )); then
  eval "$(mise activate zsh)"
fi
