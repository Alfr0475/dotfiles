"--------------------------------------------------------------------------------
" neocomplete設定
"--------------------------------------------------------------------------------
if v:version >= 702
  if neobundle#is_installed('neocomplete.vim')
    " neocompleteを起動時に有効化する
    let g:neocomplete#enable_at_startup = 1

    let g:neocomplete#enable_ignore_case = 1
    let g:neocomplete#enable_smart_case = 1

    " バッファや辞書ファイルの中で、補完の対象となるキーワードの最小長さ
    let g:neocomplete#sources#syntax#min_keyword_length = 3

    " ポップアップが表示された時にEnterを押すと１つ目を選択して確定
    " http://blog.basyura.org/entry/2013/08/17/154700
    " inoremap <expr><CR>   pumvisible() ? "\<C-n>" . neocomplete#close_popup()  : "<CR>"

    " 改行で補完ウィンドウを閉じる
    inoremap <expr><CR> pumvisible() ?  neocomplete#close_popup() : "\<CR>"

    " TABで補完候補の選択を行う
    inoremap <expr><Tab> pumvisible() ? "\<Down>" : "\<Tab>"
    inoremap <expr><S-Tab> pumvisible() ? "\<Up>" : "\<S-Tab>"
  endif
endif

