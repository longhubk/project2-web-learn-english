  
<div class="admin_container">
  <h2 class="title_ad_page">All Current Doc:</h2>
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

    if(isset($data['all_doc'])){
      $all_doc    = $data['all_doc'];

      echo "Number current document:";
      echo "<span id='all_tut_size'>".sizeof($all_doc)."</span><br><br>";

      for($i = 0; $i < sizeof($all_doc); $i++){

        if(isset($data['all_doc_ca'])){
          $all_doc_ca = $data['all_doc_ca'];
          for($j = 0; $j <sizeof($all_doc_ca); $j++){
            if($all_doc[$i][1] == $all_doc_ca[$j][0])
              array_push($all_doc[$i], $all_doc_ca[$j][2]);
          }
        }

        echo "<table class='tut_table'>

          <tr class='first_row'>
            <td><a href='DocsPage/Read/".$all_doc[$i][7]."/".$all_doc[$i][5]."'>".$all_doc[$i][3]."</a></td>
            <td>
              <img title='edit doc' id='edit_doc-".$i."' class=' icon-96 cursor_add show_lesson' src='public/icon/edit_icon.png'>

              <a href='AdminPage/getUpdateDoc/".$all_doc[$i][1]."/".$all_doc[$i][0]."'><img title='edit doc' id='update_doc-".$i."' class=' icon-96 cursor_add show_lesson' src='public/icon/setting_icon.png'></a>
            </td>
          </tr>

          <tr>
            <td>Date modify</td>
            <td>".$all_doc[$i][4]."</td>
          </tr>";
      }
    }

    ?>

  </table>


        

  <div class="clear"></div>


  <img title='add new doc' id='btn_add_doc' class="icon-120" src='public/icon/plus_green_icon.png'>

  <div class="add_new_doc">

    <form method='POST' action='./AdminPage/postNewDoc' enctype='multipart/form-data' >
      <table class="new_test_table">
        <tr class="first_row">
          <td>Choose Category </td>
          <td>New doc name </td>
          <td>Doc Image </td>
          <td></td>
        </tr>
        <tr>
          <td>
            <select name="choose_doc_category" id="select_topic">
            <?php
              if(isset($data['all_doc_ca'])){
                $all_doc_ca = $data['all_doc_ca'];
                for($i = 0; $i < sizeof($all_doc_ca); $i++)
                  echo "<option value='".$all_doc_ca[$i][0]."'>".$all_doc_ca[$i][1]."</option>";
              }
              ?>
            </select>
          </td>
          <td><input type="text" name='new_doc_name' placeholder="Enter new name of doc"></td>

          <td><input type="file" name='img_doc' accept='.jpg,.png,.gif,.jpeg' ></td>

          <td><input type="submit" value='add new doc'></td>

        </tr>

      
      </table>
    </form>

  </div>
</div>
  