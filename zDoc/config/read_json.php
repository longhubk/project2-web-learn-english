<?php 
  function read_json($path){
    $file = fopen($path, "r") or die("can't open file");
    $file_read = fread($file, filesize($path));
    $file_decoded = json_decode($file_read);
    fclose($file);
    return $file_decoded;
  }

?>