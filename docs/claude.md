# Claude Code の設定

`src/claude/` に置いている。

| ファイル | 内容 |
| --- | --- |
| `CLAUDE.md` | 全プロジェクト共通の行動指針 |
| `settings.json` | モデルと effort の設定、hook の登録、`env` による Mod の読み込み |
| `skills/` | 自作スキル（`join-project`, `verification-items`, 開発フローの `dd-*`） |
| `agents/` | 自作サブエージェント（`executor`） |
| `hooks/` | Claude Code の hook から呼ばれるスクリプト |
| `mods/` | 自作 Mod（`usage-limits`）。`settings.json` の `env.CLAUDE_CODE_PLUGIN_DIRS` で読み込む |

## 配置と CLI の導入

`~/.claude` は Claude Code 自身が会話ログやセッション状態を書き込むため、
ディレクトリ全体はリンクにせず中身を個別にリンクする（`make claude`）。
会話ログ（`projects/`）や認証情報（`.credentials.json`）は配置対象に含めない。

claude CLI は公式のネイティブインストーラ（`https://claude.ai/install.sh`）で
`~/.local/bin/claude` に入れる（`make claude`）。Node.js が不要で、本体が自動更新するため
Homebrew の cask や npm は使わない。`~/.local/bin` は `src/.zshenv` で Homebrew より
前に置いているので、他の版が残っていてもネイティブ版が優先される。
brew / npm 版が残っていれば `make claude` と `make doctor` が警告する
（利用中のセッションを壊しうるので削除は手動）。

## サブエージェント

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

## 開発フロー（`dd-*` スキル）

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

## 使用量の表示（Mod）

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

## セッション名の自動付け替え

`hooks/session-title` が、セッション名を `目的 ／ 今の段階` の形に保つ。**名前を考えるのは
セッションの中の Claude 自身**で、hook は毎ターン材料と変え方を知らせるだけ。命名規則は
`src/claude/CLAUDE.md` の「セッション名」に書いてある。設計の経緯は ideas-vault の
`inbox/202611-セッション名の自動リネーム.md`。

| 役割 | 呼び方 | 内容 |
| --- | --- | --- |
| hook | `session-title --hook`（`UserPromptSubmit`） | 今の名前、同じリポジトリの最近のセッション名（10 件）、名前の変え方を `additionalContext` で知らせる |
| コマンド | `session-title "<名前>"` | CLI・VSCode のセッションで Claude が Bash から呼ぶ。transcript に `custom-title` を書き足す |

**名前の届け先は画面で違う。** `CLAUDE_CODE_ENTRYPOINT` で切り替える。

- デスクトップアプリ（`claude-desktop`）: 名前の正本はアプリにある。transcript に書いても
  次のターンでアプリに書き直されるので、Claude にアプリのツール
  `mcp__ccd_session_mgmt__set_session_title` で変えさせる。コマンドは拒否する
- CLI（`cli`）・VSCode 拡張（`claude-vscode`）: 一覧は transcript の `custom-title` を読むので、
  コマンドで書き足せば届く
- それ以外（`claude -p` など）: 何もしない

**人が付けた名前には触らない。** 判定は「今の名前が、自分が最後に付けた名前と同じか」。

- CLI・VSCode: コマンドは `"source": "session-title"` を付けて書く。最後の `custom-title` が
  最後に印付きで書いた名前と違えば、`/rename` や VSCode の履歴から人が付けた名前。
  印の有無だけでは判定できない（Claude Code 本体が、付けた名前を印なしで書き直すことがある）
- デスクトップ: `<session-id>/custom-title.json` が、Claude が最後に `set_session_title` で
  付けた名前と違えば、人がサイドバーで付け直した名前。人が付けた名前を変えようとすると
  アプリも承認を求める

**一覧は transcript の先頭 64KB と末尾 64KB しか読まない**（Claude Code 内の `$I = 65536`）。
書き足した名前はその後の会話で窓から押し出されるので、hook は名前が末尾から 32KB 以上
離れていたら同じ名前を書き直す（CLI・VSCode のみ。デスクトップはアプリが自分で書き直している）。

コマンドは auto mode で「transcript の改ざん」として止められるため、`settings.json` の
`permissions.allow` に `Bash(~/.claude/hooks/session-title:*)` を入れてある。

旧方式（`hooks/session-retitle.sh`。`Stop` hook が Haiku を裏で呼んで名前を作っていた）の
状態 `~/.claude/session-titles/` は使っていない。消してよい。

## ログの棚卸し（cclens）

[cclens](https://github.com/lambdalisue/cclens) は `~/.claude` の会話ログと設定を読み、
使われていない skill や毎セッション読まれる重いファイル、繰り返すツール失敗を洗い出す。
解析はローカルで完結し、読み取り専用。キャッシュの SQLite は消しても次回再生成される。

mise のレジストリに無いので、mise の `github:` バックエンドで Releases のバイナリを入れる（`make mise`）。
Homebrew の tap もあるが、mise に寄せる方針に従う。

```sh
cclens doctor                  # まずこれ。次に見るべきコマンドを教えてくれる
cclens waste --scope global    # ~/.claude 側の削れる設定
```

ログが少ないマシンでは結果が薄い。貸与PCのように使い込んだ環境で見る。

## Dev Container で使う

VS Code のユーザー設定に追加すると、コンテナ内でも同じ設定と skills が使える。

```json
"remote.containers.dotfiles.repository": "https://github.com/Alfr0475/dotfiles",
"remote.containers.dotfiles.targetPath": "~/dotfiles",
"remote.containers.dotfiles.installCommand": "~/dotfiles/scripts/claude-install.sh"
```

`claude-install.sh` はコンテナ内でも同じネイティブインストーラで claude CLI を導入する（curl が必要）。
