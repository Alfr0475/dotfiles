# dotfiles

ターミナル環境（zsh / tmux / vim / git / Claude Code）を管理するリポジトリ。
`make` だけで新しい Mac に環境が揃うことを保証する。

## 構成の原則

- `src/` が設定ファイルの実体。ここが `$HOME` にリンクされる
- `etc/links.conf` が「どのファイルをどこへ置くか」の唯一の定義。
  **新しい設定ファイルを追加したら必ずここに登録する**
- `scripts/` は `Makefile` から呼ばれる。共通処理は `scripts/lib/common.sh`
- 詳細な設計判断は `README.md` に書いてある。**変更前に該当章を読むこと**

## 絶対に守るルール

**IMPORTANT: すべての make ターゲットは冪等でなければならない。**
2 回実行して `changed` が出る変更は受け入れない。検証手順:

```sh
make install && make doctor && make install   # 2 回目に changed が出ないこと
```

- 挙動を変える変更を入れたら `scripts/doctor.sh` に検証を追加する
- `src/` にファイルを追加したら `etc/links.conf` と `README.md` を同時に更新する
  （例外は `src/claude/`。こちらは `make claude` が固定リストで配置するので
  `scripts/claude-install.sh` と `scripts/doctor.sh` の `for item in ...` を直す）
- リポジトリ内では `.gitignore` / `.gitattributes` という名前を使わない
  （git がこのリポジトリ自身の設定として解釈するため `git/ignore` `git/attributes`）
- `.zshenv` の配置先は `~/.zshenv` から動かせない（zsh が読む時点で `ZDOTDIR` 未設定）
- `src/zsh/rc.d/` の番号は読み込み順。特に `05-mise.zsh` が `40-alias.zsh` より
  先にある理由（mise 管理コマンドの存在判定）を壊さないこと
- 秘密情報・マシン固有の値はコミットしない（`*.local` 側に置く）
- `make brewfile-dump` は Brewfile のコメントを消す。実行後は差分を必ず確認する

## 変更後の確認

```sh
make check     # deploy の差分（変更しない）
make doctor    # 環境の検証
make list      # 配置されるリンク一覧
```

## 手作業が必要な領域（自動化しない）

- `~/.gitconfig.local` の作成（`src/git/config.local.example` から）
- iTerm2 の設定フォルダ指定（`PrefsCustomFolder`）
- iTerm2 plist はリンク化不可。`make iterm2-save` / `make iterm2-load` で同期する
