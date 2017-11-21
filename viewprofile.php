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
<title>View Profile</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />

</head>


<?php

  $time = time();

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
          include("baseframe.php");
          //login();

          // Use cookie and Extract the cookie data (Username and Password)
          $cookie_info = explode("-", $_COOKIE['cookie_info']);
          $namecookie = $cookie_info[0];
          $passcookie = $cookie_info[1];

  // Check the level of the user
  //$checklevel = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
  //$checklevel1 = mysql_result($checklevel,0,9);

  // If the user is the admin
  //if ($checklevel1 == 1) {
 
      
	  $result=mysql_query("SELECT A.Name,EmployeeId,A.Email,Mobile,Extension,Address,B.Email FROM userdata A,tblmanager B WHERE A.MgrId=B.MgrId AND A.UserId = '$namecookie'") or die(mysql_error());
?>
<table class='header' width="800" border="0" align="center" valign="middle">
<tr><td>
<b><center>View Profile</font></center></b>
</td></tr>
</table>
<br></br> <br></br> <br></br>
<form>
<?php
while($row=mysql_fetch_array($result))
{
echo "
<table width='30%' align='center' valign='top' style='border:15px solid #CCC;background:#FFF;  box-shadow: 10px 10px 5px #888888;'>
        <tr>
                <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Name : </font></b></td>
				<td align='left'><label><font face='Tahoma' size='2'>$row[0]</font></td>
        </tr>
        <tr>
                <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Employee ID : </font></b></td>
                <td align='left'><label><font face='Tahoma' size='2'>$row[1]</font></td>
        </tr>
        <tr>
                <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Email ID : </font></b></td>
                <td align='left'><label><font face='Tahoma' size='2'>$row[2]</font></td>
        </tr>		
        <tr>
                <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Mobile No : </font></b></td>
                <td align='left'><label><font face='Tahoma' size='2'>$row[3]</font></td>
        </tr>
        <tr>
                <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Extension : </font></b></td>
                <td align='left'><label><font face='Tahoma' size='2'>$row[4]</font></td>
        </tr>
        <tr>
                <td align='right' valign='top'><b><font face='Tahoma' size='2' color='44778D'>Office Address : </font></b></td>
                <td align='left'><label><font face='Tahoma' size='2'>$row[5]</font></td>		
        </tr>

        <tr>
                <td width='50%' align='right'><b><font face='Tahoma' size='2' color='44778D'>People Manager's Email ID : </font></b></td>
				<td align='left'><label><font face='Tahoma' size='2'>$row[6]</font></td>
        </tr>";
}		
?>		

</table>
</form>
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