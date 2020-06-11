<?php 
  class Docs extends Controller{


    public function Init(){
      if(!isset($_SESSION['member_id'])){
        if(isset($_COOKIE['member_login']))
          $this->user_db->checkSession($_COOKIE['member_login'], '');
        else
          header('Location:Register/');
      }
      $this->view("master_h", [
        "page"          => "doc_main",
        // "allTuts"       => $this->tut_db->getAllTutorialIndex(),
        "tut_qs"        => $this->tut_db->loadQuestion(),
        "avatar"        => $this->user_db->getUserAvatar(),
        "allDocCatalog" => $this->doc_db->getAllDocCatalog(),
      ]);
    }

    public function expands($doc_ca_name){
      if(!isset($_SESSION['member_id'])){
        if(isset($_COOKIE['member_login']))
          $this->user_db->checkSession($_COOKIE['member_login'], '');
        else
          header('Location:Register/');
      }
      $this->view("master_h", [
        "page"          => "doc_main",
        // "allTuts"       => $this->tut_db->getAllTutorialIndex(),
        "tut_qs"        => $this->tut_db->loadQuestion(),
        "avatar"        => $this->user_db->getUserAvatar(),
        "all_doc"       => $this->doc_db->getAllDocsOfCatalog($doc_ca_name),
        "allDocCatalog" => $this->doc_db->getAllDocCatalog(),
      ]);
    }


  }


?>