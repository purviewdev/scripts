#!/bin/bash
/usr/bin/php /home/admin/scripts/cmi/ris/email_somers.php > email_somers_temp.html
cat email_somers_temp.html | mail -s "$(echo -e "Somers Animal Hospital - AUDIT SUMMARY for TODAY\nContent-Type: text/html")" pjackson@purview.net
# /usr/bin/metasend -b -t jenng@somersanimalhospital.com,pjackson@securerad.com -m "text/html" -s "Somers Animal Hospital - AUDIT SUMMARY for TODAY" -f email_somers_temp.html
rm email_somers_temp.html
