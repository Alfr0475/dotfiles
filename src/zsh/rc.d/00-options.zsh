#------------------------------------------------------------------------------
# setopt / シェルの基本挙動
#
#   確認: zsh-options / setopt / unsetopt
#------------------------------------------------------------------------------

# ディレクトリ移動
setopt AUTO_CD              # ディレクトリ名だけで cd
setopt AUTO_PUSHD           # cd した先を自動で pushd
setopt PUSHD_IGNORE_DUPS    # pushd の重複を積まない

# 補完・グロブ
setopt EXTENDED_GLOB        # 拡張グロブを有効化
setopt GLOB_DOTS            # * でドットファイルもマッチさせる
setopt MARK_DIRS            # glob 結果のディレクトリに / を付ける
# 以下は入れない（挙動が変わるため）
# setopt NO_CASE_GLOB       # グロブで大文字小文字を区別しない
# setopt NUMERIC_GLOB_SORT  # 数値を含む名前を数値順に並べる

# 入力
setopt NO_BEEP              # ビープを鳴らさない
setopt NO_FLOW_CONTROL      # Ctrl-S / Ctrl-Q を無効化
setopt PRINT_EIGHT_BIT      # 8bit 文字をそのまま出力する（日本語向け）
# 以下は入れない
# setopt INTERACTIVE_COMMENTS # 対話シェルでも # コメントを許可

# 誤操作防止
unsetopt RM_STAR_SILENT     # rm * の前に確認する
# setopt NO_CLOBBER         # > による既存ファイル上書きを禁止（>| で強制）
