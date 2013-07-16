clear

# some more ls aliases
alias ls='ls -G'
alias ll='ls -l'

alias la='ls -lAFG'
alias l='ls -CF'
alias less='less -S'

#safer file operation
alias rm='rm -i'
alias mv='mv -i'
alias cp='cp -i'


echo -en "\033[1;31mWelcome to Hang's MacBook! Do you like Fatal Frame?\033[0m\n\n"

# show git branch
parse_git_branch() {
  git branch 2> /dev/null | sed -e '/^[^*]/d' -e 's/* \(.*\)/(\1)/'
}

export PS1='\[\033[01;32m\]\u\[\033[00m\]@\[\033[01;34m\]\h\[\033[00m\] \[\033[01;36m\]\w\[\033[00m\] \[\033[01;33m\]$(parse_git_branch)\[\033[00m\] $ '


export MYSQL_PS1='\u@\h [\d]> '

export GREP_OPTIONS='--color=always'

export VIM_APP_DIR="/Applications/MacVim-snapshot-68/"

source /Users/hangzhang/.rvm/scripts/rvm


