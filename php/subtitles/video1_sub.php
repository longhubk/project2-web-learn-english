<?php 
  $sub_file = read_json("../../data/subtitles_data/video1_sub_data.json");
  
  foreach($sub_file as $eng_sub => $vi_sub){
    echo "<li style='color: green;'>$eng_sub</li> <br>";
    echo "<li style='color: blue;'>$vi_sub</li> <br>";
  }


?>