#!/bin/bash
/usr/bin/php /home/admin/scripts/cmi/tomo/email_audit.php > audit_temp.html
cat audit_temp.html | mail -s "$(echo -e "CMI - TOMO AUDIT SUMMARY for TODAY\nContent-Type: text/html")" ssmall@cmimail.net
rm audit_temp.html
