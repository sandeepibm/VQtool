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
<title>Edit Manager</title>
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

          // Use cookie and Extract the cookie data (Username and Password)
          $cookie_info = explode("-", $_COOKIE['cookie_info']);
          $namecookie = $cookie_info[0];
          $passcookie = $cookie_info[1];

  // Check the level of the user
  //$checklevel = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
  //$checklevel1 = mysql_result($checklevel,0,9);

  // If the user is the admin
  //if ($checklevel1 == 1) {
 
?>

<form>
<?php
	$menuid=$_GET["ddmId"];
	mysql_query("DELETE FROM tblmanager WHERE MgrId='$menuid'");
	
	header("Location: editmanager.php");
/*	echo "<br></br><br></br>";
	  echo "<table width='90%' border='0' align='right' valign='middle'>
			<tr><td  align='center'>
			<b><font face='Verdana' Size='2' color='848484'>Type has been deleted successfully.</font></b>
			</td></tr>
			</table>";	*/
  }
 
?>

</body>
</html>