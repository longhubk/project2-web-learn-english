
<div class="main-container">
  <div class="video-card">
    <?php
      foreach($tutKnowledge as $point => $data){
        if($point == "point-0"){
          echo "<h1>$data</h1>";
        }
      }
    
    ?>
    <p>Hãy thực hiện các bước đưới đây để học tiếng anh nha!</p>
    <?php
      echo "<img id='intro' src='views/img/$tut_img'>";
    ?>
    <div class="tips">
      <h3>Hướng dẫn học:</h3>
      <?php 
       foreach ($tut_guide as $step => $content){
         echo "<p> $step: $content</p>";
       }
      ?>
    </div>

    <div class="knowledge"> 
    <?php 

      foreach($tutKnowledge as $point => $data){
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

      <iframe id='player' width="560" height="315" src="https://www.youtube.com/embed/LfJPA8GwTdk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      
      <div class="subtitle">
        <ul id = "main_scroll">
          <?php   
            $id = 0;
            foreach($tut_subtitle as $eng_sub => $vi_sub){
              echo "<li id='en-$id' style='color: green;'>$eng_sub</li> <br>";
              echo "<li id='vn-$id' style='color: blue;'>$vi_sub</li> <br>";
              $id++;
            }
          ?>
        </ul>
      </div>

      <button id="btn_scroll">scroll</button>
      <button id="btn_auto_scroll">auto scroll</button>

    </div>
  </div>
</div>