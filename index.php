<?php/****************************************************************************** *   Filename:             index.php *   Project:              Automated Operating System *   By:                   Saptarshi Roy *   Company:              IBM(I) Pvt Ltd *   Email:                saptroy1@in.ibm.com *   Version:              1.0.0 *****************************************************************************/?><html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8">		<title>LOGIN</title><link rel="stylesheet" type="text/css" href="css/style.css" />		<link rel="stylesheet" type="text/css" href="css/styles.css" />	<link href="css/body.css" rel="stylesheet" type="text/css" /><audio id="soundfile" src="audio/click.ogg" type="audio/ogg"> </audio>		<style type="text/css">		/* CSS RESET *//* HTML, BODY, GENERAL SETUP */html { 	background: #ffffff ;  	text-align: center; 	align: center;}body { 	text-align: center;  	font: 12px 'Lucida Grande',lucida,helvetica,arial,sans-serif;  	color: #ffffff;  	padding: 0px;  	margin: 0 auto; 		width: 1840px; }#wrappertop{	width: 800px;	height: 100px;	padding: 0 20px 0 20px;	margin-top: -30px;}#content{	width: 800px;	background-color: #657383;	text-align: left;  background: -moz-linear-gradient(top, #657383, #cccccc);  background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#657383), to(#cccccc));		}/* HEADER */#header {	width: 780px; 	background: #c5e6ea;	padding: 25px 0 5px 20px;	border-bottom: #b2ccd0 solid 1px; background: -moz-linear-gradient(top, #cccccc, #657383);  background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#cccccc), to(#657383));		}#darkbanner{	margin: 20px 0 0 -18px;	padding: 8px 10px 10px 40px;	background: #424242;	position: relative;background: -moz-linear-gradient(left, #585858, #cccccc);  background: -webkit-gradient(linear, 0% 0%, 100% 0%, from(#585858), to(#cccccc));	-moz-border-radius: 0px 10px 10px 0px; -webkit-border-radius: 0px 10px 10px 0px;  border-radius: 0px 10px 10px 0px;}#darkbannerwrap{	background: url(images/aiwrap.png);	width: 18px;	height: 10px;	margin: 0 0 20px -18px;	position: relative;}.banner320{	width: 520px;}h2{	font: bold 24px helvetica, arial, sans-serif;	color: #ffffff;	display: inline;	margin-left: 10px;}/* LOGIN */body#login {  	width: 100%;	height: 100%;}body#login #wrappertop{	width: 520px;}body#login #wrapperbottom{	width: 520px;}   body#login #wrapper{	width: 620px;	padding: 0px 20px 0px 520px;	left: 500px;}body#login #content{	width: 620px;}body#login #header {	width: 600px;	left: 400px;}body#login label{	float: left;	text-align: right;	text-valign: top;		width: 80px;	height: 20px;	font-weight: bold;	margin-right: 10px;	padding-top: 7px;	background-color: #657383;background: -moz-linear-gradient(top, #657383, #cccccc);  background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#657383), to(#cccccc));		color: #CCC;	font-size: 12px;}body#login input{	height: 25px;	width: 450px;	_width: 237px;	margin-bottom: 15px;	padding: 3px;	font: 16px 'Lucida Grande', arial, sans-serif;}body#login button{	left: 20px;}</style></head><?phpinclude("outerbaseframe.php");?>	<body id="login" onload="document.forms['form1'].elements['user'].focus();">	      <div id="wrappertop"></div>			<div id="wrapper">					<div id="content">						<div id="header" align="center">							<h2>~ WE ADDRESS YOUR QUERIES ~</h2>						</div>						<div id="darkbanner" class="banner320">							<h2>LOGIN</h2>						</div>						<div id="darkbannerwrap">						</div>						<form name="form1" action="login.php" method="POST">                        	<p>								<font face="COURIER NEW" color="#fff" style="font-size:16px;">&nbsp;Username:</font>								<input name="user" id="user_name" type="text">							</p>							<p>								<font face="COURIER NEW" color="#fff" style="font-size:16px;">&nbsp;Password:</font>								<input name="pass" id="user_password" type="password">													 							</p>														<p>							<center><button type="submit" name="Submit" onClick="document.getElementById('soundfile').play();"><span><img src="images/key.png">&nbsp;&nbsp;Login</button></span>									<button type="reset" name="Reset" onClick="document.getElementById('soundfile').play();">													 <span>Reset</span></button></center>							</p>							<p>&nbsp;&nbsp;</p>							<p><font size="2" color="#0A5DAB">&nbsp;&nbsp;Forgot Password?&nbsp;<a href="forgotpassword.php" onClick="document.getElementById('soundfile').play();"><font size="2" color="#0A5DAB"><i>Click Here</i></font></a></p>													&nbsp;&nbsp;					</form></div>				</div>					<br></br>		<p><font face="COURIER NEW" size="2" color="#000000" >&nbsp;&nbsp;&nbsp;&nbsp;If you are not a registered user then please <a href="registeruser.php" onClick="document.getElementById('soundfile').play();"><B>Sign Up</B></a> to create your Account</font></p>	</body>		</br></br>		<p><font face="COURIER NEW" size="3" color="#074784" >||Best viewed in Mozilla Firefox or Google Chrome and 1600x900 Resolution||</p></html>