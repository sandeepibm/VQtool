<?php
/******************************************************************************
 *   Filename:             
 *   Project:              Automated Operating System
 *   By:                   Saptarshi Roy
 *   Company:              IBM(I) Pvt Ltd
 *   Email:                saptroy1@in.ibm.com
 *   Version:              1.0.0
 *****************************************************************************/
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Save Subtype</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
</head>

<?php

  $time = time();
  ob_start();

  // Check if there is a cookie, if there isn't then exit!
  if (!isset($_COOKIE['cookie_info'])) {
      echo "Cannot access this page: You aren't logged in";
      exit;
  }

  // If there is a cookie, validate the cookie
  else {

      // Use Connect Script
      include("connect.php");

      // Include the validation of user file
      include("validateuser.php");

      // If user and password are correct
      if (validateuser() == true) {

          // Header
          //include("header.php");
		  include("baseframe.php");
          //login();

          // Use cookie and Extract the cookie data (Username and Password)
          $cookie_info = explode("-", $_COOKIE['cookie_info']);
          $namecookie = $cookie_info[0];
          $passcookie = $cookie_info[1];

  // Check the level of the user
  $userdata = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
  $username = mysql_result($userdata,0,8);

  // If the user is the admin
  //if ($checklevel1 == 1) {

  // Variables that data come from the submission form
  $name=$_POST["name1"];
  $sequence = $_POST["seq"];
  $Type = $_POST['Type'];
  $SLA = $_POST['sla'];
  // Get IP Address of user
 // $ipaddress = $_SERVER["REMOTE_ADDR"];

  /* Check if all the sections are completed as a whole, then if one isn't
  filled out display the error message for that/those particular variables. */
?>

<table class='header' width="800" border="0" align="center" valign="middle">
<tr><td  height='23'>
<b><center>Save Subtype</font></center></b>
</td></tr>
</table>
<br></br>

<?php
	  if (!$name || !$Type) {
		echo "<table width='60%' border='0' align='right' valign='top'>
				<tr><td>
				<font face='Tahoma' size='2' color='FF0000'>Invalid or Incomplete information:</font>
				</td></tr>
			</table>";
      if (!$name) {
		echo "<table width='60%' border='0' align='right' valign='top'>
				<tr><td>
				<font face='Tahoma' size='2' color='FF0000'>Please enter Subtype.</font>
				</td></tr>
			</table>";		  
      }			
      if (!$Type) {
		echo "<table width='60%' border='0' align='right' valign='top'>
				<tr><td>
				<font face='Tahoma' size='2' color='FF0000'>Please select Type.</font>
				</td></tr>
			</table>";	  
      }
	  echo "<br></br><br></br><br></br>";
      echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";
      exit(); // If there are errors then we quit this script
  }

  // Check if postcode is a numeric
  /*if ((!is_numeric($postcode))) {
        echo "Please enter a postcode";
        exit();
  }

  // Check if phone number 1 is a numeric
  if ((!is_numeric($phone1))) {
        echo "Please enter a phone number for phone number 1";
        exit();
  }

  // Check if phone number 2 is a numeric
  if ((!is_numeric($phone2))) {
        echo "Please enter a phone number for phone number 2";
        exit();
  }


  // Get date from MySQL Server
  $currentdatetime = mysql_query('select now()');
  $curdatetime = mysql_result($currentdatetime,0);

  // Check if username exists. If not then add all data to the database.
  //If so then ask user for another name to try. 

  // MD5 Username and Password
  $username = MD5($username);
  $password = MD5($password);

  // Check if the username exists
  $usernameinuse = mysql_query("SELECT * FROM userdata WHERE userid = '$username'");
  $isusernameinuse = mysql_num_rows($usernameinuse);

  // If username exists then print error message and exit script
  If ($isusernameinuse == 1) {
      echo "The username you selected is already been used by another member.<BR>Go back and select a new username";
	  echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";
      exit;
	}
  Else {

      // Find out how many users there are so that you can determine the next user number
      $usercount = mysql_query("SELECT * FROM userdata");
      $noofusers = mysql_num_rows($usercount);

      // New user number = User number + 1
      $usernumber = $noofusers + 1;
*/
	  // Check if the sequence number exists
	  $seqinuse = mysql_query("SELECT * FROM dropdownmenus WHERE dropdownname='RequestSubType' and dropdownItemName='".mysql_real_escape_string($Type)."' and dropdownSequence=$sequence");
	  $isseqinuse = mysql_num_rows($seqinuse);
	  // If sequence number exists then print error message and exit script
	  If ($isseqinuse == 1) {
		  echo "<center><font face='Verdana' Size='2' color='FF0000'>The Sequence you entered already exists for type '$Type' .</font></center>";
		  echo "<br></br><br></br><br></br>";
		  echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";
		  exit;
		}
	
      // Insert the new user to the database since everything is fine
      mysql_query("INSERT INTO dropdownmenus (dropdownName, dropdownItemName, dropdownSubItemName, dropdownSequence, CreatedBy, CreatedOn,SLA) Values('RequestSubType','".mysql_real_escape_string($Type)."','".mysql_real_escape_string($name)."',$sequence,'$username',Now(),$SLA)");

      // Print Successful Creation of user message
/*	  echo "<table width='50%' border='0' align='center' valign='middle'>
			<tr><td> 
			<br></br><br></br><br></br>
			</td></tr>
			</table>";
			
	  echo "<table border='0' align='center' valign='middle'>
			<tr><td  align='center'>
			<b><font face='Verdana' Size='2' color='848484'>Subtype has been created successfully.</font></b>
			</td></tr>
			</table>";
	  echo "<br><br><br><br>";
      echo "<a href='createsubtype.php'><center><font size='3'>Back</font></center></a>";	*/		
  //}
  //}


	header("Location: createsubtype.php?Type=".rawurlencode($Type));
     // If user and password are not correct print error message
     }
     else {
         echo "Incorrect username/password";
         exit;
     }
  }
?>

</body>
</html>