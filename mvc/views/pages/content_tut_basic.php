
<div class="main-container">
  <div class="video-card">
    <?php
      if(isset($data['info_les']['title_lesson'])){
        $title_les = $data['info_les']['title_lesson'];
          echo "<h1>$title_les</h1>";
      }
      
    ?>
    <?php
      if(isset($data['tutContent']))
        echo "<p class='first_guide' >Hãy thực hiện các bước thật chậm để hiểu kĩ kiến thức căn bản</p>";
      else
        echo "<p>Hãy Chọn môt tutorial để bắt đầu học ngay tùy theo trình độ của bạn.</p>";

    ?>

    <?php
      if(isset($data['info_les']['image'])){
        $extension = $data['info_les']['image'];
        // $tut_img = $data['img_les'] . $extension;
        echo "<img class='intro' src='./public/img/les_img/$extension'>";
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
      // if(isset($data['tutKnowledge']))
      //   var_dump($data['tutKnowledge']);

      if(isset($data['tutKnowledge'])){
        echo "<div class='knowledge'>";
        $tutT = $data['tutKnowledge'];
        $path_img = "./public/img/basic_img/";
        $path_aud = "./public/audio/";

        echo "<div style='display:none' id='num_cont_basic'>".sizeof($tutT)."</div>";
        for($i = 0; $i < sizeof($tutT); $i++){

          if(isset($tutT[$i][2])) $img_main = $path_img . $tutT[$i][2];
          if(isset($tutT[$i][3])) $img_1 = $path_img . $tutT[$i][3];
          if(isset($tutT[$i][4])) $img_2 = $path_img . $tutT[$i][4];
          if(isset($tutT[$i][5])) $img_3 = $path_img . $tutT[$i][5];
          if(isset($tutT[$i][6])) $cont_main = $tutT[$i][6];
          if(isset($tutT[$i][7])) $sub_1 = $tutT[$i][7];
          if(isset($tutT[$i][8])) $sub_2 = $tutT[$i][8];
          if(isset($tutT[$i][9])) $sub_3 = $tutT[$i][9];
          if(isset($tutT[$i][10])) $aud_1 = $path_aud . $tutT[$i][10];
          if(isset($tutT[$i][11])) $aud_2 = $path_aud . $tutT[$i][11];
          if(isset($tutT[$i][12])) $aud_3 = $path_aud . $tutT[$i][12];


          if(!empty($img_main)) echo "<hr class='separate_knowledge'><div class='point-main'><img class='bs_img' src='$img_main'> </div><br>";
          if(!empty($cont_main)) echo "<div class='cont_main guide-main'> $cont_main </div><br>";

          echo "<ul>";
          if(!empty($sub_1)) echo "<li class='sub_cont'> $sub_1 </li><br>";
          if(!empty($aud_1)) echo "<li><audio id='aud_1_".$i."' controls> <source src='$aud_1' type='audio/mp3'></audio>  </li><br>";
          if(!empty($img_1)) echo "<li><img id='img_1_".$i."' class='bs_img' src='$img_1'> </li><br>";
          if(!empty($sub_2)) echo "<li class='sub_cont'> $sub_2 </li><br>";
          if(!empty($aud_1)) echo "<li><audio controls> <source src='$aud_2' type='audio/mp3'></audio>  </li><br>";
          if(!empty($img_2)) echo "<li> <img class='bs_img' src='$img_2'> </li><br>";
          if(!empty($sub_3)) echo "<li class='sub_cont'> $sub_3 </li><br>";
          if(!empty($aud_1)) echo "<li><audio controls> <source src='$aud_3' type='audio/mp3'></audio>  </li><br>";
          if(!empty($img_3)) echo "<li> <img class='bs_img' src='$img_3'></li><br>";
          echo "</ul><br>";
      }
        echo "</div>";
    }

  ?>

    <div class="verb-video" >
    <h3>Video có phụ đề:</h3>


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
            echo "<li id='en-".$tut_sub['start']. "-".$tut_sub['end']."' style='color: green;'>".$tut_sub['en_text']."</li>";

            echo "<li id='vi-".$tut_sub['start']. "-".$tut_sub['end']."' style='color: blue;'>".$tut_sub['vi_text']."</li>";

      }
      echo "</ul>";
    echo "</div>";

    }
    ?>


    </div>
  </div>
</div>