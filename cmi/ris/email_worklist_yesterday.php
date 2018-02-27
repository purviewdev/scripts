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
$yesterday=date("Y/m/d", time()-86400);


// SEARCH QUERY
$query = "SELECT exam.exam_id,exam.exam_appt,exam.exam_appt,exam.exam_scan_date, patient.patient_id, exam.exam_flag, exam.exam_category, exam.rad_signoff_username, facility.facility_name, facility.facility_tag, machine_name,machine_desc," .
         "    CONCAT(patient_last, ', ', patient_first) AS patient_name," .
         "    CONCAT(physician_last, ', ', physician_first) AS physician_name " .
         "  FROM exam, patient, refer_physicians, patient_schedule,facility_machines,facility " .
         " WHERE patient.patient_id = exam.exam_patient_id " .
	 "   AND exam.exam_appt = patient_schedule.schedule_id " .
	 "   AND patient_schedule.machine_id=facility_machines.machine_id " .
	 "   AND facility_machines.facility_id=facility.facility_id " .
         "   AND exam.exam_ordering_doctor = refer_physicians.physician_id" . 
         "   AND exam.exam_scan_date BETWEEN '$yesterday' AND '$yesterday'" .
         "   AND exam.rad_signoff_username = ''" .
         "   ORDER BY exam_scan_date, exam_flag DESC";

$result = mysql_query($query) or die(mysql_error());
$number_of_results = mysql_num_rows($result);
?>

<h1>The following cases remain unread from YESTERDAY at 1PM EST</h1>
<hr>
<p><b>There are <?php echo $number_of_results; ?> unread cases from yesterday at 1PM today!  What's going on?</b></p>
<table width=100%>
<?php echo $yesterday; ?>

	<?php while($row = mysql_fetch_array($result)) { ?>

<tr>
<td><?php echo $row['exam_flag']; ?></td>
<td><?php echo $row['exam_category']; ?></td>
<td><?php echo $row['exam_scan_date']; ?></td>
<td><?php echo $row['facility_tag']; ?></td>
<td><?php echo $row['machine_desc']; ?></td>
<td><?php echo $row['patient_id']; ?></td>
<td><?php echo $row['patient_name']; ?></td>
<td><?php echo $row['exam_scan_date']; ?></td>
</tr>	
<?php } ?>
</table>

</body>
</html>
