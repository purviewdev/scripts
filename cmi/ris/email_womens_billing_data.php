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
#$DATE = date('20160217');
$yesterday=date("Ymd", time()-86400);


// SEARCH QUERY
$query = "SELECT womens_exam.exam_id, womens_exam.exam_scan_date, womens_exam.rad_signoff_username,womens_exam.exam_contrast,womens_exam_procedure.procedure_code,womens_exam_procedure.extrem_geo, 
womens_exam_procedure.proc_mod, womens_exam_procedure.diagnosis_code, womens_exam.exam_id, womens_exam.exam_patient_id, facility_machines.facility_id, refer_physicians.physician_first, 
refer_physicians.physician_last, refer_physicians.npin FROM womens_exam_procedure, womens_exam, patient, patient_schedule, facility_machines, 
refer_physicians WHERE womens_exam_procedure.exam_id = womens_exam.exam_id AND womens_exam.exam_appt = patient_schedule.schedule_id AND 
patient_schedule.exam_ordering_doctor = refer_physicians.physician_id AND patient_schedule.machine_id = facility_machines.machine_id AND 
womens_exam.exam_patient_id = patient.patient_id AND womens_exam.exam_auth = '1' AND womens_exam.exam_auth_date LIKE '".$DATE."%' 
ORDER BY womens_exam.exam_id";

$result = mysql_query($query) or die(mysql_error());
$number_of_results = mysql_num_rows($result);
?>

<h1>CMI - WOMENS BILLING SUMMARY</h1>
<hr>
<p><b><?php echo $number_of_results; ?> encounters billed, today (womens)</b></p>
<table width=100%>
<tr>
<td><b>Exam ID</b></td>
<td><b>Scan Date</b></td>
<td><b>CPT</b></td>
<td><b>ICD9</b></td>
<td><b>Patient ID</b></td>
<td><b>Physician First</b></td>
<td><b>Last</b></td>
<td><b>Facility</b></td>
</tr>


	<?php while($row = mysql_fetch_array($result)) { ?>

<tr>
<td><?php echo $row['exam_id']; ?></td>
<td><?php echo $row['exam_scan_date']; ?></td>
<td><?php echo $row['procedure_code']; ?></td>
<td><?php echo $row['diagnosis_code']; ?></td>
<td><?php echo $row['exam_patient_id']; ?></td>
<td><?php echo $row['physician_first']; ?></td>
<td><?php echo $row['physician_last']; ?></td>
<td><?php echo $row['facility_id']; ?></td>
</tr>	
<?php } ?>
</table>

</body>
</html>
