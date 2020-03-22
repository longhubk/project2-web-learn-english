<?php

    $getTutorial = $_GET['name_tutorial'];
    $path_data = "../../data/core_knowledge/" . $getTutorial . ".json";
    $content_data = read_json($path_data);
    $img = $getTutorial . ".png";

?>
<div class="main-container">
  <div class="video-card">
    <?php
      foreach($content_data as $point => $data){
        if($point == "point-0"){
          echo "<h1>$data</h1>";
        }
      }
  
    
    ?>
    <p>Hãy thực hiện các bước đưới đây để học tiếng anh nha!</p>
    <?php
      echo "<img id='intro' src='../../img/$img'>";
    ?>
    <div class="tips">
      <h3>Hướng dẫn học:</h3>
      <?php include "../../php/guide_prs.php";?>
    </div>
    <div class="knowledge"> 
      <?php 

        foreach($content_data as $point => $data){
          if($point != "point-0"){
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
        }

      
      ?>
    </div>
    <div class="verb-video" >
      <h3>Video có phụ đề:</h3>
      <iframe  width="560" height="315" src="https://www.youtube.com/embed/LfJPA8GwTdk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      
      <div class="subtitle">
        <ul><?php include "../../php/subtitles/video1_sub.php" ?> </ul>
      </div>
    </div>
    
  </div>
</div>