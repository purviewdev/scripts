#!/bin/bash

set -x

#CMI Annapolis PACS
ipAddr1="172.16.1.3"
dbName1="pacsdbcmi"
file1="cmi_studies_annap_pacs.txt"
var1="$ipAddr1 $dbName1"

#CMI cloud instance
ipAddr2="192.168.179.12"
dbName2="pacsdbcmi"
file2="cmi_studies_cloud.txt"
var2="$ipAddr2 $dbName2"

FILES="cmi_studies_annap_pacs.txt cmi_studies_cloud.txt cmi_studies_all.txt tmp1 tmp2"

cd /home/admin/scripts/cmi/

# delete old stuff if it exists
for file in $FILES
do

  if [ -e "$file" ]; then     # Check if file exists.
    echo "Removing $file.";
    rm $file
  else
    echo "$file does not exist.";
   fi
done


# date to use in mySQL query
YEST=$(date +%Y-%m-%d -d "yesterday")
echo $YEST

# define date span to search for mySQL studies
YEST_RANGE="\"$YEST 00:00:00\" AND \"$YEST 23:59:59\""
echo $YEST_RANGE

selectvar="select pat_id,study_datetime, study_desc,num_series,num_instances from patient,study \
where patient.pk = study.patient_fk AND study.created_time BETWEEN $YEST_RANGE \
order by pat_id;"

mysql -uroot -pdgfsty16 -h $var1 -e "$selectvar" > $file1
mysql -uroot -pdgfsty16 -h $var2 -e "$selectvar" > $file2

sort -o $file1 $file1
sort -o $file2 $file2 

#sort $file1 > tmp1; cat tmp1 > $file1
#sort $file2 > tmp2; mv tmp2 > $file2 

comm -3 $file1 $file2 | sort > cmi_studies_all.txt

#cat yesterday.txt | column -t -s $'\t'| mail -s "Studies from $YEST" rrosenbaum@securerad.com, pjackson@purview.net, dweissman@purview.net, cdykstra@securerad.com

exit 0



