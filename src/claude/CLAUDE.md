# Claude グローバル行動指針

## 実行環境（前提として扱うこと）

環境は dotfiles リポジトリ（koga-s-cr/dotfiles）で管理している。以下は推測せず前提としてよい。

| 項目 | 値 |
| --- | --- |
| OS | macOS (Apple Silicon) |
| 端末 | iTerm2 + tmux（tmux-powerline） |
| シェル | zsh（設定は `~/.config/zsh/rc.d/*.zsh`） |
| ツール管理 | mise が主軸、Homebrew は補完 |
| Homebrew prefix | **`~/.homebrew`**（`/opt/homebrew` ではない） |
| EDITOR / LANG | `vim` / `ja_JP.UTF-8` |
| ghq root | `~/work/sources/git` |
| dotfiles | `~/work/sources/git/github.com/koga-s-cr/dotfiles`（ghq 管理下） |

### コマンド実行時の注意

- **Bash ツールは非対話シェルなので `.zshrc` が読まれない。**`mise activate` も
  エイリアスも効かないため、mise 管理のツール（`peco`, `ghq` など）は PATH に無い。
  必要なら `mise exec -- <cmd>` か `mise which <cmd>` で絶対パスを取る。
- **`mise ls` を見ずに `node` / `python` / `ruby` / `go` があると仮定しないこと。**
  グローバルに固定しているランタイムは無い（`src/mise/config.toml` はコメントアウト状態）。
  `not_found_auto_install = false` なので、無いものは自動で入らない。
- `brew install` を安易に提案しないこと。非標準 prefix のため bottle が使えず
  ソースビルドになる formula がある。**まず mise で入らないか検討する。**
- 対話シェルでは `rm` が `rmtrash`、`ls` が `gls --color=tty`、`df` が `dfc` の
  エイリアスになっている。素の挙動を前提にした説明はしない。
- GNU coreutils は `g` プレフィックス（`gls`, `gsed`, `gdate`）で入っている。
- **破壊的な操作（`rm -rf`、`git push --force`、`git reset --hard`、`make upgrade`）は
  実行前に必ず確認を取ること。**

## コミット（必須ルール・省略禁止）

**IMPORTANT: タスクが完了したら、次の作業に進む前に必ず git commit を提案すること。これは絶対に省略しない。**

- コミットは作業単位で細かく行う（まとめて後からコミットしない）
- コミットメッセージは変更内容を端的に表すこと
- ファイルを変更・作成・削除した場合は常にコミット対象として扱う
- ユーザー情報は `~/.gitconfig.local`（リポジトリ管理外）にある。`user.name` /
  `user.email` をリポジトリ側の設定に書き込まないこと。

## 開発環境構築ルール

**IMPORTANT: 新しい開発環境を構築する際は必ず Dev Container を使うこと。ローカル環境にミドルウェア（DB、Redis 等）を直接インストールしてはいけない。**

- プロダクトごとに独立した Dev Container 環境を構築する
- 推奨構成: `.devcontainer/devcontainer.json` + `docker-compose.yml` + `Dockerfile`
- `docker-compose.yml` を分離することで CI でも同じ構成を流用できる

## dotfiles の変更手順

**IMPORTANT: `~/.zshrc` `~/.zshenv` `~/.tmux.conf` `~/.gitconfig` 等は dotfiles への
シンボリックリンク。ホーム側を直接編集してはいけない。**

1. dotfiles リポジトリの `src/` 以下の実体を編集する
2. 新規ファイルなら `etc/links.conf` に配置先を追記する
3. `make check` で差分を確認してから `make deploy`
4. `make doctor` が問題なしを返すこと、`make install` を再実行して `changed` が
   出ないこと（冪等）を確認する

- `~/.claude/CLAUDE.md` `settings.json` `skills/` も `src/claude/` へのリンク。
  この指針を直そうとしたら `src/claude/CLAUDE.md` を編集する（再デプロイ不要）。
  ただし `src/claude/` は `etc/links.conf` の対象外で、`make claude`
  （`scripts/claude-install.sh`）が固定リストで配置している。ここにファイルを
  増やすときは `scripts/claude-install.sh` と `scripts/doctor.sh` の
  `for item in ...` を両方直す。
- iTerm2 の plist はリンクにできない。`make iterm2-save` / `make iterm2-load` を使う。
- マシン固有の設定は `~/.gitconfig.local` `~/.zshenv.local` `~/.zshrc.local`
  `~/.tmux.conf.local` に置く。リポジトリに秘密情報を書かない。

## 状況ボード（board-agent）

`~/work/sources/git/github.com/koga-s-cr/board-agent` は、判断待ち・口頭メモ・要対応メール・
Slack・PR・Jira・予定と Claude の稼働状況を1画面に集める常駐ツール。読み取り専用で、外部への
送信・投稿は一切しない。

| 項目 | 値 |
| --- | --- |
| 常駐 | `127.0.0.1:7788` の Node。launchd `com.koga-s.board-agent`（ログイン時起動・`KeepAlive`） |
| 画面 / ログ | http://127.0.0.1:7788/ ／ `~/Library/Logs/board-agent.log` |
| 登録・解除・状態 | board-agent の `scripts/install-agent.sh`（`--status` / `--uninstall`） |

**IMPORTANT: MCP をユーザースコープに登録済みなので、どのプロジェクトで作業していても
`board_*` ツールが使える。使いどころは各ツールの説明文に従う。**

- 数分以上かかる作業に入る**前**に `board_agent_start`。終わったら必ず `board_agent_update` で
  `done` にする（放置すると「作業中」が画面に居座る）
- 決められない判断は `board_add` で `decision` に積む。**積んだあとは返答を待たず他の作業を
  進めてよい。** 口頭の依頼に触れたら `verbal` に積み、判断が示されたら `board_resolve` で閉じる
- 登録先は `~/.claude.json`（dotfiles 管理外）。マシンを移したら
  `claude mcp add --transport http --scope user board http://127.0.0.1:7788/mcp` を打ち直す
- `.env`（資格情報）と `data/`（状態と OAuth トークン）は git 管理外。コミットしない、中身を
  ログやコミットメッセージに出さない。状態は `data/board.json` を直接書き換えないこと
  （常駐中はメモリ側が正で上書きされる）。MCP か REST か CLI を通す

**ユーザーが対話 zsh から使う `board` コマンド（`src/zsh/rc.d/40-alias.zsh` の zsh 関数）が
Claude のシェルで `command not found` になっても壊れていない。** 非対話シェルで `.zshrc` が
読まれないだけ。直そうとせず、Claude は MCP ツールを使う。

## Dev Container

Dev Container 内で Claude を使うには **VS Code Dotfiles 機能**を使う。プロジェクトの `devcontainer.json` は変更しない（チーム開発への影響を避けるため）。

### セットアップ（初回のみ）

VS Code ユーザー設定（`settings.json`）に追加：

```json
"remote.containers.dotfiles.repository": "https://github.com/koga-s-cr/dotfiles",
"remote.containers.dotfiles.targetPath": "~/dotfiles",
"remote.containers.dotfiles.installCommand": "~/dotfiles/scripts/claude-install.sh"
```

### コンテナ再ビルド後の手順

自動セットアップのタイミング問題により、再ビルド後は毎回以下が必要：

1. コンテナ内ターミナルで `bash ~/dotfiles/scripts/claude-install.sh` を実行
2. `Cmd+Shift+P` → `Developer: Reload Window`
