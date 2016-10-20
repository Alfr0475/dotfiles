(deftheme feel-at-home
  "feel-at-home theme")

(custom-theme-set-faces
 'feel-at-home

 ;; システム標準
 '(default     ((t (:background "#000000" :foreground "#C1CDCD"))))
 '(cursor      ((t (:foreground "#FFFFFF"))))
 '(bold        ((t (:bold nil))))
 '(bold-italic ((t (:italic nil :bold nil))))

 ;; 標準テキスト
 '(region                           ((t (:foreground "#C1CDCD" :background "#0000CD")))) ; リージョン
 '(mode-line                        ((t (:foreground "#000000" :background "#BFBFBF")))) ; モードライン
 '(mode-line-inactive               ((t (:foreground "#CCCCCC" :background "#4D4D4D")))) ; モードライン(非アクティブ)
 '(font-lock-comment-delimiter-face ((t (:foreground "#FF7F24")))) ; コメントデリミタ
 '(font-lock-comment-face           ((t (:foreground "#FF7F24")))) ; コメント
 '(font-lock-string-face            ((t (:foreground "#FFA07A")))) ; 文字列
 '(font-lock-function-name-face     ((t (:foreground "#87CEFA")))) ; 関数名
 '(font-lock-keyword-face           ((t (:foreground "#00FFFF")))) ; キーワード
 '(font-lock-constant-face          ((t (:foreground "#7FFFD4")))) ; 定数(this, selfなども)
 '(font-lock-variable-name-face     ((t (:foreground "#EEDD82")))) ; 変数
 '(font-lock-type-face              ((t (:foreground "#98FB98")))) ; クラス

 ;; fringe
 '(fringe ((t (:foreground "#CCCCCC" :background "#4D4D4D")))) ; fringe文字(折り返し記号などが出る部分)

 ;; hl-line
 '(hl-line ((t (:background "#333333")))) ; カレント行

 ;; linum
 '(linum ((t (:foreground "#000000" :background "#999999")))) ; 行番号
 '(linum-highlight-face ((t (:foreground "#999999" :background "#000000"))))

 ;; whitespace
 '(whitespace-tab      ((t (:background "#424242")))) ; タブ
 '(whitespace-trailing ((t (:foreground "#4682B4" :underline t)))) ; タブ
)

;;;###autoload
(when load-file-name
  (add-to-list 'custom-theme-load-path
               (file-name-as-directory (file-name-directory load-file-name))))

(provide-theme 'feel-at-home)
