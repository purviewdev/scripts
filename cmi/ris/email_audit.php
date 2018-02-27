<head>
</head>
<html>
<body>

<?php

include_once('/var/www/html/cmi_iris/includes/db.inc'); //loads database from db.inc
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die('Cannot select database');
if(isset($_GET['search']))
{
$search = $_GET['search'];
}
$DATE = date('Y-m-d');

// SEARCH QUERY
$query = "SELECT * FROM web_audit
          WHERE datetime LIKE '".$DATE."%'";

$result = mysql_query($query) or die(mysql_error());
$number_of_results = mysql_num_rows($result);
?>

<h1>ACTIVITY AUDIT for <?php echo $DATE; ?></h1>
<hr>
<p><b><?php echo $number_of_results; ?> ACTIVITY AUDIT</b></p>
<table width=100%>
<tr>
<td><b>ID</b></td>
<td><b>Username</b></td>
<td><b>Search</b></td>
</tr>


	<?php while($row = mysql_fetch_array($result)) { ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['user']; ?></td>
<td><?php echo $row['search']; ?></td>
</tr>	
<?php } ?>
</table>

</body>
</html>
