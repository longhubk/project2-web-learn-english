
  <div class="admin_container">
    <h2 class='title_ad_page'>New Lesson</h2>
    <?php
     // var_dump($_SESSION);
      if(isset($data['post_up']))
        var_dump($data['post_up']);
    ?>

  <!-- <a href="./HomeAdmin/getLessonOfTutorial">test</a> -->



  <form action="./HomeAdmin/postNewLesson" method="POST" enctype="multipart/form-data">
    <table class="table_control">
      <tr class="first_row">
        <td>Choose Tutorial</td>
        <td>Choose Lesson</td>
        <td>Number Content</td>
        <td>Tutorial Level</td>
      </tr>

      <tr>
        <td>
          <select name="choose_tut" id="select_tut">
            <?php
              if(isset($data['all_tutorial'])){
                $all_tut = $data['all_tutorial'];
                for($i = 0; $i < sizeof($all_tut); $i++){
                  echo "<option value='".$all_tut[$i][1]."'>".$all_tut[$i][0]."</option>";
                }
              }
              ?>
          </select>
        </td>
        <td>
          <select name="choose_les" id="select_les">
            <?php
              if(isset($data['all_lesson'])){
                $all_les = $data['all_lesson'];
                for($i = 0; $i < sizeof($all_les); $i++){
                  echo "<option value='".$all_les[$i][1]."'>".$all_les[$i][0]."</option>";
                }
              }
              ?>
          </select>
        </td>
        <td>
          <input type="number" id='choose_number' name='number_content'  value='1' max='10' min='1'> 
        </td>
        <td>
          <span id='tut_level'>
            <?php
              if(isset($data["all_tutorial"])){
                echo $data["all_tutorial"][0][2];
              }
            ?>
          </span>
        </td>
      </tr>
    </table>
    <br>
    <input type='hidden' id='input_tut_level' name='tut_level_input' value='2'>


      <div id='content_add_main'>
        <hr>
        <div>Content 1 :</div>
        <table id='content_1'>
          <tr>
            <td class='title_content'>Main Content</td>
            <td class="input_content"><textarea type="text" name='main_content-1'></textarea></td>

          </tr>
          <tr>
            <td class='title_content'>Guide Content</td>
            <td class="input_content"><textarea type="text" name='guide_content-1'></textarea></td>
          </tr>
          <?php 
          for($i = 1; $i <= 3; $i++){
            echo "<tr>";
              echo "<td class='title_content'>Example ".$i."</td>";
              echo "<td class='input_content'><textarea type='text' name='exp-1-".$i."'></textarea></td>";
            echo "</tr>";
          }
          ?>
        </table>
        <img class='icon-96' id='add_ex_1' src='public/icon/plus_green_icon.png'>
        <img class='icon-96' id='rm_ex_1' src='public/icon/minus_red_icon.png'>
      </div>
      <br>
      <div class="update_content">
        <input  type="submit" name='update_content' value='update'><br><br>
      </div>
  </form>
</div>
  