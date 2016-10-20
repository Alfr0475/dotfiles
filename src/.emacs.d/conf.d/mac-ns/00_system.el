(cd "~/")                               ; デフォルトディレクトリ

(set-language-environment "Japanese")   ; 言語設定

;;------------------------------------------------------------------------------
;; 文字コード
;;------------------------------------------------------------------------------
(prefer-coding-system 'utf-8-unix)      ; デフォルトの文字コード
(set-default-coding-systems 'utf-8)     ; デフォルトの文字コード
(set-keyboard-coding-system 'utf-8)     ; キーボード
(set-terminal-coding-system 'utf-8)     ; ターミナル

(require 'ucs-normalize)
(set-file-name-coding-system 'utf-8-hfs) ; ファイル名(Mac日本語の濁音/半濁音対応)

(set-default 'buffer-file-coding-system 'utf-8-unix) ; バッファー


;;------------------------------------------------------------------------------
;; システム系
;;------------------------------------------------------------------------------
(tool-bar-mode -1)                      ; ツールバー非表示
(setq resize-mini-windows nil)          ; ミニバッファのサイズを変更不可
(setq inhibit-startup-message t)        ; 起動時の画面非表示
(setq transient-mark-mode t)            ; リージョンに色をつける
(global-hl-line-mode 1)                 ; カレント行に色をつける
(setq highlight-nonselected-windows t)  ; バッファを切り替えてもリージョンの色が残る
(delete-selection-mode 1)               ; リージョン選択中に文字入力でリージョン内の文字を消す
(setq backup-inhibited t)               ; バックアップファイルを作らない
(setq delete-auto-save-files t)         ; 終了時にオートセーブファイルを消す
(setq ring-bell-function 'ignore)       ; bell消音
(defalias 'yes-or-no-p 'y-or-n-p)       ; Yes or No の選択肢を省略化
(setq completion-ignore-case t)         ; 補完の大文字小文字無視
(global-auto-revert-mode 1)             ; バッファ自動再読み込み
(setq delete-by-moving-to-trash t)      ; ファイル削除でごみ箱へ
(line-number-mode t)                    ; カーソル行表示
(column-number-mode t)                  ; カーソル列表示
(blink-cursor-mode 0)                   ; カーソル点滅表示

;; 改行コード表示
(setq eol-mnemonic-dos "(CRLF)")
(setq eol-mnemonic-mac "(CR)")
(setq eol-mnemonic-unix "(LF)")

;; スクロール系
(setq next-screen-context-lines 2)       ; 画面スクロール時の重複行数
(setq scroll-margin 5)                   ; 画面端に到達する前に画面がスクロールする
(setq scroll-preserve-screen-position t) ; スクロール時になるべくカーソル位置を変えない

(exec-path-from-shell-initialize)       ; Shellのパスを引き継ぐ

(setq auto-save-list-file-prefix "~/.emacs.d/tmp/auto-save-list/.saves-")
(setq tramp-persistency-file-name "~/.emacs.d/tmp/tramp")
(setq smex-save-file "~/.emacs.d/tmp/smex-items")
(setq url-cookie-file "~/.emacs.d/tmp/url/cookies")
(setq url-configuration-directory "~/.emacs.d/tmp/url/")

;; C-x C-C で終了するキーバインドを無効にしたのでEmacsを終了するaliase追加
(defalias 'exit-emacs 'save-buffers-kill-emacs)

;;------------------------------------------------------------------------------
;; mode-line
;;------------------------------------------------------------------------------
;; 表示時刻のカスタマイズ
(setq display-time-string-forms
      '(year "/" month "/" day " " dayname " " 24-hours ":" minutes))
(display-time)                          ; 時刻表示

;;------------------------------------------------------------------------------
;; window
;;------------------------------------------------------------------------------
(progn
  (set-scroll-bar-mode nil)         ; スクロールバー非表示
  (setq ns-pop-up-frames nil)       ; 複数起動防止
  (define-key global-map [ns-drag-file] 'ns-find-file)) ; D&Dの挙動をファイルを開く操作に変更

(setq initial-frame-alist
      (append (list
               '(width . 190)
               '(height . 50)
               )
              initial-frame-alist))
(setq default-frame-alist initial-frame-alist)

(require 'uniquify)                     ; 同名ファイル等はディレクトリパスもつける
(setq uniquify-buffer-name-style 'post-forward-angle-brackets)
(setq uniquify-ignore-buffers-re "*[^*]+*") ; *scratch*等を省く

;;------------------------------------------------------------------------------
;; hlinum
;;------------------------------------------------------------------------------
(require 'hlinum)
(global-linum-mode t)                   ; バッファ中の行番号表示
(setq linum-format "%5d")               ; 行番号書式

;;------------------------------------------------------------------------------
;; IME
;;------------------------------------------------------------------------------
(setq default-input-method "MacOSX")
(mac-add-key-passed-to-system 'shift)
(add-hook 'after-init-hook 'mac-change-language-to-us) ; 起動したら英字にする
(add-hook 'minibuffer-setup-hook 'mac-change-language-to-us) ;ミニバッファを開いた時に英字にする

(mac-set-input-method-parameter "com.google.inputmethod.Japanese.base" `title "あ")

(mac-translate-from-yen-to-backslash)   ; backslashを優先

;;------------------------------------------------------------------------------
;; yank
;;------------------------------------------------------------------------------
;; MacOSとクリップボードを共有する
;; (defun copy-from-osx ()
;;   (shell-command-to-string "pbpaste"))

;; (defun paste-to-osx (text &optional push)
;;   (let ((process-connection-type nil))
;;     (let ((proc (start-process "pbcopy" "*Messages*" "pbcopy")))
;;       (process-send-string proc text)
;;       (process-send-eof proc))))

;; (setq interprogram-cut-function 'paste-to-osx)
;; (setq interprogram-paste-function 'copy-from-osx)

;;------------------------------------------------------------------------------
;; browse-kill-ring
;;------------------------------------------------------------------------------
(require 'browse-kill-ring)
(global-set-key "\M-y" 'browse-kill-ring)
(setq browse-kill-ring-display-style 'one-line) ; kill-ring を一行で表示
(setq browse-kill-ring-quit-action 'kill-and-delete-window) ; browse-kill-ring 終了時にバッファを kill する
(setq browse-kill-ring-resize-window t) ; 必要に応じて browse-kill-ring のウィンドウの大きさを変更する
(setq browse-kill-ring-separator "-------") ; kill-ring の内容を表示する際の区切りを指定する
(setq browse-kill-ring-highlight-current-entry t) ; 現在選択中の kill-ring のハイライトする
(setq browse-kill-ring-separator-face 'region) ; 区切り文字のフェイスを指定する
(setq browse-kill-ring-maximum-display-length 100) ; 一覧で表示する文字数を指定する。 nil ならすべて表示される。

;;------------------------------------------------------------------------------
;; undo-tree
;;------------------------------------------------------------------------------
(require 'undo-tree)
(global-undo-tree-mode t)
(global-set-key (kbd "M-/") 'undo-tree-redo)

(custom-set-variables
 '(undo-tree-auto-save-history t)
 '(undo-tree-history-directory-alist '(("". "~/.emacs.d/tmp/undo-tree")))
 '(undo-tree-visualizer-timestamps t)
 )
(define-key undo-tree-visualizer-mode-map (kbd "C-g") 'undo-tree-visualizer-quit)
(define-key undo-tree-visualizer-mode-map (kbd "RET") 'undo-tree-visualizer-quit)

;;------------------------------------------------------------------------------
;; recentf
;;------------------------------------------------------------------------------
(when (require 'recentf nil t)
  (setq recentf-max-saved-items 2000)   ; 最近開いたファイル
  (custom-set-variables '(recentf-save-file "~/.emacs.d/tmp/recentf"))
  (setq recentf-exclude '("~/.emacs.d/tmp/recentf"))
  (setq recentf-auto-cleanup 10)
  (setq recentf-auto-save-timer
        (run-with-idle-timer 30 t 'recentf-save-list))
  (require 'recentf-ext))

;;------------------------------------------------------------------------------
;; session
;;------------------------------------------------------------------------------
;; ミニバッファ履歴リストの最大長：tなら無限
(setq history-length t)

;; session.el
;;   kill-ringやミニバッファで過去に開いたファイルなどの履歴を保存する
(when (require 'session nil t)
  (setq session-initialize '(de-saveplace session keys menus places)
        session-globals-include '((kill-ring 50)
                                  (session-file-alist 500 t)
                                  (file-name-history 10000)))
  (add-hook 'after-init-hook 'session-initialize)
  (setq session-save-file "~/.emacs.d/tmp/session")

  ;; 前回閉じたときの位置にカーソルを復帰
  (setq session-undo-check -1))

;; minibuf-isearch
;;   minibufでisearchを使えるようにする
(require 'minibuf-isearch nil t)

;;------------------------------------------------------------------------------
;; grep
;;------------------------------------------------------------------------------
(require 'grep)

;; grepをUTF-8に
(defadvice grep (around grep-coding-setup activate)
  (let ((coding-system-for-read 'utf-8))
    ad-do-it))

;; grep結果を編集して反映させる
(require 'wgrep)
(setq wgrep-change-readonly-file t)
(setq wgrep-enable-key "e")

;;------------------------------------------------------------------------------
;; which-key
;;------------------------------------------------------------------------------
;; 3つの表示方法どれか1つ選ぶ
(which-key-setup-side-window-bottom)       ; ミニバッファ
;; (which-key-setup-side-window-right)        ; 右端
;; (which-key-setup-side-window-right-bottom) ; 両方使う

(which-key-mode 1)

;;------------------------------------------------------------------------------
;; migemo
;;------------------------------------------------------------------------------
(when
    (and
     (executable-find "cmigemo")
     (require 'migemo nil t))

  (cond ((and run-darwin)
         (setq migemo-command "/usr/local/bin/cmigemo") ; cmigemoを使う
         (setq migemo-options '("-q" "--emacs")) ; コマンドラインオプション
         (setq migemo-dictionary "/usr/local/share/migemo/utf-8/migemo-dict") ; migemo辞書の場所
         )
        (t
         (setq migemo-command "cmigemo")    ; cmigemoを使う
         (setq migemo-options '("-q" "-e")) ; コマンドラインオプション
         (setq migemo-dictionary "~/.emacs.d/data/migemo/utf-8/migemo-dict") ; migemo辞書の場所
         ))

  (setq migemo-user-dictionary nil)                                   ; cmigemoで必須設定。おそらくuser単位の辞書の場所
  (setq migemo-regex-dictionary nil)                                  ; cmigemoで必須設定。おそらく正規表現辞書かな？
  (setq migemo-coding-system 'utf-8-unix)                             ; cmigemoの文字コード設定

  (migemo-init)
  )

;;------------------------------------------------------------------------------
;; popwin
;;------------------------------------------------------------------------------
(require 'popwin)
(setq display-buffer-function 'popwin:display-buffer)

(setq popwin:popup-window-position 'bottom) ; ポップアップの位置を画面下に表示
(setq helm-samewindow nil)                  ; helmのポップアップウィンドウ対応


;; ポップアップバッファ一覧
(setq popwin:special-display-config '(
                                      (" *auto-async-byte-compile*" :height 14 :noselect t)
                                      ("helm" :regexp t :height 0.4)
                                      ("*Google Translate*" :noselect t)
                                      ("*Warnings*" :noselect t)
                                      ("*Compile-Log*" :noselect t)
                                      ("*compilation*" :noselect t)
                                      ("*magit-process*" :noselect t)
                                      ("*magit-diff*" :height 0.4)
                                      ("*Kill Ring*" :height 0.4)
                                      ("*grep*" :height 0.4)
                                      ("*Help*" :noselect t)
                                      ("*Omnisharp Symbols*" :noselect t)
))

;;------------------------------------------------------------------------------
;; dired
;;------------------------------------------------------------------------------
;; dired拡張
(load "dired-x")

;; find-diredをLinux環境無しで使えるように
(autoload 'find-dired-lisp
  "find-dired-lisp" "findr" t nil)
(autoload 'find-grep-dired-lisp
  "find-dired-lisp" "findr" t nil)


;; スペースでマークする (FD like)
(define-key dired-mode-map " " 'dired-toggle-mark)
(defun dired-toggle-mark (arg)
  "Toggle the current (or next ARG) files."
  ;; S.Namba Sat Aug 10 12:20:36 1996
  (interactive "P")
  (let ((dired-marker-char
         (if (save-excursion (beginning-of-line)
                             (looking-at " "))
             dired-marker-char ?\040)))
    (dired-mark arg)
    (dired-previous-line 1)))

(put 'dired-find-alternate-file 'disabled nil)
(add-hook 'dired-mode-hook
          '(lambda ()
             (make-local-variable 'mouse-highlight)
             (setq mouse-highlight nil)
             (local-set-key (kbd "RET") 'dired-find-alternate-file)
             (local-set-key (kbd "C-<return>") 'dired-advertised-find-file)
             ))

;; dired を使って、一気にファイルの coding system (漢字) を変換する
;; マークを付けたファイルに対してTで変換
;; ついでにディレクトリを選ぶ度にバッファが作られるのを抑制。
;; さらにマウスカーソルがあたってハイライトしないように設定。
(require 'dired-aux)
(add-hook 'dired-mode-hook
          (lambda ()
            (define-key (current-local-map) "T" 'dired-do-convert-coding-system)
            (make-local-variable 'mouse-highlight)
            (setq mouse-highlight nil)
            (local-set-key (kbd "RET") 'dired-find-alternate-file)
            (local-set-key (kbd "C-<return>") 'dired-advertised-find-file)
            ))

(defvar dired-default-file-coding-system nil
  "*Default coding system for converting file (s).")

(defvar dired-file-coding-system 'no-conversion)

(defun dired-convert-coding-system ()
  (let ((file (dired-get-filename))
        (coding-system-for-write dired-file-coding-system)
        failure)
    (condition-case err
        (with-temp-buffer
          (insert-file file)
          (write-region (point-min) (point-max) file))
      (error (setq failure err)))
    (if (not failure)
        nil
      (dired-log "convert coding system error for %s:\n%s\n" file failure)
      (dired-make-relative file))))

(defun dired-do-convert-coding-system (coding-system &optional arg)
  "Convert file (s) in specified coding system."
  (interactive
   (list (let ((default (or dired-default-file-coding-system
                            buffer-file-coding-system)))
           (read-coding-system
            (format "Coding system for converting file (s) (default, %s): "
                    default)
            default))
         current-prefix-arg))
  (check-coding-system coding-system)
  (setq dired-file-coding-system coding-system)
  (dired-map-over-marks-check
   (function dired-convert-coding-system) arg 'convert-coding-system t))


;; コピー、削除を再帰的にできるように
(setq dired-recursive-copies 'always)
(setq dired-recursive-deletes 'always)


;; 今日変更したファイルの時間に色を付ける
(defface dired-todays-face '((t (:foreground "green"))) nil)
(defvar dired-todays-face 'dired-todays-face)

(defconst month-name-alist
  '(("1"  . "Jan") ("2"  . "Feb") ("3"  . "Mar") ("4"  . "Apr")
    ("5"  . "May") ("6"  . "Jun") ("7"  . "Jul") ("8"  . "Aug")
    ("9"  . "Sep") ("10" . "Oct") ("11" . "Nov") ("12" . "Dec")))

(defun dired-today-search (arg)
  "Fontlock search function for dired."
  (search-forward-regexp
   (let ((month-name
          (cdr (assoc (format-time-string "%b") month-name-alist))))
     (if month-name
         (format
          (format-time-string
           "\\(%Y-%m-%d\\|%b %e\\|%%s %e\\) [0-9]....") month-name)
       (format-time-string
        "\\(%Y-%m-%d\\|%b %e\\) [0-9]....")))
   arg t))

(eval-after-load "dired"
  '(font-lock-add-keywords
    'dired-mode
    (list '(dired-today-search . dired-todays-face))))


;; sorter改良版
(add-hook 'dired-load-hook
          (lambda ()
            (require 'sorter)))

(require 'ls-lisp)
(setq ls-lisp-dirs-first t)                ; ディレクトリを先に表示
(setq ls-lisp-use-localized-time-format t) ; 指定した日付フォーマットを使う
(setq ls-lisp-format-time-list (quote ("%Y-%m-%d %H:%M" "%Y-%m-%d %H:%M"))) ; dired上の時間フォーマット

(require 'wdired)
(define-key dired-mode-map "r" 'wdired-change-to-wdired-mode)


(provide '00_system)
