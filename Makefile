DOTPATH    := $(realpath $(dir $(lastword $(MAKEFILE_LIST))))
CANDIDATES := $(notdir $(wildcard src/.??*))
EXCLUSIONS := .DS_Store .git .gitmodules .travis.yml
DOTFILES   := $(filter-out $(EXCLUSIONS), $(CANDIDATES))

all: install

help:
	@echo "make list           #=> Show dot files in this repo"
	@echo "make deploy         #=> Create symlink to home directory"
	@echo "make init           #=> Setup environment settings"
	@echo "make update         #=> Fetch changes for this repo"
	@echo "make install        #=> Run make update, deploy, init"
	@echo "make clean          #=> Remove the dot files and this repo"

list:
	@$(foreach val, $(DOTFILES), /bin/ls -dF $(val);)

deploy:
	@echo 'Copyright (c) 2016 @Alfr0475 All Rights Reserved.'
	@echo '==> Start to deploy dotfiles to home directory.'
	@echo ''
	@$(foreach val, $(DOTFILES), ln -sfnv $(abspath src/$(val)) $(HOME)/$(val);)
	@ln -sfnv $(DOTPATH)/bin $(HOME)/bin

init:
	@DOTPATH=$(DOTPATH) bash $(DOTPATH)/etc/init/init.sh

update:
	git pull origin master
	git submodule update --init --recursive
	git submodule foreach git pull origin master

install: update deploy init
	@exec $$SHELL

clean:
	@echo 'Remove dot files in your home directory...'
	@-$(foreach val, $(DOTFILES), rm -vrf $(HOME)/$(val);)
	@rm -vrf $(HOME)/bin
	-rm -rf $(DOTPATH)
