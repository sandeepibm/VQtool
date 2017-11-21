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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Create New User</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>

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
  //if (!isset($_COOKIE['cookie_info'])) {
  //    echo "Cannot access this page: You aren't logged in";
  //    exit;
  //}

  // If there is a cookie, validate the cookie
  //else {

      // Use Connect Script
      include("connect.php");
      include("outerbaseframe.php");
      // Include the validation of user file
      //include("validateuser.php");

      // If user and password are correct
      //if (validateuser() == true) {

          // Header
          //include("header.php");
		  //include("home.php");
          //login();

          // Use cookie and Extract the cookie data (Username and Password)
          //$cookie_info = explode("-", $_COOKIE['cookie_info']);
          //$namecookie = $cookie_info[0];
          //$passcookie = $cookie_info[1];

  // Check the level of the user
  //$checklevel = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
  //$checklevel1 = mysql_result($checklevel,0,9);

  // If the user is the admin
  //if ($checklevel1 == 1) {

  // Variables that data come from the submission form
  $username = $_POST["user"];      // Username that will be MD5'ed
  $usernamereal = $username;  // Username
  $password = $_POST["pass"];      // Password that will be MD5'ed
  $pass = $password;
  $name =  $_POST["name1"];         // Name
  $empid = $_POST["empid"];			//emp id
  $email = $_POST["user"];			//email id
  $mobile = $_POST["mobile"];         // State
  $extension = $_POST["extension"];      // Postcode
  $address = nl2br($_POST["address1"]);    // Address
  $mgremail = $_POST["mgrEmail"];        // people mgr's email
		// for  people mgr's email
		$query_mgremail=mysql_query("Select * From tblmanager Where MgrId=$mgremail");
		$infomgremail=mysql_fetch_array($query_mgremail) ;
		$mgremailId=$infomgremail['Email'];
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

echo "<br></br>
<br></br>
<B><U><center><font face='Tahoma' size='4' color='4aafdc' >User Registration</font></U></B></center></p>
<br></br>";  
  echo "<center>";
  if ((!$username) || (!$password) || (!$name) || (!$mobile) || (!$empid) || (!$email) || (!$mgremail)) {
      echo "You didn't submit the following required information:<br><br>";

      if(!$username) {
          echo "Please enter a Username.<br>";
          }
      if (!$password) {
          echo "Please enter a Password.<br>";
      }
      if (!$name) {
          echo "Please enter your Name.<br>";
      }

      if (!$mobile) {
          echo "Please enter your Mobile Number.<br>";
      }
      if (!$empid) {
          echo "Please enter your Employee ID.<br>";
      }
      if (!$email) {
          echo "Please enter your Email Address.<br>";
      }
      if (!$mgremail) {
          echo "Please select your People Manager Email Address.<br>";
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
  }*/


  // Get date from MySQL Server
  $currentdatetime = mysql_query('select now()');
  $curdatetime = mysql_result($currentdatetime,0);

  /* Check if username exists. If not then add all data to the database.
  If so then ask user for another name to try. */

  // MD5 Username and Password
  $username = MD5($username);
  $password = MD5($password);

  // Check if the username exists
  $usernameinuse = mysql_query("SELECT * FROM userdata WHERE userid = '$username'");
  $isusernameinuse = mysql_num_rows($usernameinuse);

  // If username exists then print error message and exit script
  If ($isusernameinuse == 1) {
      echo "<font face='Verdana' Size='2' color='FF0000'>The username you selected is already been used by another member.<BR>Go back and select a new username.</font>";
	  echo "<br></br><br></br><br></br>";
	  echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";
      exit;
	}
  Else {

      // Find out how many users there are so that you can determine the next user number
      $usercount = mysql_query("SELECT * FROM userdata");
      $noofusers = mysql_num_rows($usercount);

      // New user number = User number + 1
      $usernumber = $noofusers + 1;

      // Insert the new user to the database since everything is fine
      mysql_query("INSERT INTO userdata(UserID,UserPass,Name,EmployeeID,Email,Mobile,Extension,Address,MgrId,UserName,UserGroup) VALUES ('$username','$password','$name',UPPER('$empid'),'$email','$mobile','$extension','$address','$mgremail','$usernamereal','End User')");

      // Print Successful Creation of user message
	  echo "<table width='50%' border='0' align='center' valign='middle'>
			<tr><td> 
			<br></br>
			</td></tr>
			</table>";
			
      echo "<br><font face='Verdana' Size='2' color='0A5DAB'>User " . $usernamereal . " has been created successfully.";

?>		
<br></br><br></br>

<table width="100%" border='0' align='right' valign='top'>
<tr><td align='center'>
	<h1 id="finalMessage" style="font-size: 12px; color:#000000; display:inline-block">Creating Profile in the system...</h1>
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

	echo "<script type='text/javascript'>progressBarSim(0,20,'Sending Email to You...','Account Created in the system.',".$interval.",'".$prevColors."','prevMessage1');</script>";
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
	$subject = 'Account creation confirmation in VQ portal!';
	$message = '<HTML>
				<BODY>
				<font face="Tahoma" size="2" color="44778D">Dear '.$name.',</font>
				<br></br>

				<table id="table4" width="65%" style="border:3px solid #cccccc;background:#C7F8B7;">
					<tr>
					 <td colspan="2">
					 <p><font color="0A5DAB">Welcome to VQ Portal!</font></p>
					 </td>					 
					</tr>
					
					<tr>
					 <td colspan="2">  <br />	
					 <p><font color="#07B7B5">Your account has been created as General User</font></p>
					 </td>					 
					</tr>
					
					<tr>
					 <td colspan="2"><br />
					 <p><font color="0A5DAB">Kindly note below your user profile.</font></p>
					 </td>					 
					</tr>
					
					<tr>
					 <td><br />
					 <p><font color="#B40486" >User Name :</font></p>
					 </td>
					 <td><br />
					 <p><font color="#B40486">'.$usernamereal.'</font></p>
					 </td>				 
					 </tr>						 			

					<tr>
					 <td>
					 <p><font color="#B40486" >Password :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$pass.'</font></p>
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
					 <p><font color="#B40486">'.$mgremailId.'</font></p>
					 </td>
					 </tr>	
					 					 
					<tr>
					 <td colspan="2" align="center"><br /><br />
					 Click on the link to <a href="http://9.109.114.110/vqportal/"><font color="0A5DAB">Go to the VQ Portal</font></a>
					 </td>					 
					</tr>
					 					 
					<tr>
					 <td colspan="2" align="center"><br />
					 <p><font color="#B40486">||Best viewed in Mozilla Firefox or Google Chrome and 1600x900 Resolution||</font></p>
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
			{echo"<table border='0' width='65%' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='0A5DAB'>Email sent to your email id(".$to.") with all information.</font>
					</td></tr>
					</table>";}
			else
			{echo "<table border='0' width='66%' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FA8201'>Problems occured.Couldn't send email to your email id(".$to.").</font>
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
  }
  //}
     // If user and password are not correct print error message
     //}
     //else {
     //    echo "Incorrect username/password";
     //    exit;
     //}
  //}
  echo "<table border='0' width='100%' align='right' valign='top'>
					<tr><td>";
?>					
					<font face='Tahoma' size='2' color='000000'><a href='index.php' onClick="document.getElementById('soundfile').play();"><center><font size='3'>Login Now</font></center></a></font>
<?php 				echo "</td></tr>
					</table>";
?>

</body>
</html>