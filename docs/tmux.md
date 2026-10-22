# tmux のステータスライン（tmux-powerline）

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

iTerm2 のプロファイル（`feel-at-home`）は `HackGenConsoleNF-Regular` を指定している
（旧名 `HackGenConsoleForPowerline-Regular` の後継）。

## フォントが入っているのに使えない場合

`~/Library/Fonts/` に HackGen の `.ttf` があり、Font Book でファイルを開くと
「インストール済み」と出るのに、フォント一覧には出ず iTerm2 でも選べないことがある。
cask がダウンロード時に付けた `com.apple.quarantine` が原因で macOS がフォントを登録せず、
その結果がフォントキャッシュに残ってしまうため。quarantine を外しただけでは直らない。

- `make brew` は HackGen フォントの quarantine を外す（Homebrew から `--no-quarantine` が
  無くなったため）
- `make doctor` は「ファイルがあるか」に加えて `HackGenConsoleNF-Regular` を名前で引けるかを見る

それでも登録されていなければ、ユーザーのフォントキャッシュを作り直して Mac を再起動する
（消えるのはキャッシュだけで、フォントファイルは残る）。

```sh
atsutil databases -removeUser
atsutil server -shutdown
atsutil server -ping
```
