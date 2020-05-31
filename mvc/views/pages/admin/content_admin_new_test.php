

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
        $max_num_qs = $all_test[0][3] - $num_qs_curr[0][0];
      }
    ?>
    <label for="choose_number">Choose number question:</label>
    <input type="number" id='choose_number_qs' name='number_question' value= <?php
      if($max_num_qs > 0)
        echo '1';
      else
        echo '0';
    ?>
    max='50' min='0'> 

    <label for="max_num_qs">Max:</label>
    <span id='max_num_qs'> <?php echo $max_num_qs ?></span>
    <br><br>

    <label for="test_level">Test level:</label>
    <span id='test_level'> <?php echo $all_test[0][7] ?></span>
    <br><br>


    <input type='hidden' id='input_test_level' name='test_level_input' value='0'>

    <div id='content_add_main'>
      <?php if($max_num_qs > 0){ ?>
      <hr>
      <div>Question 1 :</div>
        <label>Name question:</label>
        <input class="input_content" type="text" name='name-1'><br><br>
        
        <label>Content question:</label>
        <textarea class="area_content"  name='question-1'></textarea><br><br>
        
        <?php
          for($i = 1; $i <= 4; $i++){
            echo "
            <label>Answer ".$i.":</label>
            <input class='input_content' type='text' name='ans_".$i."-1'>
            <label>isRight:</label>
            <input class='check_content' type='checkbox' value='1' name='isRight_".$i."-1'><br><br>
            ";
          }
          ?>
      <?php }else{
        echo "Test had max number question!!!";  
      }
      ?>
      

    </div>
    <input class="update_content" type="submit" name='insert_test' value='append'><br><br>
  </form>
</div>
  