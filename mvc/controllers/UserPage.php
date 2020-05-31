<?php 
  class UserPage extends Controller{

    public $tut_db;
    public $user_db;
    public function __construct()
    {
      $this->tut_db  = $this->model("TutorialModel");
      $this->user_db = $this->model("UserModel");
    }
    private function middlewareUserPage($back){
      if(empty($_SESSION['member_id'])){

        if(!empty($_COOKIE['member_login']))
          $this->user_db->checkSession($_COOKIE['member_login'], '');
        else
           header('Location:'.$back);
      }
 
    }
    public function Init(){

        $this->middlewareUserPage('Home');
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

      $this->middlewareUserPage('../Home');
  
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
      $this->middlewareUserPage('../Home');
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
      $this->middlewareUserPage('../Home');
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


    public function findFriend(){
        $this->middlewareUserPage('../Home');
        $info = $this->user_db->getUserInfo($_COOKIE['member_login']);

        $this->view("master_h", [
          "page"      => "friend_user",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "user_id" => $this->user_db->getUserIdByName($_COOKIE['member_login']),
        ]);
    }


    public function myFriend(){
        $this->middlewareUserPage('../Home');
        $info = $this->user_db->getUserInfo($_COOKIE['member_login']);

        $this->view("master_h", [
          "page"      => "my_friend",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "user_id" => $this->user_db->getUserIdByName($_COOKIE['member_login']),
        ]);
    }


    public function getFriendById(){
      $this->middlewareUserPage('../Home');
      $res = '';
      if(isset($_POST['us_name']) && isset($_POST['friend_find'])){
        $res  = $this->user_db->getListUserById($_POST['us_name'], $_POST['friend_find']);
      }else{
          header('Location:../Home/');
      }
        $this->view("master_blank", [
          "page"      => "get_list_friend",
          "res_list"  => $res,
        ]);
    }

    public function getFriendList(){
      $this->middlewareUserPage('../Home');
      $res = '';
      if(isset($_POST)){
        $id_friend  = $this->user_db->getListFriendByUserId($_SESSION['member_id']);
        $name_friend = $this->user_db->getNameFriendByFriendId($id_friend);
        $last_active = $this->user_db->getLastActiveById($id_friend);
      }else{
          header('Location:../Home/');
      }
      $this->view("master_blank", [
          "page"      	 => "get_list_friend",
          "friend_list"  => $name_friend,
          "last_active"  => $last_active,
      ]);
    }
	
	public function updateMyActive(){
      $this->middlewareUserPage('../Home');
      $res = '';
      if(isset($_POST)){
        $res = $this->user_db->getUpdateMyActive($_SESSION['member_id']);
      }else{
          header('Location:../Home/');
      }
    }

  }

?>