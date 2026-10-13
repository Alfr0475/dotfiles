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

> iTerm2 のプロファイルは `HackGenConsoleForPowerline-Regular` を指定しているが、
> HackGen 側で命名が変わり現在の後継は `HackGenConsoleNF-Regular`。
> セパレータが豆腐になる場合はプロファイルのフォントを差し替える。
