# dotfiles

ターミナル環境（zsh / tmux / 各種CLI）を管理するリポジトリ。

新しい Mac では clone して `make` するだけで環境が揃う。すべてのターゲットは
何度実行しても同じ結果になる（冪等）ように作っている。

このリポジトリは ghq 管理下（`$(ghq root)/github.com/koga-s-cr/dotfiles`）に置く。

```sh
# ghq が無い初回は git clone でよい（配置先は ghq の規約に合わせる）
git clone git@github.com:koga-s-cr/dotfiles.git \
  ~/work/sources/git/github.com/koga-s-cr/dotfiles
cd ~/work/sources/git/github.com/koga-s-cr/dotfiles
make
exec $SHELL -l
```

`make` 後は ghq と peco が入るので、2 回目以降は次で移動できる。

```sh
dot     # このリポジトリへ cd
pg      # ghq 管理下のリポジトリを peco で選んで cd
```

## 前提

- macOS (Apple Silicon)
- Xcode Command Line Tools (`xcode-select --install`)

それ以外は `make` が入れる。

## ツールの役割分担

| 担当 | 対象 | 定義ファイル |
| --- | --- | --- |
| **mise** | 言語ランタイム、CLI ツール | `src/mise/config.toml` |
| **Homebrew** | mise で賄えないもの（GUI アプリ、フォント、ライブラリ、plugin の無い CLI） | `etc/Brewfile` |

mise を主軸にして、Homebrew は補完的に使う。

Homebrew はセキュリティ上の都合で標準の `/opt/homebrew` ではなく **`~/.homebrew`**
に入れる。公式インストーラは非標準の prefix を受け付けないため、
`Homebrew/brew` を git clone する方式（[公式ドキュメント](https://docs.brew.sh/Installation#untar-anywhere-unsupported)）を使う。

> **注意**: 非標準 prefix では配布ビルド（bottle）が使えない formula があり、
> その場合ソースからのビルドになって時間がかかる。重いものは mise 側で入れられないか
> 先に検討する。

## ディレクトリ構成

```
.
├── Makefile              エントリポイント（make help で一覧）
├── etc/
│   ├── links.conf        「どのファイルをどこに配置するか」の定義
│   └── Brewfile          Homebrew の担当分
├── src/                  設定ファイルの本体。ここが $HOME にリンクされる
│   ├── .zshenv           PATH と環境変数（全シェルで読まれる）
│   ├── .zshrc            対話シェル用。rc.d を読み込むだけ
│   ├── .tmux.conf
│   ├── zsh/rc.d/         zsh の設定本体。番号順に読まれる
│   │   ├── 00-options.zsh
│   │   ├── 10-history.zsh
│   │   ├── 20-completion.zsh
│   │   ├── 30-keybind.zsh
│   │   ├── 40-alias.zsh
│   │   ├── 50-prompt.zsh
│   │   ├── 80-plugin.zsh
│   │   └── 90-tools.zsh  mise 等の `eval "$(cmd init)"` 系
│   └── mise/config.toml
└── scripts/
    ├── lib/common.sh     共通ライブラリ（ログ出力、パス判定）
    ├── deploy.sh         シンボリックリンクの配置
    ├── homebrew.sh       Homebrew の導入と Brewfile の反映
    ├── mise.sh           mise の導入とツールの反映
    └── doctor.sh         状態確認（何も変更しない）
```

## make ターゲット

```
make               install と同じ
make install       deploy -> brew -> mise -> vim-plugins -> claude を順に実行する
make vim-plugins   etc/vim-plugins.txt の vim プラグインを ~/.vim/pack に導入する
make tmux-plugins  etc/tmux-plugins.txt の tmux プラグインを ~/.tmux/plugins に導入する
make claude        Claude Code の設定を ~/.claude に配置する
make iterm2        iTerm2 の設定が無ければリポジトリから復元する
make iterm2-save   iTerm2 の設定変更をリポジトリに取り込む
make iterm2-load   リポジトリの iTerm2 設定を ~/.config/iterm2 に復元する
make deploy        etc/links.conf に従ってシンボリックリンクを配置する
make check         deploy で何が起きるかを表示するだけ（変更しない）
make unlink        このリポジトリが張ったリンクだけを削除する
make brew          Homebrew を導入して etc/Brewfile を反映する
make mise          mise を導入して src/mise/config.toml を反映する
make doctor        環境が整っているか確認する
make update        git pull してから install し直す
make upgrade       brew / mise のパッケージを新しいバージョンへ上げる
make brewfile-dump 現在の brew の状態を etc/Brewfile に書き出す
make list          配置されるリンクの一覧
make help          ターゲット一覧
```

## 設定ファイルを追加する

1. `src/` 以下にファイルを置く
2. `etc/links.conf` に `<src/ からの相対パス>` と `<配置先>` の行を追加する
3. `make check` で確認してから `make deploy`

配置先はホーム直下でも `~/.config/` 配下でもよい。`links.conf` の右側を書き換えて
`make deploy` するだけで移動できる。

ただし **`.zshenv` は必ず `~/.zshenv` に置く必要がある**。zsh が最初に読む時点では
`ZDOTDIR` が未設定で `$HOME` にフォールバックするため。`.zshrc` 以降は `.zshenv` の中で
`ZDOTDIR` を設定すれば任意の場所に置ける。

## 冪等性について

- **シンボリックリンク**: 既に正しい先を指していれば何もしない。別の先を指していれば
  張り替える。実ファイルがあれば `<name>.bak.<timestamp>` に退避してから張る
  （退避が発生するのは初回だけ）
- **PATH**: `typeset -U path` により重複が自動で除去されるので、`.zshenv` を何度
  読み込んでも PATH は伸び続けない
- **Homebrew / mise**: 既に入っていればインストールを飛ばす。パッケージの導入は
  `brew bundle` / `mise install` に任せており、どちらも未導入のものだけを入れる

`make install` を実行した後に `make doctor` が「問題なし」を返すこと、そして
`make install` をもう一度実行しても `changed` が出ないことを確認するのが確実。

## このマシンだけの設定

リポジトリに入れたくない設定は以下に置く（`.gitignore` 済み）。

| ファイル | 読まれるタイミング |
| --- | --- |
| `~/.gitconfig.local` | `.gitconfig` の `[include]` |
| `~/.zshenv.local` | `.zshenv` の最後 |
| `~/.zshrc.local` | `.zshrc` の最後 |
| `~/.tmux.conf.local` | `.tmux.conf` の最後 |

### 新しい Mac で必要な手作業

`make` で完結しないものが 2 つある。どちらも `make doctor` が未対応を検出する。

**1. git のユーザー設定**

`~/.gitconfig.local` はマシン固有なのでリポジトリに入っていない。
テンプレートからコピーして値を埋める。

```sh
cp "$(ghq root)"/github.com/koga-s-cr/dotfiles/src/git/config.local.example ~/.gitconfig.local
$EDITOR ~/.gitconfig.local
git config --show-origin --get user.email   # 反映確認
```

設定しないと git がホスト名から推測した無効なアドレスでコミットしてしまい、
それが履歴に永久に残る（GitHub 上でもアカウントに紐付かない）。

**2. iTerm2 の設定フォルダ**

iTerm2 の設定はシンボリックリンクでは追えず、アプリ側にフォルダのパスを
持たせる方式になっている。`make` では変更できないので手で指定する。

`iTerm2 > Settings > General > Settings` の
"Load settings from a custom folder or URL" に次を指定する。

```
~/.config/iterm2
```

CLI からやる場合は iTerm2 を終了した状態で次を実行する。

```sh
defaults write com.googlecode.iterm2 PrefsCustomFolder -string ~/.config/iterm2
defaults write com.googlecode.iterm2 LoadPrefsFromCustomFolder -bool true
```

plist 本体は `make install`（`make iterm2`）がリポジトリから復元する。

### iTerm2 の設定を更新したとき

本番の場所は `~/.config/iterm2` で、リポジトリ（`src/iterm2/`）はその複製を持つ。
plist をシンボリックリンクにしていないのは、plist の書き込みが一時ファイル +
rename で行われることが多く、リンクが実ファイルに置き換わって静かに切れるため。

そのため iTerm2 で設定を変えたら取り込む操作が必要になる。

```sh
make iterm2-save    # ~/.config/iterm2 -> リポジトリ（変更を取り込む）
make iterm2-load    # リポジトリ -> ~/.config/iterm2（設定を戻す）
```

取り込み忘れは `make doctor` が検出する。`make iterm2` は既存の設定を勝手に
上書きせず、plist が無いときだけ復元する（どちらが新しいかは自動判断しない）。

## tmux のステータスライン（tmux-powerline）

| 置き場 | 内容 |
| --- | --- |
| `~/.tmux/plugins/tmux-powerline` | 本体。`make tmux-plugins` で clone（リポジトリ外） |
| `src/tmux/powerline-config.sh` | 設定 → `~/.config/tmux-powerline/config.sh` |
| `src/tmux/powerline-themes/note.sh` | カスタムテーマ → `~/.config/tmux-powerline/themes/` |

現行の tmux-powerline は設定を `$XDG_CONFIG_HOME/tmux-powerline/` 配下しか
読まない。旧環境の `~/.tmux-powerlinerc` に置くと**黙って無視され**、
カスタムテーマも見つからずステータスラインが空になる。

セパレータの字形（U+E0B0 等）にはパッチ済みフォントが必要なので
`font-hackgen-nerd` を Brewfile に入れている。`ifstat` と `tmux-mem-cpu-load` は
テーマが使うセグメントの依存。

`make doctor` が本体・設定・テーマ・依存コマンド・フォントを個別に検証する。

> iTerm2 のプロファイルは `HackGenConsoleForPowerline-Regular` を指定しているが、
> HackGen 側で命名が変わり現在の後継は `HackGenConsoleNF-Regular`。
> セパレータが豆腐になる場合はプロファイルのフォントを差し替える。

## Claude Code の設定

`src/claude/` に置いている（旧 `Alfr0475/claude.d` から統合）。

| ファイル | 内容 |
| --- | --- |
| `CLAUDE.md` | 全プロジェクト共通の行動指針 |
| `settings.json` | モデルと effort の設定 |
| `skills/` | 自作スキル（`join-project`, `promote-product`） |

`~/.claude` は Claude Code 自身が会話ログやセッション状態を書き込むため、
ディレクトリ全体はリンクにせず中身を個別にリンクする（`make claude`）。
会話ログ（`projects/`）や認証情報（`.credentials.json`）は配置対象に含めない。

macOS では claude CLI を Homebrew（`cask "claude-code"`）で入れるため、
`make claude` は `--no-cli` を付けて npm による二重導入を避けている。

### Dev Container で使う

VS Code のユーザー設定に追加すると、コンテナ内でも同じ設定と skills が使える。

```json
"remote.containers.dotfiles.repository": "https://github.com/koga-s-cr/dotfiles",
"remote.containers.dotfiles.targetPath": "~/dotfiles",
"remote.containers.dotfiles.installCommand": "~/dotfiles/scripts/claude-install.sh"
```

`claude-install.sh` はコンテナ内に claude CLI が無ければ npm / apt / brew で導入を試みる。

## 旧環境からの移行メモ

旧リポジトリ（`Alfr0475/dotfiles`）はサブモジュール構成（`zsh.d` / `tmux.d` など）
だったが、こちらは単一リポジトリにしている。移行時の対応:

| 旧 | 新 |
| --- | --- |
| `src/.zsh.d/zshrc` | `src/zsh/rc.d/*.zsh` に分割して移す |
| `src/.zsh.d/zshenv` | `src/.zshenv` |
| `src/.zsh.d/completions` | `~/.config/zsh/completions`（`20-completion.zsh` が fpath に追加） |
| `src/.zsh.d/zplug` | zplug は未メンテ。`80-plugin.zsh` を見て見直す |
| `src/.tmux.d/` + tmux-powerline | `src/.tmux.conf` に統合 |
| `bin/` の自作スクリプト | `src/bin/` に置いて `links.conf` で `~/bin` にリンクする |
| `etc/init/osx/*.sh` | 未移行。必要になったら `scripts/macos-defaults.sh` を作る |

移行中は旧設定が `~/.dotfiles/` に残っているので、そこから内容をコピーする。
旧リポジトリのリンクを剥がすのは新環境の動作を確認してからでよい
（`make deploy` は実体を `.bak.<timestamp>` に退避するので、旧リンクは自動で外れる）。
