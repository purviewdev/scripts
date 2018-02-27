<head>
</head>
<html>
<body>

<?php

include_once('/home/admin/scripts/cmi/tomo/db.inc'); //loads database from db.inc
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die('Cannot select database');
if(isset($_GET['search']))
{
$search = $_GET['search'];
}
$DATE = date('Y-m-d');
#$DATE = date('2016-02-16');

// SEARCH QUERY
$query = "SELECT * FROM patient,study
	  WHERE study.patient_fk = patient.pk	
          AND study.study_datetime LIKE '".$DATE."%'";

$result = mysql_query($query) or die(mysql_error());
$number_of_results = mysql_num_rows($result);
?>

<h1>Diagnostic Imaging report for <?php echo $DATE; ?></h1>
<hr>
<p><b><?php echo $number_of_results; ?> ACTIVITY AUDIT</b></p>
<table width=100%>
<tr>
<td><b>Patient Name</b></td>
<td><B>Patient ID</td>
<td><b>Study Description</b></td>
<td><b>Study Datetime</b></td>
</tr>


	<?php while($row = mysql_fetch_array($result)) { ?>

<tr>
<td><?php echo $row['pat_name']; ?></td>
<td><?php echo $row['pat_id']; ?></td>
<td><?php echo $row['study_desc']; ?></td>
<td><?php echo $row['study_datetime']; ?></td>
</tr>	
<?php } ?>
</table>

</body>
</html>
