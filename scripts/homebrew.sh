#!/usr/bin/env bash
#
# Homebrew を導入し、etc/Brewfile の内容を適用する。
#
# 導入先は common.sh の resolve_homebrew_prefix が決める（docs/homebrew.md）。
#   /opt/homebrew : 公式インストーラ（sudo が要る。管理権限のあるマシン）
#   ~/.homebrew   : 公式インストーラは /opt/homebrew か /usr/local しか受け付けないため、
#                   Homebrew/brew を git clone する方式を使う。
#                   参考: https://docs.brew.sh/Installation#untar-anywhere-unsupported
#
# 注意: ~/.homebrew（非標準prefix）では配布ビルド(bottle)が使えない formula があり、
#       その場合ソースからのビルドになって時間がかかる。

. "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/lib/common.sh"

BREW_REPO="https://github.com/Homebrew/brew"
BREW_INSTALLER="https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh"
BREWFILE="$ETC_DIR/Brewfile"

log_header "Homebrew ($(tilde "$HOMEBREW_PREFIX"))"

is_macos || die "macOS 以外は未対応です"

# ---- 前提: Command Line Tools ----
if ! /usr/bin/xcode-select -p >/dev/null 2>&1; then
  log_warn "Command Line Tools が未インストールです"
  log_info "次を実行して完了後に make をやり直してください: xcode-select --install"
  exit 1
fi

# ---- 本体の導入 ----
if [ -x "$BREW_BIN" ]; then
  log_ok "brew は既にインストール済み"
elif [ "$HOMEBREW_PREFIX" = /opt/homebrew ]; then
  has curl || die "curl が必要です"
  log_do "$BREW_INSTALLER で $HOMEBREW_PREFIX にインストール（sudo のパスワードを聞かれる）"
  # インストーラを一旦落としてから実行する（何が走るか確認できるようにする）
  installer="$(mktemp)"
  trap 'rm -f "$installer"' EXIT
  curl -fsSL "$BREW_INSTALLER" -o "$installer"
  /bin/bash "$installer"
  [ -x "$BREW_BIN" ] || die "インストールしたが $BREW_BIN が見つかりません"
else
  log_do "$BREW_REPO を $(tilde "$HOMEBREW_PREFIX") に clone"
  git clone "$BREW_REPO" "$HOMEBREW_PREFIX"
  [ -x "$BREW_BIN" ] || die "clone したが $BREW_BIN が見つかりません"
fi

# 以降 brew を使えるようにする（このスクリプト内限定）
eval "$("$BREW_BIN" shellenv)"
export HOMEBREW_NO_ENV_HINTS=1

# ---- Brewfile の適用 ----
if [ ! -f "$BREWFILE" ]; then
  log_skip "$BREWFILE が無いため bundle をスキップ"
  exit 0
fi

# brew bundle 自体が冪等（未導入のものだけ入れる）。
# check で差分が無いと分かる場合は install を丸ごと省略して高速化する。
# 更新は make upgrade で行うので、install と同じく check も古いだけのものは不足と見なさない
# （付けないと更新待ちがあるだけで毎回 changed になる）。
if brew bundle check --file="$BREWFILE" --no-upgrade >/dev/null 2>&1; then
  log_ok "Brewfile の内容は全て導入済み"
else
  log_do "brew bundle install --file=$(tilde "$BREWFILE")"
  brew bundle install --file="$BREWFILE" --no-upgrade
fi

# cask が置いたフォントには quarantine が付き、macOS が登録しないことがある（docs/tmux.md）。
# Homebrew から --no-quarantine が無くなったので、ここで外す。
for font in "$HOME"/Library/Fonts/HackGen*.ttf; do
  [ -f "$font" ] || continue
  if xattr "$font" 2>/dev/null | grep -qx com.apple.quarantine; then
    log_do "quarantine を外す: $(tilde "$font")"
    xattr -d com.apple.quarantine "$font"
  fi
done
