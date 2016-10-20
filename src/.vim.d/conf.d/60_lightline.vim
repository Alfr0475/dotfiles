let g:lightline = {
    \ 'mode_map': {'c': 'NORMAL'},
    \ 'colorscheme': 'hybrid',
    \ 'active': {
    \     'left': [
    \         ['mode', 'paste'],
    \         ['filename', 'anzu']
    \     ],
    \     'right': [
    \         ['lineinfo'],
    \         ['percent'],
    \         ['charcode', 'fileformat', 'fileencoding', 'filetype']
    \     ]
    \ },
    \ 'component_function': {
    \     'modified': 'MyModified',
    \     'readonly': 'MyReadOnly',
    \     'filename': 'MyFileName',
    \     'fileformat': 'MyFileFormat',
    \     'filetype': 'MyFileType',
    \     'fileencoding': 'MyFileEncoding',
    \     'mode': 'MyMode',
    \     'anzu': 'anzu#search_status'
    \ }
    \ }

function! MyModified()
    return &ft =~ 'help\|vimfiler\|gundo' ? '' : &modified ? '+' : &modifiable ? '' : '-'
endfunction

function! MyReadOnly()
    return &ft !~? 'help\|vimfiler\|gundo' && &ro ? 'x' : ''
endfunction

function! MyFileName()
    return ('' != MyReadOnly() ? MyReadOnly() . ' ' : '') .
        \ (&ft == 'vimfiler' ? vimfiler#get_status_string() :
        \  &ft == 'unite' ? unite#get_status_string() :
        \  &ft == 'vimshell' ? substitute(b:vimshell.current_dir,expand('~'),'~','') :
        \  '' != expand('%:t') ? expand('%:t') : '[No Name]') .
        \  ('' != MyModified() ? ' ' . MyModified() : '')
endfunction

function! MyFileFormat()
    return winwidth('.') > 70 ? &fileformat : ''
endfunction

function! MyFileType()
    return winwidth('.') > 70 ? (strlen(&filetype) ? &filetype : 'no ft') : ''
endfunction

function! MyFileEncoding()
    return winwidth('.') > 70 ? (strlen(&fenc) ? &fenc : &enc) : ''
endfunction

function! MyMode()
    return winwidth('.') > 60 ? lightline#mode() : ''
endfunction

