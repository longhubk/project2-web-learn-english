
<?php 
  class DocModel extends DB{


    private function getDocCatalogIdByName($name){
      $qr = "SELECT doc_ca_id FROM doc_catalog WHERE name_query = '$name' ";
      return $this->queryAssoc($qr, 'doc_ca_id');
    }

    public function getAllDocsOfCatalog($doc_ca_name){
      $doc_ca_id = $this->getDocCatalogIdByName($doc_ca_name);
      $qr = "SELECT * FROM docs WHERE doc_ca_id = '$doc_ca_id'";
      return $this->queryAllArray($qr);
    }

    public function getAllDocCatalog(){
      $qr = "SELECT * FROM doc_catalog";
      return $this->queryAllArray($qr);
    }

  }