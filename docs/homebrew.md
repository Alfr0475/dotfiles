# Homebrew

このリポジトリは管理権限の無い貸与PCと、管理権限のある個人Macの両方で使う。
Homebrew の導入先（prefix）だけがマシンによって変わり、それ以外の設定は共通。

| マシン | prefix | 導入方法 |
| --- | --- | --- |
| 管理権限なし（貸与PC） | `~/.homebrew` | `Homebrew/brew` を git clone |
| 管理権限あり（個人Mac） | `/opt/homebrew` | 公式インストーラ（sudo が要る） |

## prefix の判定

設定ファイルは持たず、マシンの状態から次の順で決める。

1. `~/.homebrew/bin/brew` がある → `~/.homebrew`
2. `/opt/homebrew/bin/brew` がある → `/opt/homebrew`
3. どちらも無い（新しい Mac）→ ユーザーが `admin` グループなら `/opt/homebrew`、それ以外は `~/.homebrew`

判定は 2 か所にある。変えるときは両方直す。

- `scripts/lib/common.sh` の `resolve_homebrew_prefix`（make 側。1〜3 すべて）
- `src/.zshenv`（シェル側。1〜2 だけ。未導入なら `~/.homebrew` 扱いだが、
  `(N-/)` で PATH に入らないので害は無い）

環境変数 `HOMEBREW_PREFIX` が既にあればスクリプトはそれを使う。対話シェルから
`make` すると `.zshenv` の判定結果がそのまま渡るので、両者が食い違うことはない。
管理権限があっても `~/.homebrew` に入れたい場合は、初回だけ
`HOMEBREW_PREFIX=~/.homebrew make brew` とすれば以後は 1 で判定される。

`make upgrade` / `make brewfile-dump` も `common.sh` の判定（`BREW_BIN`）を使う。
`make doctor` は判定された prefix と、`brew --prefix` がそれに一致するかを表示する。

## 導入と更新を分ける

`make brew` は Brewfile にあって未導入のものを入れるだけで、導入済みのものは更新しない。
更新は `make upgrade` で手動で行う。

`brew bundle check` / `install` は、既定では古いだけの formula も「満たしていない」と
扱い、更新しようとする。そこで `make brew`（`scripts/homebrew.sh`）と `make doctor` の
`check` / `install` には、すべて `--no-upgrade` を付けている。`check` に付け忘れると、
更新を待つものがあるだけで `make brew` が毎回 `changed` になり、doctor も warn を出す。

## `~/.homebrew` の注意

公式インストーラは `/opt/homebrew` か `/usr/local` しか受け付けないため、
[公式ドキュメント](https://docs.brew.sh/Installation#untar-anywhere-unsupported) の
untar-anywhere 方式（git clone）で入れている。

非標準 prefix では配布ビルド（bottle）が使えない formula があり、その場合は
ソースからのビルドになって時間がかかる。重いものは mise 側で入れられないか先に検討する。
`/opt/homebrew` ではこの制約は無い。

## 2 台で運用する流れ

どちらのマシンでも同じ `main` ブランチに commit / push する。もう一方のマシンでは
`make update`（`git pull --ff-only` → `make install`）で取り込む。

マシン固有の値はリポジトリに入れず `*.local`（README「このマシンだけの設定」）に置く。
`etc/Brewfile` は両マシン共通。`make brewfile-dump` は実行したマシンの状態をそのまま
書き出すので、片方にしか無いパッケージが混ざっていないか差分を必ず確認する。
