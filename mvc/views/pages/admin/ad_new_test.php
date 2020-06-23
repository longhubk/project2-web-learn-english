

  <div class="admin_container">
    <h2 class="title_ad_page">New Test</h2>
    <?php
      if(isset($data['all_test']))
        // var_dump($data['all_test']);
    ?>


  <form action="./AdminPage/postAppendTest" method="POST">
    <table class="table_control">
      <tr class="first_row">
        <td>Choose test</td>
        <td>Number question</td>
        <td>Max number question</td>
        <td>Test level</td>
      </tr>

      <tr>
        <td>
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
        </td>
        <td>
          <?php 
            if(isset($data['num_qs_current'])){
              $num_qs_curr = $data['num_qs_current'];
              $max_num_qs = $all_test[0][3] - $num_qs_curr[0][0];
            }
          ?>
          
          <input type="number" id='choose_number_qs' name='number_question' value= <?php
            if($max_num_qs > 0)
              echo '1';
            else
              echo '0';
          ?>
          max='50' min='0'> 
        </td>
        <td>
          <span id='max_num_qs'> <?php echo $max_num_qs ?></span>
        </td>

        <td>
          <span id='test_level'> <?php echo $all_test[0][7] ?></span>
        </td>
      </tr>
    </table>


    <br><br>


    <input type='hidden' id='input_test_level' name='test_level_input' value='0'>



    <div id='content_add_main'>
      <?php if($max_num_qs > 0){ ?>
      <hr>
        <table class="table_new_content">
          <tr class="first_row">
            <td class="first_column">Question 1</td>
            <td class="middle_column">Content</td>
            <td class="last_column">Right answer</td>
          </tr>

          <tr>
            <td class="first_column">Name question </td>
            <td class="middle_column input_content">
              <textarea name='name-1'></textarea><br><br>
            </td>
            <td class="last_column"></td>
          </tr>


          <tr>
            <td class="first_column">Content question </td>
            <td class="input_content middle_column" >
              <textarea class="area_content"  name='question-1'></textarea><br><br>
            </td>
            <td class="last_column"></td>
          </tr>


          <?php
            for($i = 1; $i <= 4; $i++){
              echo "
              <tr><td class='first_column'>Answer ".$i.":</td>
              <td class='input_content middle_column'><textarea name='ans_".$i."-1'></textarea></td>
              <td class='last_column'><input class='check_content' type='checkbox' value='true' name='isRight_".$i."-1'></td></tr>
              ";
            }
            ?>

        </table>
        
        
      <?php }else echo "Test had max number question!!!";  ?>

    </div>

    <?php
    echo "<br><a id='dynamic_link'  href='AdminPage/getUpdateTest/".$data['all_test'][0][0]."/".$data['all_test'][0][7]."'>Update this test..</a><br><br> ";
    ?>
    <div class="update_content">
      <input  type="submit" name='insert_test' value='append'><br><br>
    </div>
  </form>
</div>
  