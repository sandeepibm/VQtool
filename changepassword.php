<?php
/******************************************************************************
 *   Filename:             allrequests.php
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
<title>Change Password</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>

<script language="javascript" type="text/JavaScript">
function field_check()
{	
	
	var user_prev_pass = trim(document.getElementById("oldpassword").value);
	var user_new_pass1 = trim(document.getElementById("newpassword").value);
	var user_new_conf_pass1 = trim(document.getElementById("newpasswordagain").value);
	
	if(user_prev_pass == "" || user_new_pass1 == "" || user_new_conf_pass1 == "")
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

<body width="100%" border="0" onload="document.forms['form1'].elements['oldpassword'].focus();">
<?php

  $time = time();

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
          //$query = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
          //$nameuser = mysql_result($query,0,8);
?>
<table class='header' width='800' align='center'>
<tr><td height='36' ><td/>
<b><center><font valign='middle'>Change Password</font></b>
<tr/>
</table>
<br><br/>

<center><font face='Tahoma' Size='2' color='B40486' style='background:#FFF'>All passwords should be min 6 to max 15 characters.</font></center><br></br>
<form name="form1" action="confirmchangepassword.php" method="POST" onSubmit="javascript: return field_check();">

<?php

  // Display User Details
  echo "
  <table border='1' align='center' style='box-shadow: 7px 7px 5px #888888'><tr><td>
  <table class='stats' cellspacing='0' border='0' id='table1' align='center' style='box-shadow: 0px 0px 0px #888888'>
        <tr>
                <td width='160' style='background:#ccc'><b><font face='Tahoma' color='44778D'>Current Password:</font></b></td>
                <td align='left'> <input type='password' name='oldpassword' id='oldpassword' maxlength='15' size='20'/></td>
        </tr>
        <tr>
                <td width='160' style='background:#ccc'><b><font face='Tahoma' color='44778D'>New Password:</font></td>
                <td> <input type='password' name='newpassword' id='newpassword' maxlength='15' size='20'/></b></td>
        </tr>
        <tr>
                <td width='160' style='background:#ccc'><b><font face='Tahoma' color='44778D'>Confirm New Password:</font></td>
                <td> <input type='password' name='newpasswordagain' id='newpasswordagain' maxlength='15' size='20'/></b></td>
        </tr>
  </table>
  </table></td></tr>
  <br></br>
  <table width='800' align='right'>
          <tr >
                <td height='54' colspan='2' > " ; ?>
				<button type='Submit' name='Submit' id='Submit' onClick="document.getElementById('soundfile').play();">Change</button>
<?php       echo " </td>
        </tr>
  </table>";		
      // If user and password are not correct print error message
      }
      else {
          echo "Incorrect username/password";
          exit;
      }
  }
?>

</html>