<?php 
  session_start();
  $GLOBALS['submit_user'] = array();
  require_once "./mvc/Bridge.php";
  $myApp = new App();

?>