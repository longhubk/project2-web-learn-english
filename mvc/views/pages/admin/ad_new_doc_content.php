
  <div class="admin_container">
    <h2 class='title_ad_page'>New Lesson</h2>
    <?php
     // var_dump($_SESSION);
      if(isset($data['post_up']))
        var_dump($data['post_up']);
    ?>


  <form action="./AdminPage/postNewContentDoc" method="POST" enctype="multipart/form-data">
    <table class="table_control">
      <tr class="first_row">
        <td>Choose Doc</td>
        <td>Number Content</td>
      </tr>

      <tr>
        <td>
          <select name="choose_les" id="select_les">
            <?php
              if(isset($data['all_doc'])){
                $all_doc = $data['all_doc'];
                for($i = 0; $i < sizeof($all_doc); $i++)
                  echo "<option value='".$all_doc[$i][0]."'>".$all_doc[$i][3]."</option>";
              }
            ?>
          </select>
        </td>
        <td>
          <input type="number" id='choose_number_doc' name='number_content'  value='1' max='10' min='1'> 
        </td>

      </tr>
    </table>
    <br>

      <div id='content_add_main'>
        <hr>
        <div>Content 1 :</div>

        <table id='content_1' class='table_new_content_les'>
          <tr>
            <td class='title_content'>Text Content</td>
            <td class="input_content"><textarea type="text" name='main_content-1'></textarea></td>
          </tr>

          <tr>
            <td class='title_content'>Image</td>
            <td class='input_content'><input type='file' accept='.jpg,.png,.gif,.jpeg' name='image_doc-1'></td>
          </tr>


        </table>

      </div>
      <br>
      <div class="update_content">
        <input  type="submit" name='update_content' value='update'><br><br>
      </div>
  </form>
</div>
  