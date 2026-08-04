#------------------------------------------------------------------------------
# ヒストリ
#------------------------------------------------------------------------------

HISTFILE="${XDG_STATE_HOME:-$HOME/.local/state}/zsh/history"
HISTSIZE=100000
SAVEHIST=100000

# HISTFILE の置き場が無ければ作る
[[ -d ${HISTFILE:h} ]] || mkdir -p "${HISTFILE:h}"

setopt SHARE_HISTORY          # 複数シェル間でヒストリを共有
setopt HIST_IGNORE_ALL_DUPS   # 重複は古い方を消す
setopt HIST_IGNORE_SPACE      # 空白始まりのコマンドは記録しない
setopt HIST_NO_STORE          # history コマンド自体は記録しない

# 以下は入れない（記録・展開の挙動が変わるため）
# setopt EXTENDED_HISTORY     # 実行時刻と所要時間も記録
# setopt HIST_REDUCE_BLANKS   # 余分な空白を詰めて記録
# setopt HIST_VERIFY          # ヒストリ展開後に即実行せず確認
# setopt INC_APPEND_HISTORY   # 実行の都度追記する
