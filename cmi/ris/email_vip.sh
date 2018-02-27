#!/bin/bash
/usr/bin/php /home/admin/scripts/cmi/ris/email_vip.php > email_vip.html
cat email_vip.html | mail -s "$(echo -e "CMI - VIP SUMMARY for TODAY\nContent-Type: text/html")" slinhard@cmirad.net,pjackson@purview.net,cmimarketingteam@cmirad.net,mbaganz@cmirad.net,shannon.rainey@cmirad.net,ckosman@cmirad.net
#/usr/bin/metasend -b -t slinhard@cmirad.net,pjackson@purview.net,marketingteam@cmirad.net,mbaganz@cmirad.net,shannon.rainey@cmirad.net,ckosman@cmirad.net -m "text/html" -s "CMI - VIP SUMMARY for TODAY" -f email_vip.html
rm email_vip.html
