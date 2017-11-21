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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
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

<body width="100%" border="0">

<?php
  $time = time();

  // Check if there is a cookie, if there isn't then exit!
  if (!isset($_COOKIE['cookie_info'])) {
      include("index.php");
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
	  
          include("baseframe.php");	  

?>

<table class='header' width='800' align='center'>
<tr><td height='36'><td/>
<b><center><font valign='middle'>Change Password</font></b>
<tr/>
</table>
<br><br/>

<?php		  
          // Use cookie and Extract the cookie data (Username and Password)
          $cookie_info = explode("-", $_COOKIE['cookie_info']);
          $namecookie = $cookie_info[0];
          $passcookie = $cookie_info[1];

          // Variables that data come from the form
          $oldpass =  $_POST["oldpassword"];
          $newpass = $_POST["newpassword"];
          $newpassagain = $_POST["newpasswordagain"];

          // Check if each section has been completed
          if ((!$oldpass) || (!$newpass) || (!$newpassagain)) {
 			echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>You didn't submit the following required information:</font>
					</td></tr>
					</table>";		 		  
              if(!$oldpass) {
 			echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>Please enter Current Password</font>
					</td></tr>
					</table>";		 			  
              }
              if(!$newpass) {
 			echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>Please enter New Password.</font>
					</td></tr>
					</table>";		 			  
              }
              if(!$newpassagain) {
 			echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>Please Conirm New Password.</font>
					</td></tr>
					</table>";		 			  
              }
	  echo "<br><br>";
      echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";
              exit(); // If there are errors then we quit this script
          }

          // MD5 old pass
          $oldpass = MD5($oldpass);

          // Get details of user from Database and put them in variables
          $query = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
          $oldpassdatabase = mysql_result($query,0,1);
		  $nameuser = mysql_result($query,0,8);
		  $name =  mysql_result($query,0,2);		  
		  $Email = mysql_result($query,0,7);

          // Compare variables and update new variables to database if changed
          $checkoldpassword = strcmp($oldpass,$oldpassdatabase);
          $checknewpassmatch = strcmp($newpass,$newpassagain);

          // Check if old passwords match
          if ($checkoldpassword !=0) {
			echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>Current Password didn't match.</font>
					</td></tr>
					</table>";		
	  echo "<br><br><br><br><br><br>";
      echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";	  
              exit();
          }

          // Check that new passwords match!
          if ($checknewpassmatch !=0) {
 			echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>New Password and Confirm New Password didn't match with each other.</font>
					</td></tr>
					</table>";
	  echo "<br><br><br><br><br><br>";
      echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";					
              exit();
          }

          // MD5 the new password
          $md5newpass = MD5($newpass);

          // Update new password if changed
          mysql_query ("UPDATE userdata SET userpass = '$md5newpass' WHERE userid = '$namecookie'");

		  
          // Delete cookie
          if (isset($_COOKIE['cookie_info'])) {
              setcookie ("cookie_info", "", $time - 3600);
          }		  
		  
		echo "<table width='50%' border='0' align='center' valign='middle'>
			<tr><td> 
			<br></br>
			</td></tr>
			</table>";
			
 		echo "<table width='80%' border='0' align='center' valign='top'>
					<tr><td align='center'><label>
					<font face='Tahoma' size='2'>Password Changed Successfully.</font>				
			</table>";		  
		  
?>		
<br></br><br></br><br></br>

<table width="90%" border='0' align='right' valign='top'>
<tr><td align='center'>
	<h1 id="finalMessage" style="font-size: 12px; color:#000000; display:inline-block">Changing Passowrd...</h1>
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

	echo "<script type='text/javascript'>progressBarSim(0,20,'Sending Email to You...','Password Changed.',".$interval.",'".$prevColors."','prevMessage1');</script>";
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
	$to=$Email;
	$subject = 'Password changed in VQ portal!';
	$message = '<HTML>
				<BODY>
				<font face="Tahoma" size="2" color="44778D">Dear '.$name.',</font>
				<br></br>

				<table id="table4" width="65%" style="border:3px solid #cccccc;background:#C7F8B7;">
			
					<tr>
					 <td colspan="2">  <br />	
					 <p><font color="#0A5DAB">Your account\'s Password changed successfully.</font></p>
					 </td>					 
					</tr>
					
					<tr>
					 <td colspan="2"><br />
					 <p><font color="0A5DAB">Kindly note below your current Password.</font></p>
					 </td>					 
					</tr>
					
					<tr>
					 <td><br />
					 <p><font color="#B40486" >User Name :</font></p>
					 </td>
					 <td><br />
					 <p><font color="#B40486">'.$nameuser.'</font></p>
					 </td>				 
					 </tr>						 			

					<tr>
					 <td>
					 <p><font color="#B40486">New Password :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$newpass.'</font></p>
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

     // If user and password are not correct print error message
	 
	 		echo "<table width='50%' border='0' align='center' valign='middle'>
			<tr><td> 
			<br></br>
			</td></tr>
			</table>";
			
 		echo "<table width='95%' border='0' align='center' valign='top'>	 
	 				<tr><td align='center'><label>
					<font face='Tahoma' size='2' color='#FF0000'>You are now logged out.</font><font color='#0A5DAB'>Click <font size='3'><a href='index.php'>here to login again.</a></font>
					</td></tr>					
			</table>";
     }
     else {
 			echo "<table width='80%' border='0' align='right' valign='top'>
					<tr><td><label>
					<font face='Tahoma' size='2'>Incorrect username/password.</font>
					</td></tr>
					</table>";		 
         exit;
     }
  }
?>