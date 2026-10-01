#!/usr/bin/env bash
#
# 開発フロー（dd-* スキル）の生成物を置くローカルディレクトリを出力する。
# 保存先のルールはこのスクリプトだけが持つ。各スキルはこれを呼ぶ。
#
#   <root>/<host>/<org>/<repo>/<作業名>/
#
#   root     $DESIGN_DOCS_ROOT（未設定なら ~/work/design-docs）
#   host/... git remote origin から算出（ghq と同じ階層）。
#            origin が無ければ local/<リポジトリのディレクトリ名>
#   作業名   <チケット番号>-<英小文字ケバブの要約>。チケットが無ければ要約のみ
#
#   design-docs-dir.sh            リポジトリ単位のディレクトリ
#   design-docs-dir.sh <作業名>   作業ディレクトリ（作成はしない）
#   design-docs-dir.sh --list     そのリポジトリの既存の作業名一覧

set -euo pipefail

ROOT="${DESIGN_DOCS_ROOT:-$HOME/work/design-docs}"

die() { printf 'design-docs-dir: %s\n' "$*" >&2; exit 1; }

git rev-parse --is-inside-work-tree >/dev/null 2>&1 \
  || die "git リポジトリの中で実行してください: $PWD"

repo_path() {
  local url rest host path
  url="$(git remote get-url origin 2>/dev/null || true)"

  case "$url" in
    *://*)
      # https://github.com/org/repo.git / ssh://git@host:22/org/repo.git
      rest="${url#*://}"
      rest="${rest#*@}"
      host="${rest%%/*}"
      host="${host%%:*}"
      path="${rest#*/}"
      ;;
    *:*)
      # git@github.com:org/repo.git
      rest="${url#*@}"
      host="${rest%%:*}"
      path="${rest#*:}"
      ;;
    *)
      host=""
      path=""
      ;;
  esac

  path="${path%/}"
  path="${path%.git}"

  if [ -n "$host" ] && [ -n "$path" ]; then
    printf '%s/%s\n' "$host" "$path"
    return
  fi

  # origin が無い（またはローカルパス）。worktree でも本体と同じ名前になるよう
  # 共通の .git から辿る。
  local common
  common="$(git rev-parse --path-format=absolute --git-common-dir)"
  printf 'local/%s\n' "$(basename "$(dirname "$common")")"
}

repo_dir="$ROOT/$(repo_path)"

case "${1:-}" in
  "")
    printf '%s\n' "$repo_dir"
    ;;
  --list)
    [ -d "$repo_dir" ] || exit 0
    find "$repo_dir" -mindepth 1 -maxdepth 1 -type d -exec basename {} \; | sort
    ;;
  -*)
    die "unknown option: $1"
    ;;
  *)
    [[ "$1" =~ ^[A-Za-z0-9][A-Za-z0-9._-]*$ ]] \
      || die "作業名に使えない文字があります（英数字と . _ - のみ）: $1"
    printf '%s/%s\n' "$repo_dir" "$1"
    ;;
esac
