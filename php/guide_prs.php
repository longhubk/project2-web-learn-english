<?php
  $file = read_json("../../data/guide_listen.json");
  foreach ($file as $step => $content){
    echo "<p> $step: $content</p>";
  }
?>
