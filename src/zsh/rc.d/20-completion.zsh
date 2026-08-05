#------------------------------------------------------------------------------
# 補完
#
# 自作の補完関数は ~/.config/zsh/completions に置き、
# 下の fpath 追加で拾わせる。
#
# 外部アプリが置く補完も compinit より前にここで fpath へ足す。
# ~/.zshrc は src/.zshrc へのリンクなので、アプリが .zshrc に追記すると
# リポジトリの実体が書き換わり、末尾で compinit が二重に走る。
# 追記されていたら消して、ここに fpath を足すこと（doctor が検出する）。
#------------------------------------------------------------------------------

fpath=(
  "${XDG_CONFIG_HOME:-$HOME/.config}/zsh/completions"(N-/)
  "$HOME/.docker/completions"(N-/)   # Docker Desktop が生成・更新する
  $fpath
)

autoload -Uz compinit

# compinit は毎回フルチェックすると遅いので、1日1回だけ検証する。
# -C は dump をそのまま読むだけなので、上の fpath に補完を足した直後は
# rm ~/.cache/zsh/zcompdump で作り直さないと新しい補完が効かない。
_zcompdump="${XDG_CACHE_HOME:-$HOME/.cache}/zsh/zcompdump"
[[ -d ${_zcompdump:h} ]] || mkdir -p "${_zcompdump:h}"

if [[ -n ${_zcompdump}(#qN.mh-24) ]]; then
  compinit -C -d "$_zcompdump"
else
  compinit -d "$_zcompdump"
fi
unset _zcompdump

setopt AUTO_LIST            # 曖昧な補完は候補を一覧表示
setopt AUTO_PARAM_SLASH     # ディレクトリ補完時に / を付ける
setopt COMPLETE_IN_WORD     # 単語の途中でも補完する
setopt MAGIC_EQUAL_SUBST    # --opt=<Tab> でパス補完する
setopt LIST_PACKED          # 補完候補一覧を詰めて表示する
setopt NO_LIST_BEEP         # 補完が曖昧なときビープを鳴らさない
unsetopt MENU_COMPLETE      # 最初の候補を勝手に挿入しない
unsetopt AUTO_MENU          # Tab 連打で候補を勝手に挿入しない

# 候補が2つ以上のときだけメニュー選択にする
zstyle ':completion:*:default' menu 'select=2'

# バックアップファイルは補完候補から除外する
zstyle ':completion:*:*files' ignored-patterns '*?~' '*\#'
zstyle ':completion:*' list-colors "${(s.:.)LS_COLORS}"
zstyle ':completion:*' matcher-list 'm:{a-z}={A-Za-z}'   # 大文字小文字を区別しない
zstyle ':completion:*' verbose yes
zstyle ':completion:*:descriptions' format '%B%d%b'
zstyle ':completion:*' use-cache on
zstyle ':completion:*' cache-path "${XDG_CACHE_HOME:-$HOME/.cache}/zsh/zcompcache"
