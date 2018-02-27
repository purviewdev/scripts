#!/bin/bash
/usr/bin/php /home/admin/scripts/cmi/ris/process_billing.php > process_billing.html
cat process_billing.html | mail -s "$(echo -e "CMI - BILLING PROCESSOR\nContent-Type: text/html")" pjackson@purview.net
#/usr/bin/metasend -b -t pjackson@chesapeakeimaging.net -m "text/html" -s "CMI - BILLING PROCESSOR" -f process_billing.html
rm process_billing.html
