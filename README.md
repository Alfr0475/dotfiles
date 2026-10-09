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
（理由は「[Claude Code の設定](#claude-code-の設定)」）。

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

## tmux のステータスライン（tmux-powerline）

| 置き場 | 内容 |
| --- | --- |
| `~/.tmux/plugins/tmux-powerline` | 本体。`make tmux-plugins` で clone（リポジトリ外） |
| `src/tmux/powerline-config.sh` | 設定 → `~/.config/tmux-powerline/config.sh` |
| `src/tmux/powerline-themes/note.sh` | カスタムテーマ → `~/.config/tmux-powerline/themes/` |

現行の tmux-powerline は設定を `$XDG_CONFIG_HOME/tmux-powerline/` 配下しか
読まない。それ以外の場所に置くと**黙って無視され**、カスタムテーマも
見つからずステータスラインが空になる。

セパレータの字形（U+E0B0 等）にはパッチ済みフォントが必要なので
`font-hackgen-nerd` を Brewfile に入れている。`ifstat` と `tmux-mem-cpu-load` は
テーマが使うセグメントの依存。

`make doctor` が本体・設定・テーマ・依存コマンド・フォントを個別に検証する。

> iTerm2 のプロファイルは `HackGenConsoleForPowerline-Regular` を指定しているが、
> HackGen 側で命名が変わり現在の後継は `HackGenConsoleNF-Regular`。
> セパレータが豆腐になる場合はプロファイルのフォントを差し替える。

## Claude Code の設定

`src/claude/` に置いている。

| ファイル | 内容 |
| --- | --- |
| `CLAUDE.md` | 全プロジェクト共通の行動指針 |
| `settings.json` | モデルと effort の設定、hook の登録、`env` による Mod の読み込み |
| `skills/` | 自作スキル（`join-project`, `promote-product`, `verification-items`, 開発フローの `dd-*`） |
| `agents/` | 自作サブエージェント（`executor`） |
| `hooks/` | Claude Code の hook から呼ばれるスクリプト |
| `mods/` | 自作 Mod（`usage-limits`）。`settings.json` の `env.CLAUDE_CODE_PLUGIN_DIRS` で読み込む |

### 配置と CLI の導入

`~/.claude` は Claude Code 自身が会話ログやセッション状態を書き込むため、
ディレクトリ全体はリンクにせず中身を個別にリンクする（`make claude`）。
会話ログ（`projects/`）や認証情報（`.credentials.json`）は配置対象に含めない。

claude CLI は公式のネイティブインストーラ（`https://claude.ai/install.sh`）で
`~/.local/bin/claude` に入れる（`make claude`）。Node.js が不要で、本体が自動更新するため
Homebrew の cask や npm は使わない。`~/.local/bin` は `src/.zshenv` で Homebrew より
前に置いているので、他の版が残っていてもネイティブ版が優先される。
brew / npm 版が残っていれば `make claude` と `make doctor` が警告する
（利用中のセッションを壊しうるので削除は手動）。

### サブエージェント

上位モデル（メインループ）が調査・判断・指示書の作成までを行い、実際の変更を
下位モデルのサブエージェントに委譲する構成にしている。判断はメインループでしか
できない（サブエージェントはユーザーに質問できない）ため、判断はすべて委譲前に
済ませる。

| エージェント | モデル | 役割 |
| --- | --- | --- |
| `executor` | `sonnet` | 作業指示書のとおりに実装だけを行う。曖昧なら `BLOCKED` を返して止まる |

**`model:` は各エージェント定義で明示的にピン留めする。** 省略するとサブエージェントは
メインループのモデルを継承するため、`settings.json` の `model` を上位モデルへ変えたときに
下位モデルまで引き上がってしまう。

手順を厳密に指定する規約は `agents/` 側に閉じ込め、`CLAUDE.md` には書かない。
上位モデルに対する過度に規範的な指示は出力品質を下げるため、切り替え地点を
`settings.json` の `model` 1 行だけに保つ。

### 開発フロー（`dd-*` スキル）

要件の深掘りから実装までを、**人間が計画を理解してから実装に進む**流れに固定する
スキル群。[AIに理解を外注しない](https://zenn.dev/avaintelligence/articles/dont-outsource-understanding-to-ai)
の流れのうち実装までを取り入れ、PR 作成・レビューはプロジェクトのルールに合わせて手で行う。

```
/dd-requirements <チケット番号 / URL / 依頼文>   要件を深掘り → requirements.md
/dd-plan <作業名>                               実装計画 → plan.md
/dd-review-plan <作業名>                        文脈を持たない別エージェントが計画をレビュー → plan-review.md
/dd-explain <作業名> [D-xx]                     計画を図解した HTML → explain/
--- 新しいセッションで ---
/dd-implement <作業名>                          計画どおりに実装し、セルフレビューを 3 回
```

生成物はリポジトリに置かない（プロジェクトごとにルールが違うため）。保存先はローカルの次の場所:

```
~/work/design-docs/<host>/<org>/<repo>/<作業名>/
```

- `<host>/<org>/<repo>` は `git remote origin` から算出する（ghq と同じ階層）。origin が無ければ `local/<ディレクトリ名>`
- `<作業名>` は `<チケット番号>-<英小文字ケバブの要約>`（例: `CRM-1234-coupon-validation`）。チケットが無ければ要約のみ
- ルートは `DESIGN_DOCS_ROOT` で変えられる（Dev Container ではコンテナ内に作られ、再ビルドで消えるため）

このルールは `skills/_lib/design-docs-dir.sh` だけが持ち、各スキルはこれを呼ぶ。
`--all` で全リポジトリの作業ディレクトリを一覧でき（`ghq list -p` 相当）、
zsh の `pdd` はこれを peco に渡して cd する。
`_lib/` には `SKILL.md` が無いのでスキルとしては読み込まれない。

### 使用量の表示（Mod）

`mods/usage-limits` が、プランの利用上限の使用率とリセット時刻を表示する。
CLI ではプロンプト下のヒント行（`? for shortcuts` などの右）に、Desktop ではプロンプト上の帯に出す。

```
5h 42%（14:00 まで） · 週 63%（10/13(火) 9:00 まで）
```

| 挙動 | 内容 |
| --- | --- |
| 値 | `$.session.usage()` の `rateLimits`（5 時間枠 `five_hour`、週次枠 `seven_day`）。% は切り捨て |
| 時刻 | ローカル時刻。5 時間枠は今日なら `H:MM`、日付が変わるなら `M/D(曜) H:MM`。週次枠は常に日付付き |
| 色 | 枠ごとに 80% 以上で `warning`（黄）、95% 以上で `error`（赤）。テーマのキーなのでライト/ダークに追従する |
| 欠けた枠 | `5h --` / `週 --`。リセット時刻を過ぎた枠も古い値なので `--` にする |
| 非表示 | 両方の枠が取れないとき（初回応答前、API キー認証など）は行を出さない |
| 更新 | 応答の完了時（`session.measure`）と 1 分ごと |

対象は CLI と Claude Desktop の Code タブ。VS Code 拡張では Mod が UI を描けないので表示されない。

**Desktop でプロンプト上に出すのは、ヒント行（`PromptHint`）が Desktop では呼ばれないため。**
公式の reference と型定義には Desktop でも描かれるとあるが、2.1.293 で実測すると Desktop では
`PromptHint` の `ui.render` が一度も呼ばれず、`AbovePrompt` だけが呼ばれた。表示場所は
surface で分けている（`PromptHint` は terminal だけ、`AbovePrompt` は desktop だけ）ので、
将来 Desktop で `PromptHint` が呼ばれるようになっても二重には出ない。帯はアンケート表示中は譲る。

**読み込みはマーケットプレイスを使わず、`settings.json` の `env` で行う。**

```json
"env": { "CLAUDE_CODE_PLUGIN_DIRS": "~/.claude/mods/usage-limits" }
```

`claude plugin install` は `settings.json` に絶対パス入りの `extraKnownMarketplaces` と
`enabledPlugins` を書き込むため、リポジトリに差分が出て Mac と Dev Container でパスも食い違う。
`CLAUDE_CODE_PLUGIN_DIRS` は `--plugin-dir` 相当で、Desktop のようにフラグを渡せないアプリでも効く。
`make claude` が `~/.claude/mods` をリンクするだけなので、インストール状態を持たない。

- **`$HOME/...` は展開されない。必ず `~` で書く**（`~` は Claude Code 自身が展開する）
- 読み込みのたびに Claude Code が Mod の中へ `.claude-plugin/types/` と `tsconfig.json` を
  書き込む。バージョン依存の生成物なので `.gitignore` で除外している
- `make doctor` が設定値と、下記の `validate` / `test` を検証する。コードが壊れても
  セッション中は黙って表示されないだけなので、ここで気付けるようにしている

```sh
claude plugin validate --strict src/claude/mods/usage-limits
claude plugin test src/claude/mods/usage-limits
```

動作を確認したバージョンは Claude Code 2.1.293。Mods API はリリースごとに変わりうるので、
壊れたら生成された `.claude-plugin/types/` の型定義を見て直す。

### セッション名の自動付け替え

`hooks/session-retitle.sh`（`Stop` hook）が、直近の会話に合わせて
`/resume` 一覧のセッション名を付け替える。

Claude Code の自動タイトル生成は **1 セッションにつき 1 回だけ**で、最初の
プロンプトがそのままタイトルとして残る。会話中に話題が移ると一覧から目的の
セッションを見つけられないため、外から付け替えている。

タイトルは会話ログ（`~/.claude/projects/*/<session-id>.jsonl`）への追記で表現され、
優先順位は `custom-title` > `ai-title` > `summary` > 最初のプロンプト。この hook は
`custom-title` を追記する。Claude Code 側も追記を読み直して採用するため、
実行中のセッションのプロンプト表示にも反映される。

**追記しただけでは一覧に出ない。** セッション一覧は転写ログ全体を読まず、
**先頭 64KB と末尾 64KB** しか見ない（Claude Code 内の `$I = 65536`）。追記した
タイトルはその後の会話でこの窓から押し出されるため、末尾から 32KB 以上離れたら
同じタイトルを末尾へ再追記して窓の中へ戻す（モデルは呼ばない）。Claude Code 自身が
`last-prompt` や `ai-title` を延々と再追記しているのも同じ理由。

| 挙動 | 内容 |
| --- | --- |
| 発火 | 応答が終わるたび（`Stop`）。判定だけ同期で行い、生成はバックグラウンド |
| 間隔 | 前回更新から 10 分以上、かつ前回以降にユーザー発言が 2 回以上 |
| 窓の維持 | 発火ごとに位置を確認し、末尾 32KB より離れていたら再追記する |
| 初回 | ユーザー発言が 3 回たまるまでは付け替えない |
| モデル | `claude-haiku-4-5-20251001`（`--setting-sources ''` で hook を読ませない） |
| 手動優先 | `/rename` で人が付けた名前を検出したら、以降そのセッションには触らない |
| 状態 | `~/.claude/session-titles/<session-id>.json` とログ `retitle.log` |

`CLAUDE_RETITLE_DISABLE=1` で無効化、`CLAUDE_RETITLE_INTERVAL` で間隔、
`CLAUDE_RETITLE_MODEL` でモデルを変えられる。

**生成のために `claude -p` を起動するので、再帰しないよう二重に防いでいる。**
`--setting-sources ''` で hook 自体を読ませず、さらに環境変数
`CLAUDE_SESSION_RETITLE` を立てて子プロセス側の hook を即 return させる。

### Dev Container で使う

VS Code のユーザー設定に追加すると、コンテナ内でも同じ設定と skills が使える。

```json
"remote.containers.dotfiles.repository": "https://github.com/koga-s-cr/dotfiles",
"remote.containers.dotfiles.targetPath": "~/dotfiles",
"remote.containers.dotfiles.installCommand": "~/dotfiles/scripts/claude-install.sh"
```

`claude-install.sh` はコンテナ内でも同じネイティブインストーラで claude CLI を導入する（curl が必要）。

## トラブルシューティング

### 外部アプリが `~/.zshrc` に追記してきたとき

`~/.zshrc` は `src/.zshrc` へのシンボリックリンクなので、インストーラが `>>` で
追記するとリポジトリの実体が書き換わる。Docker Desktop は実際に追記してくる。

```zsh
# The following lines have been added by Docker Desktop to enable Docker CLI completions.
fpath=(/Users/<user>/.docker/completions $fpath)
autoload -Uz compinit
compinit
# End of Docker CLI completions
```

補完の定義（`_docker`）自体は重複しないが、`20-completion.zsh` が済ませた
`compinit` を末尾でもう一度走らせるため以下が起きる。

- 起動が遅くなる（実測 0.03 秒 → 0.05 秒）
- 既定の dump `~/.zcompdump` が別にでき、`~/.cache/zsh/zcompdump` と二重になる
- ユーザー名が絶対パスで焼き付き、別のマシンで壊れる

対処は追記を消し、fpath の追加だけを `src/zsh/rc.d/20-completion.zsh` に書くこと。
`compinit` より前なので 1 回で済む。補完の実体（`~/.docker/completions`）はアプリが
生成・更新するのでリポジトリには取り込まない。

追記されると `make doctor` が検出する（`src/.zshrc` の末尾が `true` で終わる前提を使う）。
アプリの更新で再び追記される可能性があるので、気づいたら消す。

fpath に補完を足した直後は `rm ~/.cache/zsh/zcompdump` で dump を作り直す。
`compinit -C` は既存の dump をそのまま読むため、消さないと新しい補完が効かない。
