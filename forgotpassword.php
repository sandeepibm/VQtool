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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forgot Password</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>

<script language="javascript" type="text/JavaScript">
function field_check()
{	
	var user_name = trim(document.getElementById("usrname").value);
	var user_new_pass1 = trim(document.getElementById("newpassword").value);
	var user_new_conf_pass1 = trim(document.getElementById("newpasswordagain").value);

	if(user_name.length == 0)
	{
		alert("Please enter User Name.");
		return false;
	}
	
	if(user_new_pass1 == "" || user_new_conf_pass1 == "")
	{
		alert("Please fill all password fields.");
		return false;
	}
	
	if(user_new_pass1.length < 6)
	{
		alert("Password atleast of 6 characters.");
		return false;
	}
	
	if(user_new_conf_pass1 != user_new_pass1)
	{
		alert("New password and confirm new password should match with each other.");
		return false;
	}

	return true;
}


function trim(string_to_trim)
{
	return rtrim(ltrim(string_to_trim));
}

function rtrim(string_to_trim)
{
	return string_to_trim.replace(/\s+$/,"");
}

function ltrim(string_to_trim)
{
	return string_to_trim.replace(/^\s+/,"");
}
</script>
</head>

<?php
include("outerbaseframe.php");
?>

<body width="100%" border="0" onload="document.forms['form1'].elements['usrname'].focus();">
<br></br>
<br></br>
<table width='800' align='center' >
<tr><td height='21'><td/>
<b><center><font face='Verdana' Size='3' valign='middle' color='4aafdc'><U>Reset Password</U></font></center></b>
<tr/>
</table>
<br><br/>

<center><font face='Tahoma' Size='2' color='B40486' >Enter your UserName and click on <i>Reset</i>, your password will be automatically generated and sent by email.</font></center><br></br>
<form name="form1" action="resetforgotpassword.php" method="POST" onSubmit="javascript: return field_check();">

<?php

  // Display User Details
  echo "
  <table border='1' align='center' style='box-shadow: 7px 7px 5px #888888'><tr><td>  
  <table class='stats' cellspacing='0' border='0' id='table1' align='center' style='box-shadow: 0px 0px 0px #888888'>
        <tr>
                <td width='160' style='background:#ccc'><b><font face='Tahoma' color='44778D'>UserName:</font></b></td>
                <td> <input type='text' name='usrname' id='usrname' size='40' style='border:1; color:#5D5F60; font-weight:500; font-family:Tahoma'/></td>
				<td style='background:#ccc'>(e.g.>>xxxxxxxx@in.ibm.com)</td>
        </tr>";
/*        <tr>
                <td width='160' style='background:#ccc'><b><font face='Tahoma' color='44778D'>New Password:</font></b></td>
                <td> <input type='password' name='newpassword' id='newpassword' maxlength='15' size='40'/></td>
				<td style='background:#ccc'>>>xxxxxxxx@in.ibm.com)</td>
        </tr>
        <tr>
                <td width='160' style='background:#ccc'><b><font face='Tahoma' color='44778D'>Confirm New Password:</font></b></td>
                <td> <input type='password' name='newpasswordagain' id='newpasswordagain' maxlength='15' size='40'/></td>
        </tr> */
echo "</table>
  </table></td></tr>
  <br></br>  
  <table align='center'>
          <tr >
				<td> ";
?>				
                <button type='Submit' name='Submit' id='Submit' onClick="document.getElementById('soundfile').play();">Reset</button>
<?php           echo " </td>
        </tr>
  </table>";	
/*  
      // If user and password are not correct print error message
      }
      else {
          echo "Incorrect username/password";
          exit;
      }
  }
  */
?>

</html>