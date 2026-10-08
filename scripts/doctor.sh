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
log_header "zsh"
#------------------------------------------------------------------------------
# ~/.zshrc は src/.zshrc へのリンクなので、外部アプリが ~/.zshrc に追記すると
# リポジトリの実体が書き換わる（Docker Desktop が実際にやる）。
# src/.zshrc は末尾が `true` で終わる前提なので、それで追記を検出する。
ZSHRC_SRC="$SRC_DIR/.zshrc"
if [ ! -f "$ZSHRC_SRC" ]; then
  log_fail "src/.zshrc が無い"
  note_problem
elif [ "$(tail -n 1 "$ZSHRC_SRC")" != "true" ]; then
  log_fail "src/.zshrc が外部から追記されている（末尾が true でない）"
  grep -n 'added by\|End of' "$ZSHRC_SRC" | while read -r line; do
    log_info "        $line"
  done
  log_info "        補完の fpath は src/zsh/rc.d/20-completion.zsh に寄せ、追記は消す"
  note_problem
else
  log_ok "src/.zshrc に外部からの追記なし"
fi

# 追記された compinit が走ると既定の ~/.zcompdump が作られ、
# 20-completion.zsh が使う ~/.cache/zsh/zcompdump と二重になる。
if [ -e "$HOME/.zcompdump" ]; then
  log_fail "~/.zcompdump がある（compinit が二重に走った痕跡） -> rm ~/.zcompdump"
  note_problem
else
  log_ok "compinit の dump は ~/.cache/zsh/zcompdump のみ"
fi

#------------------------------------------------------------------------------
log_header "git"
#------------------------------------------------------------------------------
# ~/.gitconfig.local は make では作られない（マシン固有のためリポジトリ管理外）。
# 未設定のまま commit すると git がホスト名から推測した無効なアドレスが
# 履歴に永久に残るので、ここで検出する。
if ! has git; then
  log_fail "git が無い"
  note_problem
else
  git_name="$(git config --get user.name 2>/dev/null || true)"
  git_email="$(git config --get user.email 2>/dev/null || true)"

  if [ -n "$git_name" ] && [ -n "$git_email" ]; then
    log_ok "user = $git_name <$git_email>"
  else
    log_fail "user.name / user.email が未設定"
    log_info "        cp $(tilde "$SRC_DIR")/git/config.local.example ~/.gitconfig.local"
    note_problem
  fi

  # core.excludesfile / attributesfile の参照先が実在するか
  # （過去に単数形 .gitattribute を指していて機能していなかったことがある）
  for key in core.excludesfile core.attributesfile; do
    path="$(git config --get "$key" 2>/dev/null || true)"
    [ -n "$path" ] || continue
    case "$path" in '~/'*) path="$HOME/${path#\~/}" ;; esac
    if [ -e "$path" ]; then
      log_ok "$key = $(tilde "$path")"
    else
      log_fail "$key の参照先が無い: $path"
      note_problem
    fi
  done

  # filter "lfs" を設定しているなら git-lfs 本体が必要
  if [ -n "$(git config --get filter.lfs.required 2>/dev/null || true)" ] && ! has git-lfs; then
    log_fail "filter.lfs が設定されているが git-lfs が無い -> make brew"
    note_problem
  fi
fi

# gh (GitHub CLI) は make では認証できない。未認証だと gh pr / gh issue が全て失敗する。
# `gh auth status` はトークン検証で API を叩いて遅いので、ここではローカルに
# 認証情報が置かれているかだけを見る（トークンの有効性までは見ない）。
if has gh || "$MISE_BIN" which gh >/dev/null 2>&1; then
  if [ -s "${XDG_CONFIG_HOME:-$HOME/.config}/gh/hosts.yml" ]; then
    log_ok "gh は認証済み"
  else
    log_warn "gh が未認証 -> gh auth login"
    note_problem
  fi
fi

#------------------------------------------------------------------------------
log_header "tmux-powerline"
#------------------------------------------------------------------------------
PL_DIR="$HOME/.tmux/plugins/tmux-powerline"
if [ ! -x "$PL_DIR/powerline.sh" ]; then
  log_fail "$(tilde "$PL_DIR") が無い -> make tmux-plugins"
  note_problem
else
  log_ok "本体あり"

  # 設定は $XDG_CONFIG_HOME/tmux-powerline/ 配下しか読まれない。
  # それ以外の場所に置くと黙って無視される。
  pl_conf="${XDG_CONFIG_HOME:-$HOME/.config}/tmux-powerline/config.sh"
  if [ -e "$pl_conf" ]; then
    log_ok "$(tilde "$pl_conf")"
  else
    log_fail "$(tilde "$pl_conf") が無い -> make deploy"
    note_problem
  fi

  if [ -e "$HOME/.tmux-powerlinerc" ]; then
    log_warn "~/.tmux-powerlinerc は現行版では読まれません（削除して構いません）"
  fi

  # テーマが解決できるか
  pl_theme="$(grep -oE '^[[:space:]]*export TMUX_POWERLINE_THEME=.*' "$pl_conf" 2>/dev/null \
    | tail -1 | /usr/bin/sed -e 's/.*=//' -e 's/"//g' -e "s/'//g" | tr -d ' ')"
  if [ -n "$pl_theme" ]; then
    if [ -f "${XDG_CONFIG_HOME:-$HOME/.config}/tmux-powerline/themes/$pl_theme.sh" ] \
      || [ -f "$PL_DIR/themes/$pl_theme.sh" ]; then
      log_ok "テーマ $pl_theme"
    else
      log_fail "テーマ $pl_theme が見つからない"
      note_problem
    fi
  fi

  # テーマが要求する外部コマンド
  for c in tmux-mem-cpu-load ifstat; do
    if has "$c"; then
      log_ok "$c"
    else
      log_warn "$c が無い（該当セグメントが空になる）-> make brew"
      note_problem
    fi
  done

  # パッチ済みフォント（セパレータ字形 U+E0B0 等）
  if grep -qE 'PATCHED_FONT_IN_USE="?true' "$pl_conf" 2>/dev/null; then
    if ls "$HOME/Library/Fonts/" 2>/dev/null | grep -qiE 'NF-|Nerd|Powerline'; then
      log_ok "パッチ済みフォントあり"
    else
      log_warn "パッチ済みフォントが無い（セパレータが豆腐になる）-> make brew"
      note_problem
    fi
  fi
fi

#------------------------------------------------------------------------------
log_header "Claude Code"
#------------------------------------------------------------------------------
# claude CLI はネイティブ版（~/.local/bin/claude）だけを使う。brew / npm 版が
# 残っていると自動更新が効かない古い版を掴む原因になるので知らせる。
if [ -x "$HOME/.local/bin/claude" ]; then
  log_ok "claude CLI (ネイティブ版) $("$HOME/.local/bin/claude" --version 2>/dev/null | head -1)"
else
  log_fail "~/.local/bin/claude が無い -> make claude"
  note_problem
fi
if [ -e "$HOMEBREW_PREFIX/bin/claude" ]; then
  log_warn "brew 版の claude が残っている -> brew uninstall --cask claude-code"
  note_problem
fi
# ~/.claude は Claude Code 自身が会話ログを書き込むため、ディレクトリ全体は
# リンクにせず中身を個別にリンクしている（make claude / claude-install.sh）。
CLAUDE_SRC="$SRC_DIR/claude"
if [ -L "$HOME/.claude" ]; then
  log_fail "~/.claude がシンボリックリンク -> $(readlink "$HOME/.claude")"
  log_info "        リンク先を書き換えてしまうため配置できません:"
  log_info "        rm ~/.claude && mkdir -p ~/.claude && make claude"
  note_problem
else
  for item in CLAUDE.md settings.json skills agents hooks mods; do
    src="$CLAUDE_SRC/$item"
    dest="$HOME/.claude/$item"
    [ -e "$src" ] || continue

    if [ -L "$dest" ] && [ "$(readlink "$dest")" = "$src" ]; then
      log_ok "~/.claude/$item"
    elif [ -e "$dest" ]; then
      log_fail "~/.claude/$item がこのリポジトリを指していない -> make claude"
      note_problem
    else
      log_fail "~/.claude/$item が未配置 -> make claude"
      note_problem
    fi
  done

  # settings.json が壊れていると Claude Code が設定を読めない。
  # plutil -lint は plist 形式を期待して JSON を弾くので使えない
  # （正しい JSON でも "Unexpected character {" になる）。
  # -convert なら JSON を解釈できるので、変換の成否で判定する。
  if [ -e "$CLAUDE_SRC/settings.json" ] && has plutil; then
    if plutil -convert json -o /dev/null "$CLAUDE_SRC/settings.json" >/dev/null 2>&1; then
      log_ok "src/claude/settings.json は妥当な JSON"
    else
      log_fail "src/claude/settings.json が JSON として不正"
      note_problem
    fi
  fi

  # セッション名の自動付け替え（Stop hook）。実行ビットが落ちると hook は
  # 黙って失敗するだけで、タイトルが更新されない理由が分からなくなる。
  retitle="$CLAUDE_SRC/hooks/session-retitle.sh"
  if [ -e "$retitle" ]; then
    if [ -x "$retitle" ]; then
      log_ok "hooks/session-retitle.sh は実行可能"
    else
      log_fail "hooks/session-retitle.sh に実行ビットが無い -> chmod +x $retitle"
      note_problem
    fi

    if grep -q 'session-retitle.sh' "$CLAUDE_SRC/settings.json" 2>/dev/null; then
      log_ok "session-retitle.sh は settings.json の hook に登録済み"
    else
      log_fail "session-retitle.sh が settings.json の hook に未登録"
      note_problem
    fi
  fi

  # 開発フロー（dd-* スキル）の保存先を決めるスクリプト。各スキルがこれを
  # 直接実行するため、実行ビットが落ちると全スキルが保存先を得られない。
  ddir="$CLAUDE_SRC/skills/_lib/design-docs-dir.sh"
  if [ -e "$ddir" ]; then
    if [ -x "$ddir" ]; then
      log_ok "skills/_lib/design-docs-dir.sh は実行可能"
    else
      log_fail "skills/_lib/design-docs-dir.sh に実行ビットが無い -> chmod +x $ddir"
      note_problem
    fi

    # pdd が使う --all。git の外で呼ばれ、作業ディレクトリだけ（中の explain/ は
    # 出さない）を host 系・local 系の両方から拾えること。
    ddtmp="$(mktemp -d)"
    mkdir -p "$ddtmp/github.com/o/r/w1/explain" "$ddtmp/local/r/w2"
    ddgot="$(cd / && DESIGN_DOCS_ROOT="$ddtmp" bash "$ddir" --all 2>&1 || true)"
    ddwant="$(printf '%s\n%s' "$ddtmp/github.com/o/r/w1" "$ddtmp/local/r/w2")"
    if [ "$ddgot" = "$ddwant" ]; then
      log_ok "design-docs-dir.sh --all は作業ディレクトリを一覧できる"
    else
      log_fail "design-docs-dir.sh --all の出力が想定と違う: $ddgot"
      note_problem
    fi
    rm -rf "$ddtmp"
  fi

  # 使用量表示の Mod（usage-limits）。settings.json の env で読み込ませているので、
  # 値が消えると Desktop を含めて黙って表示されなくなる。コードが壊れた場合も
  # セッション中は描画されないだけなので、validate と test でここで検出する。
  mod="$CLAUDE_SRC/mods/usage-limits"
  if [ ! -d "$mod" ]; then
    log_fail "src/claude/mods/usage-limits が無い（settings.json の env が読み込めない）"
    note_problem
  elif has plutil; then
    want='~/.claude/mods/usage-limits'
    got="$(plutil -extract env.CLAUDE_CODE_PLUGIN_DIRS raw -o - "$CLAUDE_SRC/settings.json" 2>/dev/null || true)"
    if [ "$got" = "$want" ]; then
      log_ok "settings.json の env.CLAUDE_CODE_PLUGIN_DIRS が usage-limits を読み込む"
    else
      log_fail "settings.json の env.CLAUDE_CODE_PLUGIN_DIRS が \"$want\" でない: \"$got\""
      note_problem
    fi

    claude_bin="$HOME/.local/bin/claude"
    if [ -x "$claude_bin" ]; then
      if "$claude_bin" plugin validate --strict "$mod" >/dev/null 2>&1; then
        log_ok "mods/usage-limits は claude plugin validate を通る"
      else
        log_fail "mods/usage-limits が validate で失敗 -> claude plugin validate $mod"
        note_problem
      fi
      if "$claude_bin" plugin test "$mod" >/dev/null 2>&1; then
        log_ok "mods/usage-limits のテストが通る"
      else
        log_fail "mods/usage-limits のテストが失敗 -> claude plugin test $mod"
        note_problem
      fi
    else
      log_warn "claude CLI が無いため mods/usage-limits の検証を飛ばした"
    fi
  fi
fi

#------------------------------------------------------------------------------
log_header "iTerm2"
#------------------------------------------------------------------------------
# iTerm2 は設定をシンボリックリンクでは追えず、アプリ側の
# PrefsCustomFolder にフォルダのパスを持つ。make では変更できないので
# 切り替え漏れをここで検出する。
#
# 本番の場所は ~/.config/iterm2 で、リポジトリはその複製を持つ。
# iTerm2 が書き戻すため乖離しうるので、差分も検出する。
ITERM2_LIVE="$HOME/.config/iterm2"
ITERM2_PLIST="com.googlecode.iterm2.plist"
if [ ! -d "/Applications/iTerm.app" ]; then
  log_skip "iTerm2 が未インストール"
elif ! has defaults; then
  log_skip "defaults コマンドが無い"
else
  iterm_folder="$(defaults read com.googlecode.iterm2 PrefsCustomFolder 2>/dev/null || true)"
  iterm_load="$(defaults read com.googlecode.iterm2 LoadPrefsFromCustomFolder 2>/dev/null || true)"

  if [ -z "$iterm_folder" ]; then
    log_fail "カスタム設定フォルダが未設定（リポジトリの設定が使われていない）"
    log_info "        iTerm2 > Settings > General > Settings で次を指定する:"
    log_info "        $ITERM2_LIVE"
    note_problem
  elif [ "$iterm_folder" != "$ITERM2_LIVE" ]; then
    log_fail "設定フォルダが別の場所を指している: $iterm_folder"
    log_info "        想定: $ITERM2_LIVE"
    note_problem
  elif [ "$iterm_load" != "1" ]; then
    log_fail "設定フォルダの読み込みが無効（LoadPrefsFromCustomFolder=$iterm_load）"
    note_problem
  else
    log_ok "設定フォルダ = $(tilde "$ITERM2_LIVE")"
  fi

  # リポジトリの複製と実際の設定が乖離していないか
  live_plist="$ITERM2_LIVE/$ITERM2_PLIST"
  repo_plist="$SRC_DIR/iterm2/$ITERM2_PLIST"
  if [ ! -f "$live_plist" ]; then
    log_warn "$(tilde "$live_plist") が無い -> make iterm2-load"
    note_problem
  elif [ ! -f "$repo_plist" ]; then
    log_warn "$(tilde "$repo_plist") が無い -> make iterm2-save"
    note_problem
  elif cmp -s "$live_plist" "$repo_plist"; then
    log_ok "リポジトリの複製と一致"
  else
    log_warn "リポジトリの複製と差分がある（設定変更が未コミット）-> make iterm2-save"
    note_problem
  fi
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
