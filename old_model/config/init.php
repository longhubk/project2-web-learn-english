<?php
  require_once "config.php";
  require_once "read_json.php";
  //auto loader 
  function __autoload($class_name){
    require_once "models/" . $class_name . ".php";
  }

?>