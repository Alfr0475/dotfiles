;;------------------------------------------------------------------------------
;; フォント設定確認用
;;------------------------------------------------------------------------------
;; abcdeABCDE
;; ａｂｃｄｅＡＢＣＤＥ
;; あいうえお
;; アイウエオ
;; +*!?\
;; ＋＊！？￥
;; ー～・％＆
;; ①②③④⑤⑥⑦⑧⑨⑩
;; ㍉㌢㌔㍍
;; ✕÷±＋
;; ◎○●△▲□■◇◆
;;------------------------------------------------------------------------------
(set-face-attribute 'default nil
                    :family "Ricty for Powerline"
                    :height 140)
(set-fontset-font "fontset-default"
                  'japanese-jisx0208
                  '("Ricty for Powerline")) ; 全角文字
(set-fontset-font "fontset-default"
                  'katakana-jisx0201
                  '("Ricty for Powerline")) ; 半角カタカナ
(set-fontset-font "fontset-default"
                  'cp932
                  '("Ricty for Powerline")) ; 機種依存文字
