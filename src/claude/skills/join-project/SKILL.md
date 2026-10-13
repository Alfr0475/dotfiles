---
description: Explore an existing project and generate CLAUDE.md. Use when joining a project for the first time without AI setup.
disable-model-invocation: true
---

このプロジェクトへの初回参加セッションです。コードベースを探索して現状を把握し、CLAUDE.md を生成してください。
途中で確認や質問はせず、探索から生成まで一気に完了させること。

## 探索手順

### Step 1: 全体構造の把握

- ルートのファイル・ディレクトリ一覧を確認する
- `README.md` があれば読む
- `docs/` があれば主要ドキュメントを確認する

### Step 2: 技術スタックの特定

以下のファイルが存在すれば読む：

- `package.json` / `yarn.lock` / `pnpm-lock.yaml`
- `Cargo.toml`
- `go.mod`
- `requirements.txt` / `pyproject.toml` / `Pipfile`
- `Gemfile`
- `build.gradle` / `pom.xml`

### Step 3: アーキテクチャの把握

- エントリーポイント（`src/main.*` / `src/index.*` / `cmd/main.go` / `app.py` 等）を読む
- 主要ディレクトリをいくつか掘り下げ、コードの構造・パターンを把握する

### Step 4: 開発規約の把握

以下のファイルが存在すれば読む：

- `.eslintrc*` / `.prettierrc*` / `biome.json`
- `rustfmt.toml` / `.editorconfig`
- `Makefile` / `justfile`（コマンド定義の把握）

### Step 5: 現在の状況の把握

- `git log --oneline -20` で最近のコミット履歴とメッセージの慣習を確認する
- `git status` で進行中の変更を確認する
- `git branch` で現在のブランチ名を確認する

## CLAUDE.md の生成

探索完了後、以下のテンプレートに従って `CLAUDE.md` をプロジェクトルートに生成する。
推測で埋めず、不明な項目は `<!-- 要確認 -->` と記載すること。
生成後、「要確認」にした箇所の一覧を出力すること。

---

# [プロジェクト名]

## プロジェクト概要

[このプロジェクトが何をするものか・誰のためのものか]

## 技術スタック

| 種別 | 内容 |
|------|------|
| 言語 | |
| フレームワーク | |
| 主要ライブラリ | |
| テスト | |
| DB / ストレージ | |

## ディレクトリ構成

```
[主要ディレクトリとその役割]
```

## よく使うコマンド

```bash
# 開発サーバー起動


# ビルド


# テスト


# Lint / Format

```

## コーディング規約

[命名規則・フォーマット・その他のルール。コードから読み取った慣習も含める]

## アーキテクチャ上の重要な決定

[設計上の制約・変えてはいけない前提・採用したパターンとその理由]

## 現在の開発状況

- **完了**: [完了している機能・実装]
- **進行中**: [WIP の内容]
- **既知の問題**: [既知のバグ・技術的負債]

## Claude 向け行動指針

- [このプロジェクトで Claude Code が特に注意すべきこと]
- [変更してはいけないファイル・領域があれば記載]
- [コードスタイル上の優先事項]
