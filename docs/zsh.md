# zsh

## 読み込みの流れ

| ファイル | 配置先 | 読まれる場面 | 置くもの |
| --- | --- | --- | --- |
| `src/.zshenv` | `~/.zshenv` | すべて（対話・非対話・スクリプト） | XDG 変数、Homebrew の変数、PATH、`LANG` `EDITOR` `PAGER` など |
| `src/.zshrc` | `~/.zshrc` | 対話シェルだけ | `rc.d/*.zsh` を番号順に読むだけ |
| `src/zsh/rc.d/*.zsh` | `~/.config/zsh/rc.d/` | `.zshrc` から | 対話用の設定本体 |

macOS での順序は `/etc/zshenv` → `~/.zshenv` →（ログイン）`/etc/zprofile` →（対話）`~/.zshrc`。
**対話用の設定を `.zshenv` に書かない。** スクリプトや Claude Code の Bash ツールのような
非対話シェルにも効いてしまう。逆に、非対話シェルでは `.zshrc` が読まれないので、
エイリアスや `mise activate` は効かない。

`.zshenv` と `.zshrc` は最後の行を `true` で終える。直前の `if` などの結果が `$?` に残ると、
最初のプロンプトの成否表示（`%(?..)`）が赤くなるため。`make doctor` はこの前提を使って
外部からの追記を検出している（[後述](#外部アプリが-zshrc-に追記してきたとき)）。

## PATH

PATH の組み立ては `.zshenv` の `__dotfiles_path_init` 関数にまとめ、`.zshrc` の先頭で
**もう一度呼ぶ**。macOS の `/etc/zprofile` が `path_helper` を実行して `/usr/bin` などを
先頭に押し出し、`.zshenv` で決めた順序を壊すため。

- `typeset -gU path` で重複を除き、左側を優先する。何度呼んでも結果は同じ（冪等）
- `(N-/)` 修飾子で、存在するディレクトリだけを足す
- 順序は `~/.local/bin`（mise 本体、claude CLI）→ `~/.homebrew/bin` → 既存の PATH
- `MANPATH` の末尾に空要素を置く。これが無いとシステムの man が引けなくなる
- `brew shellenv` は毎回サブプロセスを起動するので使わず、出力内容を直接書いている。
  Homebrew の prefix を変えたらここも直す

mise の shims（`$XDG_DATA_HOME/mise/shims`）はコメントアウトしてある。
`mise activate` と併用すると、どちらでコマンドが解決されたのか分かりにくくなるため。
cron や GUI アプリなど非対話の環境で mise のツールが必要になったら有効にする。

`make doctor` は対話 zsh を実際に起動し、PATH の解決順を検証する。

## rc.d

番号が読み込み順になる。間を空けてあるので、新しいファイルは間の番号で足せる。

| ファイル | 内容 |
| --- | --- |
| `00-options.zsh` | `setopt`（`AUTO_CD`、`AUTO_PUSHD`、`EXTENDED_GLOB`、`GLOB_DOTS` など） |
| `05-mise.zsh` | `mise activate zsh` |
| `10-history.zsh` | ヒストリ。`$XDG_STATE_HOME/zsh/history` に 10 万件。シェル間で共有し、重複は古い方を消す |
| `20-completion.zsh` | `fpath` の追加、`compinit`、補完の `zstyle` |
| `30-keybind.zsh` | emacs キーバインド。`^P`/`^N` で前方一致のヒストリ検索、`^R` で peco によるヒストリ検索 |
| `40-alias.zsh` | エイリアスと関数（下表） |
| `50-prompt.zsh` | プロンプト（2 行。下記） |
| `80-plugin.zsh` | プラグイン。今は何も入れていない |
| `90-tools.zsh` | `eval "$(cmd ...)"` 系（今は `gh` の補完だけ） |

**順序に意味があるところ**

- `05-mise` は `40-alias` より前に置く。peco や ghq は mise 管理で、`mise activate` するまで
  PATH に無い。`40-alias` はコマンドの有無を見てからエイリアスを定義するため、
  順序が逆だと、コマンドは入っているのにエイリアスが定義されない
- `05-mise` は `20-completion` の `compinit` よりも前にある。mise が `fpath` に補完を足す場合に効く
- `90-tools` の `gh completion` は `compdef` を使うので、`compinit` より後に読む

00〜50 の `setopt` には「あえて入れないもの」もコメントで残してある。
挙動が変わる設定を足す前に、その一覧を確認する。

## エイリアスと関数

| 名前 | 内容 |
| --- | --- |
| `ls` | `gls --color=tty`（GNU ls が無ければ `ls -G`）。`ll` `la` も同様 |
| `rm` | `rmtrash`（ゴミ箱に送る）。本物の rm は `command rm` |
| `df` | `dfc` |
| `..` `...` | 1 つ上、2 つ上のディレクトリへ移動 |
| `dot` | このリポジトリへ cd |
| `pg` | ghq 管理下のリポジトリを peco で選んで cd |
| `pdd` | `dd-*` スキルの生成物ディレクトリを peco で選んで cd（引数は初期クエリ）。一覧は `design-docs-dir.sh --all` に任せる |
| `awsp` | AWS プロファイルを peco で選んで `AWS_PROFILE` に設定する（引数で直接指定もできる） |
| `board` | 状況ボード（board-agent）の CLI。node は board-agent 側の mise で固定しているので `mise exec` を通す |

- `rm` に hasseg 版の `trash` を使わないのは、`rm -rf dir` のような rm のオプションを
  受け付けず、失敗するため
- `pdd` と `board` を関数にしているのは、peco をキャンセルしたときに cd しない（ホームへ
  移動しない）ようにするためと、引数をそのまま渡すため
- `awsp` は、peco をキャンセルしたときや一覧に無い値が返ったときは何も変えない。
  `AWS_PROFILE` が空のまま export すると、aws CLI が空の名前のプロファイルを探してしまう

これらは対話シェルだけで定義される。Claude Code の Bash ツールで
`command not found` になっても、設定が壊れているわけではない。

## プロンプト

```
 AWS:<profile> [~/path]                       (git)-[main] +-? (p2):S1 2026/10/09 12:34:56
user@host 1-0 $
```

- 1 行目の左は AWS プロファイル（設定時だけ）とカレントディレクトリ、右端は VCS 情報と日時
- 2 行目は `user@host`、tmux の中なら `ウィンドウ番号-ペイン番号`、プロンプトマーク。
  マークは直前のコマンドが成功なら緑、失敗なら赤
- VCS 情報の記号は、`+` がステージ済み、`-` が未ステージ、`?` が未追跡、
  `(pN)` が未 push のコミット数、`:SN` が stash の数
- 未 push の数は main / master でだけ出す。作業ブランチは未 push で当たり前なので出さない。
  比較の相手は origin 決め打ちではなく、そのブランチの upstream
- 右寄せの幅を計算するとき、色のエスケープを除いて表示幅を測る。日時を `%D{...}` のまま
  渡すと、秒の `%S` を装飾の `%S` と間違えて消してしまうので、`strftime` で文字列にしてから埋め込む
- `RPROMPT` は使わない

## 補完

- 自作の補完関数は `~/.config/zsh/completions` に置く（`fpath` に入っている）
- 外部アプリの補完も、`compinit` より前に `20-completion.zsh` で `fpath` に足す
  （例: `~/.docker/completions`）
- `compinit` の dump は `~/.cache/zsh/zcompdump`。24 時間以内に作られたものがあれば `-C` で
  検証を省いて読む。**補完を足した直後は `rm ~/.cache/zsh/zcompdump` で作り直す**
- 大文字小文字を区別せず補完し、候補が 2 つ以上あるときはメニュー選択になる

## このマシンだけの設定

`~/.zshenv.local` は `.zshenv` の最後に、`~/.zshrc.local` は `.zshrc` の最後に読まれる。
どちらもリポジトリ管理外。

## 外部アプリが `~/.zshrc` に追記してきたとき

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
