# zsh

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
