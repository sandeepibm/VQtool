<?php
/******************************************************************************
 *   Filename:            
 *   Project:              Automated Operating System
 *   By:                   Saptarshi Roy
 *   Company:              IBM(I) Pvt Ltd
 *   Email:                saptroy1@in.ibm.com
 *   Version:              1.0.0
 *****************************************************************************/

function validateuser() {

  // Use cookie information and validate cookie
  // Use cookie and Extract the cookie data (Username and Password)
  // 'cookie_info' is the cookie name you assigned it when making the cookie
  $cookie_info = explode("-", $_COOKIE['cookie_info']);
  $namecookie = $cookie_info[0];
  $passcookie = $cookie_info[1];

  // Check if username exists
  $usernamelogin = mysql_num_rows(mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie'"));

  // If username exists
  if ($usernamelogin == 1) {

      // Check if password matches the database password
      $passwordlogin = mysql_num_rows(mysql_query("SELECT * FROM userdata WHERE userid = '$namecookie' AND userpass = '$passcookie'"));

      // If password is correct
      if ($passwordlogin == 1) {

          // User is now logged in
          return (true);
      }

      // If the password is incorrect
      else {
           return(false);
      }
  }

  // If the username was not found in database
  else {
        return(false);
  }
}

?>