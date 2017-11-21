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
<title>Pending Request Details</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />

<script src="php_calendar/scripts.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function validate_form()
{
	if(document.getElementById("Type").value=="" || document.getElementById("Type").value.length == 0)
	{
		alert("Please Enter Type of the request");
//		document.forms['form1'].Elements['Type'].focus();
		return false;
	}
	
	if(document.getElementById("Subtype").value=="" || document.getElementById("Subtype").value.length == 0)
	{
		alert("Please Enter Subtype of the request");
		document.getElementById("Subtype").focus
		return false;
	}
	
	//if(document.getElementById("BluePageManager").value=="" || document.getElementById("BluePageManager").value.length == 0)
	//{
		//alert("Please Enter BluePageManager of the request");
		//document.getElementById("BluePageManager").focus
		//return false;
	//}
	
	if(document.getElementById("Subject").value=="" || document.getElementById("Subject").value.length == 0)
	{
			alert("Please Enter a Subject of the request");
			document.getElementById("Subject").focus
			return false;
	}

	if(document.getElementById("Description").value=="" || document.getElementById("Description").value.length == 0)
	{
			alert("Please Enter Description of the request");
			document.getElementById("Description").focus
			return false;
	}
	
}

function reload(form,t)
{
var val1=form.Type.options[form.Type.options.selectedIndex].value;
var val2=form.Subject.value;
var val3=form.Description.value;
self.location='allrequestdetails.php?Type=' + val1 + '&Subject=' + val2 + '&Description=' + val3 + '&valId=' + t ;
}
</script>
</head>

<body onload="document.forms['form1'].elements['Type'].focus()">

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
<form name ='form1' action='updaterequest.php?reqId=$Id' method='POST' onSubmit='javascript: return validate_form();'>

<table class='header' width='800' border='0' align='center' valign='middle'>
<tr><td height='36'>
<b><center> Details of Pending Request <font face='MV Boli'>No $IdForRequest</font></center></b>
</td></tr>
</table>
<br></br>

<table border='0' align='center' valign='top'>
<tr><td align='center' style='background:#FFF'>
<font face='Tahoma' size='2' color='B40486'>Here you are viewing the details of a request which is Pending. For other Requests, you've different screens.</font>
</td></tr>
</table>
<br></br>

<table border='0' align='center' valign='top'> ";
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
		$SLA=$rowRequest['SLA_Days'];
		$AssignedTo=$rowRequest['AssignedTo'];
		$CreatedOn=$rowRequest['CreatedOn'];
		$UpdatedOn=$rowRequest['UpdatedOn'];
		$Status=$rowRequest['Status'];
		$Creator=$rowRequest['UserName'];		
	}
//	@$Item=$reqType;
//	@$SubItem=$reqSubtype;	
	}
/*	Else
	{
	@$Item=$_GET['Type'];
	@$reqSubject=$_GET['Subject'];
	@$reqDescription=$_GET['Description'];	
	}
	
  // Get all the type of requests from the database and allow user to choose one
	$ddQuery = mysql_query("SELECT * FROM dropdownmenus WHERE dropdownName = 'RequestType' ORDER BY dropdownSequence");
  
  // Get all the subtype of requests from the database and allow user to choose one  
	If(isset($Item) and strlen($Item) > 0)
	{  
	$ddQuery2 = mysql_query("SELECT * FROM dropdownmenus WHERE dropdownName = 'RequestSubType' AND dropdownItemName='$Item' ORDER BY dropdownSequence");
	}
	Else
	{
	$ddQuery2 = mysql_query("SELECT * FROM dropdownmenus WHERE dropdownName = 'RequestSubType' AND 1=2 ORDER BY dropdownSequence");
	}

  echo "<td height='30' width=10%  align='center'><font face='Tahoma' size='2' color='848484'>Type</font></td>
  <td height='30' width=90%>
                <select size='1' name='Type' onchange='reload(this.form,$Id)'>
				
		<option></option>";

 while ($dropdownitems = mysql_fetch_array($ddQuery))
 {
	If($dropdownitems['dropdownItemName']==@$Item)
		{echo "<option selected value='$dropdownitems[dropdownItemName]'>$dropdownitems[dropdownItemName]</option>";}
	Else
        {echo "<option value='$dropdownitems[dropdownItemName]'>$dropdownitems[dropdownItemName]</option>";}
  }  
?>
                </select></td>
</tr>

<tr>
  <td height="30" width=10% align="center"><font face='Tahoma' size="2" color='848484'>Subtype</font></td>  
  <td  height="30" width=90%>
                <select size="1" name="Subtype" >
				
<?php				
	echo "<option></option>";

 while ($dropdownsubitems = mysql_fetch_array($ddQuery2))
 {
	If(isset($IdForRequest) and strlen($IdForRequest) > 0) 
	{
		If(trim($dropdownsubitems['dropdownSubItemName']," ")==trim($SubItem," "))
			{echo "<option selected value='$dropdownsubitems[dropdownSubItemName]'>$dropdownsubitems[dropdownSubItemName]</option>";}
		Else
			{echo "<option value='$dropdownsubitems[dropdownSubItemName]'>$dropdownsubitems[dropdownSubItemName]</option>";}
	}
	Else
		{echo "<option value='$dropdownsubitems[dropdownSubItemName]'>$dropdownsubitems[dropdownSubItemName]</option>";}
	
 }
                echo "</select></td>

</tr>

<!--
<tr>
  <td width='120'><font face='Tahoma' size='2'>BPManager Email</font></td>
  <td><input type='text' name='BluePageManager' id='BluePageManager' size='30'/></td>
</tr> 
-->
*/
echo "
<tr>
  <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Creator :</font></b></td>
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
  <td align='right' valign='top'><b><font face='Tahoma' size='2' color='44778D'>Description :</font></b></td>
  <td align='left'><label><font face='Tahoma' size='2'>".stripslashes($reqDescription)."</font></td>  
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
  <td align='left'><label><font face='Tahoma' size='2'>$UpdatedOn</font></td>  
</tr>
<tr>
  <td align='right'><b><font face='Tahoma' size='2' color='44778D'>Status :</font></b></td>
  <td align='left'><label><font face='Tahoma' size='2'>$Status</font></td>  
</tr>
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