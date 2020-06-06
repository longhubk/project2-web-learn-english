<?php 
  class Docs extends Controller{

    public $doc_db;
    public $user_db;
    public $tut_db;

    public function __construct()
    {
      $this->doc_db      = $this->model("DocModel");
      $this->user_db     = $this->model("UserModel");
      $this->tut_db     = $this->model("TutorialModel");
    }

    public function Init(){
      if(!isset($_SESSION['member_id'])){
        if(isset($_COOKIE['member_login']))
          $this->user_db->checkSession($_COOKIE['member_login'], '');
        else
          header('Location:Register/');
      }
      $this->view("master_h", [
        "page"          => "doc_main",
        // "allTuts"       => $this->tut_db->getAllTutorial(),
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
        // "allTuts"       => $this->tut_db->getAllTutorial(),
        "tut_qs"        => $this->tut_db->loadQuestion(),
        "avatar"        => $this->user_db->getUserAvatar(),
        "all_doc"       => $this->doc_db->getAllDocsOfCatalog($doc_ca_name),
        "allDocCatalog" => $this->doc_db->getAllDocCatalog(),
      ]);
    }


  }


?>