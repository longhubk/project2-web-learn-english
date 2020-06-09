
<div class="main-container">
  <div class="video-card">

    <h1>ARE YOU READY </h1>
    <p>Bạn đã sẵn sàng chưa !</p>
    <img src='public/gif/ready_to_test.gif'>

    

    <div id='toggle_start'>
    <form id='submit_test_form' method="POST" action="./TestPage/Check/<?php 
      if(isset($data['test_id'])) echo $data['test_id'];
    ?>">

    <?php 
    

    if(!empty($test_qs)){
      echo "<div class='qs_contain'>";
      for($i = 0; $i < sizeof($test_qs); $i++){

        $id_qs      = $test_qs[$i][0];
        $name_qs    = $test_qs[$i][1];
        $content_qs = $test_qs[$i][2];
        $ans        = [];

        echo "<div id='test_qs_".$id_qs."' name='test_qs_".$id_qs."'>";
        echo "<div class='title_qs'>".$name_qs . $content_qs . "</div>";
        echo "<div class='answer_qs'>";
        for($j = 1; $j <= 4; $j++){
          $ans[$j] = $test_qs[$i][$j+2];

          echo "<input type='hidden' id='ans_hide-".$i."-".$j."' name='isRight_".$j."-".$id_qs."' value='false' >";
          
          echo "<div class='each_ans'><input type='checkbox' id='ans_show-".$i."-".$j."' name='isRight_".$j."-".$id_qs."' value='true'> <label for='ans_show-".$i."-".$j."'>" . $ans[$j] . "</label></div><br>";
        }
        echo "</div>";
        echo "</div>";

      }
    }
    ?>

          <div class="commit_test">
            <input type='submit' id='trigger_test' class='next_commit' name='commit_test' value = "Nộp bài">
          </div>

        </form>
      </div>
    </div>
  </div>
</div>