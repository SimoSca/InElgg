#!/bin/bash

touch save.txt

# directory del progetto: path fino a sf_ElggProject
DIR=$1

# nome del file con path assoluto
FILE=$2

MatchMod="foowd_alpha2/mod_elgg/"
PathMod="/var/www/html/elgg-1.10.4/mod/"



echo $FILE
echo $DIR

if [[ "$FILE" == "$DIR"* ]]
then
	# estraggo dal file completo la directory del progetto:

 	FOOWDA=`echo "$FILE" | sed "s@$DIR@@"`
 	#${FILE#${DIR}}
 	echo $FOOWDA

 	# scelgo dove salvare il file
 	if [[ "$FOOWDA" == "$MatchMod"* ]]
 	then
 		echo 'ok'
 		CMD="rsync -avz --chown=http-web:http-web"
 		SRC=$FILE
 		DST="enomis@5.196.228.146:${PathMod}${FOOWDA#${MatchMod}}"
 		CMD="$CMD $FILE $DST"
 		echo "$CMD"
 		eval "$CMD"
 	else
 		echo 'wrong: file does not match requested dir foowd_alpha2'
 	fi

fi
