#------------------------------------------------------------------------------
# プラグイン
#
# 現状はプラグインを入れていない。素の zsh で足りるなら入れないのが一番速い。
#
# 候補:
#   - zsh-users/zsh-autosuggestions    入力補完のゴースト表示
#   - zsh-users/zsh-syntax-highlighting  コマンドの色付け（最後に読むこと）
#   - zsh-users/zsh-completions        補完定義の追加
#
# プラグインマネージャを使わず git clone して source するだけでも足りる。
# その場合の置き場: ${XDG_DATA_HOME}/zsh/plugins/<name>
#------------------------------------------------------------------------------

ZSH_PLUGIN_DIR="${XDG_DATA_HOME:-$HOME/.local/share}/zsh/plugins"

# 例: 個別に clone したプラグインを読み込む
# zsh-syntax-highlighting は他のプラグインより後に読む必要がある
for __plugin in \
  zsh-completions/zsh-completions.plugin.zsh \
  zsh-autosuggestions/zsh-autosuggestions.zsh \
  zsh-syntax-highlighting/zsh-syntax-highlighting.zsh
do
  [[ -r $ZSH_PLUGIN_DIR/$__plugin ]] && source "$ZSH_PLUGIN_DIR/$__plugin"
done
unset __plugin ZSH_PLUGIN_DIR
