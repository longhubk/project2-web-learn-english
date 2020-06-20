
<div class="main-container">
  <div class="video-card">
    <?php
      if(isset($data['info_les']['title_lesson'])){
        $title_les = $data['info_les']['title_lesson'];
          echo "<h1>$title_les</h1>";
      }

      if(isset($data['info_les']['name_lesson'])){
        $name_les = $data['info_les']['name_lesson'];
          echo "<div id='name_les' style='display: none;'>$name_les</div>";
      }
      
    ?>
    <?php
      if(isset($data['tutContent']))
        echo "<p class='first_guide' >Hãy thực hiện các bước đưới đây để học tiếng anh nha!</p>";
      else
        echo "<p>Hãy Chọn môt tutorial để bắt đầu học ngay tùy theo trình độ của bạn.</p>";

    ?>

    <?php
      if(isset($data['info_les'])){
        $extension = $data['info_les']['image'];
        echo "<img class='intro' src='./public/img/$extension'>";
      }
    ?>

    <?php
      if(isset($data['all_tuts']) && !isset($data['tutContent'])){

        $all_tut = $data['all_tuts'];
        // var_dump($all_tut);
        for($i = 0; $i < sizeof($all_tut); $i++){
          echo "<div class='each_tut_show'>
            <div class='tut_img'>
              <img class='img_tut_show  img-100' src='public/img/tutorial/".$all_tut[$i][7]."'>
            </div>

            <div class='tut_cont'>
              <div class='title'>
                <a href='TutorialPage/Lesson/".$all_tut[$i][5]."'>";
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
          if(isset($data['info_les'])){
            $vid_src = "public/video/".$data['info_les']['video'];
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
                  echo "<li class='sub_vid' id='en-".$tut_sub['start']. "-".$tut_sub['end']."' style='color: green;'>".$tut_sub['en_text']."</li>";

                  echo "<li class='sub_vid' id='vi-".$tut_sub['start']. "-".$tut_sub['end']."' style='color: blue;'>".$tut_sub['vi_text']."</li>";

            }
            echo "</ul>";
          echo "</div>";
          // echo "<button id='btn_scroll'>scroll</button>";
          // echo "<button id='btn_auto_scroll'>auto scroll</button>";
          }
          echo "<h3>Audio Conversation:</h3>";
          if(!empty($data['info_les']['audio'])){
            $aud = "public/audio/". $data['info_les']['audio'];
            echo "<audio controls> <source src='$aud' type='audio/mp3'></audio>";
          }
          

          $out = '';
          if(isset($data['sub_aud'])){
            $out = "<ul class='toggle_tab'>

              <li><button class='btn_tab active' id='btn_tab_1' onclick='showTab(\"tab_en_sc\", this.id)'>En Script</button></li>
              <li><button class='btn_tab' id='btn_tab_2' onclick='showTab(\"tab_vi_sc\", this.id)'>Vi Script</button></li>
              <li><button class='btn_tab' id='btn_tab_3' onclick='showTab(\"tab_quiz\",this.id)'>Quiz</button></li>
            </ul>";
          }

          if(isset($data['sub_aud'])){
            $en_sub = $data['sub_aud'];

            $out .= "<div class='tab active' id='tab_en_sc'>";
            $out .= "<ul>";
            for($i = 0; $i <sizeof($en_sub); $i++){
              $each_sub = (array)$en_sub[$i];
              $out .= "<li><b>".$each_sub['name']."</b>:   <span>".$each_sub['en_sub']."</span></li>";
              if($each_sub['name'] == 'Todd')
                $out .= "<br>";
            }

            $out .= "</ul></div>";
          }

          if(isset($data['sub_aud'])){
            $vi_sub = $data['sub_aud'];

            $out .= "<div class='tab' id='tab_vi_sc'>";
            $out .= "<ul>";
            for($i = 0; $i <sizeof($vi_sub); $i++){
              $each_sub = (array)$vi_sub[$i];
              $out .= "<li><b>".$each_sub['name']."</b>:   <span>".$each_sub['vi_sub']."</span></li>";

              if($each_sub['name'] == 'Todd')
                $out .= "<br>";
            }

            $out .= "</ul></div>";
          }

          if(isset($data['quiz_aud'])){
            $quiz = $data['quiz_aud'];
            $out .= "<div class='tab' id='tab_quiz'>";
            $out .= "<ul>";

            for($i = 0; $i < sizeof($quiz); $i++){
              $each_quiz = (array)$quiz[$i];

              $out .= "<li><span>".$each_quiz['name']."</span><br>";
              for($j = 0; $j < sizeof($each_quiz['ans']); $j++){
                $each_ans = (array)$each_quiz['ans'][$j];
                $out .= "<input class='input_quiz' id='ans-".$j."-".$each_quiz['id']."' type='checkbox' name='ans_".$j."-".$each_quiz['id']."'>
                  <label class='label_input_quiz' for= 'ans-".$j."-".$each_quiz['id']."' >".$each_ans['ans_ct']."</label><br>
                ";
              }
              $out .= "</li>";
            }
            $out .= "<button id='btn_submit_quiz'>Submit Quiz</button><br>";
            $out .= "<div id='res_quiz'></div>";

            $out .= "</ul></div>";

          }

          echo $out;

          ?>
          



    </div>
  </div>
</div>