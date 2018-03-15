<?php
  session_start();
  
  header("Location: login.php"); #Redirects connections to the login page and then kills index.php. 
  die();
?>
