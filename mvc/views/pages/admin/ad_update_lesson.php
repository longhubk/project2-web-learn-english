  
<div class="admin_container">
  <h2 class="title_ad_page" >Update Lesson:</h2>
  <?php 
  
    if(isset($data['id_lesson_update'])){
      $les_id = $data['id_lesson_update'];
      echo " Do you want to update lesson: <span id='les_up_id'>" . $les_id . "</span><br>";
    }

    if(isset($data['res_update'])){
      $res_up = $data['res_update'];
      if($res_up)
        echo "Update Success <br>";
      else
        echo "Update Fail<br>";
    }
    if(isset($data['content_lesson'])){
      $content_less = $data['content_lesson'];
      $tut_level = $data['tut_level'];
      echo "<form method='POST' action='./AdminPage/postUpdateLesson/".$les_id."/".$tut_level."'>"; 

      for($i = 0; $i < sizeof($content_less); $i++){
        $content_id = $content_less[$i][0];
        $content_main = $content_less[$i][2];
        $content_guide = $content_less[$i][3];
        $exp = [];

        echo "<div id='ct_main-".$content_id."'>
              <hr>
              <lab> Content ".($i+1)."</label><br><br>
              <table class='table_update_content' id='content_".($i+1)."'>
              <tr>
                <td class='title_content'> Main content</td>
                <td class='input_content' > 
                  <textarea   name='main_content-".$content_id."' >".$content_main."</textarea>
                </td>
              </tr>

              <tr>
                <td class='title_content' > Guide content</td>
                <td class='input_content' > 
                  <textarea   name='guide_content-".$content_id."' >".$content_guide."</textarea>
                </td>
              </tr>

                ";
        for($j = 1 ; $j <= 10; $j++){
          $exp[$j] = $content_less[$i][$j+3];
          if(!empty($exp[$j])){
            echo "
              <tr>
                <td class='title_content'> Example ".$j."</td>
                <td class='input_content'><textarea  name='example_".$j."-".$content_id."' >".$exp[$j]."</textarea>
                </td>
              </tr>
            ";
          }

        }

        echo "</table>
            <img class='icon-96' id='add_ex2_".($i+1)."' data-content_id='".$content_id."' src='public/icon/plus_green_icon.png'>
            <img class='icon-96' id='rm_ex2_".($i+1)."'  src='public/icon/minus_red_icon.png'>
            <img class='icon-96' id='delete_ct_".$les_id."-".$content_id."'  src='public/icon/delete_2.png'>
        </div>";
      }


      echo "<br><div class='update_content'><input type='submit' value='update lesson'></div>";
      echo "</form>";
    }

  
  ?>
</div>
  