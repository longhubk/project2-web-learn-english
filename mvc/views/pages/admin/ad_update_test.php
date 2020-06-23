  
<div class="admin_container">
  <h2 class="title_ad_page">Update Test:</h2>
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

    // $test_id = 0;
    if(isset($data['id_test_update']) && isset($data['name_test_update'])){
      // var_dump($data['id_test_update']);
      $test_id = $data['id_test_update'];
      $test_name = $data['name_test_update'];
      echo "You want to update test: " . $test_name . "<br><br>";
    }

    if(isset($data['content_test'])){
      $content_test = $data['content_test'];
      echo "<div>Number question: <span id='num_qs_up'>".sizeof($content_test)."</span></div>";

      $test_level = $data['test_level'];

      // echo "test_id = ". $test_id;
      echo "<form id='update_test' method='POST' action='./AdminPage/postUpdateTest/".$test_id."/".$test_level."'>"; 

      for($i = 0; $i < sizeof($content_test); $i++){

        $test_qs_id = $content_test[$i][0];
        $qs_name    = $content_test[$i][1];
        $qs_content = $content_test[$i][2];
        $ans        = [];
        $isRight    = [];

        for($j = 1; $j <= 4; $j++){
          $ans[$j] = $content_test[$i][$j+2];
          $isRight[$j] = $content_test[$i][$j+7];
        }

        echo "<div id='content-".$test_qs_id."'>";
        echo "<hr>
            <table class='table_new_content'>
            <tr class='first_row'>
              <td class='first_column'>Question ".($i+1)."</td>
              <td class='middle_column'>Content</td>
              <td class='last_column'>Right answer</td>
            <tr>";

        echo "<tr>
            <td class='first_column'>Name question</td>
            <td class='input_content middle_column'> 
              <textarea name='name-".$test_qs_id."' >".$qs_name."</textarea>
            </td>
            <td></td>
            </tr>";

        echo "<tr>
            <td class='first_column'>Content question</td>
            <td class='input_content middle_column'> 
              <textarea class='area_content' name='question-".$test_qs_id."'>".$qs_content."</textarea>
            </td>
            <td></td>
            </tr>";

        for($j = 1; $j <= 4; $j++){


          echo "<tr>
            <td class='first_column'> Answer ".$j."</td>
            <td class='middle_column input_content'> 
              <textarea name='ans_".$j."-".$test_qs_id."'>".$ans[$j]."</textarea>
            </td>";

          if($isRight[$j] == 'true'){
            echo "<input id='isRightHidden-".$i."-".$j."' type='hidden' name='isRight_".$j."-".$test_qs_id."' value='false'>";
          }
          echo "<td class='last_column'><input type='checkbox' id='isRight-".$i."-".$j."' class='check_content' name='isRight_".$j."-".$test_qs_id."' value='true'"; 
          ?><?php if($isRight[$j] == 'true') echo 'checked';

          echo "></td></tr>";

        }

        echo"</table>";
        echo"</div><br>";
      }
    }
  ?>
      <a id='btn_add_qs' href='AdminPage/getNewTestQuestion/'>Add more question..</a><br><br>
      <div class="update_content">
          <input type='submit' value='update test'>
      </div>
    </form>
</div>
  