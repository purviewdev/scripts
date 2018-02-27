#!/bin/bash
/usr/bin/php /home/admin/scripts/cmi/ris/email_womens_billing_data.php > temp255.html
cat temp255.html | mail -s "$(echo -e "CMI - WOMENS BILLING SUMMARY\nContent-Type: text/html")" pjackson@purview.net,punitas@cmimail.net
#/usr/bin/metasend -b -t punitas@cmimail.net -m "text/html" -s "CMI - WOMENS BILLING SUMMARY" -f temp255.html
rm temp255.html
