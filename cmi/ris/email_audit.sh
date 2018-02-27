#!/bin/bash
/usr/bin/php /home/admin/scripts/cmi/ris/email_audit.php > /home/admin/scripts/cmi/ris/audit_temp.html
cat /home/admin/scripts/cmi/ris/audit_temp.html | mail -s "$(echo -e "CMI - WEB PORTAL AUDIT SUMMARY\nContent-Type: text/html")" pjackson@purview.net,dcramer@cmirad.net,slinhard@cmirad.net
rm /home/admin/scripts/cmi/ris/audit_temp.html
