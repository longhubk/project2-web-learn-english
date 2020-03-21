<?php 

  $be_verb = read_json("../data/core_knowledge/be_verb.json");
  foreach($be_verb as $point => $data){
    foreach($data as $key => $value){
      if($key == "key"){
        echo "<div class='point-main'> $value </div><br>";
      }else{
        echo "<ol>";
        foreach($value as $eg => $eg_value){
          echo "<li class='$eg'> $eg_value </li><br>";
        }
        echo "</ol><br>";
      }
    }
  }

?>