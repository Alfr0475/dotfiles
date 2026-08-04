#------------------------------------------------------------------------------
# .zshenv  ->  ~/.zshenv
#
# zsh が最も早く、かつ全ての起動形態（対話 / 非対話 / スクリプト）で読むファイル。
# ここには「PATH と環境変数」だけを置き、対話用の設定は .zshrc に書く。
#
# 読み込み順 (macOS):
#   /etc/zshenv -> ~/.zshenv -> [login] /etc/zprofile -> ~/.zprofile
#                            -> [interactive] /etc/zshrc -> ~/.zshrc
#------------------------------------------------------------------------------

#------------------------------------------------------------------------------
# XDG Base Directory
#------------------------------------------------------------------------------
export XDG_CONFIG_HOME="${XDG_CONFIG_HOME:-$HOME/.config}"
export XDG_CACHE_HOME="${XDG_CACHE_HOME:-$HOME/.cache}"
export XDG_DATA_HOME="${XDG_DATA_HOME:-$HOME/.local/share}"
export XDG_STATE_HOME="${XDG_STATE_HOME:-$HOME/.local/state}"

#------------------------------------------------------------------------------
# Homebrew (~/.homebrew)
#
# `brew shellenv` は毎回サブプロセスを起動するので、出力内容を直接書いている。
# prefix を変えた場合はここも直すこと。
#------------------------------------------------------------------------------
export HOMEBREW_PREFIX="$HOME/.homebrew"
export HOMEBREW_CELLAR="$HOMEBREW_PREFIX/Cellar"
export HOMEBREW_REPOSITORY="$HOMEBREW_PREFIX"
export HOMEBREW_NO_ENV_HINTS=1

#------------------------------------------------------------------------------
# PATH
#
# 関数にしてあるのは macOS の /etc/zprofile が path_helper を実行して
# PATH の順序を壊す（/usr/bin 等を先頭に押し出す）ため。
# .zshrc から再度呼んで順序を取り戻す。
#
# `typeset -U path` により重複は自動で除去され、左側が優先されるので
# 何度呼んでも結果が同じになる（冪等）。
#------------------------------------------------------------------------------
__dotfiles_path_init() {
  # -g が無いと関数ローカルの変数になり、代入結果が捨てられる。
  # -U で重複を除去する（左側が優先されるので何度呼んでも同じ結果になる）。
  typeset -gU path PATH fpath FPATH manpath MANPATH

  # (N-/) は「存在するディレクトリのときだけ残す」修飾子。
  # 未導入のものが PATH に混ざらない。
  path=(
    "$HOME/.local/bin"(N-/)          # mise 本体などユーザ導入のバイナリ
    "$HOMEBREW_PREFIX/bin"(N-/)
    "$HOMEBREW_PREFIX/sbin"(N-/)
    $path
  )
  export PATH

  # 末尾の空要素は man 標準の検索パスに展開される。
  # これが無いと MANPATH を設定した時点でシステムの man が引けなくなる。
  manpath=(
    "$HOMEBREW_PREFIX/share/man"(N-/)
    $manpath
    ''
  )
  export MANPATH

  fpath=(
    "$HOMEBREW_PREFIX/share/zsh/site-functions"(N-/)
    $fpath
  )

  # INFOPATH は連動配列が無いので自前で重複を防ぐ
  if [[ -d $HOMEBREW_PREFIX/share/info && ":${INFOPATH:-}:" != *":$HOMEBREW_PREFIX/share/info:"* ]]; then
    export INFOPATH="$HOMEBREW_PREFIX/share/info:${INFOPATH:-}"
  fi
}
__dotfiles_path_init

# mise の shims。cron や GUI アプリなど `mise activate` が効かない
# 非対話環境でも mise 管理のツールを使いたい場合に有効化する。
# `mise activate`（.zshrc 側）と併用すると解決順が分かりにくくなるので既定では無効。
# path=("$XDG_DATA_HOME/mise/shims"(N-/) $path)

#------------------------------------------------------------------------------
# 基本的な環境変数
#------------------------------------------------------------------------------
export LANG="${LANG:-ja_JP.UTF-8}"
export EDITOR="${EDITOR:-vim}"
export PAGER="${PAGER:-less}"

if which source-highlight > /dev/null; then
    export LESS='-R'
    export LESSOPEN='| $HOMEBREW_PREFIX/bin/src-hilite-lesspipe.sh %s'
else
    export LESS='-R -F -X -i -M'
fi

export LS_COLORS='rs=0:di=01;34:ln=01;36:mh=00:pi=40;33:so=01;35:do=01;35:bd=40;33;01:cd=40;33;01:or=40;31;01:su=37;41:sg=30;43:ca=30;41:tw=30;42:ow=34;42:st=37;44:ex=01;32:*.tar=01;31:*.tgz=01;31:*.arc=01;31:*.arj=01;31:*.taz=01;31:*.lha=01;31:*.lz4=01;31:*.lzh=01;31:*.lzma=01;31:*.tlz=01;31:*.txz=01;31:*.tzo=01;31:*.t7z=01;31:*.zip=01;31:*.z=01;31:*.Z=01;31:*.dz=01;31:*.gz=01;31:*.lrz=01;31:*.lz=01;31:*.lzo=01;31:*.xz=01;31:*.bz2=01;31:*.bz=01;31:*.tbz=01;31:*.tbz2=01;31:*.tz=01;31:*.deb=01;31:*.rpm=01;31:*.jar=01;31:*.war=01;31:*.ear=01;31:*.sar=01;31:*.rar=01;31:*.alz=01;31:*.ace=01;31:*.zoo=01;31:*.cpio=01;31:*.7z=01;31:*.rz=01;31:*.cab=01;31:*.jpg=01;35:*.jpeg=01;35:*.gif=01;35:*.bmp=01;35:*.pbm=01;35:*.pgm=01;35:*.ppm=01;35:*.tga=01;35:*.xbm=01;35:*.xpm=01;35:*.tif=01;35:*.tiff=01;35:*.png=01;35:*.svg=01;35:*.svgz=01;35:*.mng=01;35:*.pcx=01;35:*.mov=01;35:*.mpg=01;35:*.mpeg=01;35:*.m2v=01;35:*.mkv=01;35:*.webm=01;35:*.ogm=01;35:*.mp4=01;35:*.m4v=01;35:*.mp4v=01;35:*.vob=01;35:*.qt=01;35:*.nuv=01;35:*.wmv=01;35:*.asf=01;35:*.rm=01;35:*.rmvb=01;35:*.flc=01;35:*.avi=01;35:*.fli=01;35:*.flv=01;35:*.gl=01;35:*.dl=01;35:*.xcf=01;35:*.xwd=01;35:*.yuv=01;35:*.cgm=01;35:*.emf=01;35:*.axv=01;35:*.anx=01;35:*.ogv=01;35:*.ogx=01;35:*.aac=00;36:*.au=00;36:*.flac=00;36:*.m4a=00;36:*.mid=00;36:*.midi=00;36:*.mka=00;36:*.mp3=00;36:*.mpc=00;36:*.ogg=00;36:*.ra=00;36:*.wav=00;36:*.axa=00;36:*.oga=00;36:*.spx=00;36:*.xspf=00;36:';

#------------------------------------------------------------------------------
# このマシン固有の設定（リポジトリ管理外）
#------------------------------------------------------------------------------
if [ -f "$HOME/.zshenv.local" ]; then
  source "$HOME/.zshenv.local"
fi

# 最後の判定結果を持ち越さない（.zshenv は全シェルで読まれるため）
true
