<?php 
  $sub_file = read_json("../data/subtitles_data/video1_sub_data.json");
  
  $id = 0;
  foreach($sub_file as $eng_sub => $vi_sub){
    echo "<li id='en-$id' style='color: green;'>$eng_sub</li> <br>";
    echo "<li id='vn-$id' style='color: blue;'>$vi_sub</li> <br>";
    $id++;
  }


?>