<?php 
   
   $all_tutorial = read_json("../../data/tutorials/grammar.json");
   foreach($all_tutorial as $tutorial => $name){
      if(isset($_GET['tutorial'])){
         $tutorial_all = $_GET['tutorial'];
         echo "<li><a href='../form_index/index.php?tutorial=$tutorial_all&name_tutorial=$tutorial'>$name</a></li>";
      }
      else
         echo "<li><a href='../form_index/index.php?name_tutorial=$tutorial'>$name</a></li>";
}
?>