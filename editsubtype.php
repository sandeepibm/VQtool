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
<title>Edit Subtype</title>
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

<script type="text/javascript">
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
self.location='editsubtype.php?Type=' + escape(val1) ;
}

</script>

<script type="text/javascript">			
function popText(tid,rownum)
{
	var tabl = document.getElementById("table4");
	var val1 = tabl.rows[rownum].cells[1].textContent;
	var val2 = tabl.rows[rownum].cells[2].textContent;
	var val3 = tabl.rows[rownum].cells[3].textContent;
	
	document.getElementById("seq").value = val1;
	document.getElementById("name1").value = val2;
	document.getElementById("sla").value = val3;
	document.getElementById("tid").value = tid;
	
}

function confirmDelete(){
var agree=confirm("Are you sure you want to delete this Subtype?");
if (agree)
    { return true ;}
else
    { return false ;}
}

function playSound(){
document.getElementById('soundfile').play();
}
</script>

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
 
?>
<table class='header' width="800" border="0" align="center" valign="middle">
<tr><td  height='23'>
<b><center>Edit All Subtypes</font></center></b>
</td></tr>
</table>
<br></br>
<?php 

	echo "<form method='POST' name='form1' action='updatesubtype.php' onSubmit='javascript: return validate_form();'>";
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

	$ddQuery = mysql_query("SELECT dropdownmenuid,dropdownSequence,trim(dropdownSubItemName) SubItemName,SLA, @rownum := @rownum +1 AS rank FROM dropdownmenus ,(SELECT @rownum := 0) r WHERE dropdownName = 'RequestSubType' AND dropdownItemName='".mysql_real_escape_string($TypeName)."' ORDER BY dropdownSequence");
	echo "<table border='1' id='table4' class='stats' colspace='0' align='center' width='700'>
        <tr>
		<th>Select to Edit</th><th>Sequence</th><th>Subtype</th><th>SLA</th><th>Delete</th>  
		</tr><tr> ";	
	While($row=mysql_fetch_array($ddQuery))
	{
				echo "</td><td width='110'>";
				?> <input type="radio" id="select" name="select" onclick="document.getElementById('soundfile').play(); popText( <?php echo "$row[0]" ; ?> , <?php echo "$row[4]" ; ?> );" title="Select to Edit"> <?php			
				//echo "<a href='EditType.php?item=".$row[2]."&seq=".$row[1]."' onclick='popText('$row[2]')' title='Click to Update'>Edit</a>";					
				echo "</td><td width='80'>";
				echo $row[1];
				echo "</td><td width='440'>";
				echo $row[2];
				echo "</td><td width='80'>";
				echo $row[3];				
				echo "</td><td width='70'>";
				echo "<a href='deletesubtype.php?ddmId=$row[0] &Type=".rawurlencode( $TypeName )."' onClick='playSound();return confirmDelete();' title='Click to Delete'>Delete</a> ";				
				echo "</td></tr>";		

				}
	echo "</table>";
	
echo "
<table width=75% border='0' align='right' valign='middle'>
<tr><td height='10px'>
</td></tr>
        <tr> 
		<td align='right' width='238'><b><font face='Tahoma' size='2' color='44778D'>Edit Sequence, Subtype & SLA : </font></b></td>
		<td width='500'>
			<table border='1' align='left' valign='middle'>	
			<tr>
                <td > <input type='text' name='seq' id='seq' size='9' style='border:1px solid #378EF1; height:25px; color:#5D5F60; font-weight:500; font-family:Tahoma'><center></td>
                <td > <textarea name='name1' id='name1' rows='2' cols='55' size='150' style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma' maxlength='150'></textarea></td>
				 <td > <input type='text' name='sla' id='sla' size='8' style='border:1px solid #378EF1; height:25px; color:#5D5F60; font-weight:500; font-family:Tahoma'><center></td>
				</tr>
			</table>	
		</td>
		<td align='left'><font face='Tahoma' size='2' color='848484'>(max 150 characters)</font></td>
		<td > <input type='hidden' name='tid' id='tid'> </td > 
		</tr> 
		<tr><td>
		<br></br>
		</td></tr>
		";
?>		
</table>
<table width=50% border='0' align='center' valign='middle'>
		<tr><td><br></br></td></tr>
        <tr>                
                <td height="44" colspan="2"><center> 
				<button type="Submit" name="Submit" id="Submit" onClick="document.getElementById('soundfile').play();">Save</button>
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