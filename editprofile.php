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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Edit Profile</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>

<style type="text/css"> 
text
{
-moz-border-radius: 10px; -webkit-border-radius: 10px;  border-radius: 10px;
}
/*
select
{
box-shadow: 7px 7px 5px #888888;
}
*/
textarea
{
-moz-border-radius: 10px; -webkit-border-radius: 10px;  border-radius: 10px;
}
</style>
<script language="javascript" type="text/JavaScript">
function validate_form()
{	
	if(document.getElementById("name1").value=="" || document.getElementById("name1").value.length == 0)
	{
		alert("Please Enter your Name.");
		document.getElementById("name1").focus
		return false;
	}
	if(document.getElementById("empid").value=="" || document.getElementById("empid").value.length == 0)
	{
		alert("Please Enter your Employee ID.");
		document.getElementById("empid").focus
		return false;
	}
	if(document.getElementById("email").value=="" || document.getElementById("email").value.length == 0)
	{
			alert("Please Enter your Email ID.");
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
	if(document.getElementById("mobile").value=="" || document.getElementById("mobile").value.length == 0)
	{
		alert("Please Enter your Mobile Number.");
		document.getElementById("mobile").focus
		return false;
	}
	if(document.getElementById("mobile").value.length != 10)
	{
		alert("Invalid Mobile Number.Please enter a 10 digit number.");
		document.getElementById("mobile").focus
		return false;
	}
	if(document.getElementById("mobile").value!="")
	{
		if(document.getElementById("mobile").value.match(/^[0-9]+/) != document.getElementById("mobile").value)
		{
			alert("Invalid Mobile Number.Please enter a Numeric value.");
			document.getElementById("mobile").focus
			return false;
		}
	}
	if(document.getElementById("extension").value!="")
	{
		if(document.getElementById("extension").value.match(/^[0-9]+/) != document.getElementById("extension").value)
		{
			alert("Invalid Extension.Please enter a Numeric value.");
			document.getElementById("extension").focus
			return false;
		}
		if(document.getElementById("extension").value.length != 5)
		{
			alert("Invalid Extension Number.Please enter a 5 digit number.");
			document.getElementById("extension").focus()
			return false;
		}		
	}
	if(document.getElementById("mgrEmail").options[document.getElementById("mgrEmail").options.selectedIndex].value=="")
	{
			alert("Please Select your People Manager's Email ID.");
			document.getElementById("mgrEmail").focus
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
 
      
	  $result=mysql_query("SELECT Name,EmployeeId,Email,Mobile,Extension,Address,MgrId FROM userdata WHERE UserId = '$namecookie'") or die(mysql_error());
?>
<table class='header' width="800" border="0" align="center" valign="middle">
<tr><td  height='23'>
<b><center>Edit Profile</font></center></b>
</td></tr>
</table>
<br></br>

<form name="form1" action="updateprofile.php" method="POST" onSubmit="javascript: return validate_form();">

<table width="55%" border="0" align="center" valign="top">
<tr><td style="background:#FFF"><center>
<font face='Tahoma' size="2" color='B40486'>Edit or Change the desired field, then click on<i> Save </i> to update your profile. To get back the values, click on<i> Reset</i>.</font></center>
</td></tr>
</table>
<br></br>

<?php
while($row=mysql_fetch_array($result))
{
echo "
<table width='50%' border='0' align='center' valign='middle'>	
        <tr>
                <td width='30%' align='right'><b><font face='Tahoma' size='2' color='44778D'>Name :</font></b></td>
                <td > <input type='text' name='name1' id='name1' size='40' style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma' value=$row[0]></td>
        </tr>
        <tr>
                <td width='30%' align='right'><b><font face='Tahoma' size='2' color='44778D'>Employee ID :</font></b></td>
                <td > <input type='text' name='empid' id='empid' size='40' style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma;  text-transform:uppercase' maxlength='6' value=$row[1]></td>
        </tr>
        <tr>
                <td width='30%' align='right'><b><font face='Tahoma' size='2' color='44778D'>Email ID :</font></b></td>
                <td > <input type='text' name='email' id='email' size='40' readonly='true' style='border:1px solid #378EF1; color:#5D5F60; background:#ddd; font-weight:500; font-family:Tahoma' value=$row[2]></td>
        </tr>		
        <tr>
                <td width='30%' align='right'><b><font face='Tahoma' size='2' color='44778D'>Mobile No :</font></b></td>
                <td > <input type='text' name='mobile' id='mobile' size='40' style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma' maxlength='10' value=$row[3]><font face='Tahoma' size='2' color='0A5DAB' style='background:#FFF'> (10 digits)</font></td>
        </tr>
        <tr>
                <td width='30%' align='right'><b><font face='Tahoma' size='2' color='44778D'>Extension :</font></b></td>
                <td > <input type='text' name='extension' id='extension' size='40' style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma' maxlength='5' value=$row[4]></td>
        </tr>
        <tr>
                <td width='30%' align='right'><b><font face='Tahoma' size='2' color='44778D'>Office Address :</font></b></td>
                <td > <textarea name='address1' rows='3' cols='38' size='40' style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma; -moz-border-radius: 10px; -webkit-border-radius: 10px;  border-radius: 10px;'>".preg_replace('#<br\s*/?>#i', '', $row[5])."</textarea></td>		
        </tr>

        <tr>
                <td width='40%' align='right'><b><font face='Tahoma' size='2' color='44778D'>People Manager's Email ID :</font></b></td>
				<td > <select size='1' id='mgrEmail' name='mgrEmail'> <option></option>";
			
  // Get all the type of requests from the database and allow user to choose one
	$ddQuery = mysql_query('SELECT * FROM tblmanager ORDER BY Name');
	@$mgrId=$row[6];
	while ($dropdownmgr = mysql_fetch_array($ddQuery))
	 {
		if($dropdownmgr['MgrId']==@$mgrId)
		{ echo "<option selected value='$dropdownmgr[MgrId]'>$dropdownmgr[Name] ($dropdownmgr[Email])</option>";}
		else
		{ echo "<option value='$dropdownmgr[MgrId]'>$dropdownmgr[Name] ($dropdownmgr[Email])</option>";}
	 }	  				
	echo "</select></td>				
        </tr>";
}		
?>		

		<tr><td><br></br></td></tr>
        <tr>                
                <td height="44" colspan="2"><center> 
				<button type="Submit" name="Submit" id="Submit" onClick="document.getElementById('soundfile').play();">Save</button>
				<button type="Reset" name="Submit" id="Submit" onClick="document.getElementById('soundfile').play();">Reset</button></td>
        </tr>
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