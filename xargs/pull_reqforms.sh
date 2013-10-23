#!/bin/bash
#
#

INBOX="/mnt/public/LIS/completed Reqforms"
CONFLICTS="/home/public/req_forms_conflict"
OUTBOX="/home/public/req_forms"

# how many parallel processes to run via xargs(1)?
MAX_PROCS=4

LOGGER="logger -s -t `basename $0`"
function info { $LOGGER -p local2.info -- "[INFO] $1"; }
function note { $LOGGER -p local2.notice -- "[NOTE] $1"; }
function warn { $LOGGER -p local2.warning -- "[WARN] $1"; }
function error { $LOGGER -p local2.error -- "[ERROR] $1"; exit -1; }


# sanity checks
[ -d "$INBOX" ] || error "Cannot see inbox directory $INBOX"
[ -d "$CONFLICTS" ] || error "Cannot see confict directory $CONFLICTS"
[ -d "$OUTBOX" ] || error "Cannot see outbox directory $OUTBOX"


# move new PDFs to the working area
cd "$INBOX" || error "Unable to chdir() to $INBOX"

info "starting requisition form pull"

find . -mount -type f -print0 \
  | xargs -P $MAX_PROCS -0 -r -n 100 mv --backup=numbered -t "$OUTBOX" \
  || error "Unable to move PDFs from $INBOX to $OUTBOX"


# rename .PDF to .pdf
cd "$OUTBOX" || error "Unable to chdir() to $OUTBOX"

find . -mount -type f -print0 \
  | xargs -P $MAX_PROCS -0 -r -n 100 rename 's/PDF/pdf/' \
  || error "Unable to rename some files in $OUTBOX"


FILES=`find . -maxdepth 1 -type f -name '*.pdf'`

if [ -n "$FILES" ]; then
  # file, by year
  for FILE in $FILES; do
    NAME=`basename $FILE`
    YEAR=`expr substr "$NAME" 1 4`

    # create the directory, if it doesn't exist
    [ -d "$YEAR" ] || mkdir "$YEAR"

    # file the requisition form
    note "Archiving requisition file: $NAME"
    mv --backup=numbered -t "$YEAR" "$FILE"
  done
else
  info "No new requisition files"
  exit 0
fi

# move the conflict files to the $CONFLICTS directory
find . -mount -regextype posix-egrep -maxdepth 2 \
  \( -regex '.*/[0-9]{9}\.pdf' -o -not -type f \) -o -print0 \
  | xargs -P $MAX_PROCS -0 -r -n 100 mv --backup=numbered -t "$CONFLICTS" \
  || error "Unable to move conflict PDFs from $OUTBOX to $CONFLICTS"


# fix permissions for all directories
find . -mount -type f -print0 \
  | xargs -P $MAX_PROCS -0 -r -n 100 chown nobody:nogroup \
  || error "Unable to chown some files in $OUTBOX"


cd "$CONFLICTS" || error "Unable to chdir() to $CONFLICTS"

find . -mount -type f -print0 \
  | xargs -P $MAX_PROCS -0 -r -n 100 chown nobody:nogroup \
  || error "Unable to chown some files in $CONFLICTS"


# clean up the conflicting files
find . -mount -type f -print0 \
  | xargs -P $MAX_PROCS -0 -r -n 100 rename 's/\.~1~//' \
  || error "Unable to rename some files in $CONFLICTS"

find . -mount -type f -print0 \
  | xargs -P $MAX_PROCS -0 -r -n 100 rename 's/PDF/pdf/' \
  || error "Unable to rename some files in $CONFLICTS"

info "finished requisition form pull"

