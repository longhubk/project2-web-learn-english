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
      if(!isset($_SESSION['member_id'])){
        if(isset($_COOKIE['member_login']))
          $this->user_db->checkSession($_COOKIE['member_login'], '');
        else
          header('Location:Register/');
      }
      // var_dump($_SESSION);
      $this->view("master_h", [
        "page"    => "content_main",
        "allTutsIndex" => $this->tut_db->getAllTutorialIndex(),
        "is_lock" => $this->tut_db->getIsLockTutUser($_SESSION['member_id']),
        "tut_qs"  => $this->tut_db->loadQuestion(),
        "avatar"  => $this->user_db->getUserAvatar(),
      ]);
    }


  }


?>