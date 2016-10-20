"--------------------------------------------------------------------------------
" 表示設定
"--------------------------------------------------------------------------------
" シンタックスハイライト
syntax on

" 行番号表示
set number

" 右下に行と列の番号を表示する
set ruler

" タイトルを表示
set title

" 対応括弧をハイライト表示する
set showmatch

" 対応括弧の表示秒数
set matchtime=3

" 行を折り返す
set wrap

" コマンドを画面最下部に表示する
set showcmd

" 検索結果をハイライト表示
set hlsearch

" エスケープシーケンスの表示
set list
set listchars=tab:^\ ,trail:_

" 全角スペースの表示
function! FullwidthSpace()
    highlight FullwidthSpace cterm=reverse ctermfg=DarkGray gui=reverse guifg=DarkGray
endfunction

if has('syntax')
    augroup FullwidthSpace
        autocmd!
        autocmd ColorScheme       * call FullwidthSpace()
        autocmd VimEnter,WinEnter * match FullwidthSpace /　/
    augroup END
    call FullwidthSpace()
endif

" ステータスラインの表示位置
set laststatus=2

" ColorScheme設定
if v:version >= 702
  if neobundle#is_installed('vim-hybrid')
    colorscheme hybrid
  endif
endif

