<?php 
  class HomeAdmin extends Controller{



    public $user_db;
    public $tut_db;
    public $lesson_db;
    public function __construct()
    {
      $this->user_db   = $this->model("UserModel");
      $this->tut_db    = $this->model("TutorialModel");
      $this->lesson_db = $this->model("LessonModel");
    }

    public function Init(){
      // var_dump($_SESSION);
      // if($_SESSION['user_type'] !== 'admin')
      if(!$this->user_db->checkIsAdmin($_COOKIE['member_login']))
        header("Location:Home/");

        // var_dump($this->tut_db->LoadAllTutorial());
      $this->view("master_admin", [
        "page"         => "content_admin_new_lesson",
        "avatar"       => $this->user_db->getUserAvatar(),
        "all_tutorial" => $this->tut_db->loadAllAdmin('tutorials','tut_name', 'id'),
        "all_lesson"   => $this->tut_db->loadAllAdmin('lesson_tut','name_lesson', 'lesson_id'),
        "all_topic"    => $this->tut_db->loadAllAdmin('topics','topic_name', 'topic_id'),
    
      ]);
    }

    public function getNewLesson(){
      if(!$this->user_db->checkIsAdmin($_COOKIE['member_login']))
        header("Location:Home/");
      $this->view("master_admin", [
        "page"         => "content_admin_new_lesson",
        "avatar"       => $this->user_db->getUserAvatar(),
        "all_tutorial" => $this->tut_db->loadAllAdmin('tutorials','tut_name', 'id'),
        "all_lesson"   => $this->tut_db->loadAllAdmin('lesson_tut','name_lesson', 'lesson_id'),
        // "all_topic"    => $this->tut_db->loadAllAdmin('topics','topic_name', 'topic_id'),
    
      ]);
    }

    public function getUpdateLesson($lesson_id){

      if(!$this->user_db->checkIsAdmin($_COOKIE['member_login']))
        header("Location:Home/");

      $this->view("master_admin", [
        "page"             => "content_admin_update_lesson",
        "avatar"           => $this->user_db->getUserAvatar(),
        "id_lesson_update" => $lesson_id,
        "content_lesson"   => $this->tut_db->getContentByLessonId($lesson_id),
    
      ]);
    }
    
    public function postUpdateLesson($lesson_id){

      if(!$this->user_db->checkIsAdmin($_COOKIE['member_login']))
        header("Location:Home/");

      $res = false;
      if(isset($_POST)){
        $res = $this->tut_db->updateLessonById($_POST);
      }
      $this->view("master_admin", [
        "page"             => "content_admin_update_lesson",
        "avatar"           => $this->user_db->getUserAvatar(),
        "id_lesson_update" => $lesson_id,
        "content_lesson"   => $this->tut_db->getContentByLessonId($lesson_id),
        "post_content"     => $_POST,
        "res_update"       => $res,
    
      ]);
    }
    public function getViewTutorial(){
      if(!$this->user_db->checkIsAdmin($_COOKIE['member_login']))
        header("Location:Home/");
      $this->view("master_admin", [
        "page"         => "content_admin_view_tut",
        "avatar"       => $this->user_db->getUserAvatar(),
        "all_tutorial" => $this->tut_db->loadAllInfoTutorial(),
        "num_lesson"   => $this->tut_db->getNumberLessonOfAllTut(),
        "admin_modify" => $this->tut_db->getNameAdminModify(),
        "all_lesson"   => $this->tut_db->loadAllLessonForTutorial(),
        "all_topic"    => $this->tut_db->loadAllAdmin('topics','topic_name', 'topic_id'),
      ]);
    }
    public function postNewTutorial(){
      if(!$this->user_db->checkIsAdmin($_COOKIE['member_login']))
        header("Location:Home/");

      $res = false;
      if(!empty($_POST['new_tut_name'])){
        $id_admin_create = $this->user_db->getAdminId($_COOKIE['member_login']);
        if($id_admin_create != 0)
          $res = $this->tut_db->createNewTutorial($_POST, $id_admin_create);
        if($res)
          header("Location:../HomeAdmin/getViewTutorial");
      }
      if(!empty($_POST['new_lesson_name'])){
        $res = $this->tut_db->createNewLesson($_POST);
        if($res)
          header("Location:../HomeAdmin/getViewTutorial");

      }
      
      $this->view("master_admin", [
        "page"         => "content_admin_view_tut",
        "avatar"       => $this->user_db->getUserAvatar(),
        "post_new_tut" => $_POST,
        "res_new_tut"  => $res,

      ]);
    }

    public function postNewLesson(){

      // if($_SESSION['user_type'] !== 'admin' || !$this->user_db->checkIsAdmin($_COOKIE['member_login']) !== 1)
      if(!$this->user_db->checkIsAdmin($_COOKIE['member_login']))
        header("Location:Home/");
      if(!isset($_POST['update_content']))
        header("Location:./");


        $res = false;
        if(isset($_POST)){
          // var_dump($_POST);
          if(!empty($_POST))
            $res = $this->tut_db->updateContent($_POST);
        }

      $this->view("master_admin", [
        "page"         => "content_admin_new_lesson",
        "avatar"       => $this->user_db->getUserAvatar(),
        "update_state" => $res,
        // "post_up"      => $_POST,
    
      ]);
    }

  }


?>