  
<div class="admin_container">
  <h2 class="title_ad_page" >All Current Test:</h2>
  <?php
    if(isset($data['res_new_test'])){
      if($data['res_new_test'])
        echo "Create test success";
      else
        echo "Create test fail";
    }

    if(isset($data['post_new_test'])){
      // var_dump($data['post_new_test']);
    }

    if(isset($data['all_test'])){
      // var_dump($data['all_test']);
    }

    if(isset($data['all_question'])){
      // echo "all question:";
      // var_dump($data['all_question']);
    }

    if( isset($data['all_test']) && 
        isset($data['num_question']) &&
        isset($data['all_question']) &&
        isset($data['admin_modify'])){

      // var_dump($data['num_question']);
      $num_question = $data['num_question'];
      $all_test     = $data['all_test'];
      $name_ad      = $data['admin_modify'];
      $all_question = $data['all_question'];

      echo "Number current test:";
      echo "<span id='all_test_size'>".sizeof($all_test)."</span><br><br>";

      for($i = 0; $i < sizeof($all_test); $i++){
        

        

        $has_question = false;
        echo "
          <table class='test_table'>
          <tr class='first_row'>
            <td class='title_content'>
              <a href='TestPage'>".$all_test[$i][1]."</a>
            </td>
            <td>
              <img title='show question' id='show_lesson-".$i."' class='icon-96 show_question ' src='public/icon/eye_icon.png'>

              <a title='update test' href='./AdminPage/getUpdateTest/".$all_test[$i][0]."/".$all_test[$i][7]."'><img class=' icon-96 setting_question' src='public/icon/setting_icon.png'></a>

              <img title='edit test' id='edit_test-".$i."' class=' icon-96 setting_question' src='public/icon/edit_icon.png'>
            </td>
          </tr>
        ";
        
        echo "<tr>";
        for($j = 0; $j < sizeof($num_question); $j++){
          if($num_question[$j][0] == $all_test[$i][0]){
            echo "<td class='title_content'>Number question</td>
                  <td>".$num_question[$j][1]."</td>";
            $has_question = true;
          }
        }
        if(!$has_question)
          echo "<td class='title_content'>Number question</td>
                <td>0</td>
              </tr>";


        for($j = 0; $j < sizeof($name_ad); $j++){
          if($name_ad[$j][0] == $all_test[$i][5]){

            echo "<tr>
                    <td class='title_content'>Modify by</td>
                    <td>".$name_ad[$j][1]."</td>
                  </tr>";

          }
          else{
            echo "<tr>
                    <td class='title_content'>Modify by</td>
                    <td>Unknown</td>
                  </tr>";
          }
        }

        echo "
            <tr>
              <td class='title_content'>Date modify</td>
              <td>".$all_test[$i][6]."</td>
            </tr>

            <tr>
              <td class='title_content'>Time test</td>
              <td>".$all_test[$i][2]."</td>
            </tr>

            <tr>
              <td class='title_content'>Level</td>
              <td>".$all_test[$i][7]."</td>
            </tr>

            <tr>
              <td class='title_content'>Description</td>
              <td class='des_test'>".$all_test[$i][4]."</td>
            </tr>

        </table>";

        echo "<div id='toggle_edit_test-".$i."'>";
        ?>
        <form method="POST" action="./AdminPage/postEditTest">
        <table class="toggle_edit_test_table">
          <tr class="first_row">
            <td class="first_column">Edit</td>
            <td><input type='submit' value='Save'></td>
          </tr>
        <?php
          echo "<input type='hidden' name='test_id' value='".$all_test[$i][0]."'>";
              echo "
                  <tr>
                    <td class='title_content'>New name test</td>
                    <td><input type='text' name='new_name_test' value='".$all_test[$i][1]."'></td>
                  </tr>
                  
                  <tr>
                    <td class='title_content'>New time</td>
                    <td><input type='number' max='60' min='5' name='new_time_test' value='".$all_test[$i][2]."'></td>
                  </tr>

                  
                  <tr>
                    <td class='title_content'>Number question</td>
                    <td><input type='number' max='60' min='5' name='new_num_test' value='".$all_test[$i][3]."'></td>
                  </tr>


                  <tr>
                    <td class='title_content'>New Level</td>
                    <td><input type='number' max='4' min='0' name='new_level_test' value='".$all_test[$i][7]."'></td>
                  </tr>

                  <tr>
                    <td>New description</td>
                    <td><textarea type='text' name='new_des_test' > ".$all_test[$i][4]."</textarea></td>
                  </tr>

                  ";
        ?>
          </form>

        </table>
        </div><br>

        <?php


        echo "<div class='toggle_lesson' id='toggle_lesson-".$i."'>";
        ?>

        <table class='view_question_table'>
          <tr class="first_row">
            <td class="first_column">Name</td>
            <td>Question</td>
            <td>Answer 1</td>
            <td>Answer 2</td>
            <td>Answer 3</td>
            <td>Answer 4</td>
          </tr>
        <?php
        $count_qs_test = 0;
          for($j = 0; $j < sizeof($all_question); $j++){
            if($all_question[$j][7] == $all_test[$i][0]){
              echo "<tr>";
              echo "<td>".$all_question[$j][1]."</td>" ;
              echo "<td>".$all_question[$j][2]."</td>" ;
              echo "<td>".$all_question[$j][3]."</td>" ;
              echo "<td>".$all_question[$j][4]."</td>" ;
              echo "<td>".$all_question[$j][5]."</td>" ;
              echo "<td>".$all_question[$j][6]."</td>" ;
              echo"</tr>";
              $count_qs_test++;
            }
          }

        ?>

        </table>
        </div><br>

        <?php

      }
    }

  ?>


    <div class="clear"></div>

  <img title='add new test' id='btn_add_tut' class="icon-120" src='public/icon/plus_green_icon.png'>

  <div class="add_new_tut">

    <form method='POST' action='./AdminPage/postNewTest'>
      <table class="new_test_table">
      <tr class="first_row">
        <td>New Name Of Test</td>
        <td>Choose Level</td>
        <td>Number Question</td>
        <td>Time Of Test</td>
        <td>Description Of Test</td>
        <td></td>
        
      </tr>

      <tr>
        <td><input type="text" name='new_test_name' placeholder="Enter new name of test"></td>

        <td>
          <select name="choose_level" id="select_level">
            <?php
              for($i = 1; $i < 5; $i++)
                echo "<option value'".$i."'>Level ".$i."</option>";
            ?>
          </select>
        </td>

        <td><input type="number" name='number_qs' placeholder="Enter number question" max= '50' min='10' value="15"></td>

        <td><input type="number" name='test_time' placeholder="Enter time of test(minutes)" max= '60' min='5' value="15"></td>

        <td><textarea name="test_description" class='test_area_des' placeholder="Enter new description of this test..."></textarea></td>

        <td><input type="submit" value='add new test'></td>
      </tr>

      </table>

      
    </form>

  </div>
</div>
  