<?php 
  $file =  read_json("../data/user_question.json");
  foreach($file as $name_user => $question){
    echo "<li><a href='#'> $question</a></li>";
  }
?>