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
<title>Register Manager</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>

<style type="text/css"> 

</style>

<script language="javascript" type="text/JavaScript">
function validate_form()
{	
	if(document.getElementById("name1").value=="" || document.getElementById("name1").value.length == 0)
	{
		alert("Please Enter manager's Name.");
		document.getElementById("name1").focus
		return false;
	}
	if(document.getElementById("email").value=="" || document.getElementById("email").value.length == 0)
	{
			alert("Please Enter manager's Email ID.");
			document.getElementById("email").focus
			return false;
	}
	if(document.getElementById("email").value!="" || document.getElementById("email").value.length != 0)
	{
	var str=document.getElementById("email").value;
	if(!str.match(/[a-zA-Z0-9._-]+@[a-z-]+\.[a-zA-Z]{2,4}/))
	{
		alert("Invalid Email ID.");
		document.getElementById("email").focus
		return false;
	}
	}

	if(document.getElementById("admId").options[document.getElementById("admId").options.selectedIndex].value=="")
	{
			alert("Please Select Admin who is assigned to the Manager.");
			document.getElementById("admId").focus
			return false;
	}
}
</script>
</head>

<body width="100%" border="0" onload="document.forms['form1'].elements['name1'].focus();">
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
 
      
//	  $result = mysql_query("SELECT A.Name,EmployeeId,A.Email,Mobile,Extension,Address,B.Email FROM userdata A, tblmanager B WHERE A.MgrId = B.MgrId AND UserId = '$namecookie'") or die(mysql_error());
//	  $AdminId = mysql_result($result,0,2);

?>
<table class='header' width="800" border="0" align="center" valign="middle">
<tr><td  height='23'>
<b><center>Register Manager's Email</font></center></b>
</td></tr>
</table>
<br></br>

<center><font face='Tahoma' Size='2' color='B40486' style='background:#ffffff;'>Select Manager's Email properly. Otherwise requests from the manager and his/her team's will <i> fail to communicate </i> with RSC Operation team. </font><br><br>
<form name="form1" action="savemanager.php" method="POST" onSubmit="javascript: return validate_form();">
<?php


echo "
<table width='70%' border='0' align='center' valign='middle'>	
        <tr>
                <td width='30%' align='right'><b><font face='Tahoma' size='2' color='44778D'>Name :</font></b></td>
                <td > <input type='text' name='name1' id='name1' size='63' style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma; -moz-border-radius: 10px; -webkit-border-radius: 10px;  border-radius: 10px;'></td>
        </tr>
		
        <tr>
                <td width='30%' align='right'><b><font face='Tahoma' size='2' color='44778D'>Email :</font></b></td>
				<td > <select size='1' name='email' id='email'> <option></option>";
			
  // Get all the type of requests from the database and allow user to choose one
	$ddQuery = mysql_query("SELECT * FROM userdata WHERE (UserGroup='Manager' or UserGroup='Super User & Manager') ORDER BY Name");	
	while ($dropdownmgr = mysql_fetch_array($ddQuery))
	 {
//		if($dropdownmgr['UserId']==@$AdminId) {
		 echo "<option value='$dropdownmgr[Email]'>$dropdownmgr[name]($dropdownmgr[Email])</option>";
//		 {
//		else
//		{ echo "<option value='$dropdownmgr[Email]'>$dropdownmgr[Email]</option>";}
	 }	  				
	echo "</select></td>				
        </tr>";
//}		
?>		
		
        <tr>
                <td width='30%' align='right'><b><font face='Tahoma' size='2' color='44778D'>Assign SPOC :</font></b></td>
				<td > <select size='1' name='admId'> <option></option>
<?php			
  // Get all the type of requests from the database and allow user to choose one
	$ddQuery = mysql_query("SELECT * FROM userdata WHERE (UserGroup='Admin' OR UserGroup='Super User' OR UserGroup='Super User & Manager') ORDER BY Name");	
	while ($dropdownmgr = mysql_fetch_array($ddQuery))
	 {
//		if($dropdownmgr['UserId']==@$AdminId) {
		 echo "<option value='$dropdownmgr[userid]'>$dropdownmgr[name]($dropdownmgr[Email])</option>";
//		 {
//		else
//		{ echo "<option value='$dropdownmgr[Email]'>$dropdownmgr[Email]</option>";}
	 }	  				
	echo "</select></td>				
        </tr>";
//}		
?>		

		<tr><td><br></br></td></tr>
        <tr>                
                <td height="44" colspan="2"><center> 
				<button type="Submit" name="Submit" id="Submit" onClick="document.getElementById('soundfile').play();">Create</button>
				</center></td>
        </tr>
</table>

<br></br>
<?php

      //$deleteuser = $_POST["selectuser"]; // User selected to delete
	  $result=mysql_query("SELECT A.Name, A.Email, CONCAT(B.Name,'(',B.Email,')') FROM tblmanager A,userdata B WHERE A.AsgndAdmUsrId=B.UserId ORDER BY A.Name") or die(mysql_error());
?>

<!-- <center><a href="exporttoexcel.php">Export Report to Excel</a></center> -->
<table width="90%" align="right">
<tr><td align="left">
		<table border="1" id="table4" class='stats' colspace='0' align="center" width="50%">
        <tr>
		<th >Name</th><th >Email</th><th>Assigned SPOC</th>  
		</tr><tr>
		<?php
			//echo "$nameuser";
			//$value = $_POST['posts'];
			while($row=mysql_fetch_array($result)){
				echo "</td><td width=30%>";
				echo $row[0];
				echo "</td><td width=30%>";
				echo $row[1];
				echo "</td><td width=40%>";
				echo $row[2];
				echo "</td></tr>";
				}?>
		</table>
</tr></td>
</table>		
		<br></br>
		
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