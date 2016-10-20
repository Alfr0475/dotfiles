;; C-hをバックスペースに
(define-key global-map (kbd "C-h") 'backward-delete-char)

;; C-hに割り当てられていた関数help-commandをC-x C-hに割り当てる
(define-key global-map (kbd "C-x C-h") 'help-command)

;; suspendを無効に
(define-key global-map (kbd "C-x C-z") nil)

;; Emacsの終了コマンドを無効に
(define-key global-map (kbd "C-x C-c") nil)

;; 時刻を挿入する
(define-key global-map (kbd "C-c d") 'current-insert-date)

;; ウィンドウ移動
(define-key global-map (kbd "C-t") 'other-window)

;; 行頭、行のインデント位置、行頭を繰り返す
(define-key global-map (kbd "C-a") 'repeat-line-head)

;; dired-jump
(define-key global-map (kbd "C-x C-j") 'helm-dired-mode)

;; grep
(define-key global-map (kbd "M-C-g") 'grep)

(define-key global-map [165] [92])

;; Mac環境でAltとCommandを入れ替え
;; (cond ((and run-darwin)
;;        (setq ns-command-modifier (quote meta))
;;        (setq ns-alternate-modifier (quote super))
;;        ))
