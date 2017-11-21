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
<title>Request Submitted</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />

</head>

<body>

<?php

  // Check if there is a cookie, if there isn't then redirect to login screen
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
          include("baseframe.php");
          //login();

          // Use cookie and Extract the cookie data (Username and Password)
          $cookie_info = explode("-", $_COOKIE['cookie_info']);
          $namecookie = $cookie_info[0];
          $passcookie = $cookie_info[1];

          // Get username from Database and it in a variable
          $query = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
          $nameuser = mysql_result($query,0,8);
		  $name1 =  mysql_result($query,0,2);
  // Check the level of the user
  //$checklevel = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
  //$checklevel1 = mysql_result($checklevel,0,9);

  // If the user is the items manager
  //if ($checklevel1 == 3) {
?>

<!--
<table width="75%" border="0" align="right" valign="top">
<tr><td>
<img src="images/horizontal_line.jpg" width=80% border="0">
</td></tr>
</table>
-->

<table class='header' width="800" border="0" align="center" valign="middle">
<tr><td  height='36'>
<b><center>Save Request</font></center></b>
</td></tr>
</table>
<br></br>
<?php
	   	  $time = time();
		  $Type = $_GET['Type'];            			// Type
  		  $Subtype = $_GET['Subtype'];	 			// Subtype
		  $Subject=$_GET["Subject"];
		  $Description=$_GET["Description"];
  		  $CreatedOn = date("Y-m-d");	 // Created On
/*
             // Check if each section has been completed
      if ((!$Type) || (!$Subtype) || (!$Subject) || (!$Description)) {
	                echo "<table width='70%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>You haven't submit the following required information when placing your request:</font>
					</td></tr>
					</table>";
          if (!$Type) {
              echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>The Type of your request.</font>
					</td></tr>
					</table>";
					}
          if (!$Subtype) {
              echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>The Subtype of your request.</font>
					</td></tr>
					</table>";
					}
          //if (!$BluePageManager) {
            //  echo "<center><font face='Tahoma' size='2' color='FF0000'>Enter the BluePageManager of your request.</font></center> <br>";
          //}
          if (!$Subject) {
              echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>The Subject of your request.</font>
					</td></tr>
					</table>";
					}
          if (!$Description) {
              echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>The Description of your request.</font>
					</td></tr>
					</table>";
					}
              echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>					
					<br></br>
					<br></br>
					<br></br>
					<br></br>
					<br></br>
					</td></tr>
					</table>";
		  echo "<table width='85%' border='0' align='right' valign='top'>
					<tr><td>
					<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>
					</td></tr>
					</table>";
          exit(); // If there are errors then we quit this script
      }
*/	  
		 mysql_query("INSERT INTO savedrequests(UserId,Type,Subtype,Subject,Description,CreatedOn,Status) VALUES ('$namecookie','".mysql_real_escape_string($Type)."','".mysql_real_escape_string($Subtype)."','".mysql_real_escape_string($Subject)."','".mysql_real_escape_string($Description)."',NOW(),'Not Submitted')") or die(mysql_error());

		 $id = mysql_insert_id();
		 //echo "insert done";
		
		echo 
		"			
		 <table width='75%' border='0'  id='table1'  cellspacing='0' align='center'>
		 <tr>
		 <td colspan='2'><center><label><font face='Tahoma' size='2'>Request is saved but <font face='Tahoma' size='2' color='000000'>Not Submitted</font>.Later you can view,update and submit it from 'View Requests>>Saved Requests' screens.</center></font></th>
		 </tr>
		 <tr><td><br></br></td></tr>
		 <tr>
		 <td colspan='2' height='30'  valign='top'><label><font face='Tahoma' size='2'><center> This is the request you have saved </center></font></td>
		 </tr>
		 </table>
		 
		 <table border='0'  id='table2'  cellspacing='0' align='center'>
        <tr>                
                <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Type : </b></td>
                <td > <label><font face='Tahoma' size='2'>$Type </font></td>
        </tr>
        <tr>                
                <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Subtype : </b></td>
                <td> <label><font face='Tahoma' size='2'>$Subtype </font></td>
        </tr>

        <tr>               
                <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Subject : </b></td>
                <td> <label><font face='Tahoma' size='2'>$Subject</font></td>
        </tr>
        <tr>               
                <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Description : </b></td>
                <td> <label><font face='Tahoma' size='2'>$Description </font></td>
        </tr>
        <tr>                
                <td align='right'><b><font face='Tahoma' size='2' color='44778D'>On : </b></td>
                <td> <label><font face='Tahoma' size='2'>$CreatedOn </font></td>
        </tr>
		<tr><td><br></br></td></tr>
		</table>		
		"
		;
?>
		  
		  
<?php
  //}
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