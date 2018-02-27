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

// SEARCH QUERY
$query = "SELECT * FROM patient_schedule,refer_physicians,facility_machines,facility,patient
	  WHERE patient_schedule.exam_ordering_doctor = refer_physicians.physician_id
	  AND patient_schedule.patient_id = patient.patient_id
	  AND patient_schedule.machine_id = facility_machines.machine_id
	  AND facility_machines.facility_id = facility.facility_id
          AND schedule_date = '".$DATE."' AND patient_schedule_status_id = 5";

$result = mysql_query($query) or die(mysql_error());
$number_of_results = mysql_num_rows($result);
?>

<h1>CMI - VIP SUMMARY for <?php echo $DATE; ?></h1>
<hr>
<p><b><?php echo $number_of_results; ?> VIP patients, today</b></p>
<table width=100%>
<tr>
<td><b>Patient ID</b></td>
<td><b>Patient Name</b></td>
<td><b>Machine</b></td>
<td><b>Appointment Details</b></td>
<td><b>Appt From</b></td>
<td><b>Appt To</b></td>
<td><b>Refer Physician</b></td>
</tr>


	<?php while($row = mysql_fetch_array($result)) { ?>

<tr>
<td><?php echo $row['patient_id']; ?></td>
<td><?php echo $row['patient_first']; ?> <?php echo $row['patient_last']; ?></td>
<td><?php echo $row['facility_name']; ?> - <?php echo $row['machine_name']; ?></td>
<td><?php echo $row['schedule_start']; ?></td>
<td><?php echo $row['schedule_end']; ?></td>
<td><?php echo $row['appt_details']; ?></td>
<td><?php echo $row['physician_first']; ?> <?php echo $row['physician_last']; ?></td>
</tr>	
<?php } ?>
</table>

</body>
</html>
