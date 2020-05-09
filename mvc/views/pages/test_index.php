
<div class="main-container">
  <div class="video-card">

    <!-- <h1>Test Page </h1> -->
    <p class="title_main_page">Đanh sách các bài thi:</p>
    
    <div class='all_test'>
      <?php
        if(isset($data['all_test'])){
          $all_test = $data['all_test'];
          foreach($all_test as $testId => $value){
            echo "<div class='each_test' id='".$testId."'>";
              foreach($value as $cate => $content){
                if($cate == 'name')
                  echo "<div class='name_test'>".$content."</div>";
                if($cate == 'time')
                  echo "<div class='time_test'> Thời gian: ".$content."</div>";
                if($cate == 'num_qs')
                  echo "<div class='num_qs'> Số câu hỏi: ".$content."</div>";
                if($cate == 'level')
                  echo "<div class='level_test'> Cấp độ khó: ".$content."</div>";
                if($cate == 'des_test')
                  echo "<div class='des_test'> Yêu cầu: ".$content."</div>";

             }
              echo'<button class="btn-enter-test" onclick="location.href=\'./TestPage/'.$testId.'/0\'" type="button"> Đăng ký </button>';

            echo "</div>";
          }
       }
      
      ?>
      </div>

  </div>
</div>