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
$DATE = date('Ymd');
$yesterday=date("Ymd", time()-86400);


// SEARCH QUERY
$query = "SELECT * FROM rad_worklist_billing WHERE exam_auth = '1' AND exam_auth_date = '".$DATE."'";

$result = mysql_query($query) or die(mysql_error());
$number_of_results = mysql_num_rows($result);
?>

<h1>IDTF/TELERAD - GENERAL BILLING SUMMARY</h1>
<hr>
<p><b><?php echo $number_of_results; ?> encounters billed, today</b></p>
<table width=100%>
<tr>
<td><b>ID#</b></td>
<td><b>Patient Name</b></td>
<td><b>MRN</b></td>
<td><b>Patient Study</b></td>
<td><b>Read Status</b></td>
<td><b>Read By</b></td>
<td><b>Exam Auth Date</b></td>
</tr>


	<?php while($row = mysql_fetch_array($result)) { ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['patient_name']; ?></td>
<td><?php echo $row['facility_mrn']; ?></td>
<td><?php echo $row['patient_study']; ?></td>
<td><?php echo $row['read_status']; ?></td>
<td><?php echo $row['read_by']; ?></td>
<td><?php echo $row['exam_auth_date']; ?></td>
</tr>	
<?php } ?>
</table>

</body>
</html>
