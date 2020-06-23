  
<div class="admin_container">
  <div id='debug_div'></div>
  <h2 class="title_ad_page">Update Basic Lesson:</h2>
  <?php 
  
    if(isset($data['id_lesson_update'])){
      $les_id = $data['id_lesson_update'];
      echo "Do you want to update basic lesson: " . $les_id . "<br>";
    }
    if(isset($data['post_content'])){
      $all_post = $data['post_content'];
      var_dump($all_post);
    }

    if(isset($data['res_update'])){
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
      echo "<div style='display:none;' id='max_id_ct_basic'>".$content_less[sizeof($content_less)-1][0]."</div>";
      echo "<form method='POST' action='./AdminPage/postUpdateLesson/".$les_id."/".$tut_level."' enctype='multipart/form-data' >"; 

      for($i = 0; $i < sizeof($content_less); $i++){
        $content_id   = $content_less[$i][0];
        $image_main   = $content_less[$i][2];
        $content_main = $content_less[$i][6];

        $img = $sub = $aud = [];



        echo "<br><hr><br>
        <div id='content-".$content_id."'>
          <b>Content ".($i+1)." :</b><br>
          <img class='icon-120' id='del_ct_bs-".$content_id."' src='public/icon/delete_icon.png'>
          <table class='table_new_les_basic'>
          <tr>
            <td>Image main</td>
            <td>
              <div> ".$image_main."</div>
              <input type='file' accept='.jpg,.png,.gif,.jpeg' name='image_main-".$content_id."'>
            </td>
          </tr> 

          <tr>
            <td class='bold_row'>Content main</td>
            <td class='input_content bold_row'>
              <textarea class='area_content' name='content_main-".$content_id."'> ".$content_main." </textarea>
            </td>
          </tr> 
        
        ";

        for($j = 1; $j <= 3; $j++){
          $img[$j] = $content_less[$i][$j+2];
          $sub[$j] = $content_less[$i][$j+6];
          $aud[$j] = $content_less[$i][$j+9];
          echo "<tr><td> sub content ".$j."</td><td class='input_content '> <textarea class='area_content' name='sub_".$j."-".$content_id."'>".$sub[$j]."</textarea></td></tr>";

          echo "<tr>
          <td> audio ".$j."</td> 
          <td>
            <div>".$aud[$j]."</div> 
            <input type='file' accept='.mp3,.wav' name='aud_".$j."-".$content_id."'> 
          </td></tr>";

          echo "<tr>
          <td class='bold_row'> image ".$j."</td>
          <td class='bold_row'>
            <div>".$img[$j]."</div>
            <input type='file' accept='.jpg,.png,.gif,.jpeg' name='img_".$j."-".$content_id."'>
          </td></tr>";
        }
        

        echo"</table></div>";
      }

      echo "<div class='update_content'><input type='submit' value='update lesson'></div>";
      echo "</form>";
    }

  
  ?>
</div>
  