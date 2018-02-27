#!/bin/bash
/usr/bin/php /home/admin/scripts/cmi/ris/email_worklist_48.php > temp.html
cat temp.html | mail -s "$(echo -e "CMI - MIDNIGHT WATCH\nContent-Type: text/html")" pjackson@purview.net
#metasend -b -t worklist@chesapeakeimaging.net -m "text/html" -s "Midnight Watch" -f temp.html
rm temp.html
