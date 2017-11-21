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
<title>Create Subtype</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>

<style type="text/css">
select
{
box-shadow: 7px 7px 5px #888888;
}
</style>

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
	if(document.getElementById("sla").value=="" || document.getElementById("sla").value.length == 0)
	{
		alert("Please Enter SLA.");
		document.getElementById("sla").focus
		return false;
	}
	if(document.getElementById("sla").value!="")
	{
		if(document.getElementById("sla").value.match(/^[0-9]+/) != document.getElementById("sla").value)
		{
			alert("Invalid SLA. Please enter a Numeric value.");
			document.getElementById("sla").focus
			return false;
		}
	}
	if(document.getElementById("name1").value=="" || document.getElementById("name1").value.length == 0)
	{
		alert("Please Enter Subtype.");
		document.getElementById("name1").focus
		return false;
	}		
	return true;
}

function reload(form)
{
var val1=form.Type.options[form.Type.options.selectedIndex].value;
self.location='createsubtype.php?Type=' + escape(val1) ;
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
<b><center>Create All Subtypes</font></center></b>
</td></tr>
</table>
<br></br>

<form name="form1" action="savesubtype.php" method="POST" onSubmit="javascript: return validate_form();">
<?php
	
	@$TypeName=$_GET['Type'];

	// Get all the type of requests from the database and allow user to choose one
	$ddQueryItem = mysql_query("SELECT * FROM dropdownmenus WHERE dropdownName = 'RequestType' ORDER BY dropdownSequence");
	
		echo " <table border='0' align='center' valign='middle'>
			<tr><td height='30' align='right'><b><font face='Tahoma' size='2' color='44778D'>Select Type :</font></b></td>
	  <td height='30'>
					<select size='1' name='Type' onchange='reload(this.form)'>
					
			<option></option>";
	 while ($dropdownitems = mysql_fetch_array($ddQueryItem))
	 {
		If($dropdownitems['dropdownItemName']==@$TypeName)
			{echo "<option selected value='".htmlspecialchars($dropdownitems['dropdownItemName'], ENT_QUOTES )."'>$dropdownitems[dropdownItemName]</option>";}
		Else
			{echo "<option value='".htmlspecialchars($dropdownitems['dropdownItemName'], ENT_QUOTES )."'>$dropdownitems[dropdownItemName]</option>";}
	  }  

				   echo "</select></td></tr>
			</table>";

		echo "<br></br>";

	$ddQuery = mysql_query("SELECT dropdownSequence,dropdownSubItemName,SLA FROM dropdownmenus WHERE dropdownName = 'RequestSubtype' AND dropdownItemName='".mysql_real_escape_string($TypeName)."' ORDER BY dropdownSequence");
	
	echo "<table border='1' id='table4' class='stats' colspace='0' align='center' width='700'>
        <tr>
		<th >Sequence</th><th>Subtype</th><th >SLA</th>  
		</tr><tr> ";	
	While($row=mysql_fetch_array($ddQuery))
	{
				echo "</td><td width='10%'>";
				echo $row[0];
				echo "</td><td width='80%'>";
				echo $row[1];
				echo "</td><td width='10%'>";
				echo $row[2];
				echo "</td></tr>";		
	}
	echo "</table>";
echo "
<table width=75% border='0' align='right' valign='middle'>
<tr><td height='10px'>
</td></tr>
        <tr> 
		<td align='right' width='133'><b><font face='Tahoma' size='2' color='44778D'>Enter Sequence, Subtype & SLA : </font></b></td>
		<td width='700'>
			<table border='1' align='left' valign='middle'>	
			<tr>
				<td > <input type='text' name='seq' id='seq' size='8' style='border:1px solid #378EF1; height:25px; color:#5D5F60; font-weight:500; font-family:Tahoma'><center></td>
                <td > <textarea name='name1' id='name1' rows='1' cols='85' size='150' style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma' maxlength='150'></textarea></td>
                <td > <input type='text' name='sla' id='sla' size='7' style='border:1px solid #378EF1; height:25px; color:#5D5F60; font-weight:500; font-family:Tahoma'><center></td>
				</tr>
			</table>	
		</td>
		<td align='left'><font face='Tahoma' size='2' color='848484'>(max 150 characters)</font></td>
		</tr> ";
?>		
</table>
<table width=50% border='0' align='center' valign='middle'>
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