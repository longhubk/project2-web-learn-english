  
<div class="admin_container">
  <h2>All Current Test:</h2>
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
        
        echo "<a href='#'>".$all_test[$i][1]."</a><br>";
        $has_question = false;
        for($j = 0; $j < sizeof($num_question); $j++){
          if($num_question[$j][0] == $all_test[$i][0]){
            echo "Number question: ".$num_question[$j][1]. "    ";
            $has_question = true;
          }
        }
        if(!$has_question)
            echo "Number question: 0    ";

        echo "<i title='show question' id='show_lesson-".$i."' class=' show_question fas fa-eye'></i>";
        ?>


        <?php
        echo "<a title='update test' href='./HomeAdmin/getUpdateTest/".$all_test[$i][0]."/".$all_test[$i][7]."'><i class='material-icons setting_question'>settings</i></a><br>";

        echo "<div class='toggle_lesson' id='toggle_lesson-".$i."'>";

        $count_qs_test = 0;
          for($j = 0; $j < sizeof($all_question); $j++){
            if($all_question[$j][7] == $all_test[$i][0]){
              $count_qs_test++;
              echo "<div>".$count_qs_test. " : " .$all_question[$j][3] ;
              echo "</div><br>";
            }
          }

        echo "</div>"
        ?>

        <?php
        for($j = 0; $j < sizeof($name_ad); $j++){
          if($name_ad[$j][0] == $all_test[$i][5])
            echo "Modify by: ".$name_ad[$j][1]." <br>";
          else
            echo "Modify by: unknown <br>";
        }

        echo "Date modify: ".$all_test[$i][6]." <br>";

        echo "Level : ".$all_test[$i][7]." <br><br>";

      }
    }

  ?>



  <i title='add new test' id='btn_add_tut' class=" material-icons">add_circle</i>

  <div class="add_new_tut">

    <form method='POST' action='./HomeAdmin/postNewTest'>
      <input type="text" name='new_test_name' placeholder="Enter new name of test">

      <label for="select_level">Choose level:</label>
      <select name="choose_level" id="select_level">
        <option value="0">level 0</option>
        <option value="1">level 1</option>
        <option value="2">level 2</option>
        <option value="3">level 3</option>
        <option value="4">level 4</option>
      </select>

      <label for="number_qs">Number question:</label>
      <input type="number" name='number_qs' placeholder="Enter number question" max= '50' min='10' value="15">

      <label for="test_time">Time of test:</label>
      <input type="number" name='test_time' placeholder="Enter time of test(minutes)" max= '60' min='5' value="15"><br>

      <label for="test_description">Description of test:</label>
      <textarea name="test_description" class='area_content'></textarea><br>

      <input type="submit" value='add new test'>
      
    </form>

  </div>
</div>
  