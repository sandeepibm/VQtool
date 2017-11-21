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
<title>Update Profile</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">

function progressBarSim(al,maxAL,message,prevMessage,interval,prevMsgColor,hdrName)
{
	var bar = document.getElementById("progressBar");
	var status = document.getElementById("status");
	var prevMSG = document.getElementById(hdrName);
	var prevColor = prevMsgColor;
	
	status.innerHTML = al+"%";
	bar.value = al;
	al++;
	
	var sim = setTimeout("progressBarSim("+al+","+maxAL+",'"+message+"','"+prevMessage+"',"+interval+",'"+prevColor+"','"+hdrName+"')",interval); 
	
	if(al == maxAL){
		status.innerHTML = maxAL+"%";
		bar.value = maxAL;
		document.getElementById("finalMessage").innerHTML = message;
		prevMSG.style.color = prevColor;
		prevMSG.innerHTML = prevMessage;
		clearTimeout(sim);
		}
}

function pausecomp(millis)
 {
  var date = new Date();
  var curDate = null;
  do { curDate = new Date(); }
  while(curDate-date < millis);
}

</script>
</head>

<?php

  $time = time();

  // Check if there is a cookie, if there isn't then exit!
  if (!isset($_COOKIE['cookie_info'])) {
      echo "Cannot access this page: You aren't logged in";
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
          //include("header.php");
		  include("baseframe.php");
          //login();

          // Use cookie and Extract the cookie data (Username and Password)
          $cookie_info = explode("-", $_COOKIE['cookie_info']);
          $namecookie = $cookie_info[0];
          $passcookie = $cookie_info[1];

  // Check the level of the user
  $userdata = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
  $username = mysql_result($userdata,0,8);

  // If the user is the admin
  //if ($checklevel1 == 1) {

  // Variables that data come from the submission form
  $name =  $_POST["name1"];         // Name
  $empid = $_POST["empid"];			//emp id
  $email = $_POST["email"];			//email id
  $mobile = $_POST["mobile"];         // State
  $extension = $_POST["extension"];      // Postcode
  $address = nl2br($_POST["address1"]);
  $mgrId = $_POST["mgrEmail"];        // people mgr's email

  
  /*$suburb = $_POST["suburb"];      // Suburb
  $state = $_POST["state"];        // State
  $postcode = $_POST["postcode"];  // Postcode
  $phone1 = $_POST["phone1"];      // Phone Number 1
  $phone2 = $_POST["phone2"];      // Phone Number 2
  $emailaddress = $_POST["email"];*/ // Email Address

  // Get IP Address of user
 // $ipaddress = $_SERVER["REMOTE_ADDR"];

  /* Check if all the sections are completed as a whole, then if one isn't
  filled out display the error message for that/those particular variables. */
?>

<table class='header' width="800" border="0" align="center" valign="middle">
<tr><td  height='23'>
<b><center>Update Profile</font></center></b>
</td></tr>
</table>
<br></br>

<?php
	  if ((!$name) || (!$mobile) || (!$empid) || (!$email) || (!$mgrId)) {
		echo "<table border='0' align='center' valign='top'>
		<tr><td>
		<label><font face='Tahoma' size='2' color='FF0000'>You haven't given the following required information when updating your profile:</font>
		</td></tr>
		</table>";	  
      if (!$name) {
		echo "<table border='0' align='center' valign='top'>
		<tr><td>
		<label><font face='Tahoma' size='2' color='FF0000'>Please enter your Name.</font>
		</td></tr>
		</table>";	  
      }

      if (!$mobile) {
		echo "<table border='0' align='center' valign='top'>
		<tr><td>
		<label><font face='Tahoma' size='2' color='FF0000'>Please enter your Mobile Number.</font>
		</td></tr>
		</table>";	  
      }
      if (!$empid) {
		echo "<table border='0' align='center' valign='top'>
		<tr><td>
		<label><font face='Tahoma' size='2' color='FF0000'>Please enter your Employee ID.</font>
		</td></tr>
		</table>";	  
      }
      if (!$email) {
		echo "<table border='0' align='center' valign='top'>
		<tr><td>
		<label><font face='Tahoma' size='2' color='FF0000'>Please enter your Email Address.</font>
		</td></tr>
		</table>";	  
      }
      if (!$mgrId) {
		echo "<table border='0' align='center' valign='top'>
		<tr><td>
		<label><font face='Tahoma' size='2' color='FF0000'>Please select your People Manager's Email Address.</font>
		</td></tr>
		</table>";	  
      }
	  echo "<br><br>";
      echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";
      exit(); // If there are errors then we quit this script
  }

  // Check if postcode is a numeric
  /*if ((!is_numeric($postcode))) {
        echo "Please enter a postcode";
        exit();
  }

  // Check if phone number 1 is a numeric
  if ((!is_numeric($phone1))) {
        echo "Please enter a phone number for phone number 1";
        exit();
  }

  // Check if phone number 2 is a numeric
  if ((!is_numeric($phone2))) {
        echo "Please enter a phone number for phone number 2";
        exit();
  }


  // Get date from MySQL Server
  $currentdatetime = mysql_query('select now()');
  $curdatetime = mysql_result($currentdatetime,0);

  // Check if username exists. If not then add all data to the database.
  //If so then ask user for another name to try. 

  // MD5 Username and Password
  $username = MD5($username);
  $password = MD5($password);

  // Check if the username exists
  $usernameinuse = mysql_query("SELECT * FROM userdata WHERE userid = '$username'");
  $isusernameinuse = mysql_num_rows($usernameinuse);

  // If username exists then print error message and exit script
  If ($isusernameinuse == 1) {
      echo "The username you selected is already been used by another member.<BR>Go back and select a new username";
	  echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";
      exit;
	}
  Else {

      // Find out how many users there are so that you can determine the next user number
      $usercount = mysql_query("SELECT * FROM userdata");
      $noofusers = mysql_num_rows($usercount);

      // New user number = User number + 1
      $usernumber = $noofusers + 1;
*/

	  $mgrdata = mysql_query("SELECT * FROM tblmanager WHERE MgrId = '$mgrId'");
	  $mgremail = mysql_result($mgrdata,0,2);
	  
      // Insert the new user to the database since everything is fine
      mysql_query("UPDATE userdata SET Name='$name',EmployeeID=UPPER('$empid'),Email='$email',Mobile='$mobile',Extension='$extension',Address='$address',MgrId='$mgrId' WHERE UserId='$namecookie'");

      // Print Successful Creation of user message
	  echo "<table width='50%' border='0' align='center' valign='middle'>
			<tr><td> 
			<br></br><br></br>
			</td></tr>
			</table>";
			
	  echo "<table width='90%' border='0' align='right' valign='middle'>
<tr><td  align='center'><label>
<font face='Verdana' Size='2' color='0A5DAB'>User Profile has been updated successfully.</font>
</td></tr>
</table>";
?>		
<br></br><br></br><br></br>

<table width="90%" border='0' align='right' valign='top'>
<tr><td align='center'>
	<h1 id="finalMessage" style="font-size: 12px; color:#000000; display:inline-block">Updating Profile in the system...</h1>
</tr></td>
<tr><td align='center'>
	<progress id="progressBar" value="0" max="100" align="center" style="width:600px; height:20px;">20</progress> 
	<span id="status" style="color:#000000;"></span>
</tr></td>
<tr><td align='center'>
	<h1 id="prevMessage1" style="font-size: 12px; display:inline-block">&nbsp;</h1>
</tr></td>
<tr><td align='center'>
	<h1 id="prevMessage2" style="font-size: 12px; display:inline-block">&nbsp;</h1>
</tr></td>
<tr><td align='center'>
	<h1 id="prevMessage3" style="font-size: 12px; display:inline-block">&nbsp;</h1>
</tr></td>
</table>	

<?php
		$interval=50;
		$prevColors="#04B431";

	echo "<script type='text/javascript'>progressBarSim(0,20,'Sending Email to You...','Profile Updated in the system.',".$interval.",'".$prevColors."','prevMessage1');</script>";
	try 
	{
		while (ob_get_level() > 0)
		ob_end_flush();
	}
	catch( Exception $e ) {}
    flush();
sleep(2);


/************************************MAIL SEND*********************************************************/ 
//ini_set("include_path","C:/wamp/bin/php/php5.3.10/pear");
include_once('Mail.php');
include_once('Mail/mime.php');

$mailmsg = new Mail_mime();

	$progMsg='';
	$to=$email;
	$subject = 'Account updated in VQ portal!';
	$message = '<HTML>
				<BODY>
				<font face="Tahoma" size="2" color="44778D">Dear '.$name.',</font>
				<br></br>

				<table id="table4" width="65%" style="border:3px solid #cccccc;background:#C7F8B7;">
			
					<tr>
					 <td colspan="2">  <br />	
					 <p><font color="#0A5DAB">Your profile has been updated successfully.</font></p>
					 </td>					 
					</tr>
					
					<tr>
					 <td colspan="2"><br />
					 <p><font color="0A5DAB">Kindly note below your updated profile.</font></p>
					 </td>					 
					</tr>
					
					<tr>
					 <td><br />
					 <p><font color="#B40486" >User Name :</font></p>
					 </td>
					 <td><br />
					 <p><font color="#B40486">'.$username.'</font></p>
					 </td>				 
					 </tr>						 			

					<tr>
					 <td>
					 <p><font color="#B40486">Employee Id :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.strtoupper($empid).'</font></p>
					 </td>					 
					 </tr>
					 
					<tr>
					 <td>
					 <p><font color="#B40486">Email :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$email.'</font></p>
					 </td>					 
					 </tr>	
					 
					<tr>
					 <td valign="top">
					 <p><font color="#B40486">Mobile :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$mobile.'</font></p>
					 </td>				 
					 </tr>	
					 
					<tr>
					 <td>
					 <p><font color="#B40486">Extension :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$extension.'</font></p>
					 </td>				 
					 </tr>
					 
					<tr>
					 <td valign="top">
					 <p><font color="#B40486">address :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$address.'</font></p>
					 </td>
					 </tr>	
					 
					<tr>
					 <td valign="top">
					 <p><font color="#B40486">People Manager\'s Email ID :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$mgremail.'</font></p>
					 </td>
					 </tr>	
					 
					<tr>
					 <td colspan="2" align="center"><br /><br />
					 Click on the link to <a href="https://9.109.114.110/vqportal/"><font color="0A5DAB">Go to the VQ Portal</font></a>
					 </td>					 
					</tr>
					
					<tr>
					 <td colspan="2"><br /><br />
					 <p><font color="#FF0000">DO NOT REPLY TO THIS MESSAGE</font></p>
					 </td>					 
					</tr>

					<tr>
					 <td colspan="2">
					 <p><font color="#FF0000">For further assistance, please send an email to #BLR Operations RSC</font></p>
					 </td>					 
					</tr>

					</table>
				<br />';					 
	$message .= '<font face="Tahoma" size="2" color="44778D">Warm Regards,<br />
	RSC Business Operations Team </font><br />
	<img src="./images/VQlogo email.gif" alt="" />
				</BODY>
				</HTML>'; 

$mailmsg->setHTMLBody($message);
$mailmsg->addHTMLImage("./images/VQlogo email.gif", "image/gif");

$body = $mailmsg->get();
$extraheaders = array("From"=>"RSC_Operations@in.ibm.com", "Subject"=>$subject);
$headers = $mailmsg->headers($extraheaders);
$mail = Mail::factory("mail");
	try
	{
		# supress error for this statement
		error_reporting(0); 	
		$mailsent=($mail->send($to, $headers, $body));
		error_reporting(E_ALL); #Don't forget to call this to restore error.
		if (PEAR::isError($mailsent)) 
		{
			$mailsent=false;
			$progMsg="couldn't";
			$prevColors="#FF0000";
		}
		Else
		{
			$mailsent=true;
			$progMsg="";			
			$prevColors="#04B431";
		}
	}
	catch( Exception $e ) 
	{
		$mailsent=false;
	}

			if($mailsent)
			{echo"<table border='0' width='60%' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='0A5DAB' style='background:fff'>Email sent to your email id(".$to.") with all information.</font>
					</td></tr>
					</table>";}
			else
			{echo "<table border='0' width='61%' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FA8201' style='background:fff'>Problems occured.Couldn't send email to your email id(".$to.").</font>
					</td></tr>
					</table>";
					}		

	echo "<script type='text/javascript'>progressBarSim(21,100,'Process Completed.','Email ".htmlspecialchars($progMsg, ENT_QUOTES )." sent to You.',".$interval.",'".$prevColors."','prevMessage2');</script>";
	try 
	{
		while (ob_get_level() > 0)
		ob_end_flush();
	}
	catch( Exception $e ) {}
    flush();
sleep(3);	
/************************************MAIL SENT*********************************************************/ 	  

  //}
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