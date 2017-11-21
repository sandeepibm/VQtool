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
<title>Register User</title>
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
	if(document.getElementById("user").value=="" || document.getElementById("user").value.length == 0)
	{
		alert("Please Enter the User Name.");
		document.getElementById("user").focus()
		return false;
	}
	if(document.getElementById("pass").value=="" || document.getElementById("pass").value.length == 0)
	{
		alert("Please Enter the Password.");
		document.getElementById("pass").focus()
		return false;
	}
	if(document.getElementById("pass").value.length < 6)
	{
		alert("Password should be minimum 6 characters.");
		document.getElementById("pass").focus()
		return false;
	}	
	if(document.getElementById("name1").value=="" || document.getElementById("name1").value.length == 0)
	{
		alert("Please Enter your Name.");
		document.getElementById("name1").focus()
		return false;
	}
	if(document.getElementById("empid").value=="" || document.getElementById("empid").value.length == 0)
	{
		alert("Please Enter your Employee ID.");
		document.getElementById("empid").focus()
		return false;
	}
	if(document.getElementById("empid").value.length != 6)
	{
		alert("Employee ID should be 6 characters.");
		document.getElementById("empid").focus()
		return false;
	}
	if(document.getElementById("email").value=="" || document.getElementById("email").value.length == 0)
	{
			alert("Please Enter your Email ID.");
			document.getElementById("email").focus()
			return false;
	}
	if(document.getElementById("email").value!="" || document.getElementById("email").value.length != 0)
	{
	var str=document.getElementById("email").value;
	if(!str.match(/[a-zA-Z0-9._-]+@[a-zA-Z-]+\.[a-zA-Z]{2,4}/))
	{
		alert("Invalid Email ID.");
		document.getElementById("email").focus()
		return false;
	}
	if(!str.match(/@in.ibm.com/gi))
	{
		alert("Username must be an \"in.ibm.com\" id.");
		document.getElementById("email").focus()
		return false;
	}
	}
	if(document.getElementById("mobile").value=="" || document.getElementById("mobile").value.length == 0)
	{
		alert("Please Enter your Mobile Number.");
		document.getElementById("mobile").focus()
		return false;
	}
	if(document.getElementById("mobile").value.length != 10)
	{
		alert("Invalid Mobile Number.Please enter a 10 digit number.");
		document.getElementById("mobile").focus()
		return false;
	}
	if(document.getElementById("mobile").value!="")
	{
		if(document.getElementById("mobile").value.match(/^[0-9]+/) != document.getElementById("mobile").value)
		{
			alert("Invalid Mobile Number.Please enter a Numeric value.");
			document.getElementById("mobile").focus()
			return false;
		}
	}
	if(document.getElementById("extension").value!="")
	{
		if(document.getElementById("extension").value.match(/^[0-9]+/) != document.getElementById("extension").value)
		{
			alert("Invalid Extension.Please enter a Numeric value.");
			document.getElementById("extension").focus()
			return false;
		}
		if(document.getElementById("extension").value.length != 5)
		{
			alert("Invalid Extension Number.Please enter a 5 digit number.");
			document.getElementById("extension").focus()
			return false;
		}				
	}
	if(document.getElementById("mgrEmail").value=="")
	{
			alert("Please Select your People Manager's Email ID.");
			document.getElementById("mgrEmail").focus()
			return false;
	}
}

function Test()
{

		document.getElementById("email").value=document.getElementById("user").value;
		document.getElementById("email").disabled=true;
}
</script>
</head>

<?php
include("outerbaseframe.php");
?>
<body width="100%" border="0" onload="document.forms['form1'].elements['user'].focus();">
<br></br>
<br></br>
<B><center><font face='Tahoma' size="4" color='4aafdc' ><U>User Registration</U></font></B></center></p>
<form name="form1" action="createnewuser.php" method="POST" onSubmit="javascript: return validate_form();">

<table border="0" width="75%" align='right' valign='middle'>
<br></br>	
        <tr>
                <td align="right"><b><font face='Tahoma' size='2' color='44778D'>Username :(*)</font></b></td>
                <td > <input type="text" name="user" id="user" size="40" onblur="Test();" style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma;' /><font face='Tahoma' size="2" color='0A5DAB' > &nbsp;&nbsp;(Use your intranet email id (e.g. username@in.ibm.com) [Username is case-sensitive])</font></td>
        </tr>
        <tr>
                <td align="right"><b><font face='Tahoma' size='2' color='44778D'>Password :(*)</font></b></td>
                <td > <input type="password" name="pass" id="pass"  size="40" style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma'/><font face='Tahoma' size="2" color='0A5DAB' > &nbsp;&nbsp;(min 6 characters)</font></td>
        </tr>
        <tr>
                <td align="right"><b><font face='Tahoma' size='2' color='44778D'>Name :(*)</font></b></td>
                <td > <input type="text" name="name1" id="name1" size="40" style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma'/></td>
        </tr>
        <tr>
                <td align="right"><b><font face='Tahoma' size='2' color='44778D'>Employee ID :(*)</font></b></td>
                <td > <input type="text" name="empid" id="empid" size="40" style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma; text-transform:uppercase' maxlength='6'/><font face='Tahoma' size="2" color='0A5DAB' > &nbsp;&nbsp;(6 characters fixed)</font></td>
        </tr>
        <tr>
                <td align="right"><b><font face='Tahoma' size='2' color='44778D'>Email ID :(*)</font></b></td>
                <td > <input type="text" name="email" id="email" size="40" style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma;'/><font face='Tahoma' size="2" color='0A5DAB' > &nbsp;&nbsp;(same as username)</font></td>
        </tr>		
        <tr>
                <td align="right"><b><font face='Tahoma' size='2' color='44778D'>Mobile No :(*)</font></b></td>
                <td > <input type="text" name="mobile" id="mobile" size="40" style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma' maxlength='10'/><font face='Tahoma' size="2" color='0A5DAB' > &nbsp;&nbsp;(10 digits)</font></td>
        </tr>
        <tr>
                <td align="right"><b><font face='Tahoma' size='2' color='44778D'>Extension :</font></b></td>
                <td > <input type="text" name="extension" id="extension" size="40" style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma' maxlength='5'/></td>
        </tr>
        <tr>
                <td align="right"><b><font face='Tahoma' size='2' color='44778D'>Office Address :</font></b></td>
                <td > <textarea name="address1" rows="3" cols="38" size="30" style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma;'></textarea></td>		
        </tr>

        <tr>
                <td align="right"><b><font face='Tahoma' size='2' color='44778D'>People Manager's Email ID :(*)</font></b></td>
				<td > <select size="1" name="mgrEmail" id="mgrEmail" style='border:1px solid #378EF1; color:#5D5F60; font-weight:500; font-family:Tahoma'> <option></option>
<?php				
	include("connect.php");
	
  // Get all the type of requests from the database and allow user to choose one
	$ddQuery = mysql_query("SELECT * FROM tblmanager ORDER BY Name");
	
	while ($dropdownmgr = mysql_fetch_array($ddQuery))
	 {
		echo "<option value='$dropdownmgr[MgrId]'>$dropdownmgr[Name] ($dropdownmgr[Email])</option>";
	 }	  				
		echo "</select></td>";
?>				
        </tr>		

<tr><td align="left" colspan=2><p><font face='Tahoma' size='2' color='0A5DAB'>Can't find your manager's email!!Use 'Dummy Manager' for registraion and raise a request after log on to the portal.</font></p></td></tr>
<tr><td><br></br></td></tr>
</table>
<table width="95%" align="right">
        <tr>                
                <td align="left" height="44"><center> 
				<button type="Submit" name="Submit" id="Submit" onClick="document.getElementById('soundfile').play();">Register</button>
				<button type="Reset" name="Reset" id="Reset" style="width:100px;" onClick="document.getElementById('soundfile').play();">Clear</button>
        </tr>
</table>
</form>
<?php
/*
  }
     // If user and password are not correct print error message
     }
     else {
         echo "Incorrect username/password";
         exit;
     }
  }
*/  
?>

</body>
</html>