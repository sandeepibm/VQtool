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
<title>Delete User</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />

</head>


<?php

  $time = time();
  ob_start();

  // Check if there is a cookie, if there isn't then exit!
  if (!isset($_COOKIE['cookie_info'])) {
      include ("index.php");
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
  $Qry = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
  $info=mysql_fetch_array($Qry) ;
  $Deleter=$info['username'];
  //$checklevel1 = mysql_result($checklevel,0,9);

  // If the user is the admin
  //if ($checklevel1 == 1) {
 
?>

<table class='header' width="800" border="0" align="center" valign="middle">
<tr><td  height='23'>
<b><center>Delete User</font></center></b>
</td></tr>
</table>
<br></br>

<form>
<?php
	$menuid=$_GET["ddmId"];
	$userid=md5($menuid);
	
	  // Check if the user has any in-process tickets
	  $seqinuse = mysql_query("SELECT * FROM allrequests WHERE UserId='$userid' and Status='In Process'");
	  $isseqinuse = mysql_num_rows($seqinuse);
	  // If sequence number exists then print error message and exit script
	  If ($isseqinuse > 0) {
		  echo "<center><font face='Verdana' Size='2' color='FF0000'>The User $menuid has $isseqinuse In-Process tickets to be processed. First Close them and then delete the User.</font></center>";
		  echo "<br></br><br></br><br></br>";
		  echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";
		  exit;
		}
	
		$query_usrgrp=mysql_query("Select * From userdata Where UserName='$menuid'");
		$usrgrp=mysql_fetch_array($query_usrgrp) ;
		$UserGroup=$usrgrp['UserGroup'];
		$Email=$usrgrp['Email'];
	
		If (($UserGroup == 'Manager') || ($UserGroup == 'Super User & Manager'))
		{mysql_query("DELETE FROM tblmanager WHERE Email='$Email'");}
			
	mysql_query("Insert Into histuser Select *, NOW(), '".$Deleter."' From userdata Where UserName='$menuid'");
	
	mysql_query("DELETE FROM userdata WHERE UserName='$menuid'");
	
	header("Location: accessrights.php");
/*	echo "<br></br><br></br>";
	  echo "<table width='90%' border='0' align='right' valign='middle'>
			<tr><td  align='center'>
			<b><font face='Verdana' Size='2' color='848484'>Type has been deleted successfully.</font></b>
			</td></tr>
			</table>";	*/
  }
      else {
         echo "Incorrect username/password";
         exit;
     }
  }
?>

</body>
</html>