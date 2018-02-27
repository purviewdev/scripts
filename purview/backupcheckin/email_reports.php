<head>
</head>
<html>
<body>

<?php

include_once('/root/scripts/backup/db.inc'); //loads database from db.inc
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die('Cannot select database');
if(isset($_GET['search']))
{
$search = $_GET['search'];
}
$DATE = date('Y-m-d');
#$DATE = "2016-04-07";
// SEARCH QUERY

$query = "SELECT customer_full from checkins_list WHERE customer_abbr NOT IN (SELECT customer FROM backup_checkins 
         WHERE backup_checkins.checkin_date LIKE '".$DATE."%') ORDER BY customer_full";

$result = mysql_query($query) or die(mysql_error());
$number_of_results = mysql_num_rows($result);
?>

<h1>Purview Daily Backup Checkin <?php echo $DATE; ?></h1>
<hr>
<p><b><?php echo $number_of_results; ?> instances failed backup</b></p>
<table width=100%>
<tr>
<td><B>Customer</td>
</tr>


	<?php while($row = mysql_fetch_array($result)) { ?>

<tr>
<td><?php echo $row['customer_full']; ?></td>
</tr>	
<?php } ?>
</table>

</body>
</html>
