# Claude グローバル行動指針

## コミット（必須ルール・省略禁止）

**IMPORTANT: タスクが完了したら、次の作業に進む前に必ず git commit を提案すること。これは絶対に省略しない。**

- コミットは作業単位で細かく行う（まとめて後からコミットしない）
- コミットメッセージは変更内容を端的に表すこと
- ファイルを変更・作成・削除した場合は常にコミット対象として扱う

## 開発環境構築ルール

**IMPORTANT: 新しい開発環境を構築する際は必ず Dev Container を使うこと。ローカル環境にミドルウェア（DB、Redis 等）を直接インストールしてはいけない。**

- プロダクトごとに独立した Dev Container 環境を構築する
- 推奨構成: `.devcontainer/devcontainer.json` + `docker-compose.yml` + `Dockerfile`
- `docker-compose.yml` を分離することで CI でも同じ構成を流用できる

## Dev Container

Dev Container 内で Claude を使うには **VS Code Dotfiles 機能**を使う。プロジェクトの `devcontainer.json` は変更しない（チーム開発への影響を避けるため）。

### セットアップ（初回のみ）

VS Code ユーザー設定（`settings.json`）に追加：

```json
"remote.containers.dotfiles.repository": "https://github.com/koga-s-cr/dotfiles",
"remote.containers.dotfiles.targetPath": "~/dotfiles",
"remote.containers.dotfiles.installCommand": "~/dotfiles/scripts/claude-install.sh"
```

### コンテナ再ビルド後の手順

自動セットアップのタイミング問題により、再ビルド後は毎回以下が必要：

1. コンテナ内ターミナルで `bash ~/dotfiles/scripts/claude-install.sh` を実行
2. `Cmd+Shift+P` → `Developer: Reload Window`
