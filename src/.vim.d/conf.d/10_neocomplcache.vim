"--------------------------------------------------------------------------------
" neocomplcache設定
"--------------------------------------------------------------------------------
if v:version >= 702
  if neobundle#is_installed('neocomplcache.vim')
    " neocomplcacheを起動時に有効化する
    let g:neocomplcache_enable_at_startup = 1

    " 大文字を区切りとしたワイルドカードのように振る舞う機能
    let g:neocomplcache_enable_camel_case_completion = 1

    " _区切りの補完を有効化
    let g:neocomplcache_enable_underbar_completion = 1

    " 大文字が入力されるまで大文字小文字の区別を無視する
    let g:neocomplcache_smart_case = 1

    " シンタックスをキャッシュするときの最小文字長
    let g:neocomplcache_min_syntax_length = 3

    " 手動補完時に補完を行う入力数を制御
    let g:neocomplcache_manual_completion_start_length = 0
    let g:neocomplcache_caching_percent_in_statusline = 1
    let g:neocomplcache_enable_skip_completion = 1
    let g:neocomplcache_skip_input_time = '0.5'
  endif
endif

