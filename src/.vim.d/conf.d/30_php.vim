if v:version >= 702
  if neobundle#is_installed('neocomplete.vim') && neobundle#is_installed('neocomplete-php.vim')
    " neocomplete-php.vimを使う場合は初回起動時に
    " :PhpMakeDict jaを実行する
    " http://yuheikagaya.hatenablog.jp/entry/2014/01/19/235957
    let g:neocomplete_php_locale = 'ja'
  endif
endif

" 文字列の中のSQLをハイライト
let php_sql_query = 1

" BaseLibメソッドのハイライト
let php_baselib = 1

" HTMLのハイライト
let php_hemlInStrings = 1

" <? を無効にする。ハイライトから除外
let php_noShortTags = 1

" 括弧の対応エラーをハイライト
let php_parent_error_close = 1
let php_parent_error_open = 1

