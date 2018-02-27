<?php
/*****************************************************************************
 Description:
   Database Defintions?
   @TODO Remove, replace with one configuration file
******************************************************************************/
$dbhost='localhost'; //establishes hostname
$dbusername='root'; //establishes username
$dbuserpass='dgfsty16'; //establishes pw
$dbname = 'pod_backup_checkins'; //establishes table name

// Show an error and stop the script
function showerror()
{
   if (mysql_error())
      die("Error " . mysql_errno() . " : " . mysql_error());
   else
      die("Could not connect to the DBMS");
}

// Secure the user data by escaping characters 
// and shortening the input string
function clean($input, $maxlength)
{
  $input = substr($input, 0, $maxlength);
  $input = EscapeShellCmd($input);
  return ($input);
}

?>
