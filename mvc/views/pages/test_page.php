
<div class="main-container">
  <div class="video-card">

    <!-- <h1>Test Page </h1> -->
    <!-- <p>Đây là bài thi thi của bạn</p> -->
    <div id='status'></div>
    <div class="test_result">
        <?php 
          
          if(isset($data['post_check'])){
            // var_dump($data['post_check']);
          }

          if(isset($data['test_res'])){
            echo "<div class='label_res'>Kết quả bài thi của bạn là:  <b>".$data['test_res']."</b></div>";
          }
        ?>
    </div>

    <form id='submit_test_form' method="POST" action="./TestPage/Check/<?php 
      if(isset($data['test_id'])) echo $data['test_id'];
    ?>">

    <?php 
    
    if(isset($data['time_test']))
      $time_test = $data['time_test'];

    if(isset($data['test_qs'])){

      $test_qs = $data['test_qs'];
      echo "<div>Num question: <span id='num_qs_test' >".sizeof($test_qs)."</span></div>";
      echo "<div>Time : <span id='time_test' >".$time_test."</span> (phut)</div>";
      echo "<div class='qs_contain'>";
      for($i = 0; $i < sizeof($test_qs); $i++){

        $id_qs      = $test_qs[$i][0];
        $name_qs    = $test_qs[$i][1];
        $content_qs = $test_qs[$i][2];
        $ans        = [];

        echo "<div class='title_qs'>".$name_qs . $content_qs . "</div>";
        echo "<div class='answer_qs'>";
        for($j = 1; $j <= 4; $j++){
          $ans[$j] = $test_qs[$i][$j+2];

          echo "<input type='hidden' id='ans_hide-".$i."-".$j."' name='isRight_".$j."-".$id_qs."' value='false' >";
          
          echo "<div class='each_ans'><input type='checkbox' id='ans_show-".$i."-".$j."' name='isRight_".$j."-".$id_qs."' value='true'> <label for='ans_show-".$i."-".$j."'>" . $ans[$j] . "</label></div><br>";
        }
        echo "</div>";

      }
    
    }
    ?>

      <div class="commit_test">
        <input type="submit" id='trigger_test' class='next_commit' name='commit_test' value = "Nộp bài">
      </div>

    </form>

    </div>
  </div>
</div>