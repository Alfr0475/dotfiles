;;; c-style-base.el --- Own way basic coding style   -*- lexical-binding: t; -*-

;; Copyright (C) 2016  古賀誠規

;; Author: 古賀誠規 <alfr0475@gmail.com>
;; Keywords: c, tools

;; This program is free software; you can redistribute it and/or modify
;; it under the terms of the GNU General Public License as published by
;; the Free Software Foundation, either version 3 of the License, or
;; (at your option) any later version.

;; This program is distributed in the hope that it will be useful,
;; but WITHOUT ANY WARRANTY; without even the implied warranty of
;; MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
;; GNU General Public License for more details.

;; You should have received a copy of the GNU General Public License
;; along with this program.  If not, see <http://www.gnu.org/licenses/>.

;;; Commentary:

;; Install:
;;
;; Adds in your emacs initialize file (~/.emacs.d/init.el)
;;   (autoload 'c-style-base "c-style-base")
;;   (add-hook 'c-mode-hook 'c-style-base)
;;   (add-hook 'c++-mode-hook 'c-style-base)

;;; Code:

;; ベースとなるc-styleを定義
;; 基本的にこのスタイルでコーディングする
;; 言語によって部分的に変更する場合はc-style-baseを継承して変更箇所だけを変更する
;; 何のスタイルが適用されているか調べる時は対象の行にカーソルを置いて、C-c C-s
;; 試す場合はC-c C-oでスタイルを選んで適当に値を入れる
(defconst c-style-base
  `(
    (indent-level            . 4)   ; インデントレベル
    (indent-tabs-mode        . nil) ; タブを使わない
    (tab-width               . 4)   ; タブ幅
    (c-basic-offset          . 4)   ; c-set-offsetで特殊文字を設定した際のオフセット
    (c-toggle-electric-state . 1)   ; 現在の行の自動インデント

    ;; 括弧前後の自動改行処理設定
    ;; 自動改行がONなら中括弧を入力した時点で自動改行される
    ;; before : 中括弧の前で自動改行
    ;; after  : 中括弧の後で自動改行
    (c-hanging-braces-alist
     . (
        (defun-open          after)  ; 関数定義を開始する中括弧
        (defun-close         after)  ; 関数定義を終了する中括弧
        (class-open          after)  ; クラス定義を開始する中括弧
        (class-close         after)  ; クラス定義を終了する中括弧
        (inline-open         after)  ; クラス内のインラインメソッドを開始する中括弧
        (inline-close        after)  ; クラス内のインラインメソッドを終了する中括弧
        (block-open          after)  ; 文ブロックを開始する中括弧
        (block-close         after)  ; 文ブロックを終了する中括弧
        (statement-case-open after)  ; 中括弧で始まるcaseブロックの最初の行
        (substatement-open   after)  ; substatementのブロックを開始する中括弧
        ))

    ;; コロン前後の自動改行処理設定
    ;; 自動改行がONならコロンを入力した時点で自動改行される
    ;; before : コロンの前で自動改行
    ;; after  : コロンの後で自動改行
    (c-hanging-colons-alist
     . (
        (case-label after)   ; caseまたはdefaultラベル
        (label      after)   ; 通常のラベル
        ))

    ;; 挿入された余計な空白文字のキャンセル条件設定
    ;; if-elseやセミコロン前等の余計な空白削除
    ;; { や } を打った時に再配置する
    (c-cleanup-list
     . (
        brace-catch-brace    ; '} catch () {'の構造全体を１行に再配置する
        brace-else-brace     ; '} else {'の構造全体を１行に再配置する
        brace-elseif-brace   ; '} elseif () {'の構造全体を１行に配置する
        empty-defun-braces   ; 空の関数定義の中括弧を同じ行に再配置する
        ))

    ;; オフセット量の設定
    ;; +  : c-basic-offset の    1 倍
    ;; -  : c-basic-offset の   -1 倍
    ;; ++ : c-basic-offset の    2 倍
    ;; -- : c-basic-offset の   -2 倍
    ;; *  : c-basic-offset の  0.5 倍
    ;; /  : c-basic-offset の -0.5 倍
    (c-offsets-alist
     . (
        (defun-open            . 0) ; 関数定義を開始する中括弧
        (defun-close           . 0) ; 関数定義を終了する中括弧
        (defun-block-intro     . +) ; トップレベルの関数定義の最初の行
        (class-open            . 0) ; クラス定義を開始する中括弧
        (class-close           . 0) ; クラス定義を終了する中括弧
        (inline-open           . 0) ; クラス内のインラインメソッドを開始する中括弧
        (inline-close          . 0) ; クラス内のインラインメソッドを終了する中括弧
        (topmost-intro         . 0) ; 最上位の言語構成要素の最初の行
        (topmost-intro-cont    . 0) ; 最上位の言語構成要素の２行目以降
        (block-open            . 0) ; 文ブロックを開始する中括弧
        (block-close           . 0) ; 文ブロックを終了する中括弧
        (statement             . 0) ; 通常の文
        (statement-cont        . +) ; 分の継続行
        (statement-block-intro . +) ; 新規文ブロックの最初の行
        (statement-case-intro  . +) ; caseブロックの最初の行
        (statement-case-open   . 0) ; 中括弧で始まるcaseブロックの最初の行
        (substatement          . +) ; if,while,for,do,elseの直後の最初の行
        (substatement-open     . 0) ; substatementのブロックを開始する中括弧
        (case-label            . +) ; caseまたはdefaultラベル
        (label                 . 0) ; 通常のラベル
        (do-while-closure      . 0) ; do-while文のwhile
        (else-clause           . 0) ; if-else文のelse
        (comment-intro         . 0) ; コメントの導入部分だけを含んだ行
        (arglist-intro         . +) ; 引数リストの最初の行
        (arglist-cont          . 0) ; 引数リストを開始する括弧の行に引数がない場合、引数リストの２行目以降
        (arglist-cont-nonempty . +) ; 引数リストを開始する括弧の行に少なくとも１つの引数がある場合、引数リストの２行目以降
        (arglist-close         . 0) ; 引数リストを終了する括弧
        (inclass               . +) ; クラス定義の内側に入れ子になった言語構成要素
        ))))

(c-add-style "c-style-base" c-style-base nil)

(provide 'c-style-base)
;;; c-style-base.el ends here
