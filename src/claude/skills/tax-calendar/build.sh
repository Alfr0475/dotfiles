#!/usr/bin/env bash
# テンプレートの /*__DATA__*/ の行を data.json の中身に置き換えて、公開用の HTML を作る。
# 使い方: build.sh <data.json> <出力先.html>
set -euo pipefail

here="$(cd "$(dirname "$0")" && pwd)"
data="$1"
out="$2"

# JSON として読めることだけ確かめる（jq は Homebrew で入っている前提）
jq empty "$data"

awk -v datafile="$data" '
  /\/\*__DATA__\*\// { while ((getline line < datafile) > 0) print line; next }
  { print }
' "$here/template.html" > "$out"

echo "built: $out"
