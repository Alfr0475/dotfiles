#------------------------------------------------------------------------------
# dotfiles
#
#   新しい Mac では ghq の規約に合わせた場所に clone して make する:
#     git clone git@github.com:koga-s-cr/dotfiles.git \
#       ~/work/sources/git/github.com/koga-s-cr/dotfiles
#     cd ~/work/sources/git/github.com/koga-s-cr/dotfiles && make
#
#   全てのターゲットは何度実行しても結果が変わらない（冪等）ように作っている。
#------------------------------------------------------------------------------

SHELL   := /bin/bash
DOTFILES_ROOT := $(patsubst %/,%,$(dir $(realpath $(lastword $(MAKEFILE_LIST)))))
SCRIPTS       := $(DOTFILES_ROOT)/scripts

# スクリプト側は自身の位置から DOTFILES_ROOT を導出するので export はしない。
# （旧 dotfiles の DOTPATH のような外部変数に依存させないため）

.DEFAULT_GOAL := install

.PHONY: install
install: deploy brew mise vim-plugins tmux-plugins claude iterm2 ## 一括セットアップ（deploy -> brew -> mise -> プラグイン -> claude -> iterm2）
	@printf '\n\033[1;32m==> 完了しました。新しいシェルを開いてください（exec $$SHELL）\033[0m\n'

.PHONY: deploy
deploy: ## etc/links.conf に従ってシンボリックリンクを配置する
	@bash $(SCRIPTS)/deploy.sh

.PHONY: check
check: ## deploy で何が起きるかを表示するだけ（変更しない）
	@bash $(SCRIPTS)/deploy.sh --dry-run

.PHONY: unlink
unlink: ## このリポジトリが張ったシンボリックリンクを削除する
	@bash $(SCRIPTS)/deploy.sh --unlink

.PHONY: brew
brew: ## Homebrew を ~/.homebrew に導入し etc/Brewfile を反映する
	@bash $(SCRIPTS)/homebrew.sh

.PHONY: mise
mise: ## mise を導入し src/mise/config.toml のツールを入れる
	@bash $(SCRIPTS)/mise.sh

.PHONY: vim-plugins
vim-plugins: ## etc/vim-plugins.txt の vim プラグインを ~/.vim/pack に導入する
	@bash $(SCRIPTS)/vim-plugins.sh

.PHONY: tmux-plugins
tmux-plugins: ## etc/tmux-plugins.txt の tmux プラグインを ~/.tmux/plugins に導入する
	@bash $(SCRIPTS)/tmux-plugins.sh

.PHONY: claude
claude: ## Claude Code の設定を ~/.claude に配置する
	@bash $(SCRIPTS)/claude-install.sh --no-cli

.PHONY: iterm2
iterm2: ## iTerm2 の設定が無ければリポジトリから復元する（既存は変更しない）
	@bash $(SCRIPTS)/iterm2.sh

.PHONY: iterm2-save
iterm2-save: ## iTerm2 の設定変更をリポジトリに取り込む
	@bash $(SCRIPTS)/iterm2.sh --save

.PHONY: iterm2-load
iterm2-load: ## リポジトリの iTerm2 設定を ~/.config/iterm2 に復元する
	@bash $(SCRIPTS)/iterm2.sh --load

.PHONY: doctor
doctor: ## 環境が整っているか確認する（何も変更しない）
	@bash $(SCRIPTS)/doctor.sh

.PHONY: update
update: ## リポジトリを最新にしてから install し直す
	@git -C $(DOTFILES_ROOT) pull --ff-only
	@$(MAKE) --no-print-directory install

.PHONY: upgrade
upgrade: ## brew / mise のパッケージを新しいバージョンに上げる（破壊的なので手動実行）
	@$(HOME)/.homebrew/bin/brew update
	@$(HOME)/.homebrew/bin/brew upgrade
	@$(HOME)/.homebrew/bin/brew bundle install --file=$(DOTFILES_ROOT)/etc/Brewfile
	@$(HOME)/.local/bin/mise upgrade
	@bash $(SCRIPTS)/vim-plugins.sh --update
	@bash $(SCRIPTS)/tmux-plugins.sh --update

.PHONY: brewfile-dump
brewfile-dump: ## 現在の brew の状態を etc/Brewfile に書き出す（コメントは失われる）
	@$(HOME)/.homebrew/bin/brew bundle dump --force --file=$(DOTFILES_ROOT)/etc/Brewfile
	@echo "etc/Brewfile を上書きしました。git diff で確認してください。"

.PHONY: list
list: ## 配置されるリンクの一覧を表示する
	@grep -v -e '^[[:space:]]*#' -e '^[[:space:]]*$$' $(DOTFILES_ROOT)/etc/links.conf

.PHONY: help
help: ## このヘルプを表示する
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) \
		| awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-16s\033[0m %s\n", $$1, $$2}'
