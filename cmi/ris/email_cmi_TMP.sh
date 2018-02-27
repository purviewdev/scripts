#!/bin/bash
/usr/bin/php /home/admin/scripts/cmi/ris/email_cmi.php > email_cmi_temp.html
cat email_cmi_temp.html | mail -s "$(echo -e "CMI - AUDIT SUMMARY for TODAY\nContent-Type: text/html")" pjackson@purview.net
#/usr/bin/metasend -b -t rrosenbaum@securerad.com -m "text/html" -s "CMI - AUDIT SUMMARY for TODAY" -f email_cmi_temp.html
rm email_cmi_temp.html
