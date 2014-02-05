#! /bin/bash

# this script is trying to move file with backup option
# and merge files if there is conflict

OUTBOX="2013/"

cd "$OUTBOX" || error "failed"

FILE_CONFLICTS=`find . -mount -regextype posix-egrep -maxdepth 2 \( -regex '.*[0-9]{10}\.pdf' -o -not -type f \) -o -print0`

if [ -n "$FILE_CONFLICTS" ] ; then
    for FILE in $FILE_CONFLICTS; do
        OLD=`basename $FILE`
        echo "OLD : $OLD"

        NEW=`basename $FILE .~1~`
        echo "NEW : $NEW"

        ORDER_ID=`basename $NEW .pdf`
        echo "ORDER_ID : $ORDER_ID"

        OUTPUT="$ORDER_ID-tmp.pdf"
        echo "OUTPUT : $OUTPUT"

    # merge two PDF
        pdftk $OLD $NEW cat output $OUTPUT
        rm $OLD
        rm $NEW
        mv $OUTPUT $NEW
    # merge done
    done
fi


: <<'MYCOMMENT'

pdftk paper-reading.pdf cat 1 output 201300001.pdf
mv --backup=numbered -f -t 2013 201300001.pdf

pdftk paper-reading.pdf cat 2 output 201300001.pdf
mv --backup=numbered -f -t 2013 201300001.pdf

MYCOMMENT









