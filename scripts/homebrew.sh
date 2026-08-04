#!/usr/bin/env bash
#
# Homebrew を ~/.homebrew に導入し、etc/Brewfile の内容を適用する。
#
# 公式インストーラは /opt/homebrew か /usr/local しか受け付けないため、
# カスタムprefixでは Homebrew/brew を git clone する方式を使う。
# 参考: https://docs.brew.sh/Installation#untar-anywhere-unsupported
#
# 注意: 非標準prefixでは配布ビルド(bottle)が使えない formula があり、
#       その場合ソースからのビルドになって時間がかかる。

. "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/lib/common.sh"

BREW_REPO="https://github.com/Homebrew/brew"
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
if brew bundle check --file="$BREWFILE" >/dev/null 2>&1; then
  log_ok "Brewfile の内容は全て導入済み"
else
  log_do "brew bundle install --file=$(tilde "$BREWFILE")"
  brew bundle install --file="$BREWFILE" --no-upgrade
fi
