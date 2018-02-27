<?php
/**
 *  EXAMPLE (iam_dsvdump)
 *
 *  @author     Iván Ariel Melgrati <phpclasses@imelgrat.mailshell.com>
 *  @version    1.0
 *  @package    iam_csvdump
 *
 *  A class form performing a query dump and sending it to the browser or setting it or download.
 *  Requires PHP v 4.0+ and MySQL 3.23+
 *
 *  Copyright (C) Iván Ariel Melgrati <phpclasses@imelgrat.mailshell.com>
 *
 *  This library is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU Lesser General Public
 *  License as published by the Free Software Foundation; either
 *  version 2 of the License, or (at your option) any later version.
 *
 *  This library is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 *  Lesser General Public License for more details.
 */


  #####################################################################################################################
  #                      Include the class                                                                            #
  #####################################################################################################################
  require_once("iam_csvdump.php");

  #####################################################################################################################
  #  Set the parameters: SQL Query, hostname, databasename, dbuser and password                                       #
  #####################################################################################################################
  $dumpfile = new iam_csvdump;
  $DATE = date('Ymd');
  #$DATE = 20160215;
  #####################################################################################################################
  #  Call the CSV Dumping function and THAT'S IT!!!!  A file named dump.csv is sent to the user for download          #
  #####################################################################################################################
  $dumpfile->dump("SELECT womens_exam.exam_scan_date, womens_exam.rad_signoff_username,womens_exam.exam_contrast,womens_exam_procedure.procedure_code,womens_exam_procedure.extrem_geo, 
womens_exam_procedure.proc_mod, womens_exam_procedure.diagnosis_code, womens_exam.exam_id, womens_exam.exam_patient_id, facility_machines.facility_id, refer_physicians.physician_first, 
refer_physicians.physician_last, refer_physicians.npin, womens_exam.exam_read_location_2015 FROM womens_exam_procedure, womens_exam, patient, patient_schedule, facility_machines, refer_physicians WHERE womens_exam_procedure.exam_id 
= womens_exam.exam_id AND womens_exam.exam_appt = patient_schedule.schedule_id AND patient_schedule.exam_ordering_doctor = refer_physicians.physician_id AND patient_schedule.machine_id = 
facility_machines.machine_id AND womens_exam.exam_patient_id = patient.patient_id AND womens_exam.exam_auth = '1' AND womens_exam.exam_auth_date LIKE '".$DATE."%'", "approved", "csv", 
"cmi_iris", "root", "dgfsty16", "localhost" );
?>
