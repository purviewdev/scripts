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
  $dumpfile->dump("SELECT exam.exam_scan_date, exam.rad_signoff_username, exam.exam_contrast, exam_procedure.procedure_code,exam_procedure.extrem_geo,exam_procedure.proc_mod, exam_procedure.diagnosis_code, exam_procedure.diagnosis_code_1, exam_procedure.diagnosis_code_2, exam.exam_id, exam.exam_patient_id, facility_machines.facility_id, refer_physicians.physician_first, refer_physicians.physician_last,refer_physicians.npin, exam.exam_read_location,exam.exam_read_location_2015 FROM exam_procedure, exam, patient, patient_schedule, facility_machines, refer_physicians WHERE exam_procedure.exam_id = exam.exam_id AND exam.exam_appt = patient_schedule.schedule_id AND patient_schedule.exam_ordering_doctor = refer_physicians.physician_id AND patient_schedule.machine_id = facility_machines.machine_id AND exam.exam_patient_id = patient.patient_id AND exam.exam_auth = '1' AND exam.exam_auth_date LIKE '".$DATE."%'", "approved", "csv", "cmi_iris", "root", "dgfsty16", "localhost" );

?>
