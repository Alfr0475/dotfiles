if [ -f /etc/bashrc ]; then
        . /etc/bashrc
fi

# contribが無ければ作成
! [ -a $HOME/contrib ] && mkdir $HOME/contrib

#----------------------------------------------------------------------------
# Bash
#----------------------------------------------------------------------------

#
# preexec.bash
#
source $HOME/contrib/preexec.bash


#
# alias
#
if [ `uname` = "Linux" ]; then
  alias ll="ls -l --color=tty"
  alias la="ls -al --color=tty"
elif [ `uname` = "Darwin" ]; then
  alias ll="ls -lG"
  alias la="ls -alG"
  alias vi="vim"

  # phpenvの設定
  if [ -e ~/.phpenv ]; then
    export PATH=$PATH:$HOME/.phpenv/bin
    eval "$(phpenv init -)"
  fi

  # rbenvの設定
  if which rbenv > /dev/null; then
    eval "$(rbenv init -)";
  fi

  # pyenvの設定
  if which pyenv > /dev/null; then
    eval "$(pyenv init -)";
  fi
fi

alias lm="ll | less"

#
# Term
#
export TERM="xterm-256color"

#----------------------------------------------------------------------------
# Git
#----------------------------------------------------------------------------

#
# git-completion.bash
#
source $HOME/contrib/git-completion.bash


#
# プロンプトにVCSの情報を表示する。
# 今のところSubversionとGitに対応。
#
# 表記例)
#   Subversion : (SVN:trunk:1)
#                (SVN:branches/hoge:4)
#
#   Git        : (Git:master)
#
function parse_vcs_info {
  git_branch=`git branch --no-color 2> /dev/null | sed -e '/^[^*]/d' -e 's/* \(.*\)/(Git:\1)/'`
  if ! [ $git_branch ]; then
    __svn_status=(`LANG=C svn info 2> /dev/null | awk '/^URL:/{url = $2} /^Last Changed Rev:/{rev = $4; print url " " rev} '`)
    url=`echo ${__svn_status[0]}`
    revision=`echo ${__svn_status[1]}`
    if [ $url ]; then
      echo -n '(SVN:'
      case "$url" in
        *trunk*)
          echo -n "trunk:$revision)"
        ;;
        *branches*)
          echo -n 'branches'
          branch=`echo -n $url | sed -e 's/.*branches\///' | sed -e 's/\/.*//'`
          [ $branch ] && echo -n "/$branch:$revision)"
        ;;
        *tags*)
          echo -n 'tags'
          tag=`echo -n $url | sed -e 's/.*tags\///' | sed -e 's/\/.*//'`
          [ $tag ] && echo -n "/$tag:$revision)"
        ;;
      esac
    fi
  else
    [ $git_branch ] && echo -n "$git_branch"
  fi
}

# コマンドを実行する度に必ず呼ばれる関数
function precmd() {
  PROMPT="\[\033[1;32m\][\u@${HOSTNAME} \t \W\$(parse_vcs_info)]\[\033[0m\]\$ "
}
function proml {
  PS1="\[\033[1;32m\][\u@${HOSTNAME} \t \W\$(parse_vcs_info)]\[\033[0m\]\$ "
}
proml


#
# loopwatch
# 引数で指定したコマンドを5秒置きに実行する
#
function loopwatch {
  # 無限ループして処理
  while true
  do
    date;
    echo
    $*
    sleep 5;
    clear
  done
}

