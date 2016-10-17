" 7.4未満のバージョンだと~/.vim/vimrcは自動読み込みの対象になっていない
" なので、~/.vimrcでどのバージョンでも~/.vim/vimrcを読み込むようにした
let s:from_legacy_vimrc = expand('~/.vim/vimrc')
if filereadable(s:from_legacy_vimrc)
    execute 'source ' . s:from_legacy_vimrc
endif

