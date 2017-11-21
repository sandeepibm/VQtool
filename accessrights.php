<?php
/******************************************************************************
 *   Filename:             accessrights.php
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
<title>Access Rights</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>

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
	if(document.getElementById("name1").value=="" || document.getElementById("name1").value.length == 0)
	{
		alert("Please Enter Type.");
		document.getElementById("name1").focus
		return false;
	}	
	return true;
}
</script>

<script type="text/javascript">			
function popText(rownum)
{
	var val=document.getElementById("admin").value;
	var tabl = document.getElementById("table4");
	var val4 = tabl.rows[rownum].cells[4].textContent;
	var val1 = tabl.rows[rownum].cells[1].textContent;
	var val2 = tabl.rows[rownum].cells[2].textContent;
	var val3 = tabl.rows[rownum].cells[3].textContent;
	
	document.getElementById("admin").value=val4;
	document.getElementById("tid").value=val1;
	document.getElementById("name2").value=val2;
	document.getElementById("email2").value=val3;	
}

function confirmDelete(){
var agree=confirm("Are you sure you want to delete this User?");
if (agree)
    { return true ;}
else
    { return false ;}
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
<b><center>Access Rights</font></center></b>
</td></tr>
</table>
<br></br>


<table border="0" align="center" valign="top">
<tr><td style='background:#FFF'><center>
<p align="center"><font face='Tahoma' size='2' color='B40486'>To Edit Access Rights of an user <i> Select </i> the user, <i> Change </i> to appropriate Access Rights from the box, then click on <i> Save Rights </i>.</font></p></center>
</td></tr>
</table>
<br></br>

<?php 

	echo "<form method='POST' name='form1' action='updateaccessrights.php' onSubmit='javascript: return validate_form();'>";

	$ddQuery = mysql_query("SELECT UserName,Name,Email,UserGroup, @rownum := @rownum +1 AS rank FROM userdata A,(SELECT @rownum := 0) r ORDER BY Name");
	echo "<table border='1' id='table4' class='stats' colspace='0' align='center' width='65%'>
        <tr>
		<th>Select to Edit</th><th>User Name</th><th>Name</th><th>Email</th><th>Access Rights</th><th>Delete</th>  
		</tr><tr> ";	
	While($row=mysql_fetch_array($ddQuery))
	{	
				echo "</td><td width='15%'>";
				?> <input type="radio" id="select" name="select" onclick="document.getElementById('soundfile').play(); popText( <?php echo "$row[4]" ; ?> );" title="Select to Edit"> <?php					
				echo "</td><td width='15%'>";
				echo $row[0];				
				echo "</td><td width='20%'>";
				echo $row[1];
				echo "</td><td width='20%'>";
				echo $row[2];				
				echo "</td><td width='15%'>";
				echo $row[3];
				echo "</td><td width='15%'>";
				?> <a href='deleteuser.php?ddmId=<?php echo "$row[0]" ; ?>' onClick="document.getElementById('soundfile').play();return confirmDelete();" title='Click to Delete the User'>Delete User</a> <?php							
				echo "</td></tr>";		

				}
	echo "</table>";
	
	$ddQueryItem = mysql_query("SELECT UserGroupName from tblusergroup ORDER BY 1");
	echo "
<br></br>
<table width=61% border='0' align='right' valign='middle'>
        <tr> 
		<td align='right' width='153'><b><font face='Tahoma' size='2' color='44778D'>Edit Access Rights : </font></b></td>
		<td width='500'>
			<table border='1' align='left' valign='middle'>	
			<tr>
			    <td height='30'>
					<select size='1' name='admin' id='admin'>					
					<option></option>";
			 while ($dropdownitems = mysql_fetch_array($ddQueryItem))
			 {
				//If($dropdownitems['dropdownItemName']==@$TypeName)
					//{echo "<option selected value='".htmlspecialchars($dropdownitems['dropdownItemName'], ENT_QUOTES )."'>$dropdownitems[dropdownItemName]</option>";}
				//Else
					echo "<option value='".htmlspecialchars($dropdownitems['UserGroupName'], ENT_QUOTES )."'>$dropdownitems[UserGroupName]</option>";
			  }  

				   echo "</select>		
 
			</tr>
			</table>	
		</td>
		<td > <input type='hidden' name='tid' id='tid'> </td > 
		<td > <input type='hidden' name='name2' id='name2'> </td > 
		<td > <input type='hidden' name='email2' id='email2'> </td > 		
		</tr> 
		<tr><td>
		<br></br>
		</td></tr>
		";
?>		
</table>
<table width=60% align="center">
        <tr>                
                <td height="44" colspan="2"><center> 
				<button type="Submit" name="Submit" id="Submit" style='width:180px;' onClick="document.getElementById('soundfile').play();">Save Rights</button>
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