;; JavaScript
(add-to-list 'auto-mode-alist '("\\.js$" . js2-mode))

;; HTML
(add-to-list 'auto-mode-alist '("\\.html$" . web-mode))
(add-to-list 'auto-mode-alist '("\\.tpl$" . web-mode))
(add-to-list 'auto-mode-alist '("\\.ctp$" . web-mode))
(add-to-list 'auto-mode-alist '("\\.blade\\.php$" . web-mode))

;; Shell Script
(add-to-list 'auto-mode-alist '("\\.bash$" . sh-mode))
(add-to-list 'auto-mode-alist '("\\.zsh$" . sh-mode))
(add-to-list 'auto-mode-alist '("zsh\\.d\\/zsh[env|function|rc]" . sh-mode))

;; batch
(add-to-list 'auto-mode-alist '("\\.[bB][aA][tT]$" . cmd-mode))

;; markdown
(add-to-list 'auto-mode-alist '("\\.md$" . gfm-mode))

;; textile
(add-to-list 'auto-mode-alist '("\\.textile$" . textile-mode))

;; yaml
(add-to-list 'auto-mode-alist '("\\.yml$" . yaml-mode))

;; org
(add-to-list 'auto-mode-alist '("\\.org$" . org-mode))

;; csv
(add-to-list 'auto-mode-alist '("\\.csv$" . csv-mode))

;; json
(add-to-list 'auto-mode-alist '("\\.json$" . json-mode))

;; sass
(add-to-list 'auto-mode-alist '("\\.sass$" . sass-mode))

;; scss
(add-to-list 'auto-mode-alist '("\\.scss$" . scss-mode))

;; tsv
(add-to-list 'auto-mode-alist '("\\.tsv$" . tsv-mode))

;; ssh config
(add-to-list 'auto-mode-alist '("\\.ssh\\/config$" . ssh-config-mode))

;; git config
(add-to-list 'auto-mode-alist '("\\.gitconfig.*$" . gitconfig-mode))

;; git ignore
(add-to-list 'auto-mode-alist '("\\.gitignore.*$" . gitignore-mode))
