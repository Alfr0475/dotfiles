# dotfiles

ターミナル環境（zsh / tmux / vim / git / Claude Code）を管理するリポジトリ。

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
pdd     # dd-* スキルの生成物ディレクトリを peco で選んで cd（引数は初期クエリ）
```

## 前提

- macOS (Apple Silicon)
- Xcode Command Line Tools (`xcode-select --install`)

それ以外は `make` が入れる。

## 新しい Mac で必要な手作業

`make` で完結しないものが 3 つある。いずれも `make doctor` が未対応を検出する。

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

**3. gh（GitHub CLI）の認証**

`gh` は mise で入るが、認証はブラウザを使う対話操作なので `make` では終わらない。
認証情報は `~/.config/gh/hosts.yml` に置かれる（トークンなのでリポジトリ管理外）。

```sh
gh auth login       # GitHub.com / HTTPS / ブラウザ認証 を選ぶ
gh auth status      # 反映確認
```

未認証だと `gh pr` などが全て失敗する。`make doctor` は hosts.yml の有無だけを見る
（API を叩くと遅いため、トークンが生きているかまでは見ない）。

## 日々の操作

### make ターゲット

```
make               install と同じ
make install       deploy -> brew -> mise -> vim-plugins -> tmux-plugins -> claude -> iterm2 を順に実行する
make vim-plugins   etc/vim-plugins.txt の vim プラグインを ~/.vim/pack に導入する
make tmux-plugins  etc/tmux-plugins.txt の tmux プラグインを ~/.tmux/plugins に導入する
make claude        claude CLI（ネイティブ版）を導入し、設定を ~/.claude に配置する
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

### 設定ファイルを追加する

1. `src/` 以下にファイルを置く
2. `etc/links.conf` に `<src/ からの相対パス>` と `<配置先>` の行を追加する
3. `make check` で確認してから `make deploy`

配置先はホーム直下でも `~/.config/` 配下でもよい。`links.conf` の右側を書き換えて
`make deploy` するだけで移動できる。

ただし **`.zshenv` は必ず `~/.zshenv` に置く必要がある**。zsh が最初に読む時点では
`ZDOTDIR` が未設定で `$HOME` にフォールバックするため。`.zshrc` 以降は `.zshenv` の中で
`ZDOTDIR` を設定すれば任意の場所に置ける。

**`src/claude/` だけは例外で `etc/links.conf` を使わない。** `make claude`
（`scripts/claude-install.sh`）が固定リストで配置するので、ここにファイルを増やすときは
`scripts/claude-install.sh` と `scripts/doctor.sh` の `for item in ...` を両方直す
（理由は [docs/claude.md](docs/claude.md)）。

iTerm2 で設定を変えたら `make iterm2-save` でリポジトリに取り込む（[docs/iterm2.md](docs/iterm2.md)）。

## 設計

### ツールの役割分担

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

### ディレクトリ構成

```
.
├── Makefile                エントリポイント（make help で一覧）
├── docs/                   ツールごとの仕組みと設計判断（README は概要だけ）
├── etc/
│   ├── links.conf          「どのファイルをどこに配置するか」の定義
│   ├── Brewfile            Homebrew の担当分
│   ├── vim-plugins.txt     make vim-plugins が入れる vim プラグイン
│   └── tmux-plugins.txt    make tmux-plugins が入れる tmux プラグイン
├── src/                    設定ファイルの本体。ここが $HOME にリンクされる
│   ├── .zshenv             PATH と環境変数（全シェルで読まれる）
│   ├── .zshrc              対話シェル用。rc.d を読み込むだけ
│   ├── .gitconfig
│   ├── .tigrc
│   ├── .tmux.conf
│   ├── zsh/rc.d/           zsh の設定本体。番号順に読まれる
│   │   ├── 00-options.zsh
│   │   ├── 05-mise.zsh     mise の有効化。40-alias より先に読む必要がある
│   │   ├── 10-history.zsh
│   │   ├── 20-completion.zsh
│   │   ├── 30-keybind.zsh
│   │   ├── 40-alias.zsh
│   │   ├── 50-prompt.zsh
│   │   ├── 80-plugin.zsh
│   │   └── 90-tools.zsh    `eval "$(cmd init)"` 系
│   ├── git/                グローバルな ignore / attributes、config.local.example
│   ├── vim/                vimrc と conf.d
│   ├── tmux/               tmux-powerline の設定とテーマ
│   ├── iterm2/             iTerm2 の plist（リンクではなく複製。make iterm2-save/-load）
│   ├── mise/config.toml
│   └── claude/             Claude Code の設定（make claude が ~/.claude に配置）
└── scripts/
    ├── lib/common.sh       共通ライブラリ（ログ出力、パス判定）
    ├── deploy.sh           シンボリックリンクの配置
    ├── homebrew.sh         Homebrew の導入と Brewfile の反映
    ├── mise.sh             mise の導入とツールの反映
    ├── vim-plugins.sh      vim プラグインの導入
    ├── tmux-plugins.sh     tmux プラグインの導入
    ├── iterm2.sh           iTerm2 設定の復元・取り込み
    ├── claude-install.sh   claude CLI の導入と ~/.claude への配置（Dev Container でも使う）
    └── doctor.sh           状態確認（何も変更しない）
```

### 冪等性について

- **シンボリックリンク**: 既に正しい先を指していれば何もしない。別の先を指していれば
  張り替える。実ファイルがあれば `<name>.bak.<timestamp>` に退避してから張る
  （退避が発生するのは初回だけ）
- **PATH**: `typeset -U path` により重複が自動で除去されるので、`.zshenv` を何度
  読み込んでも PATH は伸び続けない
- **Homebrew / mise**: 既に入っていればインストールを飛ばす。パッケージの導入は
  `brew bundle` / `mise install` に任せており、どちらも未導入のものだけを入れる

`make install` を実行した後に `make doctor` が「問題なし」を返すこと、そして
`make install` をもう一度実行しても `changed` が出ないことを確認するのが確実。

### このマシンだけの設定

リポジトリに入れたくない設定は以下に置く（`.gitignore` 済み）。

| ファイル | 読まれるタイミング |
| --- | --- |
| `~/.gitconfig.local` | `.gitconfig` の `[include]` |
| `~/.zshenv.local` | `.zshenv` の最後 |
| `~/.zshrc.local` | `.zshrc` の最後 |
| `~/.tmux.conf.local` | `.tmux.conf` の最後 |

## ドキュメント

ツールごとの仕組みと設計判断は `docs/` に分けている。

| ファイル | 内容 |
| --- | --- |
| [docs/zsh.md](docs/zsh.md) | zsh の読み込み順、PATH、rc.d の構成、エイリアス、プロンプト、補完、外部アプリによる追記への対処 |
| [docs/tmux.md](docs/tmux.md) | tmux のステータスライン（tmux-powerline）とフォント |
| [docs/iterm2.md](docs/iterm2.md) | iTerm2 の設定をリポジトリと同期する仕組み |
| [docs/claude.md](docs/claude.md) | Claude Code の設定（サブエージェント、`dd-*` スキル、Mod、hook、Dev Container） |
