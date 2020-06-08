#!/usr/bin/env bash

# default parameters
interval=3
verbose=0
withBreak=0

function help() {
  echo "
        Usage: $0 [parameters] -- <command>
        Parameters:
          -v <int>    - verbose level (integer)
          -s <int>    - sleep interval, in seconds (integer)
          -h        - this page

        For example:
          $0 -v 0 -s 5 -- echo \"hello\"
    "
  exit 1
}

while [ -n "$1" ]; do
  case "$1" in
  -h)
    help
    ;;
  -v)
    verbose="$2"
    shift
    ;;
  -s)
    interval="$2"
    shift
    ;;
  --)
    withBreak=1
    shift
    break
    ;;
  *)
    echo "$1 is not an option"
    help
    ;;
  esac
  shift
done

if [ $withBreak -eq 0 ] || [ $# -eq 0 ]; then
  echo "Command is not specified"
  help
fi

command="$@"

if [ $verbose -ge 2 ]; then
  echo "Sleep interval: $interval"
  echo "Command: $command"
fi

if [ $verbose -ge 1 ]; then
  echo "Wait for database connection..."
fi

state=0

while [ $state -lt 1 ]; do
  { # try
    if [ $verbose -ge 3 ]; then
      eval $command &&
        state=1
    else
      eval $command >/dev/null 2>&1 &&
        state=1
    fi

  } || { # catch
    state=0
    sleep $interval
  }

done

if [ $verbose -ge 1 ]; then
  echo "Connection established!"
fi

# exit with no errors
exit 0
