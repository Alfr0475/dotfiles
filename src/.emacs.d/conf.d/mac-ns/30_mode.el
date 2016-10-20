;;------------------------------------------------------------------------------
;; Original C Style
;;------------------------------------------------------------------------------
(require 'c-style-base)
(require 'c-style-php)

;;------------------------------------------------------------------------------
;; PHP
;;------------------------------------------------------------------------------
;; hook
(add-hook 'php-mode-hook
          '(lambda ()
             (c-set-style "c-style-php") ; オリジナルのスタイルを使用
             (setq comment-start "// ")
             (setq comment-end   "")
             (setq comment-start-skip "// *")

             (rainbow-mode t)
             ;; auto-completionのphp用設定
             (require 'php-completion)
             (php-completion-mode t)
             ;;(define-key php-mode-map (kbd "\C-o") 'phpcmp-complete)
             (when (require 'auto-complete nil t)
               (make-variable-buffer-local 'ac-sources)
               (add-to-list ac-sources '(
                                         ac-source-php
                                         ac-source-php-completion
                                         ac-source-words-in-same-mode-buffers
                                         ac-source-filename
                                         ))
               (auto-complete-mode t))
             ))

;;------------------------------------------------------------------------------
;; Ruby
;;------------------------------------------------------------------------------
;; RSense
(cond ((and run-linux)
       (setq rsense-home (expand-file-name "~/contrib/rsense/"))
       (require 'rsense)
       (setq rsense-rurema-home "~/data/rurema/ruby-refm-1.9.3-dynamic-20120829") ; リファレンスパスの指定
))

(add-hook 'ruby-mode-hook
          '(lambda ()
             (setq tab-width 2)                 ; タブサイズ
             (setq ruby-indent-level tab-width) ; インデントサイズ
             (setq ruby-deep-indent-paren-style nil) ; 引数とかを改行して並べた時にインデントを括弧に合わせない

             (cond ((and run-linux)
                    (add-to-list 'ac-sources 'ac-source-rsense-method)
                    (add-to-list 'ac-sources 'ac-source-rsense-constant)
                    ))
             ))

;; ruby-block
(require 'ruby-block)
(ruby-block-mode t)
(setq ruby-block-highlight-toggle t)    ; ミニバッファに表示し、かつオーバレイする

;;------------------------------------------------------------------------------
;; JavaScript
;;------------------------------------------------------------------------------
(when (load "js2" t)
  (require 'js)
  (setq js2-bounce-indent-flag nil
        js2-mirror-mode nil
        )

  ;; インデントしたときにスペースを除いた行頭にポイントが移動
  (defun indent-and-back-to-indentation ()
    (interactive)
    (indent-for-tab-command)
    (let ((point-of-indentation
           (save-excursion
             (back-to-indentation)
             (point))))
      (skip-chars-forward "\s " point-of-indentation)))

  (define-key js2-mode-map "\C-i" 'indent-and-back-to-indentation)
  (define-key js2-mode-map "\C-m" 'newline-and-indent)

  ;; ejacs設定
  (autoload 'js-console "js-console" nil t)
  (defun js-console-execute-region (start end)
    "Execute region"
    (interactive "r")
    (let ((buf-name (buffer-name (current-buffer))))
      (copy-region-as-kill start end)
      (switch-to-buffer-other-window "*js*")
      (js-console-exec-input (car kill-ring))
      (switch-to-buffer-other-window buf-name)))
  (defun run-js-console-and-split-window ()
    "Run js-console and split window horizontally."
    (interactive)
    (split-window-horizontally)
    (js-console)
    (other-window 1)
    )

  ;; js-modeのタブ設定を利用する
  (add-hook 'js2-mode-hook
            '(lambda ()
               (require 'js)
               (setq js-indent-level 4
                     js-expr-indent-offset 4
                     indent-tabs-mode nil
                     )

               (moz-minor-mode 1) ;; 要moz.el
               (local-set-key "\C-c\C-j" 'run-js-console-and-split-window)
               (local-set-key "\C-cr" 'js-console-execute-region)

               ;; case用のインデント関数
               (defun my-js-indent-line ()
                 (interactive)
                 (let* ((parse-status (save-excursion (syntax-ppss (point-at-bol))))
                        (offset (- (current-column) (current-indentation)))
                        (indentation (js--proper-indentation parse-status)))
                   (back-to-indentation)
                   (if (looking-at "case\\s-")
                       (indent-line-to (+ indentation 2))
                     (js-indent-line))
                   (when (> offset 0) (forward-char offset))))
               (set (make-local-variable 'indent-line-function) 'my-js-indent-line)))

  )

;;------------------------------------------------------------------------------
;; C#
;;------------------------------------------------------------------------------
(require 'csharp-mode)
;;(require 'omnisharp)

(setq omnisharp-server-executable-path (expand-file-name "/Users/skoga/work/sources/git/github.com/OmniSharp/omnisharp-server/OmniSharp/bin/Debug/OmniSharp.exe"))

(add-hook 'csharp-mode-hook
          '(lambda()
             (c-set-style "c-style-base") ; オリジナルのスタイルを使用
             ;;(set-original-c-style-base)
             ;;(font-lock-add-magic-number) ; 数値の色を変更する

             ;; csharp-insert-open-braceを無効に
             ;; 中括弧を入力した時点で勝手に指定スタイルで括弧を書かれるのが嫌だ
             (local-unset-key (kbd "{"))

             (flycheck-mode 1)
             (omnisharp-mode)
             (auto-complete-mode)

             (define-key omnisharp-mode-map "\C-c\C-s" 'omnisharp-start-omnisharp-server)
             (define-key omnisharp-mode-map "\M-/" 'omnisharp-auto-complete)
             (define-key omnisharp-mode-map "." 'omnisharp-add-dot-and-auto-complete)
             (define-key omnisharp-mode-map "\C-c\C-c" 'omnisharp-build-in-emacs)
             (define-key omnisharp-mode-map "\C-c\C-N" 'omnisharp-navigate-to-solution-member)
             (define-key omnisharp-mode-map "\C-c\C-n" 'omnisharp-navigate-to-current-file-member)
             (define-key omnisharp-mode-map "\C-c\C-f" 'omnisharp-navigate-to-solution-file)
             (define-key omnisharp-mode-map "\C-c\C-g" 'omnisharp-go-to-definition)
             (define-key omnisharp-mode-map "\C-c\C-r" 'omnisharp-rename)
             (define-key omnisharp-mode-map "\C-c\C-v" 'omnisharp-run-code-action-refactoring)
             (define-key omnisharp-mode-map "\C-c\C-o" 'omnisharp-auto-complete-overrides)
             (define-key omnisharp-mode-map "\C-c\C-u" 'omnisharp-helm-find-symbols)
             (define-key omnisharp-mode-map "\C-c\C-t\C-s" (lambda() (interactive) (omnisharp-unit-test "single")))
             (define-key omnisharp-mode-map "\C-c\C-t\C-r" (lambda() (interactive) (omnisharp-unit-test "fixture")))
             (define-key omnisharp-mode-map "\C-c\C-t\C-e" (lambda() (interactive) (omnisharp-unit-test "all")))
             ))

;;------------------------------------------------------------------------------
;; web-mode
;;------------------------------------------------------------------------------
(require 'web-mode)
(require 'ac-html)

(defun web-mode-hook ()
  (add-to-list 'ac-modes 'web-mode)

  (setq web-mode-markup-indent-offset 4) ; HTML
  (setq web-mode-css-indent-offset 4)    ; CSS
  (setq web-mode-code-indent-offset 4)   ; JavaScript,PHP

  (setq web-mode-style-padding 4)       ; <style>
  (setq web-mode-script-padding 4)      ; <script>

  (setq web-mode-enable-auto-pairing nil) ; 自動タグ閉じ
  (setq web-mode-enable-css-colorization nil) ; RGBをバックグラウンドに反映

  (setq indent-tabs-mode t)

  (rainbow-mode t)

  (setq web-mode-ac-sources-alist
        '(("css" . (ac-source-css-property))
          ("html" . (ac-source-html-attribute-value
                     ac-source-html-tag
                     ac-source-html-attribute
                     ))
          ("php" . (ac-source-php-completion
                    ac-source-words-in-same-mode-buffers
                    ac-source-filename))
          )
        )
  )
(add-hook 'web-mode-hook 'web-mode-hook)

;;------------------------------------------------------------------------------
;; Shell Script
;;------------------------------------------------------------------------------
(add-hook 'sh-mode-hook
          '(lambda ()
             (c-set-style "original-style")
             (auto-complete-mode t)
             ))

;;------------------------------------------------------------------------------
;; batch
;;------------------------------------------------------------------------------
(require 'cmd-mode)

;;------------------------------------------------------------------------------
;; markdown
;;------------------------------------------------------------------------------
(require 'markdown-mode)

;;------------------------------------------------------------------------------
;; textile
;;------------------------------------------------------------------------------
(require 'textile-mode)

;;------------------------------------------------------------------------------
;; yaml
;;------------------------------------------------------------------------------
(require 'yaml-mode)

;;------------------------------------------------------------------------------
;; css
;;------------------------------------------------------------------------------
(add-hook 'css-mode-hook 'rainbow-mode)

;;------------------------------------------------------------------------------
;; scss
;;------------------------------------------------------------------------------
(add-hook 'scss-mode-hook 'rainbow-mode)

;;------------------------------------------------------------------------------
;; org
;;------------------------------------------------------------------------------
(require 'org-install)
(setq org-log-done t)

;; メモファイルの保存先
(setq org-directory "~/.emacs.d/etc/org/")

;; org-default-notes-fileのファイル名
(setq org-default-notes-file (expand-file-name "memo.org" org-directory))

;; 画像をインライン表示
(setq org-startup-with-inline-images t)
(add-hook 'org-mode-hook 'turn-on-iimage-mode)


;; １階層下・上の見出し・項目を入力する。
(require 'org)
(defun org-insert-upheading (arg)
  "１レベル上の見出しを入力する。"
  (interactive "P")
  (org-insert-heading arg)
  (cond ((org-on-heading-p) (org-do-promote))
        ((org-at-item-p) (org-indent-item -1))))
(defun org-insert-heading-dwim (arg)
  "現在と同じレベルの見出しを入力する。
C-uをつけると１レベル上、C-u C-uをつけると１レベル下の見出しを入力する。"
  (interactive "P")
  (case arg
    (4  (org-insert-subheading nil))
    (16 (org-insert-upheading  nil))
    (t  (org-insert-heading nil))))
(define-key org-mode-map (kbd "<C-return>") 'org-insert-heading-dwim)

;; ハイパーリンクの作成
(global-set-key (kbd "C-c l") 'org-store-link)
