#!/bin/bash
/usr/bin/php /home/admin/scripts/cmi/ris/email_billing_data.php > tempbillingsum.html
cat tempbillingsum.html | mail -s "$(echo -e "CMI - GENERAL BILLING SUMMARY\nContent-Type: text/html")" pjackson@purview.net,punitas@cmirad.net
#/usr/bin/metasend -b -t punitas@cmirad.net,pjackson@purview.net -m "text/html" -s "CMI - GENERAL BILLING SUMMARY" -f tempbillingsum.html
rm tempbillingsum.html
