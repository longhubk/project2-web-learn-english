
<div class="main-container">
  <div class="video-card">

    <div class="test_result">
        <?php 
          // var_dump($_SESSION);
          
          if(isset($data['post_test'])){
            // echo "post_test<br>";
            // var_dump($data['post_test']);
          }

          if(isset($data['test_res'])){
            $point = $data['test_res'][1];
            $perPoint = $data['test_res'][2];
            $numTutUnLock = $data['test_res'][3];
            $out = $point ."/". $perPoint;
            echo "<div class='label_res'>Kết quả bài thi của bạn là:  <b>".$out."</b></div>";
            echo "<div class='label_res'>Chúc mừng bạn đã mở khóa được các level từ ".$numTutUnLock." trở xuống!!</div>";
          }
        ?>
    </div>

    <?php 
    if(isset($data['test_qs'])){

      $test_qs = $data['test_qs'];
      echo "<div class='qs_contain'>";
      $post = $data['post_test'];
      $check = [];
      $j = 0;
      $cnt = 0;
      $check[0] = [];
      foreach($post as $key => $val){
        if($cnt == 4){
            $cnt = 0;
            $j++;
            $check[$j] = [];
        }
        $cnt++;
        if($key !== 'commit_test'){

          $posts = explode('-', $key);
          $post_isRight = explode('_', $posts[0]);
          if($val == 'true'){
            $check[$j][$post_isRight[1]] = true;
          }else
            $check[$j][$post_isRight[1]] = false;

        }
      }
      // var_dump($check);

      for($i = 0; $i < sizeof($test_qs); $i++){

        $id_qs      = $test_qs[$i][0];
        $name_qs    = $test_qs[$i][1];
        $content_qs = $test_qs[$i][2];
        $ans        = [];

        echo "<div class='title_qs'>".$name_qs . $content_qs . "</div>";
        echo "<div class='answer_qs'>";
        for($j = 1; $j <= 4; $j++){
          $ans[$j] = $test_qs[$i][$j+2];
          $isCheck = $check[$i][$j];
          $isRight[$j] = $test_qs[$i][$j+7];
          $status = 1;
          if($isCheck){
            if($isRight[$j] == 'true'){
              $status = 1;
            }else
              $status = 2;
          }
          else{
            if($isRight[$j] == 'true'){
              $status = 3;
            }else
              $status = 4;
          }

          if($status == 1){
            echo "<div class='each_ans'>
                    <input type='checkbox' checked> 
                    <label style='color: green'>" . $ans[$j] . "</label>
                  </div><br>";
          }else 
          if( $status == 2){
            echo "<div class='each_ans'>
                    <input type='checkbox' checked> 
                    <label  style='color: red'>" . $ans[$j] . "</label>
                  </div><br>";

          }else
          if( $status == 3){
            echo "<div class='each_ans'>
                    <input type='checkbox'> 
                    <label  style='color: green'>" . $ans[$j] . "</label>
                  </div><br>";
          }else
          if( $status == 4){
            echo "<div class='each_ans'>
                    <input type='checkbox'> 
                    <label  style='color: red'>" . $ans[$j] . "</label>
                  </div><br>";
          }

          
        }
        echo "</div>";

      }
    
    }
    ?>


    </div>
  </div>
</div>