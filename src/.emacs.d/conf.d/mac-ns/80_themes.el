;; color-thema
(cond ((and run-emacs24)
       ;; Emacs24から実装されたThemeフレームワークを利用
       (setq custom-theme-directory "~/.emacs.d/data/themes/")
       (load-theme 'feel-at-home t)
       (enable-theme 'feel-at-home)
       )
)
;; (require 'color-theme)
;; (require 'color-theme-solarized)
;; (color-theme-initialize)
;; (color-theme-solarized-dark)

;; ;; color
;; (cond ((and run-w32)
;;        (set-foreground-color                                  "#C1CDCD") ; 文字色
;;        (set-background-color                                  "#000000") ; 背景色
;;        (set-cursor-color                                      "#FFFFFF") ; カーソル色
;;        (set-face-foreground 'region                           "#C1CDCD") ; リージョン文字
;;        (set-face-background 'region                           "#0000CD") ; リージョン背景
;;        (set-face-foreground 'mode-line-inactive               "#CCCCCC") ; モードライン文字(非アクティブ)
;;        (set-face-background 'mode-line-inactive               "#4D4D4D") ; モードライン背景(非アクティブ)
;;        (set-face-foreground 'font-lock-comment-delimiter-face "#FF7F24") ; コメントデリミタ
;;        (set-face-foreground 'font-lock-comment-face           "#FF7F24") ; コメント
;;        (set-face-foreground 'font-lock-string-face            "#FFA07A") ; 文字列
;;        (set-face-foreground 'font-lock-function-name-face     "#87CEFA") ; 関数名
;;        (set-face-foreground 'font-lock-keyword-face           "#00FFFF") ; キーワード
;;        (set-face-foreground 'font-lock-constant-face          "#7FFFD4") ; 定数(this, selfなども)
;;        (set-face-foreground 'font-lock-variable-name-face     "#EEDD82") ; 変数
;;        (set-face-foreground 'font-lock-type-face              "#98FB98") ; クラス
;;        (set-face-foreground 'fringe                           "#C1CDCD") ; fringe文字(折り返し記号などが出る部分)
;;        (set-face-background 'fringe                           "#1A1A1A") ; fringe背景
;;        (set-face-background 'hl-line                          "#333333") ; カレント行背景
;;        (set-face-foreground 'linum                            "#999999") ; 行番号文字

;;        (cond ((and run-emacs24 (equal emacs-minor-version 2))
;;               (set-face-foreground 'modeline                         "#000000") ; モードライン文字
;;               (set-face-background 'modeline                         "#BFBFBF") ; モードライン背景
;;               ))
;;        )
;;       ((and run-linux)
;;        (set-foreground-color                                  "#C1CDCD") ; 文字色
;;        (set-background-color                                  "#000000") ; 背景色
;;        (set-cursor-color                                      "#FFFFFF") ; カーソル色
;;        (set-face-foreground 'region                           "#C1CDCD") ; リージョン文字
;;        (set-face-background 'region                           "#0000CD") ; リージョン背景
;;        (set-face-foreground 'mode-line-inactive               "#CCCCCC") ; モードライン文字(非アクティブ)
;;        (set-face-background 'mode-line-inactive               "#4D4D4D") ; モードライン背景(非アクティブ)
;;        (set-face-foreground 'font-lock-comment-delimiter-face "#FF7F24") ; コメントデリミタ
;;        (set-face-foreground 'font-lock-comment-face           "#FF7F24") ; コメント
;;        (set-face-foreground 'font-lock-string-face            "#FFA07A") ; 文字列
;;        (set-face-foreground 'font-lock-function-name-face     "#87D7FF") ; 関数名
;;        (set-face-foreground 'font-lock-keyword-face           "#00FFFF") ; キーワード
;;        (set-face-foreground 'font-lock-constant-face          "#87FFD7") ; 定数(this, selfなども)
;;        (set-face-foreground 'font-lock-variable-name-face     "#FFD787") ; 変数
;;        (set-face-foreground 'font-lock-type-face              "#87FF87") ; クラス
;;        (set-face-foreground 'fringe                           "#C6C6C6") ; fringe文字(折り返し記号などが出る部分)
;;        (set-face-background 'fringe                           "#1C1C1C") ; fringe背景
;;        (set-face-background 'hl-line                          "#303030") ; カレント行背景
;;        (set-face-foreground 'linum                            "#9E9E9E") ; 行番号文字
;;        )
;;       )

(set-face-bold-p 'font-lock-warning-face nil) ; 定数
