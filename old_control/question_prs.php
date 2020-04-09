<?php 
  $file =  read_json("../views/data/user_question.json");
  foreach($file as $name_user => $question){
    echo "<li><a href='#'> $question</a></li>";
  }
?>