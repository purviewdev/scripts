<head>
</head>
<html>
<body>

<?php

include_once('/var/www/html/cmi_iris/includes/db.inc'); //loads database from db.inc
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die('Cannot select database');

// SEARCH QUERY
$query = "  UPDATE `exam` SET `exam_flag` = 'TIME_SENS'    " .
	 "  WHERE `exam_id` >=65000    " .
	 "  AND rad_signoff_username = ''    " .
	 "  AND `exam_flag` != 'TIME_SENS'    " .
	 "  AND exam_created_timestamp < SUBDATE( CURRENT_DATE, INTERVAL 24 HOUR )   ";


$result = mysql_query($query) or die(mysql_error());
echo $query;
echo $result;
?>
