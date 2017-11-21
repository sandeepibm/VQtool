<?php
/******************************************************************************
 *   Filename:             
 *   Project:              Automated Operating System
 *   By:                   Saptarshi Roy
 *   Company:              IBM(I) Pvt Ltd
 *   Email:                saptroy1@in.ibm.com
 *   Version:              1.0.0
 *****************************************************************************/


  // Get the MySQL time
  $time = time();

  // Say that user is logged out
  $loggedout = true;

  // If there is a cookie
  if (isset($_COOKIE['cookie_info'])) {

      // Delete the cookie
      setcookie ("cookie_info", "", time() - 3600);

      // Use Connect Script
      include("connect.php");

      // Include the validation of user file
      include("validateuser.php");

      // If user and password are correct
      if (validateuser() == true) {

          // Use cookie and Extract the cookie data (Username and Password)
          $cookie_info = explode("-", $_COOKIE['cookie_info']);
          $namecookie = $cookie_info[0];
          $passcookie = $cookie_info[1];

          // Get details of user from Database and put them in variables
          $query = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
          $nameuser = mysql_result($query,0,8);

          // The user is not logged out yet
          $loggedout = false;
      }

      // If user and password are not correct print error message
      else {
          echo "Incorrect username/password";
          exit;
      }
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Logout</title>
</head>
<CENTER><a href="index.php">Click here to Login again</a><BR>

<?php

  // If user is logged out then print message
  if ($loggedout == false) {
      echo "You are now logged out<BR>";
  }

?>

</CENTER>
</html>