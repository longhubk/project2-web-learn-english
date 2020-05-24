  
  <div class="admin_container">
    <h2>New Lesson</h2>
    <?php
      if(isset($data['post_up']))
        var_dump($data['post_up']);
    ?>

  <!-- <a href="./HomeAdmin/getLessonOfTutorial">test</a> -->



  <form action="./HomeAdmin/postNewLesson" method="POST">
    <!-- <label for="select_topic">Choose topic:</label>
    <select name="choose_topic" id="select_topic">
      <?php
        if(isset($data['all_topic'])){
          $all_top = $data['all_topic'];
          for($i = 0; $i < sizeof($all_top); $i++){
            echo "<option value='".$all_top[$i][1]."'>".$all_top[$i][0]."</option>";
          }
        }
        ?>
    </select> -->
    
    <label for="select_tut">Choose tutorial:</label>
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
    <label for="select_lesson">Choose lesson:</label>
    <select name="choose_les" id="select_les">
      <?php
        if(isset($data['all_lesson'])){
          $all_les = $data['all_lesson'];
          for($i = 0; $i < sizeof($all_les); $i++){
            echo "<option value='".$all_les[$i][1]."'>".$all_les[$i][0]."</option>";
          }
        }
        ?>
    </select><br><br>

    <label for="choose_number">Choose number content:</label>
    <input type="number" id='choose_number' name='number_content'  value='1' max='10' min='1'> 
    
    <br><br>

    <div id='tut_level_main'>Tutorial Level: 
      <span id='tut_level'>
        <?php
          if(isset($data["all_tutorial"])){
            echo $data["all_tutorial"][0][2];
          }
        ?>
      </span>
    </div>
    <input type='hidden' id='input_tut_level' name='tut_level_input' value='2'>


    <div id='content_add_main'>
    
    <hr>
    <div>Content 1 :</div>
    <label>Main Content:</label>
    <input class="input_content" type="text" name='main_content-1'><br><br>
    <label>Guide Content:</label>
    <input class="input_content" type="text" name='guide_content-1'><br><br>
    <label>Example 1:</label>
    <input class="input_content" type="text" name='exp-1-1'><br><br>
    
    <label>Example 2:</label>
    <input class="input_content" type="text" name='exp-1-2'><br><br>
    
    <label>Example 3:</label>
    <input class="input_content" type="text" name='exp-1-3'><br><br>

    <label>Example 4:</label>
    <input class="input_content" type="text" name='exp-1-4'><br><br>
    
    <label>Example 5:</label>
    <input class="input_content" type="text" name='exp-1-5'><br><br>

    </div>


    <input class="update_content" type="submit" name='update_content' value='update'><br><br>
  </form>
</div>
  