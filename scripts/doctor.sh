#!/usr/bin/env bash
#
# 環境が期待どおりに整っているかを確認する。何も変更しない。
# 問題があれば終了コード 1 を返す。

. "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/lib/common.sh"

# 個別のチェックが失敗しても最後まで走らせたいので -e を切る
set +e

PROBLEMS=0
note_problem() { PROBLEMS=$((PROBLEMS + 1)); }

#------------------------------------------------------------------------------
log_header "シンボリックリンク"
#------------------------------------------------------------------------------
LINKS_CONF="$ETC_DIR/links.conf"
if [ ! -f "$LINKS_CONF" ]; then
  log_fail "$LINKS_CONF が無い"
  note_problem
else
  while read -r src dest _rest; do
    case "${src:-}" in ''|'#'*) continue ;; esac
    [ -n "${dest:-}" ] || continue
    dest="$(expand_home "$dest")"
    abs_src="$SRC_DIR/$src"

    if [ ! -e "$abs_src" ]; then
      log_fail "src/$src が無い (links.conf の記述と不一致)"
      note_problem
    elif [ ! -L "$dest" ]; then
      if [ -e "$dest" ]; then
        log_fail "$(tilde "$dest") がリンクではなく実体になっている -> make deploy"
      else
        log_fail "$(tilde "$dest") が未配置 -> make deploy"
      fi
      note_problem
    elif [ "$(readlink "$dest")" != "$abs_src" ]; then
      log_fail "$(tilde "$dest") が別の場所を指している: $(readlink "$dest") -> make deploy"
      note_problem
    elif [ ! -e "$dest" ]; then
      log_fail "$(tilde "$dest") のリンクが切れている"
      note_problem
    else
      log_ok "$(tilde "$dest")"
    fi
  done < "$LINKS_CONF"
fi

#------------------------------------------------------------------------------
log_header "Homebrew"
#------------------------------------------------------------------------------
if [ ! -x "$BREW_BIN" ]; then
  log_fail "$(tilde "$BREW_BIN") が無い -> make brew"
  note_problem
else
  log_ok "brew $("$BREW_BIN" --version 2>/dev/null | head -1)"

  actual_prefix="$("$BREW_BIN" --prefix 2>/dev/null)"
  if [ "$actual_prefix" = "$HOMEBREW_PREFIX" ]; then
    log_ok "prefix = $(tilde "$actual_prefix")"
  else
    log_fail "prefix が想定と違う: $actual_prefix (想定 $HOMEBREW_PREFIX)"
    note_problem
  fi

  if [ -f "$ETC_DIR/Brewfile" ]; then
    if "$BREW_BIN" bundle check --file="$ETC_DIR/Brewfile" >/dev/null 2>&1; then
      log_ok "Brewfile の内容は全て導入済み"
    else
      log_warn "Brewfile に未導入のものがある -> make brew"
      note_problem
    fi
  fi
fi

#------------------------------------------------------------------------------
log_header "mise"
#------------------------------------------------------------------------------
if [ ! -x "$MISE_BIN" ]; then
  log_fail "$(tilde "$MISE_BIN") が無い -> make mise"
  note_problem
else
  log_ok "$("$MISE_BIN" --version 2>/dev/null | head -1)"
  if missing="$("$MISE_BIN" ls --missing 2>&1)"; then
    if [ -n "$missing" ]; then
      log_warn "未導入のツールがある -> make mise"
      printf '%s\n' "$missing" | sed 's/^/          /'
      note_problem
    else
      log_ok "設定されたツールは全て導入済み"
    fi
  else
    # コマンドが失敗したこと自体を隠さない（黙って「問題なし」にしない）
    log_warn "mise ls --missing の実行に失敗した: $missing"
    note_problem
  fi
fi

#------------------------------------------------------------------------------
log_header "PATH"
#------------------------------------------------------------------------------
# 対話 zsh を起動して、実際にログインシェルで解決される PATH を見る
zsh_path="$(zsh -ic 'printf "%s" "$PATH"' 2>/dev/null)"
if [ -z "$zsh_path" ]; then
  log_warn "zsh の PATH を取得できなかった"
else
  brew_pos=-1; usr_pos=-1; i=0
  IFS=':'
  for p in $zsh_path; do
    [ "$p" = "$HOMEBREW_PREFIX/bin" ] && [ "$brew_pos" -lt 0 ] && brew_pos=$i
    [ "$p" = "/usr/bin" ] && [ "$usr_pos" -lt 0 ] && usr_pos=$i
    i=$((i + 1))
  done
  unset IFS

  if [ "$brew_pos" -lt 0 ]; then
    log_fail "$(tilde "$HOMEBREW_PREFIX")/bin が PATH に無い"
    note_problem
  elif [ "$usr_pos" -ge 0 ] && [ "$brew_pos" -gt "$usr_pos" ]; then
    log_fail "/usr/bin が $(tilde "$HOMEBREW_PREFIX")/bin より先にある (path_helper に負けている)"
    note_problem
  else
    log_ok "$(tilde "$HOMEBREW_PREFIX")/bin が /usr/bin より先にある"
  fi
fi

#------------------------------------------------------------------------------
if [ "$PROBLEMS" -eq 0 ]; then
  log_header "問題なし"
  exit 0
fi
log_header "$PROBLEMS 件の問題があります"
exit 1
