
<div class="main-container">
  <div class="video-card">

    <!-- <h1>Test Page </h1> -->
    <!-- <p>Đây là bài thi thi của bạn</p> -->
    <div id='status'></div>
    <div class="test_result">
        <?php 
          if(isset($data['test_as'])){
            echo "<div class='label_res'>Kết quả bài thi của bạn là:  <b>".$data['test_as']."</b></div>";
          }
        ?>
    </div>

    <form id='submit_test_form' method="POST" action="./TestPage/Check">

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
      $page_next = $page + 1;
      // echo "page: ". $page;
      
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
            $appear = false;
            foreach($value_qs as $num_asw => $content_asw){
              if($num_asw == 'as-id')  
              $as_id = $content_asw;
              else
              {
                if(isset($data['post_last'])){
                  $for_last = $data['post_last'];
                  for($k = 0; $k < sizeof($for_last); $k++){
                    if(isset($for_last[$k][$as_id])){
                      if($for_last[$k][$as_id][0] == $num_asw)
                        $appear = true;
                    }
                  }
                }
                if($appear)
                    echo "<div class='each_ans'><input type='checkbox' id='".$as_id. $num_asw."' name='". $as_id . "[]' value='".$num_asw."' checked> <label for='".$as_id.$num_asw."'>" . $content_asw . "</label></div><br>";
                else
                    echo "<div class='each_ans'><input type='checkbox' id='".$as_id. $num_asw."' name='". $as_id . "[]' value='".$num_asw."'> <label for='".$as_id.$num_asw."'>" . $content_asw . "</label></div><br>";
                }

                $appear = false;
            }
            
            echo "</div>";
          }
        }
        echo "</div>";
        $count++;
      }
      $index++;
    }
    echo "<input type='hidden' name='page_next' value='".$page_next."'>";
    echo "<input type='hidden' name='num_qs' value='".$page_next."'>";
    
    }
    ?>
    <?php if($page == $num_page-1){?>
    <div class="commit_test">
      <input type="submit" class='next_commit' name='commit_test' value = "Nộp bài">
    </div>

    <?php 
    }else{
      echo "<div class='commit_test'>"; 
      echo '<input type="submit" class="next_commit" name="next_qs" value = "Next">';
      echo"</div>";
    } ?>

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
              // echo "hello";
            ?>
      </div>
    </div>

  </div>
</div>