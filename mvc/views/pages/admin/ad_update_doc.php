<div class="admin_container">
  <h2 class="title_ad_page" >Update Document:</h2>
  <?php 
  
    if(isset($data['doc_id'])){
      $doc_id = $data['doc_id'];
      echo " Do you want to update doc: <span id='les_up_id'>" . $doc_id . "</span><br>";
    }
    

    if(isset($data['res_update_doc'])){
      $res_up = $data['res_update_doc'];
      if($res_up)
        echo "Update Success <br>";
      else
        echo "Update Fail<br>";
    }

    if(isset($data['content_doc'])){
      $content_doc = $data['content_doc'];
      echo "<div style='display:none;' id='max_id_ct_doc'>".$content_doc[sizeof($content_doc)-1][0]."</div>";

      $doc_ca_id = $data['doc_ca_id'];

      echo "<form method='POST' action='./AdminPage/postUpdateDoc/".$doc_ca_id."/".$doc_id."' enctype='multipart/form-data'>"; 

      for($i = 0; $i < sizeof($content_doc); $i++){
        $content_id    = $content_doc[$i][0];
        $content_text  = $content_doc[$i][2];
        $content_image = $content_doc[$i][3];

        echo "<div id='ct_main-".$content_id."'>
              <hr>
              <label> Content ".($i+1)."</label><br><br>
              <img class='icon-120' id='del_ct_doc-".$content_id."' src='public/icon/delete_icon.png'>
              <table class='table_update_content' id='content_".($i+1)."'>
                <tr>
                  <td class='title_content'> Text content</td>
                  <td class='input_content' > 
                    <textarea class='doc_area'  name='text-".$content_id."' >".$content_text."</textarea>
                  </td>
                </tr>

                <tr>
                  <td class='title_content' > Image content</td>
                  <td class='input_content' > 
                    <div>".$content_image."</div>
                    <input name='image-".$content_id."' type='file' accept='.jpg,.png,.gif,.jpeg' >
                  </td>
                </tr>
              </table>
              </div><br>

                ";
      }


      echo "<br><div class='update_content'><input type='submit' value='update doc'></div>
        </form>";
    }

  
  ?>
</div>
  