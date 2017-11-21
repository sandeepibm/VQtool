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
<title>Forgot Password</title>
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

<body width="100%" border="0">

<?php
/*
  $time = time();

  // Check if there is a cookie, if there isn't then exit!
  if (!isset($_COOKIE['cookie_info'])) {
      include("Index.php");
      exit;
  }

  // If there is a cookie, validate the cookie
  else {
*/
      // Use Connect Script
      include("connect.php");
	  include("outerbaseframe.php");
/*
      // Include the validation of user file
      include("validateuser.php");

      // If user and password are correct
      if (validateuser() == true) {
	  
          include("BaseFrame.php");	  
*/
?>
<br></br>
<br></br>
<table width='800' align='center' >
<tr><td height='21'><td/>
<b><center><U><font face='Verdana' Size='3' valign='middle' color='4aafdc'>Forgot Password</font></U></center></b>
<tr/>
</table>
<br><br/>

<?php		  
/*
          // Use cookie and Extract the cookie data (Username and Password)
          $cookie_info = explode("-", $_COOKIE['cookie_info']);
          $namecookie = $cookie_info[0];
          $passcookie = $cookie_info[1];
*/
		//Creating alpha-numeric pwd
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		
		 $string = '';
		 for ($i = 0; $i < 8; $i++) {
			  $string .= $characters[rand(0, strlen($characters) - 1)];
		 }

		
          // Variables that data come from the form
          $username =  $_POST["usrname"];
          $newpass = $string;
          //$newpassagain = $_POST["newpasswordagain"];
		  $md5pass = MD5($newpass);
		  $userid = MD5($username);

		  
		  
          // Check if each section has been completed
          if (!$username) {
 			echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>You didn't submit the following required information:</font>
					</td></tr>
					</table>";		 		  
              if(!$username) {
 			echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>Please enter UserName.</font>
					</td></tr>
					</table>";		 			  
              }
			echo "<table width='60%' border='0' align='center' valign='top'>
					<tr><td> <br><br> </td></tr>";
      echo "<tr><td> <a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>
			</td></tr></table>";
              exit(); // If there are errors then we quit this script
          }
/*
          // MD5 old pass
          $oldpass = MD5($oldpass);

          // Get details of user from Database and put them in variables
          $query = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
          $oldpassdatabase = mysql_result($query,0,1);

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
              exit();
          }

          // Check that new passwords matches with confirm new password!
		  $checknewpassmatch = strcmp($newpass,$newpassagain);
		  echo "<br></br><br></br><br></br>";
          if ($checknewpassmatch !=0) {
 			echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>New Password and Confirm New Password didn't match with each other.</font>
					</td></tr>
					</table>";
	  echo "<br><br>";
      echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";					
              exit();
          }
*/		  
		  // Check if the username exists
		  $usernameinuse = mysql_query("SELECT * FROM userdata WHERE userId = '$userid'");
		  $isusernameinuse = mysql_num_rows($usernameinuse);

		  // If username exists then print error message and exit script
		  If ($isusernameinuse == 0) 
		  {
 			echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>Username doesn't exist.</font>
					</td></tr>
					</table>";
	  echo "<br><br>";
      echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";					
              exit();		  
		  }
		  Else
		  {
		  $userdata=mysql_fetch_array($usernameinuse);
		  $Email=$userdata['Email'];
		  $name=$userdata['name'];		  
		  }
/*
          // MD5 the new password
          $newpass = MD5($newpass);

          // Update new password if changed
          mysql_query ("UPDATE userdata SET userpass = '$newpass' WHERE userid = '$namecookie'");

          // Delete cookie
          if (isset($_COOKIE['cookie_info'])) {
              setcookie ("cookie_info", "", $time - 3600);
          }	
*/		  
		  
		// Update new password if changed
          mysql_query ("UPDATE userdata SET userpass = '$md5pass' WHERE userId = '$userid'");

 		echo "<table width='90%' border='0' align='right' valign='top'>
					<tr><td align='center'>
					<font face='Tahoma' size='2' color='0A5DAB'>Password has been Reset. An email has sent to your registered email id with new password.</font>
					</td></tr>				
			</table>";		  
		  
?>		
<br></br><br></br><br></br>

<table width="90%" border='0' align='right' valign='top'>
<tr><td align='center'>
	<h1 id="finalMessage" style="font-size: 12px; color:#000000; display:inline-block">Changing Password...</h1>
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

	echo "<script type='text/javascript'>progressBarSim(0,20,'Sending Email to You...','Password Reset.',".$interval.",'".$prevColors."','prevMessage1');</script>";
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
	$subject = 'Password reset in VQ portal!';
	$message = '<HTML>
				<BODY>
				<font face="Tahoma" size="2" color="44778D">Dear '.$name.',</font>
				<br></br>

				<table id="table4" width="65%" style="border:3px solid #cccccc;background:#C7F8B7;">
			
					<tr>
					 <td colspan="2">  <br />	
					 <p><font color="#0A5DAB">Your account\'s Password reset successfully.</font></p>
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
					 <p><font color="#B40486">'.$username.'</font></p>
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
			{echo"<table border='0' width='58%' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='0A5DAB' style='background:fff'>Email sent to your email id(".$to.") with all information.</font>
					</td></tr>
					</table>";}
			else
			{echo "<table border='0' width='59%' align='right' valign='top'>
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
/*
     // If user and password are not correct print error message
     }
     else {
 			echo "<table width='60%' border='0' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>Incorrect username/password.</font>
					</td></tr>
					</table>";		 
         exit;
     }
  }
*/  
				echo"<table width='90%' border='0' align='right' valign='top'>
					<tr><td align='center'><br></br></td></tr>
					<tr><td align='center'> ";
?>					
					<font face='Tahoma' size='3' color='0A5DAB'><a href='index.php' onClick="document.getElementById('soundfile').play();">Click here to login.</a></font>
<?php				echo " </td></tr>					
			</table>";
?>