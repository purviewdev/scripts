<html>

<?php

mysql_connect ('localhost', 'root', 'dgfsty16');
mysql_select_db('cmi_iris') or die('Cannot select database');

$today = date("Y-m-d");
//$today = "2016-09-15";
// SEARCH QUERY
$query = "SELECT * FROM fax_reporting,exam,patient,refer_physicians,patient_schedule 
		  WHERE fax_reporting.exam = exam.exam_id
		  AND exam.exam_appt = patient_schedule.schedule_id
		  AND patient_schedule.exam_ordering_doctor = refer_physicians.physician_id
		  AND exam.exam_patient_id = patient.patient_id
		  AND fax_reporting.submit_time LIKE '$today%'";

$result = mysql_query($query) or die(mysql_error());
?>

<html>
<body>

<p align="center"><h2>Nightly Fax Report</h2></p>

<table width="100%">

<tr>
	<td><b>Patient Name</b></td>
	<td><b>Exam ID</b></td>
	<td><b>Fax Submit Time</b></td>
	<td><b>Fax Complete Time</b></td>
	<td><b>Referring Physician</b></td>
	<td><b>Fax Destination #</b></td>
	<td><b>Pages Sent</b></td>
	<td><b>Pages Submitted</b></td>
	<td><b>Status</b></td>

</tr>	

<?php while($row = mysql_fetch_array($result))
	{
	echo "<tr padding=\"5\">";

	echo "<td>".$row['patient_last']." ".$row['patient_first']."</td>";
	echo "<td>".$row['exam_id']."</td>";
	echo "<td>".$row['submit_time']."</td>";
	echo "<td>".$row['complete_time']."</td>";
	echo "<td>".$row['physician_first']." ".$row['physician_last']." ".$row['physician_title']."</td>";
	echo "<td>".$row['destination_fax']."</td>";
	echo "<td>".$row['pages_sent']."</td>";
	echo "<td>".$row['pages_submitted']."</td>";
	echo "<td>";
	echo "".$row['status']."";

		if ($row['status'] === '0') {
			echo " - Fax sent successfully";
		}

		if ($row['status'] === '6017') {
			echo " - Line Busy";
		}

		if ($row['status'] === '-3') {
			echo " - Pending Retry";
		}

		if ($row['status'] === '-11') {
			echo " - Processing Fax";
		}

		if ($row['status'] === '8010') {
			echo " - The remote fax machine disconnected before fax completed";
		}

		if ($row['status'] === '3936') {
			echo " - Human voice answer";
		}

		if ($row['status'] === '3211') {
			echo " - Fax machine incompatibility";
		}

		if ($row['status'] === '3220') {
			echo " - Fax machine incompatibility";
		}

		if ($row['status'] === '3224') {
			echo " - The remote fax machine failed to respond";
		}
		
		if ($row['status'] === '3225') {
			echo " - Fax machine incompatibility";
		}

		if ($row['status'] === '3231') {
			echo " - Fax machine incompatibility";
		}		

		if ($row['status'] === '3233') {
			echo " - Fax machine incompatibility";
		}	

		if ($row['status'] === '3264') {
			echo " - Fax machine incompatibility";
		}	

		if ($row['status'] === '3267') {
			echo " - Fax machine incompatibility";
		}	

		if ($row['status'] === '3267') {
			echo " - Fax machine incompatibility";
		}

		if ($row['status'] === '8021') {
			echo " - No answer, out of paper or memory full";
		}	

		if ($row['status'] === '6016') {
			echo " - Telephony Error";
		}	

		if ($row['status'] === '6028') {
			echo " - Phone number not operational";
		}	

		if ($row['status'] === '6044') {
			echo " - Telephony Error";
		}
				
	echo "</td>";
	echo "</tr>";
	};
	?>
</table>

</html>
</body>
