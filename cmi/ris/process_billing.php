<head>
</head>
<html>
<body>

<?php

include_once('/var/www/html/cmi_iris/includes/db.inc'); //loads database from db.inc
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die('Cannot select database');

$query = "TRUNCATE TABLE pmi_billing";
$result = mysql_query($query) or die(mysql_error());
echo $query;

$query2 = "TRUNCATE TABLE pmi_payments";
$result2 = mysql_query($query2) or die(mysql_error());
echo $query2;

$file_pay = '/home/pmi/ingester/pmidata/cmipay.csv';
$query3 = "LOAD DATA LOCAL INFILE '$file_pay' INTO TABLE pmi_payments FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n'";
$result3 = mysql_query($query3) or die(mysql_error());
echo $query3;

$file_chg = '/home/pmi/ingester/pmidata/cmichg.csv';
$query4 = "LOAD DATA LOCAL INFILE '$file_chg' INTO TABLE pmi_billing FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n'";
$result4 = mysql_query($query4) or die(mysql_error());
echo $query4;
?>

</table>

</body>
</html>
