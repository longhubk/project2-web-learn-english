  
<div class="admin_container">
  <h2 class="title_ad_page">All Current Tutorial:</h2>
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

      $num_lesson = $data['num_lesson'];
      $all_tut    = $data['all_tutorial'];
      $name_ad    = $data['admin_modify'];
      $all_lesson = $data['all_lesson'];

      echo "Number current tutorial:";
      echo "<span id='all_tut_size'>".sizeof($all_tut)."</span><br><br>";
      for($i = 0; $i < sizeof($all_tut); $i++){

        echo "<span id='tut_id' style='display:none;'>".$all_tut[$i][0]."</span>";

        echo "<table class='tut_table'>";

        echo "<tr class='first_row'><td><a href='Tut/One/".$all_tut[$i][5]."'>".$all_tut[$i][1]."</a></td><td>";

        

        echo "<img title='show lesson' id='show_lesson-".$i."' class='show_lesson icon-96 cursor_add' src='public/icon/eye_icon.png' >";

        echo "&nbsp;&nbsp;&nbsp;<img title='add lesson for this tutorial' id='show_add_lesson-".$i."' class=' icon-96 cursor_add show_lesson' src='public/icon/plus_none_icon.png'></td></tr><tr><td>";
        echo "Number lesson </td>";
        $has_lesson = false;
        for($j = 0; $j < sizeof($num_lesson); $j++){
          if($num_lesson[$j][0] == $all_tut[$i][0]){
            echo "<td>".$num_lesson[$j][1]. "</td></tr>";
            $has_lesson = true;
          }
        }
        if(!$has_lesson)
            echo "<td> 0 </td></tr>";

        echo "<tr><td>Modify by</td><td>";
        for($j = 0; $j < sizeof($name_ad); $j++){
          if($name_ad[$j][0] == $all_tut[$i][2])
            echo $name_ad[$j][1]." </td></tr>";
          else
            echo " unknown </td></tr>";
        }


        echo "<tr><td>Date modify</td>";
          echo"<td>".$all_tut[$i][3]."</td></tr>";

        echo "<tr><td>Level</td>";
          echo"<td>".$all_tut[$i][6]."</td></tr>";

        ?>

      </table>

        <?php
        echo "<div class='toggle_lesson' id='toggle_lesson-".$i."'>";
        ?>

          <table class="table_view_tut">
            <tr class='first_row'>
              <td class="center">STT</td>
              <td>Name lesson</td>
              <td class="center">Option</td>
              <td class="center">Delete</td>
            </tr>

          <?php
            $count_les_tut = 0;
            for($j = 0; $j < sizeof($all_lesson); $j++){
              if($all_lesson[$j][1] == $all_tut[$i][0]){
                echo "<tr>";
                $count_les_tut++;
                echo "<td class='center'>".$count_les_tut. " </td><td>" .$all_lesson[$j][3] . "</td>" ;
                echo "<td class='center'><a title='update lesson' href='./HomeAdmin/getUpdateLesson/".$all_lesson[$j][0]."/".$all_tut[$i][6]."'><img class='icon-96-center' src='public/icon/setting_icon.png'></a></td>";
                echo "<td class='center'><img class='icon-96-center' id='delete_lesson-".$all_lesson[$j][0]."' src='public/icon/delete_icon.png'></a></td>";
                echo "</tr>";
              }
              
            }
          ?>
        </table>
        </div>

        <?php echo "<div class='toggle_lesson' id='toggle_add_lesson-".$i."'>" ?>

          <form method='POST' action='./HomeAdmin/postNewTutorial' enctype="multipart/form-data">
          <table class="add_lesson_table">
            <tr class="first_row">
            </tr>

          <tr>
            <td>Name new lesson</td>
            <td><input type='text' name='new_lesson_name' placeholder='Enter new name of lesson'>
          </tr>
          <tr>
            <td>Title new lesson</td>
            <td><input type='text' name='new_lesson_title' placeholder='Enter title for lesson'></td>
          </tr>

          <tr>
            <td>Image new lesson</td>
            <td>
              <input type="file" name="select_img_les" >
            </td>
          </tr>
          <tr>
            <td>Option</td>
            <td>
              <?php
                echo "<input type='hidden' name='tut_lesson' value='".$all_tut[$i][0]."'>";
              ?>
              <input type='submit' value='add new lesson'>
            </td>
          </tr>

          </table>
          </form>
        </div>

        

        <?php

      }
    }

  ?>

  <div class="clear"></div>


  <img title='add new tutorial' id='btn_add_tut' class="icon-120" src='public/icon/plus_green_icon.png'>

  <div class="add_new_tut">

    <form method='POST' action='./HomeAdmin/postNewTutorial'>
      <table class="new_test_table">

        <tr class="first_row">
          <td>Choose topic </td>
          <td>New tutorial name </td>
          <td>Choose level</td>
          <td></td>

        </tr>
        <tr>
          <td><select name="choose_topic" id="select_topic">
            <?php
              if(isset($data['all_topic'])){
                $all_top = $data['all_topic'];
                for($i = 0; $i < sizeof($all_top); $i++){
                  echo "<option value='".$all_top[$i][1]."'>".$all_top[$i][0]."</option>";
                }
              }
              ?>
            </select>
          </td>
          <td><input type="text" name='new_tut_name' placeholder="Enter new name of tutorial"></td>

          <td>
            <select name="choose_level" id="select_level">
                  <?php
                      for($i = 0; $i < 5; $i++)
                        echo "<option value='".$i."'>Level ".$i."</option>";
                  ?>
            </select>
          </td>
          <td>
            <input type="submit" value='add new tutorial'>
          </td>

        </tr>

      
      </table>
    </form>

  </div>
</div>
  