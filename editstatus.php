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
<title>Edit Status</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>

<script type="text/javascript">
function validate_form()
{	
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
function popText(tid,rownum)
{
	var tabl = document.getElementById("table4");
	var val1 = tabl.rows[rownum].cells[1].textContent;

	document.getElementById("name1").value = val1;
	document.getElementById("tid").value = tid;
	
}

function confirmDelete(){
var agree=confirm("Are you sure you want to delete this Status?");
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
<b><center>Edit All Status</font></center></b>
</td></tr>
</table>
<br></br>
<?php 

	echo "<form method='POST' name='form1' action='updatestatus.php' onSubmit='javascript: return validate_form();'>";

	$ddQuery = mysql_query("SELECT StatusId,Status, @rownum := @rownum +1 AS rank FROM tblstatus ,(SELECT @rownum := 0) r ORDER BY StatusId");
	echo "<table border='1' id='table4' class='stats' colspace='0' align='center' width='400'>
        <tr>
		<th>Select to Edit</th><th>Status</th><th>Delete</th>  
		</tr><tr> ";	
	While($row=mysql_fetch_array($ddQuery))
	{
				echo "</td><td width='110'>";
				?> <input type="radio" id="select" name="select" onclick="document.getElementById('soundfile').play(); popText( <?php echo "$row[0]" ; ?> , <?php echo "$row[2]" ; ?> );" title="Select to Edit"> <?php			
				echo "</td><td width='220'>";
				echo $row[1];
				echo "</td><td width='70'>";
				?> <a href='deletestatus.php?ddmId= <?php echo "$row[0]" ; ?> ' onClick="document.getElementById('soundfile').play();return confirmDelete();" title='Click to Delete'>Delete</a> <?php				
				echo "</td></tr>";		

				}
	echo "</table>";
	
echo "
<table width=73% border='0' align='right' valign='middle'>
<tr><td height='10px'>
</td></tr>
        <tr> 
		<td align='right' width='251'><b><font face='Tahoma' size='2' color='44778D'>Edit Status : </font></b></td>
		<td width='400'>
			<table border='1' align='left' valign='middle'>	
			<tr>
                <td > <input type='text' name='name1' id='name1' size='63' style='border:1px solid #378EF1; height:25px; color:#5D5F60; font-weight:500; font-family:Tahoma' maxlength='50'></td>
			</tr>
			</table>	
		</td>
		<td align='left'><font face='Tahoma' size='2' color='848484'>(max 50 characters)</font></td>
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