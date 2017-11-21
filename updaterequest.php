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
<title>Update Request</title>
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

<body>

<?php

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
          $cookie_info = explode("-", $_COOKIE['cookie_info']);
          $namecookie = $cookie_info[0];
          $passcookie = $cookie_info[1];

          // Get username from Database and it in a variable
          $query = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
          $nameuser = mysql_result($query,0,8);
		  $name1 =  mysql_result($query,0,2);
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
	   	  $time = time(); 
		  $ReqId = $_GET['reqId'];
		  $Type = $_POST["Type"];            			// Type
  		  $Subtype = $_POST["Subtype"];  	 			// Subtype
		  $Subject=$_POST["Subject"];
		  $Description=$_POST["comments"];
		  $Description=mysql_real_escape_string($Description); 	
  		  $UpdatedOn = date("Y-m-d");	 // Created On


echo "<table class='header' width='800' border='0' align='center' valign='middle'>
	<tr><td  height='36'>
	<b><center>Updation of Pending Request No $ReqId</font></center></b>
	</td></tr>
	</table>
	<br></br> ";
		  
             // Check if each section has been completed
	  if ((!$Type) || (!$Subtype) || (!$Subject) || ($Description=='Add comments here...')) {
	                echo "<table border='0' align='center' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>You haven't given the following required information when submitting your request:</font>
					</td></tr>
					</table>";
          if (!$Type) {
              echo "<table border='0' align='center' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>The Type of your request.</font>
					</td></tr>
					</table>";
					}
          if (!$Subtype) {
              echo "<table border='0' align='center' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>The Subtype of your request.</font>
					</td></tr>
					</table>";
					}
          //if (!$BluePageManager) {
            //  echo "<center><font face='Tahoma' size='2' color='FF0000'>Enter the BluePageManager of your request.</font></center> <br>";
          //}
          if (!$Subject) {
              echo "<table border='0' align='center' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>The Subject of your request.</font>
					</td></tr>
					</table>";
					}
          if ($Description=='Add comments here...') {
              echo "<table border='0' align='center' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FF0000'>The Comments of your request.</font>
					</td></tr>
					</table>";
					}
              echo "<table border='0' align='center' valign='top'>
					<tr><td>					
					<br></br>
					<br></br>
					<br></br>
					<br></br>
					<br></br>
					</td></tr>
					</table>";					
		  echo "<table border='0' align='center' valign='top'>
					<tr><td>
					<a href='javascript:history.back()'><center><font size='3'>Back</font></center></a>
					</td></tr>
					</table>";
          exit(); // If there are errors then we quit this script
      }
	  
	if(substr($Description,-4)<>'<br>')
	{
		$Description = $Description.'<br />';
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
	  
		$query_email=mysql_query("Select A.Email,A.UserName,B.AssignedTo,B.Severity From userdata A,allrequests B Where A.Userid=B.Userid And B.RequestId='$ReqId'");
		$info=mysql_fetch_array($query_email) ;
		$AssignedTo=$info['AssignedTo'];	  
		$Email=$info['Email'];
		$Severity=$info['Severity'];

		$query_name=mysql_query("Select Name,UserName From userdata Where Email='$AssignedTo'");
		$info=mysql_fetch_array($query_name) ;
		$AssignedToName=$info['Name'];
		$AssignedToUserName=$info['UserName'];
	  
		// for SLA
		$query_email=mysql_query("Select * From dropdownmenus Where dropdownItemname='".mysql_real_escape_string($Type)."' AND dropdownSubItemname='".mysql_real_escape_string($Subtype)."'");
		$info=mysql_fetch_array($query_email) ;
		$SLA=$info['SLA'];

		// for Severity
		$query_Severity=mysql_query("Select * From tblseverity Where Id=$Severity");
		$infoSeverity=mysql_fetch_array($query_Severity) ;
		$SeverityDesc='('.$infoSeverity['Sequence'].')'.$infoSeverity['Description'];
				
		 mysql_query("UPDATE allrequests SET Status='In Process', Type='".mysql_real_escape_string($Type)."', Subtype='".mysql_real_escape_string($Subtype)."', Subject='".mysql_real_escape_string($Subject)."', Description=concat(Description,'<br />....................<br />".$nameuser." added On ',Now(),' <br />','".mysql_real_escape_string($Description)."','..............................'), UpdatedOn=NOW(), UpdatedBy='$namecookie' WHERE RequestId='$ReqId'") or die(mysql_error());

		 //$id = mysql_insert_id();
		 //echo "insert done";
		 
		$interval=50;
		$prevColors="#04B431";		  
		
		echo 
		"			
		 <table width='75%' border='0'  id='table1'  cellspacing='0' align='center'>
		 <tr>
		 <td colspan='2'><label><center><font face='Tahoma' size='2'>Thank you <font color='44778D'><b>$name1</b></font> for updating your pending request. You will be updated thourgh mail again, once the request is processed.</center></font></th>
		 </tr>
		 <tr><td><br></br></td></tr>
		 <tr>
		 <td colspan='2'><label><font face='Tahoma' size='2'><center> This is your updated request </center></font></td>
		 </tr>
		 </table>

		<table border='0'  id='table2'  cellspacing='0' align='center'>
        <tr>                
                <td width='60px'><b><font face='Tahoma' size='2' color='44778D'>Type:</b></td>
                <td > <label><font face='Tahoma' size='2'>$Type </font></td>
        </tr>
        <tr>                
                <td width='120'><b><font face='Tahoma' size='2' color='44778D'>Subtype:</b></td>
                <td> <label><font face='Tahoma' size='2'>$Subtype </font></td>
        </tr>

        <tr>               
                <td width='120'><b><font face='Tahoma' size='2' color='44778D'>Subject:</b></td>
                <td> <label><font face='Tahoma' size='2'>$Subject</font></td>
        </tr>
        <tr>               
                <td width='120' valign='top'><b><font face='Tahoma' size='2' color='44778D' >Comments:</b></td>
                <td> <label><font face='Tahoma' size='2'>$Description </font></td>
        </tr>
        <tr>                
                <td width='120'><b><font face='Tahoma' size='2' color='44778D'>Severity :</b></td>
                <td> <label><font face='Tahoma' size='2'>$SeverityDesc </font></td>
        </tr>
        <tr>                
                <td width='120'><b><font face='Tahoma' size='2' color='44778D'>Updated On:</b></td>
                <td> <label><font face='Tahoma' size='2'>$UpdatedOn </font></td>
        </tr>
		<tr><td><br></br></td></tr>
		</table>
		
		<table width='75%' border='0'  id='table3'  cellspacing='0' align='center'>
		<tr>
		<td colspan='2'><label><font face='Tahoma' size='2'><center>You've updated the Request Number <font color='B40486'><b> $ReqId </b></font>. Kindly note this for your further reference.</center></font></td>
		</tr>
        </table>	
		";
		
?>		
<br></br><br></br>

<table width="87%" border='0' align='right' valign='top'>
<tr><td align='center'>
	<h1 id="finalMessage" style="font-size: 12px; color:#000000; display:inline-block">Submitting Request in the system...</h1>
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


	echo "<script type='text/javascript'>progressBarSim(0,20,'Sending Email to You...','Request Updated in the system.',".$interval.",'".$prevColors."','prevMessage1');</script>";
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
	$subject = 'Pending Request#-'.$ReqId.' Updated in VQ portal!';
	$message = '<HTML>
				<BODY>
				<font face="Tahoma" size="2" color="44778D">Dear '.$name1.',</font>
				<br></br>

				<table id="table4" width="65%" style="border:3px solid #cccccc;background:#C7F8B7;">
					<tr>
					 <td colspan="2">
					 <p><font color="0A5DAB">Thank you for updating your request.</font></p>
					 </td>					 
					</tr>
					
					<tr>
					 <td colspan="2">  <br />	
					 <p><font color="#07B7B5">Your updated request has been assigned to RSC OPS SPOC - '.$AssignedToName.' (<font color="#000000"><b>'.$AssignedTo.'</b></font>).</font></p>
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
					 <p><font color="#B40486">'.$ReqId.'</font></p>
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
					 <p><font color="#B40486">'.$UpdatedOn.'</font></p>
					 </td>
					 </tr>	
					 
					<tr>
					 <td>
					 <p><font color="#B40486">Severity :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486"> '.$SeverityDesc.'</font></p>
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
					<font face='Tahoma' size='2' color='06B2B0' style='background:#ffffff'>Email sent to your registered email id(".$to.") with all information.</font>
					</td></tr>
					</table>";}
			else
			{echo "<table border='0' width='61%' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FA8201' style='background:#ffffff'>Problems occured.Couldn't send email to your registered email id(".$to.").</font>
					</td></tr>
					</table>";
					}		

	echo "<script type='text/javascript'>progressBarSim(21,60,'Sending Email to the Assigned Person...','Email ".htmlspecialchars($progMsg, ENT_QUOTES )." sent to You.',".$interval.",'".$prevColors."','prevMessage2');</script>";
	try 
	{
		while (ob_get_level() > 0)
		ob_end_flush();
	}
	catch( Exception $e ) {}
    flush();
sleep(3);	
/************************************MAIL SENT*********************************************************/ 
/************************************MAIL SEND TO ADMIN*********************************************************/ 

include_once('Mail.php');
include_once('Mail/mime.php');

$mailmsg = new Mail_mime();
	$progMsg='';
	$to=$AssignedTo;
	$subject = ' Request Assigned to you is updated in VQ Portal!____'.$ReqId;
	$message = '<HTML>
				<BODY>
				<font face="Tahoma" size="2" color="44778D">Dear '.$AssignedToName.',</font>
				<br></br>

				<table id="table4" width="65%" style="border:3px solid #cccccc;background:#C7F8B7;">
					<tr>
					 <td colspan="2">
					 <p><font color="0A5DAB">Please Note - The Request No '.$ReqId.' is updated.</font></p>
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
					 <p><font color="#B40486">'.$ReqId.'</font></p>
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
					 <p><font color="#B40486">'.$UpdatedOn.'</font></p>
					 </td>
					 </tr>	
					 
					<tr>
					 <td>
					 <p><font color="#B40486">Severity :</font></p>
					 </td>
					 <td>
					 <p><font color="#B40486"> '.$SeverityDesc.'</font></p>
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
	

			if ($mailsent)
			{echo"<table border='0' width='63%' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='06B2B0' style='background:#ffffff'>Email sent to the assigned person's registered email id(".$to.") with all information.</font>
					</td></tr>
					</table>";}
			else
			{echo "<table border='0' width='64%' align='right' valign='top'>
					<tr><td>
					<font face='Tahoma' size='2' color='FA8201' style='background:#ffffff'>Problems occured.Couldn't send email to the assigned person's registered email id(".$to.").</font>
					</td></tr>
					</table>";
					}
					
/************************************MAIL SENT*********************************************************/ 

	echo "<script type='text/javascript'>progressBarSim(61,100,'Process Completed.','Email ".htmlspecialchars($progMsg, ENT_QUOTES )." sent to the Assigned Person.',".$interval.",'".$prevColors."','prevMessage3');</script>";
	try 
	{
		while (ob_get_level() > 0)
		ob_end_flush();
	}
	catch( Exception $e ) {}
    flush();
sleep(3);	

	if($name_of_uploaded_file!="")
	{
	$new_path_of_uploaded_file = $upload_folder . $ReqId . '_' . time() . '_' . $name_of_uploaded_file;
	Rename($path_of_uploaded_file,$new_path_of_uploaded_file);
	}
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