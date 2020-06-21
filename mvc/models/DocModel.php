
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

  }