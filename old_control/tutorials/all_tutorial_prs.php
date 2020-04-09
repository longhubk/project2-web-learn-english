<?php 
   
   $all_tutorial = read_json("../data/tutorials/all_tutorial.json");
   foreach($all_tutorial as $tutorial => $name){
      echo "<li><a href='index.php?tutorial=$tutorial'>$name</a></li>";   
   }

?>