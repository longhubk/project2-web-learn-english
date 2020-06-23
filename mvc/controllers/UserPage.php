<?php 
  class UserPage extends Controller{


    protected $info_user;

    public function __construct()
    {
      parent::__construct();
      $this->info_user = $this->user_db->getUserInfo($_COOKIE['member_login']);

      $this->view_arr = [
          "all_tuts"   => $this->all_tuts,
          "all_doc"    => $this->all_doc,
          "avatar"    => $this->avatar,
          "menu_user" => $this->user_db->getUserMenu(),
          // "isAdmin"   => $this->user_db->checkIsAdmin($_COOKIE['member_login']),
      ];
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
        $this->middlewareUserPage('HomePage');
        $view_more = [
          "page"      => "user_change_info",
          "info"      => $this->info_user
        ];
        $this->render('master_home',$view_more);
    }
    
    public function upload(){
      $this->middlewareUserPage('../HomePage');
      $res = '';
      if(!empty($_FILES)){
        $f_name      = $_FILES['file']['name'];
        $f_Temp_name = $_FILES['file']['tmp_name'];
        $f_Size      = $_FILES['file']['size'];
        $f_Error     = $_FILES['file']['type'];
        $f_Type      = $_FILES['file']['error'];
        $res = $this->user_db->uploadAvatar($f_name, $f_Temp_name, $f_Size, $f_Error, $f_Type);
        if($res == 'ok')
          header("Location:./");
      }
        $view_more = [
          "page"      => "user_change_info",
          "info"      => $this->info_user,
          "res_upload"=> $res
        ];
        $this->render('master_home',$view_more);
    }

    public function updateInfo(){
      $this->middlewareUserPage('../HomePage');
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
        $info_after_update = $this->user_db->getUserInfo($_COOKIE['member_login']);

        $view_more = [
          "page"      => "user_change_info",
          "info"      => $info_after_update
        ];
        $this->render('master_home',$view_more);
      }
    public function change_pass(){

      $this->middlewareUserPage('../HomePage');
      $res = '';
      if(isset($_POST['change_pw'])){
        $old_pass = $new_pass = $new_pass_ag = "";

        if(!empty($_POST['old_pass']))
          $old_pass    = $_POST["old_pass"];
        if(!empty($_POST['new_pass']))
          $new_pass    = $_POST["new_pass"];
        if(!empty($_POST['new_pass_again']))
          $new_pass_ag = $_POST["new_pass_again"];

        $res = $this->user_db->updatePass( $_COOKIE['member_login'],$old_pass, $new_pass, $new_pass_ag);
      }
        $view_more = [
          "page"      => "user_change_pass",
          "pass_update" => $res,
        ];
        $this->render('master_home',$view_more);
      }


    public function myFriend(){
        $this->middlewareUserPage('../HomePage');
        $view_more = [
          "page"      => "user_my_friend",
        ];
        $this->render('master_home',$view_more);
    }


    public function getFriendById(){
      $this->middlewareUserPage('../HomePage');
      $res = '';
      if(isset($_POST['us_name']) && isset($_POST['friend_find'])){
        $res  = $this->user_db->getListUserById($_POST['us_name'], $_POST['friend_find']);
      }else
        header('Location:../HomePage/');
      $this->view("master_empty", [
          "page"      => "get_list_friend",
          "res_list"  => $res,
      ]);
    }


    public function getFriendList(){
      $this->middlewareUserPage('../HomePage');
      $res = '';
      if(isset($_POST)){
        $id_friend    = $this->user_db->getListFriendByUserId($_SESSION['member_id']);
        $name_friend  = $this->user_db->getNameFriendByFriendId($id_friend);
        $last_active  = $this->user_db->getLastActiveById($id_friend);
        $count_unseen = $this->user_db->count_unseen_message($_SESSION['member_id'], $id_friend);
      }else{
          header('Location:../HomePage/');
      }
      $this->view("master_empty", [
          "page"         => "get_list_friend",
          "friend_list"  => $name_friend,
          "last_active"  => $last_active,
          "count_unseen" => $count_unseen,
      ]);
    }
    
    public function getFriendListId(){
      $this->middlewareUserPage('../HomePage');
      $id_friend  = $this->user_db->getListFriendByUserId($_SESSION['member_id']);

      $this->view("master_empty", [
          "page"         => "get_friend_id",
          "friend_list"  => $id_friend,
      ]);
    }




    public function getNotifyFriendRequest(){
      $this->middlewareUserPage('../HomePage');
      $res = '';
      $res  = $this->user_db->countRequestFriend($_SESSION['member_id']);

      $this->view("master_empty", [
          "page"      => "get_id_lesson",
          "id_lesson" => $res,
      ]);
    }

    public function getUserListId(){
      $this->middlewareUserPage('../HomePage');
      $id_user  = $this->user_db->getListUserNotMe($_SESSION['member_id']);
      $this->view("master_empty", [
          "page"      => "get_user_id",
          "user_list" => $id_user,
      ]);
    }

    public function addUserToMyFriend(){
      $this->middlewareUserPage('../HomePage');
      $res = '';
      $res  = $this->user_db->getSendFriendRequest($_SESSION['member_id'], $_POST['us_want_id']);
      $this->view("master_empty", [
          "page"      => "get_id_lesson",
          "id_lesson" => $res,
      ]);
    }


    public function acceptRequest(){
      $this->middlewareUserPage('../HomePage');
      $res = '';
      $res  = $this->user_db->getAcceptRequest($_SESSION['member_id'], $_POST['us_want_id']);
      $this->view("master_empty", [
          "page"      => "get_id_lesson",
          "id_lesson" => $res,
      ]);
    }


    public function removeRequest(){
      $this->middlewareUserPage('../HomePage');
      $res = '';
      $res  = $this->user_db->getRemoveRequest($_SESSION['member_id'], $_POST['us_want_id']);
      $this->view("master_empty", [
          "page"      => "get_id_lesson",
          "id_lesson" => $res,
      ]);
    }
	
	public function updateMyActive(){
      $this->middlewareUserPage('../HomePage');
      $res = '';
      if(isset($_POST))
        $res = $this->user_db->getUpdateMyActive($_SESSION['member_id']);
      else
          header('Location:../HomePage/');
    }

	public function insertChatMessage(){
      $this->middlewareUserPage('../HomePage');
      $res = '';
      if(isset($_POST)){
        // var_dump($_POST);
        $res = $this->user_db->getInsertChatMessage($_SESSION['member_id'], $_POST['friend_id'], $_POST['chat_message']);
      }else
          header('Location:../HomePage/');
      $this->view("master_empty", [
          "page"        => "get_mes_history",
          'mes_history' => $res,
      ]);

    }
    
	public function getHistoryMessage(){
      $this->middlewareUserPage('../HomePage');
      $res = '';
      if(isset($_POST)){
        $res = $this->user_db->getUserChatHistory($_SESSION['member_id'], $_POST['friend_id']);
      }else
        header('Location:../HomePage/');
      $this->view("master_empty", [
          "page"        => "get_mes_history",
          'mes_history' => $res,
      ]);

    }

    
	public function userChart(){
      $this->middlewareUserPage('../HomePage');
      $pointLesson = $this->user_db->getUserPointLesson($_SESSION['member_id']);
      $pointTest = $this->user_db->getUserPointTest($_SESSION['member_id']);
      $view_more = [
          "page"       => "user_chart",
          'point_test' => $pointTest,
          'point_les'  => $pointLesson,
      ];
      $this->render('master_home',$view_more);
    }

	public function user_friend_request(){
      $this->middlewareUserPage('../HomePage');
      $user_friend_request = $this->user_db->getUserListFriendRequest($_SESSION['member_id']);
      $list_my_request     = $this->user_db->getUserListMyRequest($_SESSION['member_id']);

      $view_more = [
          "page"           => "user_friend_request",
          "friend_request" => $user_friend_request,
          "my_request"     => $list_my_request,
      ];
      $this->render('master_home',$view_more);
  }


	public function getCountMesTwoPeople(){
      $this->middlewareUserPage('../HomePage');
      $res = '';
      if(isset($_POST)){
        $res = $this->user_db->countMessageTwoPeople($_SESSION['member_id'], $_POST['friend_id']);
      }else
          header('Location:../HomePage/');
      $this->view("master_empty", [
          "page"        => "get_mes_history",
          'mes_history' => $res,
      ]);

    }

      public function getFindFriendForUser(){
      $this->middlewareUserPage('../HomePage');
      $res = '';
      if(isset($_POST))
        $res = $this->user_db->findFriendForUser($_SESSION['member_id']);
      $this->view("master_empty", [
          "page"        => "get_list_user",
          'list_user'   => $res,
          'text_search' => $_POST['text_search'],
      ]);

    }

    

  }

?>