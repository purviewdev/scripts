#!/usr/bin/expect -f
spawn /usr/bin/sftp octtollgate@hub.caretracker.com
expect "Password:"
#sleep 5
send "taXuspufU6\n"
expect "sftp>"
send "mput /var/www/html/secureris_tollgate/tmp/caretracker-*\r"
expect "sftp>"
