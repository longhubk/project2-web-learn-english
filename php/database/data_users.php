<?php
  $host_name = "localhost";
  $db_username = "root";
  $db_password = "PtOGOOZuHq7aV4Pi";
  $db_name = "speakmore";
  $result = "";
    $connect = new PDO("mysql:host=$host_name;dbname=$db_name", $db_username, $db_password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>