<head>
</head>
<html>
<body>

<?php


$dbhost = "66.159.85.196";
$dbusername = "root";
$dbuserpass = "dgfsty16";
$dbname= "pacsdbtollgate";

mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die('Cannot select database');
if(isset($_GET['search']))
{
$search = $_GET['search'];
}
$DATE = date('Y-m-d');

// SEARCH QUERY
$query = "SELECT * FROM patient,study
          WHERE patient.pk = study.patient_fk
          AND study.created_time >= '".$DATE."%'";

$result = mysql_query($query) or die(mysql_error());
$number_of_results = mysql_num_rows($result);
?>

<h1>Tollgate Radiology secureCLOUD Activity for <?php echo $DATE; ?></h1>
<hr>
<p><b><?php echo $number_of_results; ?> Activity Log</b></p>
<table width=100%>
<tr>
<td><b>Patient Name</b></td>
<td><b>Study Description</b></td>
<td><b>Study Datetime</b></td>
</tr>


	<?php while($row = mysql_fetch_array($result)) { ?>

<tr>
<td>Patient Name Removed</td>
<td><?php echo $row['study_desc']; ?> | <?php echo $row['num_instances']; ?> Images</td>
<td><?php echo $row['study_datetime']; ?></td>
</tr>	
<?php } ?>
</table>

</body>
</html>
