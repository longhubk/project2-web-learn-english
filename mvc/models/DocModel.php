
<?php 
  class DocModel extends Database{


    private function getDocCategoryIdByName($name){
      $qr = "SELECT doc_ca_id FROM doc_category WHERE name_query = '$name' ";
      return $this->queryAssoc($qr, 'doc_ca_id');
    }

    public function getAllDocsOfCategory($doc_ca_name){
      $doc_ca_id = $this->getDocCategoryIdByName($doc_ca_name);
      $qr = "SELECT * FROM docs WHERE doc_ca_id = '$doc_ca_id'";
      $arr_doc =  $this->queryAllArray($qr);
      for($i = 0; $i < sizeof($arr_doc); $i++){
        $doc_id = $arr_doc[$i][0];
        $ad_post_id = $arr_doc[$i][2];
        $qr2 = "SELECT text FROM doc_content WHERE doc_id = '$doc_id'";
        $qr3 = "SELECT name FROM users WHERE  id = '$ad_post_id'";
        $ad_name = $this->queryAssoc($qr3, "name" );

        $text = $this->queryAllArray($qr2);
        if(!empty($text[0][0]))
          array_push($arr_doc[$i],$text[0][0]);
        else
          array_push($arr_doc[$i],"empty");

        if(!empty($ad_name)){
          array_push($arr_doc[$i],$ad_name);
        }
        else
          array_push($arr_doc[$i],"unknown");
        
      }
      return $arr_doc;

    }

    public function getAllDocCategory(){
      $qr = "SELECT * FROM doc_category";
      return $this->queryAllArray($qr);
    }

    public function getAllDoc(){
      $qr = "SELECT * FROM docs";
      $all_doc = $this->queryAllArray($qr);
      $all_doc_ca = $this->getAllDocCategory();
      for($i = 0; $i < sizeof($all_doc); $i++){
        for($j = 0; $j < sizeof($all_doc_ca); $j++){
          if($all_doc[$i][1] == $all_doc_ca[$j][0]){
            array_push($all_doc[$i], $all_doc_ca[$j][2]);
            break;
          }
        }
      }
      return $all_doc;
    }

    public function getDocContent($doc_name){
      $qr1 = "SELECT doc_id FROM docs WHERE doc_query = '$doc_name'";
      $doc_id = $this->queryAssoc($qr1, "doc_id" );

      $qr = "SELECT * FROM doc_content WHERE doc_id = '$doc_id'";
      return $this->queryAllArray($qr);
    }

    public function getDocNameByDocQuery($doc_name){
      $qr = "SELECT doc_name FROM docs WHERE doc_query = '$doc_name'";
      return $this->queryAssoc($qr, 'doc_name');
    }

    public function getDocCategoryNameByDocQuery($doc_ca_name){
      $qr = "SELECT name FROM doc_category WHERE name_query = '$doc_ca_name'";
      return $this->queryAssoc($qr, 'name');
    }

    public function createNewDoc($post, $file){
      $doc_new_name  = $post['new_doc_name'];
      $doc_ca_id     = $post['choose_doc_category'];
      $user_post_id  = $_SESSION['member_id'];
      $doc_query     = $this->stripVN($doc_new_name);
      $doc_img       = $file['name'];
      $f_Ext_Allowed = array('png', 'jpg', 'gif', 'jpeg');
      $f_dir         = './public/img/doc_img/';
      $qr_max = "SELECT MAX(doc_id) as max_id FROM docs";
      $max_id = $this->queryAssoc($qr_max, 'max_id');

      $new_name = "img_doc_".($max_id+1);

      $f_new_name = $this->uploadFile($file['name'], $file['tmp_name'], $new_name, $file['size'], $file['error'], $f_Ext_Allowed, $f_dir);

      $qr = "INSERT INTO docs VALUES(null, '$doc_ca_id', '$user_post_id', '$doc_new_name', now(), '$doc_query', '$f_new_name')";

      return $this->queryOne($qr);

    }

    public function getDeleteContentDocById($ct_id){
      $f_dir_img = './public/img/doc_img/';
        
      $qr_img_main = "SELECT image FROM doc_content WHERE doc_content_id = '$ct_id' ";
        $img = $this->queryAssoc($qr_img_main, 'image');
        
      $f_dir4 = $f_dir_img . $img;
      if(file_exists($f_dir4))
        unlink($f_dir4);
        
      $qr   = "DELETE FROM doc_content WHERE doc_content_id = '$ct_id'";
      $res = $this->queryOne($qr);

      if($res) return 'ok';
      else return 'fail';

    }

    public function getContentDocById($doc_id){
      $qr = "SELECT * FROM doc_content WHERE doc_id = '$doc_id' ";
      return $this->queryAllArray($qr);
    }

    public function updateDocContent($post, $file){
      $res = false;
      foreach($file as $key => $value){
        $f_arr = explode('-',$key);
        $doc_ct_id    = $f_arr[1];

        $f_name     = $value['name'];
        $f_tmp_name = $value['tmp_name'];
        $f_size     = $value['size'];
        $f_err      = $value['error'];
        $f_Ext_Allowed = array('png', 'jpg', 'gif', 'jpeg');
        $f_dir = './public/img/doc_img/';
        $new_name = 'img_content_doc_'. $doc_ct_id;
        if(!empty($f_name)){
          $f_new_name = $this->uploadFile($f_name, $f_tmp_name, $new_name, $f_size, $f_err, $f_Ext_Allowed, $f_dir);

          $qr = "UPDATE doc_content SET image = '$f_new_name' WHERE doc_content_id = '$doc_ct_id' ";
          $res = $this->queryOne($qr);
        }

      }

      foreach($post as $key => $value){
        $p_arr = explode('-', $key);
        $doc_ct_id = $p_arr[1];
        $qr = "UPDATE doc_content SET text = '$value' WHERE doc_content_id = '$doc_ct_id'";
        $res = $this->queryOne($qr);
      }
      if($res) return 'ok';
      else return 'fail';
    }
    
    public function insertDocContent($post, $file){
      $doc_id   = $post['choose_les'];
      $num_ct   = $post['number_content'];
      $text_str = 'text_content-';
      $img_str  = 'image_doc-';

      for($i = 1; $i <= $num_ct ; $i++ ){
        $text_id  = $text_str . $i;
        $text_ct  = $post[$text_id];
        $img_id   = $img_str . $i;
        $name_img = $file[$img_id]['name'];


        $qr_max = "SELECT MAX(doc_content_id) AS max_id FROM doc_content";
        $max_id = $this->queryAssoc($qr_max, 'max_id');

        $f_Ext_Allowed = array('jpg', 'png', 'jpeg', 'gif');
        $f_dir         = "./public/img/doc_img/";

        $new_name = 'img_content_doc_' . ($max_id+1);
        $f_new_name = $this->uploadFile($name_img, $file[$img_id]['tmp_name'], $new_name, $file[$img_id]['size'], $file[$img_id]['error'], $f_Ext_Allowed, $f_dir);

        $qr = "INSERT INTO doc_content VALUES(null, '$doc_id', '$text_ct', '$f_new_name' )";
        $res1 = $this->queryOne($qr);
      }
      if($res1 && empty($res2)) return true;
      else return false;


    }

  }