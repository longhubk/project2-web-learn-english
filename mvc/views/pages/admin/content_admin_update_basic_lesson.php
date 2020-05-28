  
<div class="admin_container">
  <h2>Update Basic Lesson:</h2>
  <?php 
  
    if(isset($data['id_lesson_update'])){
      $les_id = $data['id_lesson_update'];
      echo " you want to update lesson: " . $les_id . "<br>";
    }
    if(isset($data['post_content'])){
      $all_post = $data['post_content'];
      // $cnt = 0;
      // foreach($all_post as $key => $val){
      //   echo $cnt . "-" . $key . "<br>" . "->" .$val . "<br>";
      //   $cnt++;
      // }
      // var_dump($all_post);
    }

    if(isset($data['res_update'])){
      // var_dump($data['res_update']);
      $res_up = $data['res_update'];

      var_dump($res_up);
      if($res_up)
        echo "Update Success <br>";
      else
        echo "Update Fail<br>";

    }
    if(isset($data['content_lesson'])){
      $content_less = $data['content_lesson'];
      $tut_level = $data['tut_level'];
      // var_dump($content_less);
      echo "<form method='POST' action='./HomeAdmin/postUpdateLesson/".$les_id."/".$tut_level."'>"; 

      for($i = 0; $i < sizeof($content_less); $i++){
        $content_id = $content_less[$i][0];
        $image_main = $content_less[$i][2];

        $img_1 = $content_less[$i][3];
        $img_2 = $content_less[$i][4];
        $img_3 = $content_less[$i][5];

        $content_main = $content_less[$i][6];

        $sub_1 = $content_less[$i][7];
        $sub_2 = $content_less[$i][8];
        $sub_3 = $content_less[$i][9];

        $aud_1 = $content_less[$i][10];
        $aud_2 = $content_less[$i][11];
        $aud_3 = $content_less[$i][12];

        echo "<div id='content-".$content_id."'>";

        echo "<label>Content ".($i+1)." :</label><br>";
        echo "Image main:  <input type='text' class='input_content' name='image_main-".$content_id."' value='".$image_main."'><br>";
        
        echo "image 1: <input type='text' class='input_content' name='img_1-".$content_id."' value='".$img_1."'><br>";
        echo "image 2: <input type='text' class='input_content' name='img_2-".$content_id."' value='".$img_2."'><br>";
        echo "image 3: <input type='text' class='input_content' name='img_3-".$content_id."' value='".$img_3."'><br>";
        
        echo "Content main: <input type='text' class='input_content' name='content_main-".$content_id."' value='".$content_main."'><br>";

        echo "sub content 1: <textarea class='area_content' name='sub_1-".$content_id."'>".$sub_1."</textarea><br>";
        echo "sub content 2: <textarea class='area_content' name='sub_2-".$content_id."'>".$sub_2."</textarea><br>";
        echo "sub content 3: <textarea class='area_content' name='sub_3-".$content_id."'>".$sub_3."</textarea><br>";

        echo "audio 1: <input type='text' class='input_content' name='aud_1-".$content_id."' value='".$aud_1."'><br>";
        echo "audio 2: <input type='text' class='input_content' name='aud_2-".$content_id."' value='".$aud_2."'><br>";
        echo "audio 3: <input type='text' class='input_content' name='aud_3-".$content_id."' value='".$aud_3."'><br>";

        echo"</div>";
      }

      echo "<input type='submit' value='update lesson'>";
      echo "</form>";
    }

  
  ?>
</div>
  