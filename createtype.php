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
<title>Create Type</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>

<script language="javascript" type="text/JavaScript">
function validate_form()
{	
	if(document.getElementById("seq").value=="" || document.getElementById("seq").value.length == 0)
	{
		alert("Please Enter Sequence.");
		document.getElementById("seq").focus
		return false;
	}
	if(document.getElementById("seq").value!="")
	{
		if(document.getElementById("seq").value.match(/^[0-9]+/) != document.getElementById("seq").value)
		{
			alert("Invalid Sequence Number. Please enter a Numeric value.");
			document.getElementById("seq").focus
			return false;
		}
	}
	if(document.getElementById("name1").value=="" || document.getElementById("name1").value.length == 0)
	{
		alert("Please Enter Type.");
		document.getElementById("name1").focus
		return false;
	}	
	return true;
}
</script>
</head>

<body width="100%" border="0" onload="document.forms['form1'].elements['seq'].focus();">
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
 
?>
<table class='header' width="800" border="0" align="center" valign="middle">
<tr><td  height='23'>
<b><center>Create All Types</font></center></b>
</td></tr>
</table>
<br></br>

<form name="form1" action="savetype.php" method="POST" onSubmit="javascript: return validate_form();">
<?php

	$ddQuery = mysql_query("SELECT dropdownSequence,dropdownItemName FROM dropdownmenus WHERE dropdownName = 'RequestType' ORDER BY dropdownSequence");
	echo "<table border='1' id='table4' class='stats' colspace='0' align='center' width='500'>
        <tr>
		<th >Sequence</th><th>Type</th>  
		</tr><tr> ";	
	While($row=mysql_fetch_array($ddQuery))
	{
				echo "</td><td width='60'>";
				echo $row[0];
				echo "</td><td width='440'>";
				echo $row[1];
				echo "</td></tr>";		
	}
	echo "</table>";
echo "
<table width=72% border='0' align='right' valign='middle'>
<tr><td height='10px'>
</td></tr>
        <tr> 
		<td align='right' width='185'><b><font face='Tahoma' size='2' color='44778D'>Enter Sequence and Type : </font></b></td>
		<td width='500'>
			<table border='1' align='left' valign='middle'>	
			<tr>
                <td > <input type='text' name='seq' id='seq' size='8' style='border:1px solid #378EF1; height:25px; color:#5D5F60; font-weight:500; font-family:Tahoma'><center></td>
                <td > <input type='text' name='name1' id='name1' size='68' style='border:1px solid #378EF1; height:25px; color:#5D5F60; font-weight:500; font-family:Tahoma' maxlength='50'></td>
			</tr>
			</table>	
		</td>
		<td align='left'><font face='Tahoma' size='2' color='848484'>(max 50 characters)</font></td>
		</tr> ";
?>
</table>
<table width=72% border='0' align='center' valign='middle'>
		<tr><td><br></br></td></tr>
        <tr>                
                <td height="44" colspan="2"><center> 
				<button type="Submit" name="Submit" id="Submit" onClick="document.getElementById('soundfile').play();">Create</button>
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