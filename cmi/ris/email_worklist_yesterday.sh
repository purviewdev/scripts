#!/bin/bash


/usr/bin/php /home/admin/scripts/cmi/ris/email_worklist_yesterday.php > temp.html

cat temp.html | mail -s "$(echo -e "CMI - Lingering Yesterday Cases\nContent-Type: text/html")" pjackson@purview.net

#/usr/bin/metasend -b -t worklist@chesapeakeimaging.net -m "text/html" -s "Lingering Yesterday Cases" -f temp.html

rm temp.html
