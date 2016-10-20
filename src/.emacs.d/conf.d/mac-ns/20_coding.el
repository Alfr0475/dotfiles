(require 'whitespace)
(setq whitespace-style '(face           ; faceで可視化
                         trailing       ; 行末
                         tabs           ; タブ
                         space-mark
                         tab-mark
                         ))

(setq whitespace-display-mappings
      '((?\t [?\u00BB ?\t] [?\\ ?\t])))

(global-whitespace-mode 1)

;; paren
(show-paren-mode t)                     ; 対応括弧のハイライト
(setq show-paren-style 'mixed)          ; 括弧が画面外なら内容をハイライト

;; indent
(setq-default indent-tabs-mode nil)     ; タブを使わない
(setq-default indent-level 4)           ; インデントレベル
(setq-default tab-width 4)              ; タブ幅

;; up/down case
(put 'upcase-region 'disabled nil)      ; 大文字化の問い合わせ無し
(put 'downcase-region 'disabled nil)    ; 小文字化の問い合わせ無し

;; save place
(setq-default save-place t)             ; 各種ファイルのカーソル位置を記憶
(require 'saveplace)
(setq save-place-file (concat user-emacs-directory "tmp/save-place")) ; カーソル位置記憶用ファイル

;; 1行ずつスクロールさせる
(setq scroll-conservatively 35
       scroll-margin 0
       scroll-step 1)

;; dirtree
(require 'dirtree)
(require 'eproject)
(defun ep-dirtree ()
  (interactive)
  (dirtree eproject-root t))
(global-set-key (kbd "C-c C-j") 'ep-dirtree)

;;------------------------------------------------------------------------------
;; auto-complete
;;------------------------------------------------------------------------------
(require 'auto-complete-config)
;; (require 'auto-complete-yasnippet)
(require 'pos-tip)

(setq ac-comphist-file (concat user-emacs-directory "tmp/ac-comphist.dat"))

(add-to-list 'ac-dictionary-directories (concat user-emacs-directory "data/auto-complete/dict"))

(ac-config-default)

;; (setq ac-auto-start 1)                ; 補完を開始する文字数
(setq ac-auto-show-menu 0.2)          ; 補完リストが表示されるまでの時間

;; 補完メニュー表示キー
(ac-set-trigger-key "TAB")

;; 補完メニュー操作
(setq ac-use-menu-map t)
(define-key ac-menu-map "\C-n" 'ac-next)
(define-key ac-menu-map "\C-p" 'ac-previous)

;; 補完リスト設定追加
(defun ac-php-mode-setup ()
  (setq ac-sources (append '(ac-source-yasnippet) ac-sources)))
(add-hook 'php-mode-hook 'ac-php-mode-setup)

;;------------------------------------------------------------------------------
;; ace
;;------------------------------------------------------------------------------
(global-ace-isearch-mode 1)             ; 常にace-isearchを有効にする
(define-key isearch-mode-map (kbd "M-o") 'helm-multi-swoop-all-from-isearch)

;;------------------------------------------------------------------------------
;; diff
;;------------------------------------------------------------------------------
(defun diff-mode-setup ()
  (diff-auto-refine-mode t)           ; 変更箇所の文字単位で色を付ける

  (set-face-foreground 'diff-added             "#90EE90") ; diff 追加分文字
  (set-face-foreground 'diff-changed           "#FFFF00") ; diff 追加分文字
  (set-face-foreground 'diff-indicator-added   "#90EE90") ; diff 追加分文字
  (set-face-foreground 'diff-indicator-changed "#FFFF00") ; diff 追加分文字
  (set-face-foreground 'diff-indicator-removed "#8B0000") ; diff 追加分文字
  (set-face-foreground 'diff-refine-change     "#000000") ; diff 文字単位での変更箇所文字
  (set-face-background 'diff-refine-change     "#FFFF00") ; diff 文字単位での変更箇所背景
  (set-face-foreground 'diff-removed           "#8B0000") ; diff 削除分文字
  )
(add-hook 'diff-mode-hook 'diff-mode-setup)

;;------------------------------------------------------------------------------
;; anzu
;;------------------------------------------------------------------------------
(require 'anzu)
(global-anzu-mode +1)

;;------------------------------------------------------------------------------
;; auto-highlight-symbol
;;------------------------------------------------------------------------------
(require 'auto-highlight-symbol)
(global-auto-highlight-symbol-mode)

;;------------------------------------------------------------------------------
;; flycheck
;;------------------------------------------------------------------------------
;; (require 'flycheck)

;; (setq flycheck-check-syntax-automatically '(mode-enabled save idle-change))
;; (setq flycheck-idle-change-delay 2)

;; (add-hook 'after-init-hook #'global-flycheck-mode)

;;------------------------------------------------------------------------------
;; git-gutter-fringe+
;;------------------------------------------------------------------------------
(require 'git-gutter-fringe)
(global-git-gutter-mode 1)

;;------------------------------------------------------------------------------
;; rainbow-mode
;;------------------------------------------------------------------------------
(require 'rainbow-mode)
(setq rainbow-html-colors t)
(setq rainbow-x-colors t)
(setq rainbow-latex-colors t)
(setq rainbow-ansi-colors t)

;;------------------------------------------------------------------------------
;; rainbow-delimiters
;;------------------------------------------------------------------------------
(require 'rainbow-delimiters)
(add-hook 'prog-mode-hook 'rainbow-delimiters-mode) ; 括弧の対応を虹色にする

;; rainbow-delimitersの色を強調する
;; http://d.hatena.ne.jp/murase_syuka/20140815/1408061850
(require 'cl-lib)
(require 'color)
(cl-loop
 for index from 1 to rainbow-delimiters-max-face-count
 do
 (let ((face (intern (format "rainbow-delimiters-depth-%d-face" index))))
   (cl-callf color-saturate-name (face-foreground face) 30)))

;;------------------------------------------------------------------------------
;; yasnippet
;;------------------------------------------------------------------------------
;; (require 'yasnippet)

;; (custom-set-variables
;;  '(yas/trigger-key "TAB")               ; 単語展開キーバインド
;;  '(yas/snippet-dirs '("~/.emacs.d/data/yasnippet"))) ; スニペットの保存先

;; (yas/global-mode 1)

;; ;; helm interface
;; (eval-after-load "helm-config"
;;   '(progn
;;      (defun my-yas/prompt (prompt choices &optional display-fn)
;;        (let* ((names (loop for choice in choices
;;                            collect (or (and display-fn (funcall display-fn choice))
;;                                        choice)))
;;               (selected (helm-other-buffer
;;                          `(((name . ,(format "%s" prompt))
;;                             (candidates . names)
;;                             (action . (("Insert snippet" . (lambda (arg) arg))))))
;;                          "*helm yas/prompt*")))
;;          (if selected
;;              (let ((n (position selected names :test 'equal)))
;;                (nth n choices))
;;            (signal 'quit "user quit!"))))
;;      (custom-set-variables '(yas/prompt-functions '(my-yas/prompt)))
;;      (define-key helm-command-map (kbd "y") 'yas/insert-snippet)))

;; (add-to-list 'auto-mode-alist '("\\.yasnippet$" . snippet-mode))

;; ;; keybind
;; (define-key yas-minor-mode-map (kbd "C-x i i") 'yas-insert-snippet) ; 既存スニペットの挿入
;; (define-key yas-minor-mode-map (kbd "C-x i n") 'yas-new-snippet)    ; 新規スニペットの作成
;; (define-key yas-minor-mode-map (kbd "C-x i v") 'yas-visit-snippet-file) ; 既存スニペットの閲覧と編集

;;------------------------------------------------------------------------------
;; align
;;------------------------------------------------------------------------------
(require 'align)

;; Align for php-mode
;; http://d.hatena.ne.jp/Tetsujin/20070614/1181757931
(add-to-list 'align-rules-list
             '(php-assignment
               (regexp   . "[^-=!^&*+<>/.| \t\n]\\(\\s-*[.-=!^&*+<>/|]*\\)=>?\\(\\s-*\\)\\([^= \t\n]\\|$\\)")
               (justify  . t)
               (tab-stop . nil)
               (modes    . '(php-mode))))
(add-to-list 'align-dq-string-modes 'php-mode)
(add-to-list 'align-sq-string-modes 'php-mode)
(add-to-list 'align-open-comment-modes 'php-mode)
(setq align-region-separate (concat "\\(^\\s-*$\\)\\|"
                                    "\\([({}\\(/\*\\)]$\\)\\|"
                                    "\\(^\\s-*[)}\\(\*/\\)][,;]?$\\)\\|"
                                    "\\(^\\s-*\\(}\\|for\\|while\\|if\\|else\\|"
                                    "switch\\|case\\|break\\|continue\\|do\\)[ ;]\\)"
                                    ))

;;------------------------------------------------------------------------------
;; pcre2el
;;------------------------------------------------------------------------------
(require 'pcre2el)
(setq reb-re-syntax 'pcre)              ; re-builderのデフォルトをpcreに変更
