
<div class="main-container">
  <div class="video-card">

    <h1>Test Page </h1>
    <!-- <p>Đây là bài thi thi của bạn</p> -->

    <form method="POST" action="./TestPage/Check">

    <?php 
    
    if(isset($data['test_qs'])){
      $test_qs = $data['test_qs'];
      
      foreach($test_qs as $qs_id => $qs_content){
        echo "<div class='qs_contain'>";
        foreach($qs_content as $key_qs => $value_qs){
          if($key_qs == 'name'){
            echo "<div class='title_qs'>".$value_qs . ": ";
          }
          if($key_qs == 'question'){
            echo $value_qs;
            echo "</div>";
          }
          if($key_qs == 'note'){
            echo "<div class='qs_note'> Chú ý: ". $value_qs ."</div>";
          }
          if($key_qs == 'answer'){
            echo "<div class='answer_qs'>";
            $as_id = '';
            foreach($value_qs as $num_asw => $content_asw){
              if($num_asw == 'as-id')  
              $as_id = $content_asw;
              else
              echo "<div class='each_ans'><input type='checkbox' name='". $as_id . "[]' value='".$num_asw."'>  " . $content_asw . "</div><br>";
            }
            echo "</div>";
          }
        }
        echo "</div>";
      }
      
    }
    ?>
    <div class="commit_test">
      <input type="submit" name='commit_test' value = "Nộp bài">
    </div>

    </form>
    <div class="test_result">
        <?php 
          if(isset($data['test_as'])){
            echo "<div class='label_res'>Kết quả bài thi của bạn là:</div>";
            echo $data['test_as'];
          }
        ?>
    </div>
  </div>
</div>