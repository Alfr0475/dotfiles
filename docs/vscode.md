# VSCode

| 対象 | 置き場所 | 反映 |
| --- | --- | --- |
| ユーザー設定 | `src/vscode/settings.json` | `make deploy`（`etc/links.conf`） |
| キーバインド | `src/vscode/keybindings.json` | `make deploy`（`etc/links.conf`） |
| 拡張 | `etc/Brewfile` の `vscode "..."` 行 | `make brew`（`brew bundle`） |

VSCode 本体は管理していない。貸与PC（`~/.homebrew`、管理権限なし）では cask が
`/Applications` に入れられないため、両マシン共通の Brewfile には書かない。

## 設定ファイル

配置先は `~/Library/Application Support/Code/User/` の中の 2 ファイル。
`User/` ごとリンクにしないのは、`globalStorage/` `History/` `workspaceStorage/` など
VSCode 自身が書き込むものが同居しているため。

VSCode は設定画面からの変更をリンク先（リポジトリ側）へ書き込むので、iTerm2 のような
取り込み操作は要らない。設定を変えたら `git diff` で確認してコミットする。

配置先のパスに空白があるため、`etc/links.conf` は右側（配置先）を行末までの 1 パスとして読む
（`deploy.sh` / `doctor.sh` の `read -r src dest`）。

`snippets/` は中身が無いので管理していない。使い始めたら `src/vscode/snippets` を作り、
`etc/links.conf` にディレクトリごと登録する。

**Settings Sync は使わない。** 同期とリンクが同じファイルを書き換え合うため、
どちらが正か分からなくなる。設定の正はこのリポジトリにする。

## 拡張

`brew bundle` が `code --install-extension` で入れる。`code` コマンドが PATH に無いと
入れられないので、`make doctor` が確認する（無ければ VSCode のコマンドパレットで
`Shell Command: Install 'code' command in PATH`）。

追加するときは Brewfile に `vscode "<publisher>.<name>"` を書いて `make brew`。
入っている拡張の ID は `code --list-extensions` で出る。`make brewfile-dump` でも
書き出されるが、Brewfile のコメントが消えるので差分を確認すること。

Brewfile は追加しかしない（`brew bundle cleanup` を使っていない）ので、
Brewfile から消しても入っている拡張はアンインストールされない。
