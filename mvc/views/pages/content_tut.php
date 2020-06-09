
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
        $extension = $data['img_les'];
        // $tut_img = $data['img_les'] . $extension;
        echo "<img class='intro' src='./public/img/$extension'>";
      }
    ?>

    <?php
      if(isset($data['allTutsIndex']) && !isset($data['tutContent'])){

        $all_tut = $data['allTutsIndex'];
        // var_dump($all_tut);
        for($i = 0; $i < sizeof($all_tut); $i++){
          echo "<div class='each_tut_show'>
            <div class='tut_img'>
              <img class='img_tut_show  img-100' src='public/img/tutorial/".$all_tut[$i][7]."'>
            </div>

            <div class='tut_cont'>
              <div class='title'>
                <a href='Tut/One/".$all_tut[$i][5]."'>";
                  echo $all_tut[$i][1];
                echo "</a>
              </div>
              <div class='des_tut'>";
                echo $all_tut[$i][8];
              echo"</div>
              <div class='tut_level'>";
                echo "Cấp độ: ". $all_tut[$i][4];
              echo "</div>
            </div>
          
          </div><br>";
        }
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

          $ex = [];
          if(isset($tutT[$i][2])) $point_main = $tutT[$i][2];
          if(isset($tutT[$i][3])) $guide_main = $tutT[$i][3];


          if(!empty($point_main)) echo "<div class='point-main'> $point_main </div><br>";
          if(!empty($guide_main)) echo "<div class='guide-main'> $guide_main </div><br>";

          echo "<ol>";
          for($j = 1; $j <= 10; $j++){
            $ex[$j] = $tutT[$i][$j+3];
            if(!empty($ex[$j])) echo "<li>".$ex[$j]."</li><br>";
          }
          echo "</ol><br>";
      }
        echo "</div>";
    }

  ?>

    <div class="verb-video" >
      <h3>Video có phụ đề:</h3>

      <!-- <iframe id='player' width="560" height="315" src="https://www.youtube.com/embed/LfJPA8GwTdk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
          <?php   
          if(isset($data['vid_les'])){
            $vid_src = "public/video/".$data['vid_les'];
            echo "
            <div class='video_src'>
            <video id='video_les' controls >

              <source src='".$vid_src."' type='video/mp4'>
            </video>
            </div>
            ";
          }

          if(isset($data['tut_sub'])){
            echo "<div class='subtitle'>";
              echo "<ul id = 'main_scroll'>";
            $tut_subtitle =  $data['tut_sub'];
            // var_dump($tut_subtitle);
            for($i = 0; $i < sizeof($tut_subtitle); $i++){
                  $tut_sub = (array)$tut_subtitle[$i];
                  echo "<li id='en-".$tut_sub['start']. "-".$tut_sub['end']."' style='color: green;'>".$tut_sub['en_text']."</li>";

                  echo "<li id='vi-".$tut_sub['start']. "-".$tut_sub['end']."' style='color: blue;'>".$tut_sub['vi_text']."</li>";

            }
            echo "</ul>";
          echo "</div>";
          // echo "<button id='btn_scroll'>scroll</button>";
          // echo "<button id='btn_auto_scroll'>auto scroll</button>";
          }
          ?>


    </div>
  </div>
</div>