#!/bin/bash
/usr/bin/php /home/admin/scripts/purview/backupcheckin/email_reports.php > temp5.html
cat temp5.html | mail -s "$(echo -e "Purview Daily Backup Checkin\nContent-Type: text/html")" les@purview.net,rrosenbaum@purview.net,josh@purview.net
rm temp5.html
