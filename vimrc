syntax on       "syntax highlight
set ruler       "show the cursor position
set nu

set tabstop=4       "tab
set shiftwidth=4    "tab
set expandtab       "always space, noexpandtab=\t

set hlsearch    "highlight search
set incsearch   "increase search

set ai          "auto indenting

autocmd FileType ruby setlocal tabstop=2 shiftwidth=2 expandtab
autocmd FileType php setlocal ts=4 sw=4 expandtab
autocmd FileType cpp setlocal ts=4 sw=4 et

nmap <silent> <Leader>n :NERDTreeToggle<CR>    "Nerdtree toggle \n

colorscheme elflord
set background=dark
set go-=T       "hide tool bar
set lines=35    "window height
"set guifont=Monaco:h13

if has('gui_running')   "only run for GUI
    colorscheme macvim
endif
