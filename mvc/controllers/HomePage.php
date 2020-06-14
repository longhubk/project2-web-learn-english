<?php 
  class HomePage extends Controller{

    public function __construct()
    {
      parent::__construct();
      $this->view_arr = [
          "all_tuts"   => $this->all_tuts,
          "avatar"    => $this->avatar,
          "tut_qs"    => $this->tut_qs,
      ];
    }

    public function Init(){
      if(!isset($_SESSION['member_id'])){
        if(isset($_COOKIE['member_login']))
          $this->user_db->checkSession($_COOKIE['member_login'], '');
        else
          header('Location:RegisterPage/');
      }
      $view_more = [
        "page"    => "content_main",
        "is_lock" => $this->tut_db->getIsLockTutUser($_SESSION['member_id']),
      ];

      $this->render('master_home', $view_more);
    }


  }


?>