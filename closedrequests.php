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
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>

<title>Closed Requests</title>
</head>

<body>


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
          $cookie_info = explode("-", $_COOKIE['cookie_info']);
          $namecookie = $cookie_info[0];
          $passcookie = $cookie_info[1];

          // Get username from Database and it in a variable
          $query = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
          $nameuser = mysql_result($query,0,8);

  // Check the level of the user
  //$checklevel = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
  //$checklevel1 = mysql_result($checklevel,0,9);

  // If the user is the admin
  //if ($checklevel1 == 1) {
?>

<!--
<table width="75%" border="0" align="right" valign="top">
<tr><td>
<img src="images/horizontal_line.jpg" width=81% border="0">
</td></tr>
</table>
-->

<table class="header" width="800" border="0" align="center" valign="middle">
<tr><td height='23'>
<?php echo "<b><center>Closed Tickets of $nameuser </font></center></b>"; ?>
</td></tr>
</table>
<br></br>

  
<?php

      //$deleteuser = $_POST["selectuser"]; // User selected to delete
	  $result=mysql_query("SELECT A.RequestId,B.UserName,A.AssignedTo,A.Type,A.Subtype,A.Subject,A.SLA_Days,A.CreatedOn,A.Status,A.Rating FROM allrequests A,userdata B WHERE A.UserId = B.UserId AND B.UserId = '$namecookie' AND A.Status='Closed' ORDER BY A.CreatedOn DESC") or die(mysql_error());

	  ?>

<table border="0" align="center" valign="top">
<tr><td style='background:#FFF'><center>
<p align="center"><font face='Tahoma' size='2' color='B40486'>Click on the <i> Link </i> to rate the ticket.</font></p></center>
</td></tr>
</table>
<br></br>

<!-- <center><a href="exporttoexcel.php">Export Report to Excel</a></center> -->
<table border="1" id="table4" class='stats' colspace='0' align="center" width=85%>
        <tr>
		<th >Request No</th><th >Creator</th><th >Assigned To</th><th >Rate Ticket</th><th>Type</th><th>Subtype</th><th>Subject</th><th>Request Date</th><th>Status</th>  
		</tr><tr>
		<?php
			//echo "$nameuser";
			//$value = $_POST['posts'];
			while($row=mysql_fetch_array($result)){
				echo "</td><td width=10%>";
				echo $row[0];
				echo "</td><td width=5%>";
				echo $row[1];				
				echo "</td><td width=7%>";
				echo $row[2];
				echo "</td><td width=12%>";
			if (!$row[9])
				{?> <a href='closedrequestdetailsrate.php?ReqId=<?php echo "$row[0]" ; ?> ' title='Click to do Rate a ticket' onClick="document.getElementById('soundfile').play();">Rate this Ticket</a> <?php ;}
			else
				{?> <a href='closedrequestdetailsrated.php?ReqId=<?php echo "$row[0]" ; ?> ' title='Click to view details of the ticket' onClick="document.getElementById('soundfile').play();">Already Rated</a> <?php ;}
				echo "</td><td width=11%>";
				echo $row[3];
				echo "</td><td width=23%>";
				echo $row[4];
				echo "</td><td width=11%>";
				echo $row[5];
				echo "</td><td width=14%>";
				echo $row[7];
				echo "</td><td width=7%>";
				echo $row[8];
				echo "</td></tr>";

		}?>
		</table>		
		<br></br>
		
<?php
  //}
  // If there was a staff to delete selected
  

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