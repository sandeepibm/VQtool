<?php
/******************************************************************************
 *   Filename:             home.php
 *   Project:              Automated Operating System
 *   By:                   Saptarshi Roy
 *   Company:              IBM(I) Pvt Ltd
 *   Email:                saptroy1@in.ibm.com
 *   Version:              1.0.0
 *****************************************************************************/
 ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VQ Portal</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/body.css" rel="stylesheet" type="text/css" />

<style type="text/css">
h3
{

background:url(../images/horizontal_line.jpg) 0 0 no-repeat;
position:relative;
animation:myfirst 5s linear 2s infinite alternate;
/* Firefox: */
-moz-animation:myfirst 5s linear 2s infinite alternate;
/* Safari and Chrome: */
-webkit-animation:myfirst 5s linear 2s infinite alternate;
}

@keyframes myfirst
{
0%   {background: left:0px; top:0px;}
25%  {background: left:200px; top:0px;}
50%  {background: left:200px; top:200px;}
75%  {background: left:0px; top:200px;}
100% {background: left:0px; top:0px;}
}

@-moz-keyframes myfirst /* Firefox */
{
0%   {background: left:0px; top:0px;}
25%  {background: left:200px; top:0px;}
50%  {background: left:200px; top:200px;}
75%  {background: left:0px; top:200px;}
100% {background: left:0px; top:0px;}
}

@-webkit-keyframes myfirst /*Safari and Chrome */
{
0%   {background:url(../images/horizontal_line.jpg) 0 0 no-repeat; left:0px; top:0px;}
25%  {background:yellow; left:200px; top:0px;}
50%  {background:blue; left:200px; top:200px;}
75%  {background:green; left:0px; top:200px;}
100% {background:red; left:0px; top:0px;}
}
</style>

</head>
<body>

<div>
<?php
//$username=$_GET['usrId'];	
include("baseframe.php");
include("connect.php");
?>
</div>

<div id="mainbody">
	<div id="sidebarmenu">
	</div>
  <div id="topback">
    <h2>welcome</h2>
    <p><span><marquee behavior="alternate">VQ Tool</marquee></span><br/>
      <font size="2">Automation is excellent at anywhere in the industry. So, we've thought about the same. Now you can search for business operation related best solutions by placing your request in this portal.</font></p>
    <ul>
      <!--li><a href="#">Dolores et ea consetetur sadi </a></li>
      <li><a href="#">pscing elit consetetur pscing elitr,</a></li>
      <li><a href="#">sed diam nonumy consetetur sadi </a></li>
      <li><a href="#">pscing elit consetetur pscing</a></li>
      <li><a href="#">elitr, sed diam nonumy consetetur </a></li-->
    </ul>
  <!--  <ul class="ask">
      <li><a href="CreateRequest.php" title="Create Request">link</a></li>
    </ul> -->
  </div>
  

  
  <div id="bodypan">
  <!--
    <div id="leftpan">
      <h2>text</h2>
      <ul>
        <li class="arrow"> 
		<?php  
		$my_t=date('l, F jS, Y');
		Print ("$my_t");
		?> </li>
        <li><span>one of the request on the day <a href="#">| more</a></li>
        <li class="arrow">
		<?php  
		$my_t=date('l, F jS, Y');
		Print ("$my_t");
		?> </li>
        <li><span>one of the request on the day <a href="#">| more</a></li>
      </ul>
    </div>
    <div id="middlepan">
      <h2>text</h2>
      <h3>image</h3>
      <p><span>We are here to help you guys regarding the issues about 'Timesheet', 'Reports', 'Facilities & IS' and <a href="#">| more</a> <br />
        <br />
        some description of requests performed by the team...........</p>
    </div>
	<div id="leftpan"></div>
	-->
    <div id="rightpan">
      <h2></h2>
      <p style="background:#FFF"><span><font size="2" >We, the RSC Business Operations Team, consists of </font></span><font size="2" color="484848">
<?php	  $Query = mysql_query("SELECT Sequence,Name,Designation,Introduction FROM tblteammembers ORDER BY Sequence");

	 while ($member = mysql_fetch_array($Query))
 {
echo "".htmlspecialchars($member['Name'], ENT_QUOTES ).", ";
}
echo "...";
?>	  
	  </font></p>
<?php	  $Query = mysql_query("SELECT Sequence,Name,Designation,Introduction FROM tblteammembers ORDER BY Sequence");
	 while ($member = mysql_fetch_array($Query))
 {
echo "
      <div id='img".htmlspecialchars($member['Sequence'], ENT_QUOTES )."'>
        <p style='background: -moz-linear-gradient(top, #D6D6D6, #ffffff);background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#D6D6D6), to(#ffffff)); -moz-border-radius: 0px 10px 10px 0px; -webkit-border-radius: 0px 10px 10px 0px;border-radius: 0px 10px 10px 0px;'><font color='484848' size='2'> &nbsp Hi, I'm <font color='444'><b>".htmlspecialchars($member['Name'], ENT_QUOTES )."</b></font>, <br><font color='067977'> &nbsp ".htmlspecialchars($member['Designation'], ENT_QUOTES )." @ RSC Business Operations Industry Solutions.</font></font></p>
		<p><font color='D68331' size='2'><br> &nbsp I'm the SPOC for the managers </font><font color='484848' size='2'>".$member['Introduction']." </font><a href='#'>| more</a></p>
      </div>
";
	  }
?>

  <table width="100%"><tr height="20px"><td><br></br></td></tr></table>
	  </div>
  </div>

  <div id="footer"><br></br>
<!--  <img src="images/copyright1.jpg" title="Automated Operation Requests" alt="Automated Operation Requests" border="0" /> -->

  <p align="right" valign="top">RSC Business Operations internal Tool</p>
  </div>
<?php

//header("Location: BaseFrame.php?usrId=".$username);

  // Function firstlogin. This function is used when the user is logging on
  // and cookies are created, but cookies don't work until they refresh the page
  // so this function gets the name of the user and then checks the users level
  // to see if they are the admin, item manager or staff and then displays
  // that users controls.
?>

</body>
</html>