<?php
/**
 *  EXAMPLE (iam_dsvdump)
 *
 *  @author     Iv�n Ariel Melgrati <phpclasses@imelgrat.mailshell.com>
 *  @version    1.0
 *  @package    iam_csvdump
 *
 *  A class form performing a query dump and sending it to the browser or setting it or download.
 *  Requires PHP v 4.0+ and MySQL 3.23+
 *
 *  Copyright (C) Iv�n Ariel Melgrati <phpclasses@imelgrat.mailshell.com>
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

  #####################################################################################################################
  #  Call the CSV Dumping function and THAT'S IT!!!!  A file named dump.csv is sent to the user for download          #
  #####################################################################################################################
  $dumpfile->dump("SELECT * FROM providers_insurance", "providers_insurance", "csv", "cmi_iris", "root", "dgfsty16", "localhost" );


?>
