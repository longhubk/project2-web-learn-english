
<?php 
  class DocModel extends Database{


    private function getDocCatalogIdByName($name){
      $qr = "SELECT doc_ca_id FROM doc_catalog WHERE name_query = '$name' ";
      return $this->queryAssoc($qr, 'doc_ca_id');
    }

    public function getAllDocsOfCatalog($doc_ca_name){
      $doc_ca_id = $this->getDocCatalogIdByName($doc_ca_name);
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

    public function getAllDocCatalog(){
      $qr = "SELECT * FROM doc_catalog";
      return $this->queryAllArray($qr);
    }

    public function getAllDoc(){
      $qr = "SELECT * FROM docs";
      return $this->queryAllArray($qr);
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

    public function getDocCatalogNameByDocQuery($doc_ca_name){
      $qr = "SELECT name FROM doc_catalog WHERE name_query = '$doc_ca_name'";
      return $this->queryAssoc($qr, 'name');

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

        $qr = "INSERT INTO doc_content VALUES(null, '$doc_id', '$text_ct', '$name_img' )";
        $res1 = $this->queryOne($qr);

        $f_Ext_Allowed = array('jpg', 'png', 'jpeg', 'gif');
        $f_dir         = "./public/img/doc_img/";
        $res2 = $this->uploadFile($name_img, $file[$img_id]['tmp_name'], $file[$img_id]['size'], $file[$img_id]['error'], $f_Ext_Allowed, $f_dir);

      }
      if($res1 && empty($res2)) return true;
      else return false;


    }

  }