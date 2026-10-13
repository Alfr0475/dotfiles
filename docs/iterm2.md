# iTerm2

設定フォルダの初回指定は README の「新しい Mac で必要な手作業」を参照。

## 設定を更新したとき

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
