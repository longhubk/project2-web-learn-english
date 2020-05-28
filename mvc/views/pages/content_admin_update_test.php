  
<div class="admin_container">
  <h2>Update Test:</h2>
  <?php 
  
    if(isset($data['id_test_update'])){
      $test_id = $data['id_test_update'];
      echo " you want to update test: " . $test_id . "<br>";
    }

    if(isset($data['res_update'])){
      // var_dump($data['res_update']);
      $res_up = $data['res_update'];
      if($res_up)
        echo "Update Success <br>";
      else
        echo "Update Fail<br>";

    }
    if(isset($data['content_test'])){
      $content_test = $data['content_test'];
      // var_dump($content_test);
      // echo "<form method='POST' action='./HomeAdmin/postUpdateLesson/".$test_id."'>"; 

      $test_level = $data['test_level'];
      // var_dump($content_test);
      echo "<form method='POST' action='./HomeAdmin/postUpdateTest/".$test_id."/".$test_level."'>"; 

      for($i = 0; $i < sizeof($content_test); $i++){

        $test_qs_id = $content_test[$i][0];
        $qs_name = $content_test[$i][1];
        $qs_content = $content_test[$i][2];
        $ans_1 = $content_test[$i][3];
        $ans_2 = $content_test[$i][4];
        $ans_3 = $content_test[$i][5];
        $ans_4 = $content_test[$i][6];

        echo "<div id='content-".$test_qs_id."'>";

        echo "<label>Question ".($i+1)." :</label><br>";
        echo "Name: <input type='text' class='input_content' name='name-".$test_qs_id."' value='".$qs_name."'><br>";
        echo "main:  <textarea class='area_content' name='question-".$test_qs_id."'>".$qs_content."</textarea><br>";
        echo "Answer 1: <input type='text' class='input_content' name='ans_1-".$test_qs_id."' value='".$ans_1."'><br>";
        echo "Answer 2: <input type='text' class='input_content' name='ans_2-".$test_qs_id."' value='".$ans_2."'><br>";
        echo "Answer 3: <input type='text' class='input_content' name='ans_3-".$test_qs_id."' value='".$ans_3."'><br>";
        echo "Answer 4: <input type='text' class='input_content' name='ans_4-".$test_qs_id."' value='".$ans_4."'><br>";

        echo"</div><br><br>";
      }

      echo "<input type='submit' value='update test'>";
      echo "</form>";
    }

  
  ?>
</div>
  