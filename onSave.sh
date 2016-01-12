#!/bin/bash

function InCompile {
	file=$1
	base=$(echo "$file" | sed 's|\.[^\.]*$||g')
	ext=$(echo ${file##*.})
	#echo "nome $base ext $ext"

	if [[ "$ext" == "styl" ]]
		then
		stylus -u nib "$file" > /dev/null 2>&1
		file="$file $base.css"
	elif [[ "$ext" == "coffee" ]]
		then
		coffee -c "$file" > /dev/null 2>&1
		# printf "\n### Compilation via coffee script\n"
		# coffee -c "$file"
		file="$file $base.js"

	else
		file="$file"
	fi

	# string stored as returned variable
	echo "$file"
}

# touch save.txt

# directory del progetto: path fino a sf_ElggProject/
DIR=$1

# nome del file con path assoluto
FILE=$2
FILESCOMPILE=$(InCompile "$FILE")

MatchMod="foowd_alpha2/mod_elgg/"
PathMod="/var/www/html/elgg-1.10.4/mod/"


echo $DIR
echo $FILE


if [[ "$FILE" == "$DIR"* ]]
then
	# estraggo dal file completo la directory del progetto:

 	FOOWDA=`echo "$FILE" | sed "s@$DIR@@"`
 	#${FILE#${DIR}}
 	echo $FOOWDA

 	# scelgo dove salvare il file
 	if [[ "$FOOWDA" == "$MatchMod"* ]]
 	then
 		FOOWDA=$(dirname $FOOWDA)
 		printf "\n### file/s will be saved in directory: $FOOWDA \n"
 		CMD="rsync -avz --chown=http-web:http-web"
 		SRC=$FILESCOMPILE
 		DST="enomis@5.196.228.146:${PathMod}${FOOWDA#${MatchMod}}"
 		CMD="$CMD $SRC $DST"
 		printf "$CMD"
 		eval "$CMD"
 	else
 		echo 'wrong: file does not match requested dir foowd_alpha2'
 	fi

fi

