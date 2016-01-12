#!/bin/bash

# windows compatibility
# 's/\r$//'

# questo file e' scritto in windows, quindi devo togliergli le newline \r
# Per comodita' nella directory corrente eseguo il comando su tutti i files
# find . -type f -exec dos2unix.exe {} \;
# o solo per questo file, prima di runnarlo:
# dos2unix.exe <questo_file>


#### PROPEL ####

INPUT="propel.json"
OUTPUT="propel_test.json"

FOOWD_USER="foowd"
FOOWD_PASSWORD="mangioBENE"

sed -e '{
	s/FOOWD_USER/'"${FOOWD_USER}"'/g
	s:FOOWD_PASSWORD:'"${FOOWD_PASSWORD}"':g
	}' < $INPUT > $OUTPUT 