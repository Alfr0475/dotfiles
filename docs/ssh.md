# ssh

## 方針

- **秘密鍵は 1Password に置く。** リポジトリにもディスクにも秘密鍵を置かない。
  ssh は 1Password の SSH エージェント経由で署名を頼み、使うたびに Touch ID で承認する。
- **このリポジトリは公開なので、`src/ssh/config` には誰が見てもよい設定だけを書く。**
  取引先のホスト名・IP・ユーザー名は `~/.ssh/config.local`（リポジトリ管理外）に書く。
- **1Password を使うのは個人 Mac だけ。** 貸与PCには 1Password を入れていない。
  同じ `~/.ssh/config` を配っても貸与PC側では 1Password の設定が効かないようにし、
  鍵は従来どおりディスクに置いて `~/.ssh/config.local` で指定する（[貸与PC](#貸与pc1password-なし)）。

以前は秘密鍵を private リポジトリ（Alfr0475/ssh）で管理して `~/.ssh` に clone していたが、
次の理由でやめた。

- 平文の秘密鍵が GitHub 上に置かれ、履歴から消せない
- git はパーミッションを保存しないので、clone した鍵は `644` になり ssh に拒否される

## 構成

| ファイル | 管理 | 中身 |
| --- | --- | --- |
| `~/.ssh/config` | `src/ssh/config` へのリンク | 1Password の切り替え、`Include`、共通の既定値、github.com / gitlab.com |
| `~/.ssh/config.local` | 1Password のドキュメント「ssh config.local」 | 取引先のホスト。`IdentityFile` は公開鍵を指す |
| `~/.ssh/keys/<アイテム名>.pub` | `make ssh` がエージェントから書き出す | `IdentityFile` が指す公開鍵 |
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

### 公開鍵と config.local の配布（make ssh）

`make ssh`（`make install` にも含まれる）が 1Password から次の 2 つを取り出す。
1Password のソケットが無いマシンでは何もしない。

| 対象 | 取り出し方 | 既にあるとき |
| --- | --- | --- |
| 公開鍵 | `ssh-add -L` でエージェントから。`~/.ssh/keys/<アイテム名>.pub` に書く | 内容が違えば書き直す |
| config.local | `op document get "ssh config.local"` | **上書きしない**。1Password と違えば知らせるだけ |

- **公開鍵のファイル名は 1Password のアイテム名そのもの。** 対応表を別に持たないため。
  アイテム名を変えたら `config.local` の `IdentityFile` も直す。`/` と空白は使えない
- 公開鍵は `op item get` ではなくエージェントから取る。`ssh-add -L` はアイテム名を
  コメントにして公開鍵を返し、承認も要らない。また `op item get` は、取り込んだ
  `.pem`（AWS 形式）の鍵だと `PEM block contains more than just private key` で失敗する
- config.local は手元で編集していることがあるので、既存のファイルは上書きしない。
  手元で直したら `make ssh-save` で 1Password に戻す。1Password 側を正にしたいときは
  手元を消してから `make ssh`
- config.local の保管先（アカウント・保管庫）はスクリプトに書かず、サインイン済みの
  全アカウントからドキュメント名で探す（公開リポジトリに取引先のアカウント名を載せないため）。
  現在は業務アカウントの「サーバー」保管庫にある
- `op` は mise で入れる（`src/mise/config.toml`）。1Password の `設定 > 開発者` で
  「1Password CLI と連携」をオンにしておくと、Touch ID で承認できる

### Include の位置

`Include` を `Match` / `Host` の直後に書くと、そのブロックの条件付きの読み込みになる
（`ssh -G -v` に `(parse only)` と出て中身が効かない）。
`Match all` で範囲を閉じてから `Include` する。

## 新しい Mac での手順（個人 Mac のみ）

1. 1Password にサインインし、`設定 > 開発者` で次の 2 つをオンにする
   - SSH エージェントを使用
   - 1Password CLI と連携
2. `make install` を実行する。`~/.ssh/config` と `agent.toml` が配置され、
   `make ssh` が公開鍵と `config.local` を 1Password から取り出す
   （既存の `~/.ssh/config` は `config.bak.<日時>` に退避される）
3. `make doctor` の `ssh` 欄が全て ok になることを確認する

```sh
ssh -T git@github.com   # Touch ID を求められ、認証できれば OK
```

`signing failed ... communication with agent failed` で失敗したら、1Password の
承認がキャンセルされたか時間切れになっている。鍵の選択は済んでいるので、もう一度実行して承認する。

## 貸与PC（1Password なし）

1Password のソケットが無いので、`src/ssh/config` の 1Password のブロックは効かず、
`make ssh` も何もしない。秘密鍵をディスクに置き、`~/.ssh/config.local` を手で書く。

```
Host github.com
  HostName github.com
  User git
  IdentityFile ~/.ssh/github
  IdentitiesOnly yes
```

- 秘密鍵は `chmod 600` にする（group / other から読めると ssh が拒否する）
- この `config.local` は 1Password に保存しない（`make ssh-save` は 1Password が無いと動かない）
- `make install` で既存の `~/.ssh/config` は `config.bak.<日時>` に退避されるので、
  元の設定はそこから `config.local` へ移す
- GitHub の鍵がどのアカウントに登録されているかに注意する。`ssh -T git@github.com` の
  `Hi <アカウント>!` で確かめ、別アカウントのリポジトリに push するならそのアカウントを
  コラボレーターに加える

## 鍵を追加するとき

1. 1Password で鍵を作るか取り込む（`新規アイテム > SSH キー`）。
   業務の鍵は「サーバー」保管庫に置く（別の保管庫にするなら `agent.toml` に足す）
   アイテム名がそのまま公開鍵のファイル名になるので、`/` と空白を含めない
2. `make ssh` で `~/.ssh/keys/<アイテム名>.pub` が書き出される
3. `~/.ssh/config.local` の `IdentityFile` にその `.pub` を書き、`make ssh-save` で 1Password に保存する

## make doctor の検証内容

1Password のソケットがあるマシンでだけ、次を確認する（無ければ skip）。

- `ssh -G github.com` で `IdentityAgent` が 1Password になっている（`Match exec` が効いている）
- `~/.ssh` に秘密鍵のファイルが残っていない
- `IdentityFile` が指す公開鍵が全て揃っている
- `~/.ssh/config.local` がある（1Password との差分までは見ない。`op` の呼び出しで承認を
  求められるため。差分は `make ssh` が知らせる）

1Password のソケットが無いマシン（貸与PC）では、`~/.ssh/config.local` があるときだけ次を確認する
（無ければ鍵を使わないマシンとして skip）。

- `config.local` の `IdentityFile` が指す鍵が全て揃っている
- その秘密鍵が group / other から読めない
