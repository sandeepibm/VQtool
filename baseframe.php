<?php
/******************************************************************************
 *   Filename:             baseframe.php
 *   Project:              Automated Operating System
 *   By:                   Saptarshi Roy
 *   Company:              IBM(I) Pvt Ltd
 *   Email:                saptroy1@in.ibm.com
 *   Version:              1.0.0
 *****************************************************************************/
?>

<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Base Frame</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />		
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />
<audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>
 
<script type="text/javascript">

var menuids=["sidebarmenu1"] //Enter id(s) of each Side Bar Menu's main UL, separated by commas

function initsidebarmenu(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
    ultags[t].parentNode.getElementsByTagName("a")[0].className+=" subfolderstyle"
  if (ultags[t].parentNode.parentNode.id==menuids[i]) //if this is a first level submenu
   ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px" //dynamically position first level submenus to be width of main menu item
  else //else if this is a sub level submenu (ul)
    ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.display="block"
    }
    ultags[t].parentNode.onmouseout=function(){
    this.getElementsByTagName("ul")[0].style.display="none"
    }
    }
  for (var t=ultags.length-1; t>-1; t--){ //loop through all sub menus again, and use "display:none" to hide menus (to prevent possible page scrollbars
  ultags[t].style.visibility="visible"
  ultags[t].style.display="none"
  }
  }
}

if (window.addEventListener)
window.addEventListener("load", initsidebarmenu, false)
else if (window.attachEvent)
window.attachEvent("onload", initsidebarmenu)

</script>
<link rel="SHORTCUT ICON" href="images/favicon2.gif">
</head>
<body >

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

          // Use cookie and Extract the cookie data (Username and Password)
          $cookie_info = explode("-", $_COOKIE['cookie_info']);
          $namecookie = $cookie_info[0];
          $passcookie = $cookie_info[1];

          // Get username from Database and it in a variable
          $query = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
          $nameuser = mysql_result($query,0,8);
		  $usergroup = mysql_result($query,0,11);
		}
		/*
		$nameuser=$_GET["usrId"];
		echo $nameuser;
          $query = mysql_query("SELECT * FROM userdata WHERE username = '".$nameuser."'");
		  $usergroup = mysql_result($query,0,11);*/		
?>

<div id="mainbody">

  <div id="topheader"><img src="images/VQlogo.gif" title="Automated Operation Requests" alt="Automated Operation Requests" border="0" />
    <ul>
	<!--
      <li class="alltkts"><a href="AllRequests.php"></a></li>
      <li class="savedtkts"><a href="#"></a></li>
      <li class="pendingtkts"><a href="#"></a></li>
      <li class="tktstatus"><a href="#"></a></li>
      <li class="logout"><a href="logout.php"></a></li> 148DC1
	  -->
	  <li class="projname"><center><h1 valign="top"><U><B>VQ Tool</B></U></h1></center></li>
<?php
	  echo "<li class='loggedinas'><p align='right'><font face='Tahoma' size='2' color='000000'>&nbsp; Logged in as <font size='3'><i> $nameuser </i></font></p></font></li>"
?>
    </ul>
  </div>


<div id="bodypan">
<div id="sidebarmenu">
<ul id="sidebarmenu1"  style="background-color: #06928F" onClick="document.getElementById('soundfile').play();">
<?php
	If ($usergroup=='End User')
	{ ?> 
		<li><a href="home.php">Home</a></li>
		<li><a href="createrequest.php">Create Requests</a></li>
		<li><a href="#">View Requests >></a>
		  <ul  style="background-color: #06928F">
		  <li><a href="allrequests.php">All  Requests</a></li>
		  <li><a href="savedrequests.php">Saved  Requests</a></li>    
		  </ul>
		</li>
		<li><a href="#">Manage Profile >></a>
			<ul  style="background-color: #06928F">
			<li><a href="editprofile.php">Edit Profile</a></li>	
			<li><a href="viewprofile.php">View Profile</a></li>
			<li><a href="changepassword.php">Change Password</a></li>
			</ul>
		</li>
		<li><a href="inprocessrequests.php">Escalate A Request</a></li>
		<li><a href="closedrequests.php">Rate A Ticket</a></li>
		<li><a href="Detail User Guide VQ Tool.pdf" target='_blank'>User Guide</a></li>		
		<li><a href="logout.php">Logout</a></li>	
<?php	}
	Elseif ($usergroup=='Super User')
	{ ?>
		<li><a href="home.php">Home</a></li>
		<li><a href="createrequest.php">Create Requests</a></li>		
		<li><a href="#">View Requests >></a>
		  <ul style="background-color: #06928F">
		  <li><a href="allrequestsadmin.php">All Requests(All)</a></li>
		  <li><a href="inprocessrequestsadmin.php">In-Process Requests(All)</a></li>
		  <li><a href="pendingrequests.php">Pending  Requests(Own)</a></li>		  
		  <li><a href="savedrequests.php">Saved  Requests(Own)</a></li>    
		  </ul>
		</li>
		<li><a href="#">Create/View Items >></a>
		  <ul style="background-color: #06928F">
		  <li><a href="createtype.php">All Types</a></li>
		  <li><a href="createsubtype.php">All Subtypes</a></li>		  
		  <li><a href="createstatus.php">All Status</a></li>
		  <li><a href="registermanager.php">All Managers</a></li>    
		  </ul>
		</li>
		<li><a href="#">Edit/Delete Items >></a>
		  <ul style="background-color: #06928F">
		  <li><a href="edittype.php">All Types</a></li>
		  <li><a href="editsubtype.php">All Subtypes</a></li>		  
		  <li><a href="editstatus.php">All Status</a></li>
		  <li><a href="editmanager.php">All Managers</a></li>    
		  </ul>		
		</li>
		<li><a href="#">Manage Profile >></a>
			<ul style="background-color: #06928F">
			<li><a href="editprofile.php">Edit Profile</a></li>	
			<li><a href="viewprofile.php">View Profile</a></li>
			<li><a href="changepassword.php">Change Password</a></li>
			</ul>
		</li>	
		<li><a href="inprocessrequests.php">Escalate A Request</a></li>	
		<li><a href="closedrequests.php">Rate A Ticket</a></li>
		<li><a href="setescalationmanager.php">Set Escalation Manager</a></li>
		<li><a href="accessrights.php">Edit Access Rights</a></li>	
		<li><a href="deleteduser.php">View Deleted User</a></li>
		<li><a href="report.php">View Report</a></li>	
		<li><a href="Detail User Guide VQ Tool.pdf" target='_blank'>User Guide</a></li>
		<li><a href="logout.php">Logout</a></li>	
<?php } 
	Elseif ($usergroup=='Super User & Manager')
	{ ?>
		<li><a href="home.php">Home</a></li>
		<li><a href="createrequest.php">Create Requests</a></li>		
		<li><a href="#">View Requests >></a>
		  <ul style="background-color: #06928F">
		  <li><a href="allrequestsadmin.php">All Requests(All)</a></li>
		  <li><a href="inprocessrequestsadmin.php">In-Process Requests(All)</a></li>
		  <li><a href="pendingrequests.php">Pending  Requests(Own)</a></li>		  
		  <li><a href="savedrequests.php">Saved  Requests(Own)</a></li>    
		  </ul>
		</li>
		<li><a href="#">Create/View Items >></a>
		  <ul style="background-color: #06928F">
		  <li><a href="createtype.php">All Types</a></li>
		  <li><a href="createsubtype.php">All Subtypes</a></li>		  
		  <li><a href="createstatus.php">All Status</a></li>
		  <li><a href="registermanager.php">All Managers</a></li>    
		  </ul>
		</li>
		<li><a href="#">Edit/Delete Items >></a>
		  <ul style="background-color: #06928F">
		  <li><a href="edittype.php">All Types</a></li>
		  <li><a href="editsubtype.php">All Subtypes</a></li>		  
		  <li><a href="editstatus.php">All Status</a></li>
		  <li><a href="editmanager.php">All Managers</a></li>    
		  </ul>		
		</li>
		<li><a href="#">Manage Profile >></a>
			<ul style="background-color: #06928F">
			<li><a href="editprofile.php">Edit Profile</a></li>	
			<li><a href="viewprofile.php">View Profile</a></li>
			<li><a href="changepassword.php">Change Password</a></li>
			</ul>
		</li>	
		<li><a href="inprocessrequests.php">Escalate A Request</a></li>	
		<li><a href="closedrequests.php">Rate A Ticket</a></li>
		<li><a href="setescalationmanager.php">Set Escalation Manager</a></li>
		<li><a href="accessrights.php">Edit Access Rights</a></li>	
		<li><a href="deleteduser.php">View Deleted User</a></li>
		<li><a href="report.php">View Report</a></li>
		<li><a href="Detail User Guide VQ Tool.pdf" target='_blank'>User Guide</a></li>
		<li><a href="logout.php">Logout</a></li>	
<?php } 
	Elseif ($usergroup=='Admin')
	{ ?>
		<li><a href="home.php">Home</a></li>
		<li><a href="createrequest.php">Create Requests</a></li>		
		<li><a href="#">View Requests >></a>
		  <ul style="background-color: #06928F">
		  <li><a href="allrequestsadmin.php">All Requests(All)</a></li>
		  <li><a href="inprocessrequestsadmin.php">In-Process Requests(All)</a></li>
		  <li><a href="pendingrequests.php">Pending  Requests(Own)</a></li>		  
		  <li><a href="savedrequests.php">Saved  Requests(Own)</a></li>    
		  </ul>
		</li>
		<li><a href="#">Create/View Items >></a>
		  <ul style="background-color: #06928F">
		  <li><a href="createtype.php">All Types</a></li>
		  <li><a href="createsubtype.php">All Subtypes</a></li>		  
		  <li><a href="createstatus.php">All Status</a></li>
		  <li><a href="registermanager.php">All Managers</a></li>    
		  </ul>
		</li>
		<li><a href="#">Edit/Delete Items >></a>
		  <ul style="background-color: #06928F">
		  <li><a href="edittype.php">All Types</a></li>
		  <li><a href="editsubtype.php">All Subtypes</a></li>		  
		  <li><a href="editstatus.php">All Status</a></li>
		  <li><a href="editmanager.php">All Managers</a></li>    
		  </ul>		
		</li>
		<li><a href="#">Manage Profile >></a>
			<ul style="background-color: #06928F">
			<li><a href="editprofile.php">Edit Profile</a></li>	
			<li><a href="viewprofile.php">View Profile</a></li>
			<li><a href="changepassword.php">Change Password</a></li>
			</ul>
		</li>
		<li><a href="inprocessrequests.php">Escalate A Request</a></li>
		<li><a href="closedrequests.php">Rate A Ticket</a></li>
		<li><a href="Detail User Guide VQ Tool.pdf" target='_blank'>User Guide</a></li>
		<li><a href="logout.php">Logout</a></li>
<?php } 	
	ElseIf ($usergroup=='Manager')
	{ ?>
		<li><a href="home.php">Home</a></li>
		<li><a href="createrequest.php">Create Requests</a></li>
		<li><a href="#">View Requests >></a>
		  <ul style="background-color: #06928F">
		  <li><a href="allrequests.php">All  Requests</a></li>
		  <li><a href="savedrequests.php">Saved  Requests</a></li>    
		  </ul>
		</li>
		<li><a href="#">Manage Profile >></a>
			<ul style="background-color: #06928F">
			<li><a href="editprofile.php">Edit Profile</a></li>	
			<li><a href="viewprofile.php">View Profile</a></li>
			<li><a href="changepassword.php">Change Password</a></li>
			</ul>
		</li>
		<li><a href="inprocessrequests.php">Escalate A Request</a></li>
		<li><a href="closedrequests.php">Rate A Ticket</a></li>
		<li><a href="Detail User Guide VQ Tool.pdf" target='_blank'>User Guide</a></li>
		<li><a href="logout.php">Logout</a></li>
<?php	}	?>
</ul>

</div>
</div>


</div>

</body>
</html>