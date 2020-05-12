
<div class="main-container">
  <div class="video-card">
    <?php
      if(isset($data['tutKnowledge'])){
        $tutKnowledge = $data['tutKnowledge'];
        foreach($tutKnowledge as $point => $knowledge){
          if($point == "point-0"){
            echo "<h1>$knowledge</h1>";
          }
        }
      }
      
    ?>
    <?php
      if(isset($data['tutContent']))
        echo "<p>Hãy thực hiện các bước đưới đây để học tiếng anh nha!</p>";
      else
        echo "<p>Hãy Chọn môt tutorial để bắt đầu học ngay tùy theo trình độ của bạn.</p>";

    ?>

    <?php
      if(isset($data['img_tut'])){
        $file_data = (array)$data['tutKnowledge'];
        $extension = $file_data['avatar'];
        $tut_img = $data['img_tut'] . $extension;
        echo "<img id='intro' src='./public/img/$tut_img'>";
      }
    ?>


      <?php 
        if(isset($data['tut_guide'])){
          echo" <div class='tips'>";
          echo "<h3>Hướng dẫn học:</h3>";
          $tut_guide = $data['tut_guide'];
          foreach ($tut_guide as $step => $content){
            echo "<p> $step: $content</p>";
          }
          echo "</div>";
        }
      ?>

    <?php 

      if(isset($data['tutKnowledge'])){
        echo "<div class='knowledge'>";
        $tutKnowledge = $data['tutKnowledge'];
        foreach($tutKnowledge as $point => $knowledge){
          if($point != "point-0" && $point != "avatar"){
            foreach($knowledge as $key => $value){
              if($key == "key"){
                echo "<div class='point-main'> $value </div><br>";
              }else if($key == "guide"){
                echo "<div class='guide-main'> $value </div><br>";
              }
              else{
                echo "<ol>";
                foreach($value as $eg => $eg_value){
                  echo "<li class='$eg'> $eg_value </li><br>";
                }
                echo "</ol><br>";
              }
            }
          }
        }
        echo "</div>";
      }

    
    ?>
    <div class="verb-video" >
      <h3>Video có phụ đề:</h3>

      <iframe id='player' width="560" height="315" src="https://www.youtube.com/embed/LfJPA8GwTdk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      
          <?php   
          if(isset($data['tut_sub'])){
            echo "<div class='subtitle'>";
              echo "<ul id = 'main_scroll'>";
            $tut_subtitle = $data['tut_sub'];
            $id = 0;
            foreach($tut_subtitle as $eng_sub => $vi_sub){
              echo "<li id='en-$id' style='color: green;'>$eng_sub</li> <br>";
              echo "<li id='vn-$id' style='color: blue;'>$vi_sub</li> <br>";
              $id++;
            }
            echo "</ul>";
          echo "</div>";
          echo "<button id='btn_scroll'>scroll</button>";
          echo "<button id='btn_auto_scroll'>auto scroll</button>";
          }
          ?>


    </div>
  </div>
</div>