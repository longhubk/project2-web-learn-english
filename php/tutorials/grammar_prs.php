<?php 
   
   $all_tutorial = read_json("../../data/tutorials/grammar.json");
   foreach($all_tutorial as $tutorial => $name){
     echo "<li><a href='../../html/form_index/index.php?tutorial=$tutorial'>$name</a></li>";
   }

?>