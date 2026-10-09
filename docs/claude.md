# Claude Code の設定

`src/claude/` に置いている。

| ファイル | 内容 |
| --- | --- |
| `CLAUDE.md` | 全プロジェクト共通の行動指針 |
| `settings.json` | モデルと effort の設定、hook の登録、`env` による Mod の読み込み |
| `skills/` | 自作スキル（`join-project`, `promote-product`, `verification-items`, 開発フローの `dd-*`） |
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

## Dev Container で使う

VS Code のユーザー設定に追加すると、コンテナ内でも同じ設定と skills が使える。

```json
"remote.containers.dotfiles.repository": "https://github.com/koga-s-cr/dotfiles",
"remote.containers.dotfiles.targetPath": "~/dotfiles",
"remote.containers.dotfiles.installCommand": "~/dotfiles/scripts/claude-install.sh"
```

`claude-install.sh` はコンテナ内でも同じネイティブインストーラで claude CLI を導入する（curl が必要）。
