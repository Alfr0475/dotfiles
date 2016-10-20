;;----------------------------------------------------------------------
;; Emacs Configuration
;;----------------------------------------------------------------------


;;----------------------------------------------------------------------
;; 実行環境判別
;; http://d.hatena.ne.jp/hito-d/20060220#1140445790
;;----------------------------------------------------------------------
;; OSを判別
(defvar run-unix
  (or (equal system-type 'gnu/linux)
      (or (equal system-type 'usg-unix-v)
          (or  (equal system-type 'berkeley-unix)
               (equal system-type 'cygwin)))))
(defvar run-linux
  (equal system-type 'gnu/linux))
(defvar run-system-v
  (equal system-type 'usg-unix-v))
(defvar run-bsd
  (equal system-type 'berkeley-unix))
(defvar run-cygwin ;; cygwinもunixグループにしておく
  (equal system-type 'cygwin))
(defvar run-w32
  (and (null run-unix)
       (or (equal system-type 'windows-nt)
           (equal system-type 'ms-dos))))
(defvar run-darwin (equal system-type 'darwin))

;; 実行OS名設定
(cond
 (run-w32
  (setq run-os-name "windows"))
 ((or run-unix run-linux run-cygwin)
  (setq run-os-name "linux"))
 (run-darwin
  (setq run-os-name "mac")))

;; WindowSystem名設定
(cond
 ((null window-system)
  (setq run-window-system-name "terminal"))
 (t
  (setq run-window-system-name window-system)))

;; Emacsの種類とバージョンを判別
(defvar run-emacs20
  (and (equal emacs-major-version 20)
       (null (featurep 'xemacs))))
(defvar run-emacs21
  (and (equal emacs-major-version 21)
       (null (featurep 'xemacs))))
(defvar run-emacs22
  (and (equal emacs-major-version 22)
       (null (featurep 'xemacs))))
(defvar run-emacs23
  (and (equal emacs-major-version 23)
       (null (featurep 'xemacs))))
(defvar run-emacs24
  (and (equal emacs-major-version 24)
       (null (featurep 'xemacs))))
(defvar run-meadow (featurep 'meadow))
(defvar run-meadow1 (and run-meadow run-emacs20))
(defvar run-meadow2 (and run-meadow run-emacs21))
(defvar run-meadow3 (and run-meadow run-emacs22))
(defvar run-xemacs (featurep 'xemacs))
(defvar run-xemacs-no-mule
  (and run-xemacs (not (featurep 'mule))))
(defvar run-carbon-emacs (and run-darwin window-system))


;;----------------------------------------------------------------------
;; package configuration
;;----------------------------------------------------------------------
(when load-file-name
  (setq user-emacs-directory (file-name-directory load-file-name)))

;; OSによってインストール先を変える
;; http://d.hatena.ne.jp/tarao/20150221/1424518030#tips-package-directory
(let ((run-os-dir (locate-user-emacs-file (format "packages/%s-%s" run-os-name run-window-system-name))))
  (setq el-get-dir (expand-file-name "el-get" run-os-dir)
        package-user-dir (expand-file-name "elpa" run-os-dir))

  (setq load-path
        (append
         (list
          (expand-file-name (concat user-emacs-directory  "packages"))
          (expand-file-name (concat run-os-dir "/el-get/el-get"))
          (expand-file-name run-os-dir)
          )
         load-path)))


;; El-Getがインストールされていなければダウンロードしてインストール
;; http://d.hatena.ne.jp/tarao/20150221/1424518030#el-get-setup
(unless (require 'el-get nil 'noerror)
  (with-current-buffer
      (url-retrieve-synchronously
       "https://raw.githubusercontent.com/dimitri/el-get/master/el-get-install.el")
    (goto-char (point-max))
    (eval-print-last-sexp)))

;; El-Get install packages
(when (load (format "install-packages-%s-%s" run-os-name run-window-system-name) nil t))


;;----------------------------------------------------------------------
;; load-path configuration
;;----------------------------------------------------------------------
(setq load-path
      (append
       (list
        (expand-file-name (concat user-emacs-directory "data/c-style"))
        )
       load-path))


;;----------------------------------------------------------------------
;; load settings
;;----------------------------------------------------------------------
(require 'init-loader)
(setq init-loader-show-log-after-init 'error-only) ; ログにエラーのみを表示
(init-loader-load (locate-user-emacs-file (format "conf.d/%s-%s" run-os-name run-window-system-name)))


;;----------------------------------------------------------------------
;; start server
;;----------------------------------------------------------------------
(require 'server)

(unless (server-running-p)              ; 複数サーバー起動を防ぐ
  (server-start))


(provide 'init)
