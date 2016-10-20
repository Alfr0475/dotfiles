;; カーソル位置のフェースを調べる関数
(defun describe-face-at-point ()
  "Return face used at point."
  (interactive)
  (message "%s" (get-char-property (point) 'face)))


;; 日付挿入 (Changesとかで使う)
(defun current-insert-date ()
  (interactive)
  "現在の日付を挿入する"
  (insert (format-time-string "%Y-%m-%d %R:%S" (current-time))))


;; 行頭、行の最初のインデント位置、行頭を繰り返す
(defun repeat-line-head (arg)
  (interactive "^p")
  (cond
   ((bolp)
    (call-interactively 'back-to-indentation))
   (t
    (move-beginning-of-line arg))))


;; 全てのバッファーを閉じる
(defun kill-all-buffers ()
  (interactive)
  "全てのバッファーを閉じる"
  (loop for buffer being the buffers
        do (kill-buffer buffer)))
