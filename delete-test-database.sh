#!/bin/bash

DBUSER=root
DBPASSWORD=root
DBSERVER=localhost

DBSNAME=$1
FROM=$2
TO=$3

if [ ! -z $DBSNAME -a ! -z $FROM -a ! -z $TO ]; then
	fCreateTable=""
	fInsertData=""
	for i in `seq $FROM $TO`; do
		DBNAME=$DBSNAME$i
		echo "Droping database ${DBNAME}... (may take a while ...)"
		DBCONN="-h ${DBSERVER} -u ${DBUSER} --password=${DBPASSWORD}"
		echo "DROP DATABASE IF EXISTS ${DBNAME}" | mysql ${DBCONN}
	done;
else
	echo "Call script using DBNAME FROM TO"
	echo "Example: sh delete-test-database.sh tp24_test 0 10"
fi