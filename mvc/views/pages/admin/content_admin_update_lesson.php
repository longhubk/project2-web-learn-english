  
<div class="admin_container">
  <h2>Update Lesson:</h2>
  <?php 
  
    if(isset($data['id_lesson_update'])){
      $les_id = $data['id_lesson_update'];
      echo " you want to update lesson: " . $les_id . "<br>";
    }

    if(isset($data['res_update'])){
      // var_dump($data['res_update']);
      $res_up = $data['res_update'];
      if($res_up)
        echo "Update Success <br>";
      else
        echo "Update Fail<br>";

    }
    if(isset($data['content_lesson'])){
      $content_less = $data['content_lesson'];
      // var_dump($content_less);
      // echo "<form method='POST' action='./HomeAdmin/postUpdateLesson/".$les_id."'>"; 

      $tut_level = $data['tut_level'];
      // var_dump($content_less);
      echo "<form method='POST' action='./HomeAdmin/postUpdateLesson/".$les_id."/".$tut_level."'>"; 

      for($i = 0; $i < sizeof($content_less); $i++){
        $content_id = $content_less[$i][0];
        $content_main = $content_less[$i][2];
        $content_guide = $content_less[$i][3];
        $exp_1 = $content_less[$i][4];
        $exp_2 = $content_less[$i][5];
        $exp_3 = $content_less[$i][6];
        $exp_4 = $content_less[$i][7];
        $exp_5 = $content_less[$i][8];

        echo "<div id='content-".$content_id."'>";

        echo "<label>Content ".($i+1)." :</label><br>";
        echo "main:  <input type='text' class='input_content' name='main_content-".$content_id."' value='".$content_main."'><br>";
        echo "guide: <input type='text' class='input_content' name='guide_content-".$content_id."' value='".$content_guide."'><br>";
        echo "exp_1: <input type='text' class='input_content' name='example_1-".$content_id."' value='".$exp_1."'><br>";
        echo "exp_2: <input type='text' class='input_content' name='example_2-".$content_id."' value='".$exp_2."'><br>";
        echo "exp_3: <input type='text' class='input_content' name='example_3-".$content_id."' value='".$exp_3."'><br>";
        echo "exp_4: <input type='text' class='input_content' name='example_4-".$content_id."' value='".$exp_4."'><br>";
        echo "exp_5: <input type='text' class='input_content' name='example_5-".$content_id."' value='".$exp_5."'><br><br>";

        echo"</div>";
      }

      echo "<input type='submit' value='update lesson'>";
      echo "</form>";
    }

  
  ?>
</div>
  