  
<div class="admin_container">
  <h2>All Current Tutorial:</h2>
  <?php
    if(isset($data['res_new_tut'])){
      if($data['res_new_tut'])
        echo "Create success";
      else
        echo "Create fail";
    }

    if(isset($data['post_new_tut'])){
      var_dump($data['post_new_tut']);
    }

    if( isset($data['all_tutorial']) && 
        isset($data['num_lesson']) &&
        isset($data['all_lesson']) &&
        isset($data['admin_modify'])){

      // var_dump($data['all_tutorial']);
      // var_dump($data['num_lesson']);
      $num_lesson = $data['num_lesson'];
      $all_tut    = $data['all_tutorial'];
      $name_ad    = $data['admin_modify'];
      $all_lesson = $data['all_lesson'];

      echo "Number current tutorial:";
      echo "<span id='all_tut_size'>".sizeof($all_tut)."</span><br><br>";
      for($i = 0; $i < sizeof($all_tut); $i++){
        
        echo "<a href='#'>".$all_tut[$i][1]."</a><br>";
        $has_lesson = false;
        for($j = 0; $j < sizeof($num_lesson); $j++){
          if($num_lesson[$j][0] == $all_tut[$i][0]){
            echo "Number lesson: ".$num_lesson[$j][1]. "    ";
            $has_lesson = true;
          }
        }
        if(!$has_lesson)
            echo "Number lesson: 0    ";

        echo "<i title='show lesson' id='show_lesson-".$i."' class=' show_lesson fas fa-eye'></i>";
        echo "&nbsp;&nbsp;&nbsp;<i title='add lesson for this tutorial' id='show_add_lesson-".$i."' class='cursor_add show_lesson material-icons'>&#xe145;</i><br>"

        ?>


        <?php

        echo "<div class='toggle_lesson' id='toggle_add_lesson-".$i."'>";
          echo "<form method='POST' action='./HomeAdmin/postNewTutorial'>";
          echo "<input type='text' name='new_lesson_name' placeholder='Enter new name of lesson'>";
          echo "<input type='text' name='new_lesson_title' placeholder='Enter title for lesson'>";
          echo "choose extension image:";
          echo "<select  name='select_ext_img'>";
              echo "<option value='.png'>.png</option>";
              echo "<option value='.jpg'>.jpg</option>";
              echo "<option value='.gif'>.gif</option>";
          echo"</select>";
          echo "<input type='hidden' name='tut_lesson' value='".$all_tut[$i][0]."'>";
          echo "<input type='submit' value='add new lesson'>";
          echo"</form>";
        echo"</div>";

        echo "<div class='toggle_lesson' id='toggle_lesson-".$i."'>";

        $count_les_tut = 0;
          for($j = 0; $j < sizeof($all_lesson); $j++){
            if($all_lesson[$j][1] == $all_tut[$i][0]){
              $count_les_tut++;
              echo "<div>".$count_les_tut. " : " .$all_lesson[$j][3] ;
              echo "<a title='update lesson' href='./HomeAdmin/getUpdateLesson/".$all_lesson[$j][0]."'><i class='material-icons setting_lesson'>settings</i></a>";
              echo "</div><br>";

            }
            
          }

        ?>

        </div>
        

        <?php
        for($j = 0; $j < sizeof($name_ad); $j++){
          if($name_ad[$j][0] == $all_tut[$i][2])
            echo "Modify by: ".$name_ad[$j][1]." <br>";
          else
            echo "Modify by: unknown <br>";
        }


        echo "Date modifiy: ".$all_tut[$i][3]." <br><br>";

      }
    }

  ?>



  <i title='add new tutorial' id='btn_add_tut' class=" material-icons">add_circle</i>

  <div class="add_new_tut">

    <form method='POST' action='./HomeAdmin/postNewTutorial'>
      <label for="select_topic">Choose topic:</label>
      <select name="choose_topic" id="select_topic">
      <?php
        if(isset($data['all_topic'])){
          $all_top = $data['all_topic'];
          for($i = 0; $i < sizeof($all_top); $i++){
            echo "<option value='".$all_top[$i][1]."'>".$all_top[$i][0]."</option>";
          }
        }
        ?>
      </select>
      <input type="text" name='new_tut_name' placeholder="Enter new name of tutorial">

      <label for="select_level">Choose level:</label>
      <select name="choose_level" id="select_level">
        <option value="0">level 0</option>
        <option value="1">level 1</option>
        <option value="2">level 2</option>
        <option value="3">level 3</option>
        <option value="4">level 4</option>
        
      </select>

      <input type="submit" value='add new tutorial'>
      
    </form>

  </div>
</div>
  