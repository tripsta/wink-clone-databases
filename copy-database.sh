#!/bin/bash

DBROOTUSER=root
DBSNAME=$1
DBNAME=$2
DBSERVER=$3
DBSERVER=$3
DBROOTPASSWORD=$4
DBUSER=$5
DBPASSWORD=$6

fCreateTable=""
fInsertData=""
DBCONN="-h ${DBSERVER} -u ${DBROOTUSER} --password=${DBROOTPASSWORD}"

echo "CREATE DATABASE ${DBNAME}" | mysql ${DBCONN}
for TABLE in `echo "SHOW TABLES" | mysql $DBCONN $DBSNAME | tail -n +2`; do
    createTable=`echo "SHOW CREATE TABLE ${TABLE}"|mysql -B -r $DBCONN $DBSNAME|tail -n +2|cut -f 2-`
    fCreateTable="${fCreateTable} ; ${createTable}"
    insertData="INSERT INTO ${DBNAME}.${TABLE} SELECT * FROM ${DBSNAME}.${TABLE}"
    fInsertData="${fInsertData} ; ${insertData}"
done;


echo "set foreign_key_checks = 0; $fCreateTable ; $fInsertData ; set foreign_key_checks = 1;" | mysql $DBCONN $DBNAME
echo "GRANT ALL ON ${DBNAME}.* TO '${DBUSER}'@'${DBSERVER}' IDENTIFIED BY '${DBPASSWORD}';" | mysql $DBCONN $DBNAME
echo "Database ${DBNAME} created..."
