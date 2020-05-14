  
  <div class="admin_container">
    <h2>Update Tutorial</h2>
    <?php
      if(isset($data['update_state']))
        echo $data['update_state'];
    ?>

  <form action="./HomeAdmin/updateLesson" method="POST">
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
    </select>
    
    <br><br>
    <label>Main Content:</label>
    <input class="input_content" type="text" name='main_content'><br><br>
    <label>Guide Content:</label>
    <input class="input_content" type="text" name='guide_content'><br><br>
    <label>Example 1:</label>
    <input class="input_content" type="text" name='exp_1'><br><br>
    
    <label>Example 2:</label>
    <input class="input_content" type="text" name='exp_2'><br><br>
    
    <label>Example 3:</label>
    <input class="input_content" type="text" name='exp_3'><br><br>

    <label>Example 4:</label>
    <input class="input_content" type="text" name='exp_4'><br><br>
    
    <label>Example 5:</label>
    <input class="input_content" type="text" name='exp_5'><br><br>
    
    <input class="update_content" type="submit" name='update_content' value='update'><br><br>
  </form>
</div>
  