#!/bin/bash
/usr/bin/php /home/admin/scripts/cmi/ris/email_billing_data_telerad.php > temp5.html
cat temp5.html | mail -s "$(echo -e "CMI - GENERAL BILLING SUMMARY TELERAD\nContent-Type: text/html")" pjackson@purview.net
#/usr/bin/metasend -b -t billingteam@chesapeakeimaging.net -m "text/html" -s "CMI - GENERAL BILLING SUMMARY TELERAD" -f temp5.html
rm temp5.html
