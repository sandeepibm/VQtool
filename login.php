<?php
/******************************************************************************
 *   Filename:             login.php
 *   Project:              Automated Operating System
 *   By:                   Saptarshi Roy
 *   Company:              IBM(I) Pvt Ltd
 *   Email:                saptroy1@in.ibm.com
 *   Version:              1.0.0
 *****************************************************************************/

 

      // Variables that data come from the form
      $usernamereal = $_POST["user"];
      $password = $_POST["pass"];
	  
	  include("outerbaseframe.php");
      // Check if username and password where submitted
      if (!$usernamereal) {
          echo "<p align='center'><font size='3' color='FF0000'> Please enter username </p> <p align='center'><a href='javascript:history.back()'> GO BACK </a></font></p>"; exit;
      }
      if (!$password) {
          echo "<p align='center'><font size='3' color='FF0000'> Please enter password </p> <p align='center'><a href='javascript:history.back()'> GO BACK </a></font></p>"; exit;
      }

      // Use Connect Script
      include("connect.php");

      // MD5 Username and Password
      $username = MD5($usernamereal);
      $password = MD5($password);

      // Check if username exists. If not then say no such username.
      $issuchusername = mysql_query("SELECT * FROM userdata WHERE userid = '$username'");
      $usernamelogin = mysql_num_rows($issuchusername);
      $firstloginhere = 0;

      // If username exists
      if ($usernamelogin == 1) {

          $issuchpassword = mysql_query("SELECT * FROM userdata WHERE userid = '$username' AND userpass = '$password'");
          $passwordlogin = mysql_num_rows($issuchpassword);

          // If password is correct
          if ($passwordlogin == 1) {

              // Get the current time and make the cookie
              $time = time();
              $cookie_data = $username.'-'.$password;
			  			  
              if (setcookie ("cookie_info",$cookie_data, time()+3600)==TRUE) 
				{
					              header("Location: home.php");
				}
              else 
				{
					              header("Location: home.php");
					echo "<font color='FF0000'>You computer does not support cookies. <BR> To view other pages after logged in you need to have cookies enabled.<BR></font>";
				}

              // Since this is the first time of login, cookies aren't readable yet
              //$firstloginhere = 1;

              // Header

              //include("header.php");
              //firstlogin($username); // Allows the header to work without cookies
          }
          else {
              echo "<p align='center'><font size='3' color='FF0000'> Incorrect Password <a href='javascript:history.back()'> GO BACK </a></font></p>";
              exit;
          }
      }
      else {
          echo "<p align='center'><font size='3' color='FF0000'> Incorrect Username <a href='javascript:history.back()'> GO BACK </a></font></p>";
          exit;
      }

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Login</title>

<?php

  // Use cookie and Extract the cookie data (Username and Password)
  $cookie_info = explode("-", $_COOKIE['cookie_info']);
  $namecookie = $cookie_info[0];
  $passcookie = $cookie_info[1];

  // If no cookies are set then rename the username and password variables
  if (!isset($_COOKIE['cookie_info'])) {
      $namecookie = $_POST["user"];
      $passcookie = $_POST["pass"];

      // MD5 Username and Password
      $namecookie = MD5($namecookie);
      $passcookie = MD5($passcookie);
  }

  // Check if username exists. If not then say no such username.
  $issuchusername = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
  $usernamelogin = mysql_num_rows($issuchusername);

  // If username exists
  if ($usernamelogin == 1) {
      $issuchpassword = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie' AND userpass = '$passcookie'");
      $passwordlogin = mysql_num_rows($issuchpassword);

      // If password is correct
      if ($passwordlogin == 1) {

          // User is now logged in, display details of user
          // Get details of user from Database and put them in variables
          $query = mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'");
          $nameuser = mysql_result($query,0,8);

          // If it was a cookie login, use the normal header function
          //if ($firstloginhere == 0) {
              // Header
              //include("Home.php");
          //}

          //echo "<CENTER><font face='Verdana'><B>Logged in as $nameuser</B></CENTER><BR><BR>";

      // If user and password are not correct print error message
      }
      else {
          echo "<p align='center'><font size='3'>Incorrect username/password <a href='index.php'> GO BACK </a></font></p>";
          exit;
      }
  }
  else {
      echo "<p align='center'><font size='3'>Incorrect username/password <a href='index.php'> GO BACK </a></font></p>";
      exit;
  }
  // End Login

?>

</body>
</html>