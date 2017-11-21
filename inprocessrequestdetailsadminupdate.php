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
<title>In Process Request Details Update</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>

<script src="php_calendar/scripts.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">


function onFocusText()
{
	var div = document.getElementById('block1');
	//alert(div.innerHTML.replace('...',''));
	div.innerHTML = div.innerHTML.replace('Add comments here...','');
	div.style.color = '#848484';
	div.style.fontSize = '12';
}

function lostFocusText()
{
	var div = document.getElementById('block1');
	//alert(div.innerHTML);
	if (div.innerHTML =='' || div.innerHTML =='<br>')
		{	div.style.color = '#B6B6B6';
			div.style.fontSize = '16';
			div.innerHTML = 'Add comments here...'
		}
	document.getElementById("comments").value = div.innerHTML;
	//alert(document.getElementById("comments").value);.replace('<br>','<br />')
}
	
function validate_form()
{
	if(document.getElementById("Status").value=="" || document.getElementById("Status").value.length == 0)
	{
		alert("Please Enter Status.");
//		document.getElementById("Status").focus();
		return false;
	}

	if(document.getElementById("Comments").value=="" || document.getElementById("Comments").value.length == 0)
	{
			alert("Please Enter Comments of the request");
			document.getElementById("Comments").focus();
			return false;
	}
	
}

</script>
</head>

<body onload="document.forms['form1'].elements['Status'].focus()">

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
          //$cookie_info = explode("-", $_COOKIE['cookie_info']);
          //$namecookie = $cookie_info[0];
          //$passcookie = $cookie_info[1];

          // Get username from Database and it in a variable
          //$query = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
          //$nameuser = mysql_result($query,0,8);

  // Check the level of the user
  //$checklevel = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
  //$checklevel1 = mysql_result($checklevel,0,9);

  // If the user is the items manager
  //if ($checklevel1 == 3) {
?>

<!--
<table width="75%" border="0" align="right" valign="top">
<tr><td>
<img src="images/horizontal_line.jpg" width=80% border="0">
</td></tr>
</table>    
-->

<?php
  @$IdForRequest=$_GET['ReqId'];

	if (isset($IdForRequest) and strlen($IdForRequest) > 0)
	{$Id=$IdForRequest;}
	Else
	{$Id=$_GET['valId'];}
	
 echo "
 
<!-- Form starts -->
<form name ='form1' action='updateinprocessrequest.php?reqId=$Id' method='POST' content='application/x-www-form-urlencoded' enctype='multipart/form-data'  onSubmit='javascript: return validate_form();'>

<table class='header' width='800' border='0' align='center' valign='middle'>
<tr><td height='36'>
<b><center> Details of In-Process Request <font face='MV Boli'>No $IdForRequest</font></center></b>
</td></tr>
</table>
<br></br>

<table border='0' align='center' valign='top'>
<tr><td style='background:#FFF'><center>
<font face='Tahoma' size='2' color='B40486'>Change the Status and do Comments, 
then click on<i> Update </i> to update the status of the request. To get back the original values, click <i> Reset</i>.</font></center>
</td></tr>
</table>
<br></br>

<table width='50%' align='center' valign='top' > ";
// <tr>

	If(isset($IdForRequest) and strlen($IdForRequest) > 0)
	{
	  // Get all the type of requests from the database and allow user to choose one
		$ReqIdQuery = mysql_query("SELECT A.*,B.UserName FROM allrequests A, userdata B WHERE A.UserId=B.UserId AND RequestId = $IdForRequest") or die(mysql_error());
		While ($rowRequest = mysql_fetch_array($ReqIdQuery))
		{
			$reqType=$rowRequest['Type'];
			$reqSubtype=$rowRequest['Subtype'];
			$reqSubject=$rowRequest['Subject'];
			$reqDescription=$rowRequest['Description'];
			
			//$reqDescription=preg_replace('#<br>#i','/n',$reqDescription);
			$SLA=$rowRequest['SLA_Days'];
			$AssignedTo=$rowRequest['AssignedTo'];
			$CreatedOn=$rowRequest['CreatedOn'];
			$UpdatedOn=$rowRequest['UpdatedOn'];
			$Status=$rowRequest['Status'];
			$Creator=$rowRequest['UserName'];		
		}	
	}

echo "
<tr>
  <td  width='150px' align='right'><b><font face='Tahoma' size='2' color='44778D'>Creator :</font></b></td>
  <td  align='left'><label><font face='Tahoma' size='2'>$Creator</font></td>
</tr>
<tr>
  <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Type :</font></b></td>
  <td  align='left'><label><font face='Tahoma' size='2'>$reqType</font></td>
</tr>
<tr>
  <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Subtype :</font></b></td>
  <td  align='left'><label><font face='Tahoma' size='2'>$reqSubtype</font></td>
</tr>
<tr>
  <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Subject :</font></b></td>
  <td  align='left'><label><font face='Tahoma' size='2'>$reqSubject</font></td>  
</tr>
<tr>
  <td align='right' valign='top'><b><font face='Tahoma' size='2' color='44778D'>Attachment(s) :</font></b></td>
  <td  align='left'><label><font face='Tahoma' size='2'></font>";
//path to directory to scan
$directory = "Attachments/";
 
//get all the files associated with the request
$files = glob($directory . $IdForRequest . "_*.*",GLOB_BRACE);

//print each file name
foreach($files as $file)
{
$fileName = basename($file);
$fileOrgName = substr($fileName,strpos($fileName,'_',(strpos($fileName,'_')+1))+1);
echo "<a href = ". $directory . rawurlencode(htmlspecialchars($fileName, ENT_QUOTES ))." target='_blank' style='font-size:12;'>$fileOrgName<br></a>";
}  
echo "</td>  
</tr>
<tr>
  <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Expected SLA :</font></b></td>
  <td align='left'><label><font face='Tahoma' size='2'>$SLA days</font></td>  
</tr>
<tr>
  <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Assigned To :</font></b></td>
  <td align='left'><label><font face='Tahoma' size='2'>$AssignedTo</font></td>  
</tr>
<tr>
  <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Created On :</font></b></td>
  <td align='left'><label><font face='Tahoma' size='2'>$CreatedOn</font></td>  
</tr>
<tr>
  <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Updated On :</font></b></td>
  <td align='left'><label><font face='Tahoma' size='2' color='848484'>$UpdatedOn</font></td>  
</tr>
<tr>
  <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Status :</font></b></td>
  <td align='left'>
                <select size='1' name='Status' id='Status'>  		
		<option></option>";
		
$ddQuery2 = mysql_query("SELECT * FROM tblstatus");

 while ($dropdownitems = mysql_fetch_array($ddQuery2))
 {
	If($dropdownitems['Status']==@$Status)
		{echo "<option selected value='$dropdownitems[Status]'>$dropdownitems[Status]</option>";}
	Else
        {echo "<option value='$dropdownitems[Status]'>$dropdownitems[Status]</option>";}
  }  
     echo "</select></td>
</tr>
<tr>
  <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Comments :</font></b></td>
  <td align='left'>
<div id='editable-content' style='border:1px solid #378EF1; background:#FFF; font-size:13; font-family:Tahoma; -moz-border-radius: 10px; -webkit-border-radius: 10px;  border-radius: 10px;'>
    <span id='block2' class='non-editable' style='background:#DADADA; -moz-border-radius: 10px; -webkit-border-radius: 10px;  border-radius: 10px;'>".stripslashes($reqDescription)."</span>
		<br /><br />
		<font color='#B6B6B6' style='font-size:16; font-family:Tahoma'>
	<span id='block1' class='editable' contenteditable='true' onfocus='onFocusText()' onblur='lostFocusText()' >Add comments here...</span></font>
	<br /><br />
</div>
</td>
</tr>
 <tr>
  <td height='30' align='right' valign='top'><b><font face='Tahoma' size='2' color='44778D'>Add Attachment :</font></b></td>
  <td colspan='2'><input type='file' name='uploaded_file' id='uploaded_file' style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma'></td>
 </tr>
</table>

<input type='hidden' name='comments' id='comments'>

<table width='86%' align='right' style='margin:15px'>
<tr>                
		<td height='44' colspan='2'><center> " ; ?>
		<button type='Submit' name='Submit' id='save-page' onclick="document.getElementById('soundfile').play();lostFocusText()">Update</button>
<?php echo "</tr>
</table>
</form>
<!-- Form ends --> ";
  
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