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
<title>Update In-Process Request</title>
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
  $status =  $_POST["Status"];         // Name
  $comments=mysql_real_escape_string($_POST["comments"]);    
  $Id = $_GET["reqId"];

  // Get IP Address of user
 // $ipaddress = $_SERVER["REMOTE_ADDR"];

  /* Check if all the sections are completed as a whole, then if one isn't
  filled out display the error message for that/those particular variables. */
?>

<table class='header' width="800" border="0" align="center" valign="middle">
<tr><td  height='23'>
<b><center>Update In-Process Request</font></center></b>
</td></tr>
</table>
<br></br>

<?php
	  if ((!$status) || ($comments=='Add comments here...')) {
      echo "<center><font face='Verdana' Size='2' color='FF0000'>You didn't submit the following required information:</font></center><br><br>";
      if (!$status) {
          echo "<center><font face='Verdana' Size='2' color='FF0000'>Please enter Status.</font></center>";
      }
      if ($comments=='Add comments here...') {
          echo "<center><font face='Verdana' Size='2' color='FF0000'>Please enter Comments.</font></center>";
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
	  // Check if the sequence number exists
	  $seqinuse = mysql_query("SELECT * FROM allRequests WHERE RequestId='$Id' and Status='$status'");
	  $isseqinuse = mysql_num_rows($seqinuse);
	  // If sequence number exists then print error message and exit script
	  If ($isseqinuse == 1) {
		  echo "<center><font face='Verdana' Size='2' color='FF0000'>The Status you didn't change.</font></center>";
		  echo "<center><font face='Verdana' Size='2' color='FF0000'>First change the status then Update the request.</font></center>";
		  echo "<br></br><br></br><br></br>";
		  echo "<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>";
		  exit;
		}

	if(substr($comments,-4)<>'<br>')
	{
		$comments = $comments.'<br />';
	}
	/**********attachment*********/

//Get the uploaded file information
$name_of_uploaded_file = htmlspecialchars(
    basename($_FILES["uploaded_file"]["name"]), ENT_QUOTES );

if ($name_of_uploaded_file!="")
{
if (is_uploaded_file($_FILES["uploaded_file"]["tmp_name"]))
{
	//get the file extension of the file
	$type_of_uploaded_file =
		substr($name_of_uploaded_file,
		strrpos($name_of_uploaded_file, '.') + 1);
	$size_of_uploaded_file =
		$_FILES["uploaded_file"]["size"]/1024;//size in KBs		

	//Settings
	$max_allowed_file_size = 50000; // size in KB

	if($size_of_uploaded_file > $max_allowed_file_size )
	{
	echo "<table border='0' align='center' valign='top'>
		<tr><td>
		<label><font face='Tahoma' size='2' color='FF0000'>Size of file should be less than $max_allowed_file_size(KB).</font>
		</td></tr>
		</table>";
	echo "<table border='0' align='center' valign='top'>
		<tr><td>
		<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>
		</td></tr>
		</table>";
          exit(); // If there are errors then we quit this script
	}

	//copy the temp. uploaded file to uploads folder
	$upload_folder = './Attachments/';
	$path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;

	$tmp_path = $_FILES["uploaded_file"]["tmp_name"];

	  if(!copy($tmp_path,$path_of_uploaded_file))
	  {	  
		echo "<table border='0' align='center' valign='top'>
			<tr><td>
			<label><font face='Tahoma' size='2' color='FF0000'>Error while copying the uploaded file.</font>
			</td></tr>
			</table>";
		echo "<table border='0' align='center' valign='top'>
			<tr><td>
			<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>
			</td></tr>
			</table>";
          	exit(); // If there are errors then we quit this script
	  }
}
else
{
       echo "<table border='0' align='center' valign='top'>
		<tr><td>
		<label><font face='Tahoma' size='2' color='FF0000'>Attachment couldn't be uploaded.</font>
		</td></tr>
		</table>";
	echo "<table border='0' align='center' valign='top'>
		<tr><td>
		<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>
		</td></tr>
		</table>";
          exit(); // If there are errors then we quit this script

}
}		
      // Insert the new user to the database since everything is fine
	  $reqRow = mysql_query("SELECT * FROM allrequests WHERE RequestId='$Id'");
	  
	  While($row = mysql_fetch_array($reqRow))
	  {
		$prevStatus=$row['Status'];
		$sentTo=$row['UserId'];	  
	  }
	  
		$query_email=mysql_query("Select A.Email,A.UserName,B.AssignedTo,B.SLA_Days,A.Name,B.Type,B.Subtype,B.Subject,B.Description,B.CreatedOn,B.Severity From userdata A,allrequests B Where A.Userid=B.Userid And B.RequestId='$Id'");
		$info=mysql_fetch_array($query_email) ;
		$AssignedTo=$info['AssignedTo'];	  
		$Email=$info['Email'];
		$nameuser=$info['UserName'];
		$SLA=$info['SLA_Days'];
		$name=$info['Name'];
		$Type=$info['Type'];
		$Subtype=$info['Subtype'];
		$Subject=$info['Subject'];
		$Description=$info['Description'];
		$CreatedOn=$info['CreatedOn'];
		$Severity=$info['Severity'];

		$query_name=mysql_query("Select Name,UserName From userdata Where Email='$AssignedTo'");
		$info=mysql_fetch_array($query_name) ;
		$AssignedToName=$info['Name'];
		$AssignedToUserName=$info['UserName'];

		// for Severity
		$query_Severity=mysql_query("Select * From tblseverity Where Id=$Severity");
		$infoSeverity=mysql_fetch_array($query_Severity) ;
		$SeverityDesc='('.$infoSeverity['Sequence'].')'.$infoSeverity['Description'];
				
		/* for SLA
		$query_email=mysql_query("Select B.AsgndAdmUsrName From userdata A,tblmanager B Where A.MgrEmail=B.Email And A.Userid='$namecookie'");
		$info=mysql_fetch_array($query_email) ;
		$AssignedTo=$info['AsgndAdmUsrName'];	  
*/	
      mysql_query("UPDATE allrequests SET Status='$status',Description=concat(Description,'<br />....................<br />".$username." added On ',Now(),'<br />','".mysql_real_escape_string($comments)."','..............................'),UpdatedOn=Now(),UpdatedBy='$namecookie' WHERE RequestId='$Id' ");
	  
      mysql_query("INSERT INTO tblrequestupdate(RequestNo,PrevStatus,CurrStatus,Comments,SentBy,SentTo,SentOn) VALUES('$Id','$prevStatus','$status','$comments','$namecookie','$sentTo',Now())");
      // Print Successful Creation of user message
	  
	  echo "<table width='50%' border='0' align='center' valign='middle'>
			<tr><td> 
			<br></br>
			</td></tr>
			</table>";
			
	  echo "<table border='0' align='center' valign='middle'>
			<tr><td  align='center'>";	
	
		If ($status !='Closed')			
	  {echo "<label><font face='Verdana' Size='2'>Request Status has been changed from '$prevStatus' to '<b>$status</b>'.</font>";}
	  
	  echo "</td></tr>
			<tr><td  align='center'>

			</td></tr>
			<tr><td  align='center'>";
			If ($status=='Closed')
			{echo "<label><font face='Verdana' Size='2'>Request has been closed successfully.</font>";}
			Else
			{echo "<label><font face='Verdana' Size='2'>Request has been updated successfully.</font>";}
	  echo "</td></tr>
			</table>";
	  echo "<br>";
	  
	  
		$interval=50;
		$prevColors="#04B431";		  

?>		
<br></br><br></br>

<table width="87%" border='0' align='right' valign='top'>
<tr><td align='center'>
	<h1 id="finalMessage" style="font-size: 12px; color:#000000; display:inline-block">Updating Request in the system...</h1>
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
</table>	

<?php


	echo "<script type='text/javascript'>progressBarSim(0,20,'Sending Email to the Requestor...','Request Updated in the system.',".$interval.",'".$prevColors."','prevMessage1');</script>";
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
	If ($status=='Closed') 
		{$subject = 'Your Request No - '.$Id.' is closed in VQ Portal!';}
	ElseIf ($status=='Pending')
		{$subject = 'Your Request No - '.$Id.' status has changed from "In process" to "Pending" in VQ Portal!';}
	Else {$subject = 'Your Request No - '.$Id.' status has changed in VQ Portal!';}
	$message = '<HTML>
				<BODY>
				<font face="Tahoma" size="2" color="44778D">Dear '.$name.',</font>
				<br></br>

				<table id="table4" width="65%" style="border:3px solid #cccccc;background:#C7F8B7;">';
				
	If ($status=='Closed'){
		$message .= '<tr>
					 <td colspan="2">
					 <p><font color="0A5DAB">Your Request which was assigned to RSC OPS SPOC - '.$AssignedToName.' (<font color="#000000"><b>'.$AssignedTo.'</b></font>) is closed.</font></p>
					 </td>					 
					</tr>';
		}
	ElseIf ($status=='Pending'){
		$message .= '<tr>
					 <td colspan="2">
					 <p><font color="0A5DAB">Please Note - RSC OPS SPOC - '.$AssignedToName.' (<font color="#000000"><b>'.$AssignedTo.'</b></font>) has changed back your Request No - '.$Id.' from status "In Process" to "Pending".</font></p>
					 </td>					 
					</tr>

					<tr>
					 <td colspan="2">
					 <p><font color="07B7B5">Please go to the VQ portal and respond to the pending request at the earliest!</font></p>
					 </td>					 
					</tr>
					
					<tr>
					 <td valign="top">
					 <p><font color="0A5DAB">The RSC OPS SPOC remarks : </font></p>
					 </td>	
					 <td>
					 <p><font color="FF0000">'.$comments.'</font></p>
					 </td>						 
					</tr>
					';
		}
	Else{			
		$message .= '<tr>
					 <td colspan="2">
					 <p><font color="0A5DAB">Please Note - RSC OPS SPOC - '.$AssignedToName.' (<font color="#000000"><b>'.$AssignedTo.'</b></font>) has changed your Request No - '.$Id.' status.</font></p>
					 </td>					 
					</tr>';
		}				

					
		$message .= '<tr>
					 <td colspan="2"><br />
					 <p><font color="0A5DAB">Request Details are as below,</font></p>
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
					 <td valign="top">
					 <p><font color="#B40486">Attachment :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486">'.$name_of_uploaded_file.'</font></p>
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
					 <p><font color="#B40486">Severity :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486"> '.$SeverityDesc.'</font></p>
					 </td>				 
					 </tr>';
	If ($status=='Closed'){
				$message .= '<tr>
					 <td colspan="2" align="center"><br /><br />
					 Request you to please <a href="http://9.109.114.110/vqportal/closedrequestdetailsrate.php?ReqId='.$Id.'"><font color="0A5DAB">Rate the ticket</font></a>.
					 </td>					 
					</tr>';


					}
	$message .= '<tr>
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
if($name_of_uploaded_file!="")
{$mailmsg->addAttachment($path_of_uploaded_file);}

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

	echo "<script type='text/javascript'>progressBarSim(21,100,'Process Completed.','Email ".htmlspecialchars($progMsg, ENT_QUOTES )." sent to the Requestor.',".$interval.",'".$prevColors."','prevMessage2');</script>";
	try 
	{
		while (ob_get_level() > 0)
		ob_end_flush();
	}
	catch( Exception $e ) {}
    flush();
sleep(3);	
/************************************MAIL SENT*********************************************************/ 

	if($name_of_uploaded_file!="")
	{
	$new_path_of_uploaded_file = $upload_folder . $Id . '_' . time() . '_' . $name_of_uploaded_file;
	Rename($path_of_uploaded_file,$new_path_of_uploaded_file);
	}

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