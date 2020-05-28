  
<div class="admin_container">
  <h2>Update Test:</h2>
  <?php 
  

    if(isset($data['post_content'])){
      // var_dump($data['post_content']);

    }

    if(isset($data['res_update'])){
      // var_dump($data['res_update']);
      $res_up = $data['res_update'];
      if($res_up) 
        echo "<div class='update_data_ok'><b>Update Success</b></div><br>";
      else 
        echo "<div class='update_data_fail'><b>Update Fail</b></div><br>";

    }


    if(isset($data['id_test_update'])){
      $test_id = $data['id_test_update'];
      echo " you want to update test: " . $test_id . "<br>";
    }

    if(isset($data['content_test'])){
      $content_test = $data['content_test'];
      echo "<div>Number question: <span id='num_qs_up'>".sizeof($content_test)."</span></div>";
      // var_dump($content_test);
      // echo "<form method='POST' action='./HomeAdmin/postUpdateLesson/".$test_id."'>"; 

      $test_level = $data['test_level'];
      // var_dump($content_test);

      echo "<form id='update_test' method='POST' action='./HomeAdmin/postUpdateTest/".$test_id."/".$test_level."'>"; 


      for($i = 0; $i < sizeof($content_test); $i++){

        $test_qs_id = $content_test[$i][0];
        $qs_name = $content_test[$i][1];
        $qs_content = $content_test[$i][2];
        $ans = [];
        $isRight = [];
        for($j = 1; $j <= 4; $j++){
          $ans[$j] = $content_test[$i][$j+2];
          $isRight[$j] = $content_test[$i][$j+7];
        }


        echo "<div id='content-".$test_qs_id."'>";
        echo "<hr>";
        echo "<label>Question ".($i+1)." :</label><br>";
        echo "Name: <input type='text' class='input_content' name='name-".$test_qs_id."' value='".$qs_name."'><br>";

        echo "main:  <textarea class='area_content' name='question-".$test_qs_id."'>".$qs_content."</textarea><br>";

        for($j = 1; $j <= 4; $j++){
          echo "Answer ".$j.": <input type='text' class='input_content' name='ans_".$j."-".$test_qs_id."' value='".$ans[$j]."'>";

          if($isRight[$j] == 'true'){
            echo "<input id='isRightHidden-".$i."-".$j."' type='hidden' name='isRight_".$j."-".$test_qs_id."' value='false'>";
          }
          echo "Is right: <input type='checkbox' id='isRight-".$i."-".$j."' class='check_content' name='isRight_".$j."-".$test_qs_id."' value='true'"; 
          ?>
          <?php
          if($isRight[$j] == 'true') {
            echo 'checked';
          }
          ?>
          
          <?php
            echo "><br><br>";

        }


        echo"</div><br><br>";
      }

      echo "<input type='submit' value='update test'>";
      echo "</form>";
      echo "<button id='btn_test'>test</button>";
    }

  
  ?>
</div>
  