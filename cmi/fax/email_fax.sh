#!/bin/bash
/usr/bin/php /home/admin/scripts/cmi/fax/nightly_report.php > nightly_report.html
cat nightly_report.html | mail -s "$(echo -e "CMI - NIGHTLY FAX AUDIT for TODAY\nContent-Type: text/html")" FaxReport@cmimail.net 
rm audit_temp.html
