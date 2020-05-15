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
        "page"         => "content_admin_update_tut",
        "avatar"       => $this->user_db->getUserAvatar(),
        "all_tutorial" => $this->tut_db->loadAllAdmin('tutorials','tut_name', 'id'),
        "all_lesson"   => $this->tut_db->loadAllAdmin('lesson_tut','name_lesson', 'lesson_id'),
        "all_topic"    => $this->tut_db->loadAllAdmin('topics','topic_name', 'topic_id'),
    
      ]);
    }

    public function updateLesson(){

      // if($_SESSION['user_type'] !== 'admin' || !$this->user_db->checkIsAdmin($_COOKIE['member_login']) !== 1)
      if(!$this->user_db->checkIsAdmin($_COOKIE['member_login']))
        header("Location:Home/");
      if(!isset($_POST['update_content']))
        header("Location:./");


        $res = false;
        if(isset($_POST)){
          // var_dump($_POST);
          $res = $this->tut_db->updateContent($_POST);
        }

      $this->view("master_admin", [
        "page"         => "content_admin",
        "avatar"       => $this->user_db->getUserAvatar(),
        "update_state" => $res,
    
      ]);
    }


  }


?>