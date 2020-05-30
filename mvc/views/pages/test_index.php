
<div class="main-container">
  <div class="video-card">

    <!-- <h1>Test Page </h1> -->
    <p class="title_main_page">Danh sách các bài thi:</p>
    
    <div class='all_test'>
      <?php
        // var_dump($_SESSION);
        if(isset($data['all_test'])){
          $all_test = $data['all_test'];
          // var_dump($all_test);
          echo "<div>Number test: <span id='number_test'>".sizeof($all_test)."</span></div>";

          for($i = 0; $i < sizeof($all_test); $i++){

            $test_id          = $all_test[$i][0];
            $test_name        = $all_test[$i][1];
            $test_time        = $all_test[$i][2];
            $test_num_qs      = $all_test[$i][3];
            $test_description = $all_test[$i][4];
            $test_ad_create   = $all_test[$i][5];
            $test_time_modify = $all_test[$i][6];
            $test_level       = $all_test[$i][7];
            $num_turn = 0;

            if(isset($data['test_turn'])){
              $test_turn = $data['test_turn'];
              for($j = 0; $j < sizeof($test_turn); $j++){
                if($test_id == $test_turn[$j][0])
                  $num_turn = $test_turn[$j][1];
              }
            }

            echo "<div class='each_test' id='".$test_id."'>";

              echo "<div class='name_test'>".$test_name."</div>";
              echo "<div class='time_test'> Thời gian: ".$test_time."</div>";
              echo "<div class='num_qs'> Số câu hỏi: ".$test_num_qs."</div>";
              echo "<div class='level_test'> Cấp độ khó: ".$test_level."</div>";
              echo "<div class='test_turn'> Số lần kiểm tra còn lại: ".$num_turn."</div>";
              echo "<div class='des_test'> Yêu cầu: ".$test_description."</div><br>";

              // echo'<button class="btn-enter-test" id="btn_test-'.$test_id.'"><a href="TestPage/Test/'.$test_id.'/0" > Đăng ký </a> </button>';

              echo'<button class="btn-enter-test" id="btn_test-'.$test_id.'"> Đăng ký </button>';
              
            echo "</div>";
          }


        }
      
      ?>
      </div>

  </div>
</div>