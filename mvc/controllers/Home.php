<?php 
  class Home extends Controller{

    // public $sinhvien_db;
    public $tut_db;
    public $user_db;
    public function __construct()
    {
      // $this->sinhvien_db = $this->model("SinhVienModel");
      $this->tut_db      = $this->model("TutorialModel");
      $this->user_db     = $this->model("UserModel");
    }

    public function Init(){
      // var_dump($_SESSION);
      $this->view("master_h", [
        "page"    => "content_main",
        "allTuts" => $this->tut_db->getAllTutorial(),
        "tut_qs"  => $this->tut_db->loadQuestion(),
        "avatar"  => $this->user_db->getUserAvatar(),
    
      ]);
    }


  }


?>