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
          "allTutsIndex"   => $this->tut_db->getAllTutorialIndex(),
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
        $f_Size      = $_FILES['file']['size'];
        $f_Error     = $_FILES['file']['type'];
        $f_Type      = $_FILES['file']['error'];
        $this->user_db->uploadAvatar($f_name, $f_Temp_name, $f_Size, $f_Error, $f_Type);
        header("Location:./");
      }
        $this->view("master_h", [
          "page"      => "content_user",
          "allTutsIndex"   => $this->tut_db->getAllTutorialIndex(),
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
          "allTutsIndex"   => $this->tut_db->getAllTutorialIndex(),
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
          "allTutsIndex"   => $this->tut_db->getAllTutorialIndex(),
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
          "allTutsIndex"   => $this->tut_db->getAllTutorialIndex(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "user_id"   => $this->user_db->getUserIdByName($_COOKIE['member_login']),
        ]);
    }


    public function myFriend(){
        $this->middlewareUserPage('../Home');
        $info = $this->user_db->getUserInfo($_COOKIE['member_login']);

        $this->view("master_h", [
          "page"      => "my_friend",
          "allTutsIndex"   => $this->tut_db->getAllTutorialIndex(),
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
        $count_unseen = $this->user_db->count_unseen_message($_SESSION['member_id'], $id_friend);
      }else{
          header('Location:../Home/');
      }
      $this->view("master_blank", [
          "page"         => "get_list_friend",
          "friend_list"  => $name_friend,
          "last_active"  => $last_active,
          "count_unseen"  => $count_unseen,
      ]);
    }
    
    public function getFriendListId(){
      $this->middlewareUserPage('../Home');
      $res = '';
      $id_friend  = $this->user_db->getListFriendByUserId($_SESSION['member_id']);

      $this->view("master_blank", [
          "page"         => "get_friend_id",
          "friend_list"  => $id_friend,
      ]);
    }


    public function getNotifyFriendRequest(){
      $this->middlewareUserPage('../Home');
      $res = '';
        $res  = $this->user_db->countRequestFriend($_SESSION['member_id']);

      $this->view("master_blank", [
          "page"         => "get_id_lesson",
          "id_lesson"  => $res,
      ]);
    }

    public function getUserListId(){
      $this->middlewareUserPage('../Home');
      $res = '';
        $id_user  = $this->user_db->getListUserNotMe($_SESSION['member_id']);
      $this->view("master_blank", [
          "page"         => "get_user_id",
          "user_list"  => $id_user,
      ]);
    }

    public function addUserToMyFriend(){
      $this->middlewareUserPage('../Home');
      $res = '';
      $res  = $this->user_db->getSendFriendRequest($_SESSION['member_id'], $_POST['us_want_id']);
      $this->view("master_blank", [
          "page"         => "get_id_lesson",
          "id_lesson"  => $res,
      ]);
    }


    public function acceptRequest(){
      $this->middlewareUserPage('../Home');
      $res = '';
      $res  = $this->user_db->getAcceptRequest($_SESSION['member_id'], $_POST['us_want_id']);
      $this->view("master_blank", [
          "page"         => "get_id_lesson",
          "id_lesson"  => $res,
      ]);
    }


    public function removeRequest(){
      $this->middlewareUserPage('../Home');
      $res = '';
      $res  = $this->user_db->getRemoveRequest($_SESSION['member_id'], $_POST['us_want_id']);
      $this->view("master_blank", [
          "page"         => "get_id_lesson",
          "id_lesson"  => $res,
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

	public function insertChatMessage(){
      $this->middlewareUserPage('../Home');
      $res = '';
      if(isset($_POST)){
        // var_dump($_POST);
        $res = $this->user_db->getInsertChatMessage($_SESSION['member_id'], $_POST['friend_id'], $_POST['chat_message']);
      }else{
          header('Location:../Home/');
      }

      $this->view("master_blank", [
          "page"        => "get_mes_history",
          'mes_history' => $res,
      ]);

    }
    
	public function getHistoryMessage(){
      $this->middlewareUserPage('../Home');
      $res = '';
      if(isset($_POST)){
        // var_dump($_POST);
        $res = $this->user_db->getUserChatHistory($_SESSION['member_id'], $_POST['friend_id']);
      }else{
          header('Location:../Home/');
      }

      $this->view("master_blank", [
          "page"        => "get_mes_history",
          'mes_history' => $res,
      ]);

    }

    
	public function userChart(){
      $this->middlewareUserPage('../Home');
      $res = '';
      $pointLesson = $this->user_db->getUserPointLesson($_SESSION['member_id']);
      $pointTest = $this->user_db->getUserPointTest($_SESSION['member_id']);

      $this->view("master_h", [
          "page"        => "user_chart",
          'point_les' => $pointLesson,
          'point_test' => $pointTest,
          "allTutsIndex"   => $this->tut_db->getAllTutorialIndex(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
      ]);

    }

	public function list_friend_request(){
      $this->middlewareUserPage('../Home');
      $res                 = '';
      $list_friend_request = $this->user_db->getUserListFriendRequest($_SESSION['member_id']);
      $list_my_request     = $this->user_db->getUserListMyRequest($_SESSION['member_id']);

      $this->view("master_h", [
          "page"           => "list_friend_request",
          "allTutsIndex"   => $this->tut_db->getAllTutorialIndex(),
          "tut_qs"         => $this->tut_db->loadQuestion(),
          "avatar"         => $this->user_db->getUserAvatar(),
          "menu_user"      => $this->user_db->getUserMenu(),
          "friend_request" => $list_friend_request,
          "my_request"     => $list_my_request,
      ]);

    }


	public function getCountMesTwoPeople(){
      $this->middlewareUserPage('../Home');
      $res = '';
      if(isset($_POST)){
        $res = $this->user_db->countMessageTwoPeople($_SESSION['member_id'], $_POST['friend_id']);
      }else{
          header('Location:../Home/');
      }

      $this->view("master_blank", [
          "page"        => "get_mes_history",
          'mes_history' => $res,
      ]);

    }

      public function getFindFriendForUser(){
      $this->middlewareUserPage('../Home');
      $res = '';
      if(isset($_POST)){
        $res = $this->user_db->findFriendForUser($_SESSION['member_id']);
      }

      $this->view("master_blank", [
          "page"        => "get_list_user",
          'list_user' => $res,
          'text_search' => $_POST['text_search'],
      ]);

    }

    

  }

?>