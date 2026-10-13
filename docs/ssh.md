# ssh

## 方針

- **秘密鍵は 1Password に置く。** リポジトリにもディスクにも秘密鍵を置かない。
  ssh は 1Password の SSH エージェント経由で署名を頼み、使うたびに Touch ID で承認する。
- **このリポジトリは公開なので、`src/ssh/config` には誰が見てもよい設定だけを書く。**
  取引先のホスト名・IP・ユーザー名は `~/.ssh/config.local`（リポジトリ管理外）に書く。
- **1Password を使うのは個人 Mac だけ。** 貸与PCには 1Password を入れておらず、
  ssh の鍵も使わない。同じ `~/.ssh/config` を配っても貸与PC側では何も変わらないようにする。

以前は秘密鍵を private リポジトリ（Alfr0475/ssh）で管理して `~/.ssh` に clone していたが、
次の理由でやめた。

- 平文の秘密鍵が GitHub 上に置かれ、履歴から消せない
- git はパーミッションを保存しないので、clone した鍵は `644` になり ssh に拒否される

## 構成

| ファイル | 管理 | 中身 |
| --- | --- | --- |
| `~/.ssh/config` | `src/ssh/config` へのリンク | 1Password の切り替え、`Include`、共通の既定値、github.com / gitlab.com |
| `~/.ssh/config.local` | 管理外（マシン固有） | 取引先のホスト。`IdentityFile` は公開鍵を指す |
| `~/.ssh/**/*.pub` | 管理外 | `IdentityFile` が指す公開鍵。1Password から書き出す |
| 秘密鍵 | 1Password | ディスクには置かない |
| `~/.config/1Password/ssh/agent.toml` | `src/1password/agent.toml` へのリンク | エージェントが鍵を出す保管庫（「個人」「サーバー」） |

### 1Password を使うマシンだけで有効にする仕組み

1Password の案内では `Host *` に `IdentityAgent` を書くよう指示されるが、
そのままでは 1Password の無い貸与PCでも存在しないソケットを指してしまう。
そこで `Match exec` でソケットの有無を見て、あるときだけ有効にしている。

```
Match exec "test -S '%d/Library/Group Containers/2BUA8C4S2C.com.1password/t/agent.sock'"
  IdentityAgent "~/Library/Group Containers/2BUA8C4S2C.com.1password/t/agent.sock"
  IdentitiesOnly yes
```

- パスに空白を含むので、`exec` の中では単引用符で囲む（`%d` はホームディレクトリ）
- ssh_config は最初に得た値が勝つので、このブロックを先頭に置く

### 鍵を出す保管庫（agent.toml）

1Password のエージェントは、既定では個人保管庫の鍵しか出さない。
業務で使うサーバーの鍵は「サーバー」保管庫に分けているので、`agent.toml` で両方を指定している。

- **`agent.toml` があると既定が無効になる。** 書いた保管庫の鍵だけが出るので、個人保管庫も明記する
- 保管庫は 1Password 上の表示名どおりに書く（`Private` / `Personal` ではなく `個人`）
- `~/.config/1Password` 自体はアプリが書き込む（`telemetry-enabled` など）ので、
  ディレクトリごとではなく `ssh/agent.toml` だけをリンクする
- 公開リポジトリに載るので、保管庫名に取引先名を入れない

### 公開鍵で鍵を選ぶ

1Password のエージェントは、1 ホストあたり最初の 6 本までしか鍵を試さない。
それを超えるとサーバー側で `Too many authentication failures` になる。
そのため各ホストの `IdentityFile` に**公開鍵**（`*.pub`）を書き、
`IdentitiesOnly yes` でその鍵だけをエージェントに出させる。
秘密鍵ではなく公開鍵を指すのは、エージェントに対して「この鍵で」と指定するのに公開鍵で足りるため。

### Include の位置

`Include` を `Match` / `Host` の直後に書くと、そのブロックの条件付きの読み込みになる
（`ssh -G -v` に `(parse only)` と出て中身が効かない）。
`Match all` で範囲を閉じてから `Include` する。

## 新しい Mac での手順（個人 Mac のみ）

1. 1Password の `設定 > 開発者` で「SSH エージェントを使用」をオンにする
2. `make install` で `~/.ssh/config` が配置される
   （既存の `~/.ssh/config` は `config.bak.<日時>` に退避される）
3. 使う鍵の公開鍵を 1Password から書き出し、`~/.ssh/` 以下に置く
   （`original.pub` と、`config.local` が指すもの）
4. `~/.ssh/config.local` を置く（1Password に保存したものを使う）
5. `make doctor` の `ssh` 欄が全て ok になることを確認する

```sh
ssh -T git@github.com   # Touch ID を求められ、認証できれば OK
```

## 鍵を追加するとき

1. 1Password で鍵を作るか取り込む（`新規アイテム > SSH キー`）。
   業務の鍵は「サーバー」保管庫に置く（別の保管庫にするなら `agent.toml` に足す）
2. 公開鍵を書き出して `~/.ssh/<会社>/<名前>.pub` に置く
3. `~/.ssh/config.local` の `IdentityFile` にその `.pub` を書く

## make doctor の検証内容

1Password のソケットがあるマシンでだけ、次を確認する（無ければ skip）。

- `ssh -G github.com` で `IdentityAgent` が 1Password になっている（`Match exec` が効いている）
- `~/.ssh` に秘密鍵のファイルが残っていない
- `IdentityFile` が指す公開鍵が全て揃っている
