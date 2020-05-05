
<div class="main-container">
  <div class="video-card">

    <h1>Test Page </h1>
    <p>Hãy thực hiện các bước đưới đây để học tiếng anh nha!</p>

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
            echo "<div>". $value_qs ."</div>";
          }
          if($key_qs == 'answer'){
            echo "<div class='answer_qs'>";
            $as_id = '';
            foreach($value_qs as $num_asw => $content_asw){
              if($num_asw == 'as-id')  
              $as_id = $content_asw;
              else
              echo "<input type='checkbox' name='". $as_id . "[]' value='".$num_asw."'>  " . $content_asw . "<br>";
            }
            echo "</div>";
          }
        }
        echo "</div>";
      }
      
    }
    
    
    ?>
      <input type="submit" name='commit_test' value="Nộp bài">
      <div class="test_result">
        Kết quả bài thi của bạn là:
        <?php 
          if(isset($data['test_as']))
            echo $data['test_as'];
        ?>
      </div>
    </form>
  </div>
</div>