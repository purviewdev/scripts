#!/bin/bash
set -x

/usr/bin/php /home/pjackson/scripts/email_tollgate.php > email_tollgate_temp.html
/usr/bin/metasend -b -t rrosenbaum@securerad.com -m "text/html" -s "TOLLGATE - AUDIT SUMMARY for TODAY" -f email_tollgate_temp.html
