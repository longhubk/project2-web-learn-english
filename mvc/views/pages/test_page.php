
<div class="main-container">
  <div class="video-card">

    <!-- <h1>Test Page </h1> -->
    <!-- <p>Đây là bài thi thi của bạn</p> -->

    <form method="POST" action="./TestPage/Check">

    <?php 
    
    if(isset($data['test_qs'])){
      $test_qs = $data['test_qs'];
      $array = (array)$test_qs;
      $num_qs = sizeof($array);
      $num_per_page = 2;
      $num_page = $num_qs / $num_per_page;


      $first = 1;
      $page = 0;
      if(isset($data['first']))
        $page = $data['first'];
      
      $first = $page * $num_per_page + 1;
    

      $last  = $first+$num_per_page;
      $count = 0;                     //_in_loop
      $index = 1;                     //_out_loop

      foreach($test_qs as $qs_id => $qs_content){
        if($count == $num_per_page)  break;
        if($index >=$first && $index < $last){
          
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
              echo "<div class='each_ans'><input type='checkbox' id='".$as_id. $num_asw."' name='". $as_id . "[]' value='".$num_asw."'> <label for='".$as_id.$num_asw."'>" . $content_asw . "</label></div><br>";
            }
            echo "</div>";
          }
        }
        echo "</div>";
        $count++;
        }
        $index++;
      }
      
    }
    ?>
    <?php if($page == $num_page-1){?>
    <div class="commit_test">
      <input type="submit" name='commit_test' value = "Nộp bài">
    </div>
    <?php } ?>

    </form>

    <div class="center">
      <div class="pagination">
        <?php
            if($page > 0)
              echo "<a title='prev' href='./TestPage/Test/".($page)."'>&laquo;</a>";
            for($i = 0; $i < $num_page; $i++){
              if($i == $page )
                echo "<a href='./TestPage/Test/".($i+1)."' class='active' >".($i+1)."</a>";
              else
                echo "<a href='./TestPage/Test/".($i+1)."'>".($i+1)."</a>";
            }
            if($page < $num_page - 1)
              echo "<a title='next' href='./TestPage/Test/".($page+2)."'>&raquo;</a>";
            ?>
      </div>
    </div>

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