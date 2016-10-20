;;------------------------------------------------------------------------------
;; helm
;;------------------------------------------------------------------------------
(require 'helm)
(require 'helm-config)

(helm-mode 1)                           ; 常時helm使用
(helm-migemo-mode 1)
;;(helm-dired-bindings 1)

(setq helm-idle-delay 0.2)        ; 候補を表示するまでの時間
(setq helm-input-idle-delay 0.1)  ; タイプしてから再描画するまでの時間
(setq helm-quick-update t)        ; 体感速度向上
(setq helm-execute-action-at-once-if-one nil) ; 候補が一つの場合になっても自動実行しない
(remove-hook 'kill-emacs-hook 'helm-c-adaptive-save-history) ; Emacs終了時に、履歴を保存


;; buffer-listにヒストリとカレントディレクトリを追加したオリジナル関数追加
(defun my:helm-buffers-list ()
  "Preconfigured `helm' to list buffers.
It is an enhanced version of `helm-for-buffers'."
  (interactive)
  (helm :sources '(helm-source-buffers-list
                  helm-source-ido-virtual-buffers
                  helm-source-buffer-not-found
                  helm-source-file-name-history
                  helm-source-files-in-current-dir)
        :buffer "*helm buffers*" :keymap helm-buffer-map))


(custom-set-variables '(helm-ff-auto-update-initial-value nil)) ; 自動補完を無効

(define-key helm-read-file-map (kbd "C-h") 'delete-backward-char) ; C-hでバックスペース
(define-key helm-read-file-map (kbd "TAB") 'helm-execute-persistent-action) ; TABで任意補完。選択肢が出てきたらC-nやC-pで上下移動してから決定する事も可能

(define-key helm-map (kbd "C-h") 'delete-backward-char) ; helm中はC-hが効かなかったから再定義

(global-set-key (kbd "C-c h") 'helm-mini)        ; helm起動
(global-set-key (kbd "C-x C-f") 'helm-for-files) ; デフォルトのhelm-find-fileを変更
(global-set-key (kbd "C-x b") 'my:helm-buffers-list) ; switch-to-bufferをhelmのlist-bufferに変更
(global-set-key (kbd "C-M-z") 'helm-resume) ; 直前のhelm実行結果に復帰する
(global-set-key (kbd "M-x") 'helm-M-x)      ; コマンド実行をhelmに変更
(global-set-key (kbd "M-y") 'helm-show-kill-ring) ; yankをhelm化
(global-set-key (kbd "C-x C-g") 'helm-ghq)        ; ghqのhelmインターフェイス

;;------------------------------------------------------------------------------
;; helm-grep
;;------------------------------------------------------------------------------
(require 'helm-grep)

;;------------------------------------------------------------------------------
;; helm-gtags
;;------------------------------------------------------------------------------
(define-key global-map (kbd "<f3>") 'helm-gtags-find-tag)    ; 関数の定義場所
(define-key global-map (kbd "S-<f3>") 'helm-gtags-pop-stack) ; ひとつ戻る
(define-key global-map (kbd "C-S-g") 'helm-gtags-find-rtag)  ; 関数の参照場所

(setq helm-gtags-auto-update t)         ; バッファを保存した時にTAGファイル更新

(provide '10_helm)
