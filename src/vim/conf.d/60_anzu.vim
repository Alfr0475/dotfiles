" 通常の検索でanzuを利用する
"
" ガードが無いと、anzu が入っていない環境では n / N / * / # が存在しない
" <Plug> に割り当てられ、検索操作そのものが動かなくなる。
" プラグインがある場合だけ割り当てる。
if DotHasVimPlugin('vim-anzu')
  nmap n <Plug>(anzu-n)
  nmap N <Plug>(anzu-N)
  nmap * <Plug>(anzu-star)
  nmap # <Plug>(anzu-sharp)
endif

