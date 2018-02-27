#!/usr/bin/expect -f
spawn /usr/bin/sftp TollgateRd@207.99.96.69
send "yes\n"
expect "Password:"
#sleep 5
send "1R4d9PR@4\n"
expect "sftp>"
send "mput /var/www/html/secureris_tollgate/tmp/amazing-*\r"
expect "sftp>"
