

  <div class="admin_container">
    <h2>New Test</h2>
    <?php
      if(isset($data['all_test']))
        // var_dump($data['all_test']);
    ?>


  <form action="./HomeAdmin/postAppendTest" method="POST">
    
    <label for="select_test">Choose test:</label>
    <select name="choose_test" id="select_test">
      <?php
        $all_test = [];
        if(isset($data['all_test'])){
          $all_test = $data['all_test'];
          for($i = 0; $i < sizeof($all_test); $i++){
            echo "<option value='".$all_test[$i][0]."'>".$all_test[$i][1]."</option>";
          }
        }
        ?>
    </select>


    <?php 
      if(isset($data['num_qs_current'])){
        $num_qs_curr = $data['num_qs_current'];
        // echo "<div> Number current question of this test:". $num_qs_curr ."</div>";
      }
    ?>
    <label for="choose_number">Choose number question:</label>
    <input type="number" id='choose_number_qs' name='number_question'  value='0' max='50' min='0'> 

    <label for="max_num_qs">Max:</label>
    <span id='max_num_qs'> <?php echo $all_test[0][3] ?></span>
    <br><br>

    <label for="test_level">Test level:</label>
    <span id='test_level'> <?php echo $all_test[0][7] ?></span>
    <br><br>


    <input type='hidden' id='input_test_level' name='test_level_input' value='0'>

    <div id='content_add_main'>
    
    <hr>
      <div>Question 1 :</div>
      <label>Name question:</label>
      <input class="input_content" type="text" name='name-1'><br><br>
      
      <label>Content question:</label>
      <textarea class="area_content"  name='question-1'></textarea><br><br>

      <label>Answer 1:</label>
      <input class="input_content" type="text" name='ans_1-1'><br><br>
      
      <label>Answer 2:</label>
      <input class="input_content" type="text" name='ans_2-1'><br><br>
      
      <label>Answer 3:</label>
      <input class="input_content" type="text" name='ans_3-1'><br><br>

      <label>Answer 4:</label>
      <input class="input_content" type="text" name='ans_4-1'><br><br>

    </div>


    <input class="update_content" type="submit" name='insert_test' value='append'><br><br>
  </form>
</div>
  