
<div class="main-container">
  <div class="video-card">
    <?php
      if(isset($data['title_les'])){
        $title_les = $data['title_les'];
            echo "<h1>$title_les</h1>";
      }
      
    ?>
    <?php
      if(isset($data['tutContent']))
        echo "<p class='first_guide' >Hãy thực hiện các bước đưới đây để học tiếng anh nha!</p>";
      else
        echo "<p>Hãy Chọn môt tutorial để bắt đầu học ngay tùy theo trình độ của bạn.</p>";

    ?>

    <?php
      if(isset($data['img_les'])){
        $extension = $data['ext_les'];
        // $tut_img = $data['img_les'] . $extension;
        echo "<img class='intro' src='./public/img/$extension'>";
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
        $tutT = $data['tutKnowledge'];

        for($i = 0; $i < sizeof($tutT); $i++){

          if(isset($tutT[$i][2])) $point_main = $tutT[$i][2];
          if(isset($tutT[$i][3])) $guide_main = $tutT[$i][3];
          if(isset($tutT[$i][4])) $ex_1 = $tutT[$i][4];
          if(isset($tutT[$i][5])) $ex_2 = $tutT[$i][5];
          if(isset($tutT[$i][6])) $ex_3 = $tutT[$i][6];
          if(isset($tutT[$i][7])) $ex_4 = $tutT[$i][7];
          if(isset($tutT[$i][8])) $ex_5 = $tutT[$i][8];

          if(!empty($point_main)) echo "<div class='point-main'> $point_main </div><br>";
          if(!empty($guide_main)) echo "<div class='guide-main'> $guide_main </div><br>";

          echo "<ol>";
          if(!empty($ex_1)) echo "<li> $ex_1 </li><br>";
          if(!empty($ex_2)) echo "<li> $ex_2 </li><br>";
          if(!empty($ex_3)) echo "<li> $ex_3 </li><br>";
          if(!empty($ex_4)) echo "<li> $ex_4 </li><br>";
          if(!empty($ex_5)) echo "<li> $ex_5 </li><br>";
          echo "</ol><br>";
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