#!/usr/bin/env bash
#
# mise を ~/.local/bin に導入し、グローバル設定のツールを入れる。
#
# 方針: 言語ランタイムと CLI ツールは基本的に mise で管理し、
#       mise で賄えないもの（GUIアプリ / cask / ビルド依存ライブラリ等）を
#       Homebrew の担当とする。
#
# mise は単体バイナリなので Homebrew 経由にせず公式インストーラで入れる。
# 非標準prefixの Homebrew でソースビルドが走るのを避ける意図もある。

. "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/lib/common.sh"

MISE_CONFIG="$HOME/.config/mise/config.toml"

log_header "mise ($(tilde "$MISE_BIN"))"

# ---- 本体の導入 ----
if [ -x "$MISE_BIN" ]; then
  log_ok "mise は既にインストール済み ($("$MISE_BIN" --version 2>/dev/null | head -1))"
else
  has curl || die "curl が必要です"
  log_do "https://mise.run からインストール"
  # インストーラを一旦落としてから実行する（何が走るか確認できるようにする）
  installer="$(mktemp)"
  trap 'rm -f "$installer"' EXIT
  curl -fsSL https://mise.run -o "$installer"
  MISE_INSTALL_PATH="$MISE_BIN" sh "$installer"
  [ -x "$MISE_BIN" ] || die "インストールしたが $MISE_BIN が見つかりません"
fi

# ---- ツールの導入 ----
if [ ! -f "$MISE_CONFIG" ]; then
  log_skip "$(tilde "$MISE_CONFIG") が無いため install をスキップ (make deploy 済みか確認)"
  exit 0
fi

# `mise install` は未導入のバージョンだけ入れるので、そのまま毎回呼んでよい。
# 「入れる必要があるか」を先に判定しようとすると mise 側のフラグ仕様に依存して
# 誤判定したときに黙って導入を飛ばすことになるので、判定はせず mise に任せる。
log_do "mise install"
"$MISE_BIN" install
