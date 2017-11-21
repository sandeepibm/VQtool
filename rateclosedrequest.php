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
<title>Rate A Closed Request</title>
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
  $Rating =  $_POST["Rating"];  
  $Remarks=nl2br($_POST["Description"]);
  $Id = $_GET["reqId"];
  // Get IP Address of user
 // $ipaddress = $_SERVER["REMOTE_ADDR"];

  /* Check if all the sections are completed as a whole, then if one isn't
  filled out display the error message for that/those particular variables. */
?>

<table class='header' width="800" border="0" align="center" valign="middle">
<tr><td  height='23'>
<b><center>Rate A Closed Request</font></center></b>
</td></tr>
</table>
<br></br>

<?php

	  if ((!$Rating)) {
      echo "<center><font face='Verdana' Size='2' color='FF0000'>You didn't submit the following required information:</font></center><br><br>";
      if (!$Rating) {
          echo "<center><font face='Verdana' Size='2' color='FF0000'>Please select a Rating.</font></center>";
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

	  // Check if the sequence number exists
	  $seqinuse = mysql_query("SELECT * FROM allrequests WHERE RequestId='$Id'");
		$info=mysql_fetch_array($seqinuse) ;
		$AssignedTo=$info['AssignedTo'];
	  
	  // If sequence number exists then print error message and exit script
	  If ($AssignedTo==$ReassignedTo) {
		  echo "<center><font face='Verdana' Size='2' color='FF0000'>You didn't change the assigned person.</font></center>";
		  echo "<center><font face='Verdana' Size='2' color='FF0000'>First change the ReassignedTo then Reassign the request.</font></center>";
		  echo "<br></br><br></br><br></br>";
		  echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";
		  exit;
		}
	  Else
		{		
			$query_name=mysql_query("Select Name,UserName From userdata Where Email='$AssignedTo'");
			$info=mysql_fetch_array($query_name) ;
			$AssignedToName=$info['Name'];
			$AssignedToUserName=$info['UserName'];
		}
*/	
      mysql_query("UPDATE allrequests SET Rating = '$Rating', RatingRemarks='".mysql_real_escape_string($Remarks)."' WHERE RequestId='$Id'");
/*	  
		$query_email=mysql_query("Select A.Email,A.UserName,B.AssignedTo,B.SLA_Days,A.Name,B.Type,B.Subtype,B.Subject,B.Description,B.CreatedOn From userdata A,allrequests B Where A.Userid=B.Userid And B.RequestId='$Id'");
		$info=mysql_fetch_array($query_email) ;
		$Email=$info['Email'];
		$nameuser=$info['UserName'];
		$SLA=$info['SLA_Days'];
		$name=$info['Name'];
		$Type=$info['Type'];
		$Subtype=$info['Subtype'];
		$Subject=$info['Subject'];
		$Description=$info['Description'];
		$CreatedOn=$info['CreatedOn'];
*/		
/*
		$query_name=mysql_query("Select Name,UserName From userdata Where Email='$ReassignedTo'");
		$info=mysql_fetch_array($query_name) ;
		$ReAssignedToName=$info['Name'];
		$ReAssignedToUserName=$info['UserName'];
	*/
		/* for SLA
		$query_email=mysql_query("Select B.AsgndAdmUsrName From userdata A,tblmanager B Where A.MgrEmail=B.Email And A.Userid='$namecookie'");
		$info=mysql_fetch_array($query_email) ;
		$AssignedTo=$info['AsgndAdmUsrName'];	  
*/	
	  echo "<table width='50%' border='0' align='center' valign='middle'>
			<tr><td> 
			<br></br>
			</td></tr>
			</table>";
	  echo "<table width='55%' border='0' align='center' valign='middle'>
			<tr><td  align='center'>";			
	  echo "<label><font face='Verdana' Size='2'>Request has been successfully Rated in the system.</font>";
	  echo "</td></tr>
			</table>";
/*			
		$interval=50;
		$prevColors="#04B431";
*/
?>		
<br></br><br></br>
<!--
<table width="87%" border='0' align='right' valign='top'>
<tr><td align='center'>
	<h1 id="finalMessage" style="font-size: 12px; color:#000000; display:inline-block">Escalating Request in the system...</h1>
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
-->
<?php
/*

	echo "<script type='text/javascript'>progressBarSim(0,20,'Sending Email to the Requestor...','Request Escalated in the system.',".$interval.",'".$prevColors."','prevMessage1');</script>";
	try 
	{
		while (ob_get_level() > 0)
		ob_end_flush();
	}
	catch( Exception $e ) {}
    flush();
sleep(2);

*/
/************************************MAIL SEND*********************************************************/ 
//ini_set("include_path","C:/wamp/bin/php/php5.3.10/pear");
/*
include_once('Mail.php');
include_once('Mail/mime.php');

$mailmsg = new Mail_mime();

	$progMsg='';
	$to=$Email;
	$subject = 'Your Request No - '.$Id.' has been Escalated to '.$EscalatedTo.' in VQ portal!';
	$message = '<HTML>
				<BODY>
				<font face="Tahoma" size="2" color="44778D">Dear '.$name.',</font>
				<br></br>

				<table id="table4" width="65%" style="border:3px solid #cccccc;background:#C7F8B7;">
					<tr>
					 <td colspan="2">
					 <p><font color="0A5DAB">Please Note - Your request has been escalated to <font color="#07B7B5">'.$EscalatedToName.'(<font color="#000000"><b>'.$EscalatedToEmail.'</b></font>) </font></font>.</font></p>
					 </td>					 
					</tr>
					
					<tr>
					 <td colspan="2">
					 <p><font color="0A5DAB">You will be updated thourgh mail again, once the request is processed.</font></p>
					 </td>					 
					</tr>
					
					<tr>
					 <td colspan="2"><br />
					 <p><font color="0A5DAB">Kindly note below for further reference.</font></p>
					 </td>					 
					</tr>
				
					<tr>
					 <td><br />
					 <p><font color="#B40486" >Request No :</font></p>
					 </td>
					 <td><br />
					 <p><font color="#B40486">'.$Id.'</font></p>
					 </td>				 
					 </tr>						 			

					<tr>
					 <td>
					 <p><font color="#B40486" >Type :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$Type.'</font></p>
					 </td>				 
					 </tr>		
					 
					<tr>
					 <td>
					 <p><font color="#B40486">Subtype :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$Subtype.'</font></p>
					 </td>					 
					 </tr>
					 
					<tr>
					 <td>
					 <p><font color="#B40486">Subject :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$Subject.'</font></p>
					 </td>					 
					 </tr>	
					 
					<tr>
					 <td valign="top">
					 <p><font color="#B40486">Description :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$Description.'</font></p>
					 </td>				 
					 </tr>	
					 
					<tr>
					 <td>
					 <p><font color="#B40486">Created On :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$CreatedOn.'</font></p>
					 </td>
					 </tr>	
					 
					<tr>
					 <td>
					 <p><font color="#B40486">Expected Processing Time :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486"> '.$SLA.' days</font></p>
					 </td>				 
					 </tr>

					<tr>
					 <td colspan="2" align="center"><br /><br />
					 Click on the link to <a href="http://9.109.114.110/vqportal/"><font color="0A5DAB">Go to the VQ Portal</font></a>
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
					<font face='Tahoma' size='2' color='06B2B0' style='background:#ffffff'>Email sent to the Requestor's registered email id(".$to.") with all information.</font>
					</td></tr>
					</table>";}
			else
			{echo "<table border='0' width='61%' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FA8201' style='background:#ffffff'>Problems occured.Couldn't send email to the Requestor's registered email id(".$to.").</font>
					</td></tr>
					</table>";
					}		

	echo "<script type='text/javascript'>progressBarSim(21,60,'Sending Email to the Escalation Manager...','Email ".htmlspecialchars($progMsg, ENT_QUOTES )." sent to the Requestor.',".$interval.",'".$prevColors."','prevMessage2');</script>";
	try 
	{
		while (ob_get_level() > 0)
		ob_end_flush();
	}
	catch( Exception $e ) {}
    flush();
sleep(3);	
*/
/************************************MAIL SENT*********************************************************/ 
/************************************MAIL SEND TO Reassigned To*********************************************************/ 
/*
include_once('Mail.php');
include_once('Mail/mime.php');

$mailmsg = new Mail_mime();
	$progMsg='';
	$to=$EscalatedToEmail;
	$subject = 'Request No - '.$Id.' Escalated to You in VQ portal!';
	$message = '<HTML>
				<BODY>
				<font face="Tahoma" size="2" color="44778D">Dear '.$EscalatedToName.',</font>
				<br></br>

				<table id="table4" width="65%" style="border:3px solid #cccccc;background:#C7F8B7;">
					<tr>
					 <td colspan="2">
					 <p><font color="0A5DAB">Please Note: Request No-'.$Id.' has been escalated to you.</font></p>
					 </td>					 
					</tr>
										
					<tr>
					 <td colspan="2">  <br />	
					 <p><font color="#0A5DAB">Request details are as below,</font></p>
					 </td>					 
					</tr>
				
					<tr>
					 <td><br />
					 <p><font color="#B40486" >Request No :</font></p>
					 </td>
					 <td><br />
					 <p><font color="#B40486">'.$Id.'</font></p>
					 </td>				 
					 </tr>						 			

					<tr>
					 <td>
					 <p><font color="#B40486" >Type :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$Type.'</font></p>
					 </td>				 
					 </tr>		
					 
					<tr>
					 <td>
					 <p><font color="#B40486">Subtype :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$Subtype.'</font></p>
					 </td>					 
					 </tr>
					 
					<tr>
					 <td>
					 <p><font color="#B40486">Subject :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$Subject.'</font></p>
					 </td>					 
					 </tr>	
					 
					<tr>
					 <td valign="top">
					 <p><font color="#B40486">Description :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$Description.'</font></p>
					 </td>				 
					 </tr>	

					 <tr>
					 <td>
					 <p><font color="#B40486">Created On :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$CreatedOn.'</font></p>
					 </td>
					 </tr>	
					 
					<tr>
					 <td>
					 <p><font color="#B40486">Expected Processing Time :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486"> '.$SLA.' days</font></p>
					 </td>				 
					 </tr>

					<tr>
					 <td colspan="2"><br /><br />
					 <p><font color="#44778D">YOU\'RE REQUIRED AND IT\'S MANDATORY TO CHANGE THE STATUS OF THE REQUEST IN THE VQ PORTAL ONCE YOU PROCESS THE REQUEST.</font></p>
					 </td>					 
					</tr>
					
					<tr>
					 <td colspan="2" align="center"><br /><br />
					 Click on the link to <a href="http://9.109.114.110/vqportal/"><font color="0A5DAB">Go to the VQ Portal</font></a>
					 </td>					 
					</tr>
					
					<tr>
					 <td colspan="2"><br /><br />
					 <p><font color="#FF0000">DO NOT REPLY TO THIS MESSAGE</font></p>
					 </td>					 
					</tr>

					<tr>
					 <td colspan="2">
					 <p><font color="#FF0000">For further assistance and help in need, please reach out to your manager.</font></p>
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
	

			if ($mailsent)
			{echo"<table border='0' width='63%' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='06B2B0' style='background:#ffffff'>Email sent to the Escalation Manager's registered email id(".$to.") with all information.</font>
					</td></tr>
					</table>";}
			else
			{echo "<table border='0' width='64%' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FA8201' style='background:#ffffff'>Problems occured.Couldn't send email to the Escalation Manager's registered email id(".$to.").</font>
					</td></tr>
					</table>";
					}

	echo "<script type='text/javascript'>progressBarSim(61,100,'Process Completed','Email ".htmlspecialchars($progMsg, ENT_QUOTES )." sent to the Escalation Manager.',".$interval.",'".$prevColors."','prevMessage3');</script>";
	try 
	{
		while (ob_get_level() > 0)
		ob_end_flush();
	}
	catch( Exception $e ) {}
    flush();
sleep(3);	
*/
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