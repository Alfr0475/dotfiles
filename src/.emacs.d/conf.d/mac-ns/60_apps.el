;;------------------------------------------------------------------------------
;; auto-insert
;;------------------------------------------------------------------------------
(auto-insert-mode t)

;; テンプレートディレクトリ指定
(setq auto-insert-directory "~/.emacs.d/data/auto-insert/")

;; テンプレートリスト
(setq auto-insert-alist
      (append '(
                ("\\.class.php" . "php/class.php") ;; クラス
                ("\\Test.php" . "php/test.php") ;; PHPUnitテストクラス
                ("\\.php" . "php/class.php") ;; 通常スクリプト
                ("\\.pl" . "perl/script.pl") ;; 通常スクリプト
                ("\\.pm" . "perl/class.pl") ;; クラス
                ("\\.cgi" . "perl/index.pl") ;; index
                )
              auto-insert-alist))

;;------------------------------------------------------------------------------
;; navi2ch
;;------------------------------------------------------------------------------
(autoload 'navi2ch "navi2ch" "Navigator for 2ch for Emacs" t)

(setq navi2ch-directory "~/.emacs.d/data/navi2ch") ; キャッシュファイル等の置き場

(setq navi2ch-list-stay-list-window t)  ; 3ペインモードで見る

(setq navi2ch-list-window-width 40)     ; 板一覧の横幅
(setq navi2ch-list-indent-width 2)      ; 板一覧のインデント幅
(setq navi2ch-board-window-height 15)   ; スレ一覧の高さ
(setq navi2ch-bm-subject-width 80)      ; 各スレ題名の幅
(setq navi2ch-bm-number-width 4)        ; 各スレ番号の幅

(setq navi2ch-article-message-separator-width '(window-width)) ; レス区切りの幅

(setq navi2ch-mona-enable t)            ; モナーフォント有効化
(setq navi2ch-message-save-sendlog t)   ; 書き込みログ有効化

;; (add-to-list 'navi2ch-list-navi2ch-category-alist
;;               navi2ch-message-sendlog-board)

(setq navi2ch-message-user-name "")        ; デフォルトの名前
(setq navi2ch-message-mail-address "sage") ; デフォルトのメールアドレス

(setq navi2ch-board-insert-subject-with-diff t) ; Board モードのレス数欄にレスの増加数を表示する
(setq navi2ch-board-insert-subject-with-unread t) ; Board モードのレス数欄にレスの未読数を表示する

(setq navi2ch-article-exist-message-range '(1 . 1000)) ; 既読スレは全て表示
(setq navi2ch-article-new-message-range '(1000 . 1))   ; 未読スレは全て表示

;;------------------------------------------------------------------------------
;; open-junk-file
;;------------------------------------------------------------------------------
(require 'open-junk-file)
(setq open-junk-file-format "~/.emacs.d/data/junk/%Y-%m/%d-%H%M%S.")

(define-key global-map (kbd "C-, C-,") 'open-junk-file)

;;------------------------------------------------------------------------------
;; magit
;;------------------------------------------------------------------------------
(define-key global-map (kbd "C-x m") 'magit-status)

(eval-after-load 'magit
  '(progn
     (set-face-background 'magit-item-highlight "#202020")
     (set-face-foreground 'magit-diff-add "#40FF40")
     (set-face-background 'magit-diff-add "#000000")
     (set-face-foreground 'magit-diff-del "#FF4040")
     (set-face-background 'magit-diff-del "#000000")
     (set-face-foreground 'magit-diff-file-header "#2020FF")
     (set-face-background 'magit-diff-file-header "#404040")
     (set-face-background 'magit-diff-hunk-header "#404040")
     ))

;;------------------------------------------------------------------------------
;; Google Translate
;; http://qiita.com/styzo/items/72197ad6717eb9266315
;;------------------------------------------------------------------------------
(require 'google-translate)
(require 'google-translate-default-ui)
(defvar google-translate-japanese-chars
  "[ぁ-んァ-ヶ々〇〻\u3220-\u3244\u3280-\u32B0\u3400-\u9FFF\uF900-\uFAFF\U00020000-\U0002FFFF]"
  "これらの文字が含まれているときは日本語とみなす") ;いい加減

(defun google-translate-get-string (arg)
  (cond ((stringp arg) arg)
        ((= arg 4)                      ; C-u
         (thing-at-point 'paragraph))
        ((= arg 16)                     ; C-u C-u
         (thing-at-point 'word))
        ((= arg 64)
         (read-string "Google Translate: "))
        ((use-region-p)                 ; リージョン指定
         (buffer-substring (region-beginning) (region-end)))
        (t                              ; デフォルト
         (thing-at-point 'sentence))))

(defun google-translate-enja-or-jaen (arg)
  "regionか現在位置の単語を翻訳する。C-u付きでquery指定も可能"
  (interactive "p")
  (let* ((string (google-translate-get-string arg))
         (japanesep (string-match
                     google-translate-japanese-chars
                     string)))
    (run-at-time 0.1 nil 'deactivate-mark)
    (google-translate-translate
     (if japanesep "ja" "en")
     (if japanesep "en" "ja")
     string)))

(push '("*Google Translate*" :height 0.5 :stick t) popwin:special-display-config)

(global-set-key (kbd "C-M-t") 'google-translate-enja-or-jaen)

;;------------------------------------------------------------------------------
;; tabbar
;;------------------------------------------------------------------------------
(require 'tabbar)
(tabbar-mode)

(tabbar-mwheel-mode nil)                 ; マウスホイール無効
(setq tabbar-buffer-groups-function nil) ; グループ無効
(setq tabbar-use-images nil)             ; 画像を使わない

(global-set-key (kbd "<C-tab>") 'tabbar-forward-tab)
(global-set-key (kbd "<C-S-tab>") 'tabbar-backward-tab)

;; 左側のボタンを消す
(dolist (btn '(tabbar-buffer-home-button
               tabbar-scroll-left-button
               tabbar-scroll-right-button))
  (set btn (cons (cons "" nil)
                 (cons "" nil))))

(setq tabbar-separator '(0.5))          ; タブのセパレーターの長さ

;; 外観変更
(set-face-attribute 'tabbar-default nil :family "Ricty for Powerline" :background "black" :foreground "gray72" :height 1.0)
(set-face-attribute 'tabbar-unselected nil :background "black" :foreground "gray72" :box nil)
(set-face-attribute 'tabbar-selected nil :background "gray32" :foreground "light green" :box nil :weight 'bold)
(set-face-attribute 'tabbar-modified nil :background "black" :foreground "red" :box nil)
(set-face-attribute 'tabbar-selected-modified nil :box nil)
(set-face-attribute 'tabbar-button nil :box nil)
(set-face-attribute 'tabbar-separator nil :height 1.5)

;; 表示するバッファ
(defun my-tabbar-buffer-list ()
  (delq nil
        (mapcar #'(lambda (b)
                    (cond
                     ((eq (current-buffer) b) b)
                     ((buffer-file-name b) b)
                     ((char-equal ?\ (aref (buffer-name b) 0)) nil)
                     ((equal "*scratch*" (buffer-name b)) b) ; *scratch*バッファは表示する
                     ((char-equal ?* (aref (buffer-name b) 0)) nil) ; それ以外の*で始まるバッファは表示しない
                     ((buffer-live-p b) b)))
                (buffer-list))))
(setq tabbar-buffer-list-function 'my-tabbar-buffer-list)
