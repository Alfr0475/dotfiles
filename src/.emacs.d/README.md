# Emacsの設定 #

## ディレクトリ構成 ##

```
.emacs.d
|-- conf  // 各種設定ファイル群
|-- data
|   |-- auto-complete  // auto-complete辞書
|   |-- auto-insert    // auto-insertテンプレート
|   |-- etags          // etagsで生成するタグ用ファイル
|   |-- junk           // open-junk-fileで生成されたファイル郡
|   |-- migemo         // migemo辞書
|   |-- navi2ch        // navi2chの各種データ
|   +-- yasnippet      // スニペットデータ
+-- elisp
|   +-- mode           // 各種メジャーモードlisp
+-- site-lisp          // Package.elでインストールしたPackage群
```

## 変更したKeyBind ##

### browse-kill-ring ###

`M-y`
    browse-kill-ring起動

### helm ###

`C-h`
    バックスペース

`TAB`
    補完

`C-c h`
    helm起動

`C-x C-f`
    デフォルトのhelm-find-fileをhelm-for-filesに変更

`C-x b`
    デフォルトのswitch-to-bufferをオリジナル定義に変更

`C-z b`
    elscreen-findをhelm-elscreenに変更

`C-M-z`
    helm-resume

`M-x`
    コマンドの実行をhelmに変更

`M-y`
    yankをhelm化

`C-v`
`M-v`
    前後のsourceに移動

`C-z`
    elscreenのprefixなので無効

### auto-complete ###

`C-n`
`C-p`
    補完メニューの操作

### open-junk-file ###

`C-, C-,`
    junkファイル作成

### org ###

`C-<return>`
    現在と同じレベルの見出しを入力する

`C-c l`
    ハイパーリンクの作成

### multi-term ###

`C-h`
    バックスペース

`C-y`
    ペースト

`C-p`
`C-n`
    十字キー上下

`C-v`
`M-v`
    ページ遷移

### revive ###

`C-x S`
    現在の状態を保存

`C-x F`
    レジューム

### その他 ###

`C-h`
    バックスペース

`C-x C-h`
    元々C-hに割り当てられていたhelp-command

`C-x C-z`
    サスペンドを無効

`C-x C-c`
    Emacsの終了を無効

`C-c d`
    時刻挿入

`C-t`
    ウィンドウ移動

`C-a`
    行頭、行のインデント位置を繰り返す

`C-x C-j`
    dired-jump

`M-C-g`
    grep
