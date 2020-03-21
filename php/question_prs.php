<?php 
  $user_question = fopen("../data/user_question.json", "r") or die("Can't open file");
  echo fread($user_question, filesize("../data/user_question.json"));
  fclose($user_question)
?>