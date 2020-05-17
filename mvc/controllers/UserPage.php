<?php 
  class UserPage extends Controller{

    public $tut_db;
    public $user_db;
    public function __construct()
    {
      $this->tut_db  = $this->model("TutorialModel");
      $this->user_db = $this->model("UserModel");
    }
    public function Init(){
        if(empty($_COOKIE['member_login']))
          header('Location:./Home/');
        $info = $this->user_db->getUserInfo($_COOKIE['member_login']);
        $this->view("master_h", [
          "page"      => "content_user",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "OK",
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "info"      => $info,
          "isAdmin"   => $this->user_db->checkIsAdmin($_COOKIE['member_login']),
        ]);
      }
    public function upload(){
      if(empty($_COOKIE['member_login']))
        header('Location:../Home/');
  
      if(!empty($_FILES)){
        $f_name      = $_FILES['file']['name'];
        $f_Temp_name = $_FILES['file']['tmp_name'];
        $f_Size      = $_FILES['file']['tmp_name'];
        $f_Error     = $_FILES['file']['type'];
        $f_Type      = $_FILES['file']['error'];
        $this->user_db->uploadAvatar($f_name, $f_Temp_name, $f_Size, $f_Error, $f_Type);
        header("Location:./");
      }
        $this->view("master_h", [
          "page"      => "content_user",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),

        ]);
      }
    public function updateInfo(){
      if(empty($_COOKIE['member_login']))
          header('Location:../Home/');
      if(isset($_POST['update_info'])){
        $f_name   = $_POST["f_name"];
        $l_name   = $_POST["l_name"];
        $birthday = $_POST["birthday"];
        $school   = $_POST["school"];
        $toeic    = $_POST["toeic_score"];
        $gender   = "";
        if(isset($_POST["gender"]))
          $gender = $_POST["gender"];

        $this->user_db->updateUserInfo( $_COOKIE['member_login'],$f_name, $l_name, $birthday, $gender, $school, $toeic);

      }
        $info = $this->user_db->getUserInfo($_COOKIE['member_login']);
        $this->view("master_h", [
          "page"      => "content_user",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "info"      => $info,

        ]);
      }
    public function change_pass(){
      if(empty($_COOKIE['member_login']))
          header('Location:../Home/');
      if(isset($_POST['change_pw'])){
        $old_pass    = $_POST["old_pass"];
        $new_pass    = $_POST["new_pass"];
        $new_pass_ag = $_POST["new_pass_again"];

        $this->user_db->updatePass( $_COOKIE['member_login'],$old_pass, $new_pass, $new_pass_ag);

      }
        $info = $this->user_db->getUserInfo($_COOKIE['member_login']);
        $this->view("master_h", [
          "page"      => "change_pass",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
        ]);
      }
  }

?>