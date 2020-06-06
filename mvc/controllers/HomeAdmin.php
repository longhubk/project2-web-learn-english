<?php 
  class HomeAdmin extends Controller{



    public $user_db;
    public $tut_db;
    public $lesson_db;
    public $test_db;
    public function __construct()
    {
      $this->user_db   = $this->model("UserModel");
      $this->tut_db    = $this->model("TutorialModel");
      $this->lesson_db = $this->model("LessonModel");
      $this->test_db   = $this->model("TestModel");
    }
    private function middlewareAdmin(){
      if(empty($_SESSION['member_id'])){
        if(!empty($_COOKIE['member_login']))
          $this->user_db->checkSession($_COOKIE['member_login'], '');
        else
           header('Location:Register/');
      }

      if($_SESSION['user_type'] !== 'admin')
        header("Location:Home/");
    }

    public function Init(){
      //var_dump($_SESSION);
      $this->middlewareAdmin();
      $this->view("master_admin", [
        "page"         => "content_admin_new_lesson",
        "avatar"       => $this->user_db->getUserAvatar(),
        "all_tutorial" => $this->tut_db->loadAllAdminTutLevel('tutorials','tut_name', 'id','tut_level'),
        "all_lesson"   => $this->tut_db->getAllLessonOfTutorialById(1),
        "all_topic"    => $this->tut_db->loadAllAdmin('topics','topic_name', 'topic_id'),
    
      ]);
    }

    public function getNewLesson(){
      $this->middlewareAdmin();
      $this->view("master_admin", [
        "page"         => "content_admin_new_lesson",
        "avatar"       => $this->user_db->getUserAvatar(),
        "all_tutorial" => $this->tut_db->loadAllAdminTutLevel('tutorials','tut_name', 'id','tut_level'),
        "all_lesson"   => $this->tut_db->getAllLessonOfTutorialById(1),
    
      ]);
    }
    public function getLessonOfTutorial(){
      $res = "";
      if(isset($_POST)){
        $res = $this->tut_db->getAllLessonOfTutorialById($_POST['id']);
      }

      $this->view("master_blank", [
        "page" => "get_lesson_of_tutorial",
        "data_lesson" => $res,
      ]);
    }

    public function getTutLevel(){
      $res = "";
      if(isset($_POST)){
        $res = $this->tut_db->getTutLevelById($_POST['id']);
      }
      $this->view("master_blank", [
        "page" => "get_tut_level",
        "tut_level" => $res,
      ]);
    }

    public function getUpdateLesson($lesson_id, $tut_level){
      $this->middlewareAdmin();
      $page = '';
      if($tut_level > 0){
        $page = "content_admin_update_lesson";
        $content_less = $this->tut_db->getContentByLessonId($lesson_id);
      }
      else{
        $page = "content_admin_update_basic_lesson";
        $content_less = $this->tut_db->getContentByBasicLessonId($lesson_id);
      }

      $this->view("master_admin", [
        "page"             => $page,
        "avatar"           => $this->user_db->getUserAvatar(),
        "id_lesson_update" => $lesson_id,
        "content_lesson"   => $content_less,
        "tut_level"        => $tut_level,
      ]);
    }
    
    public function postUpdateLesson($lesson_id, $tut_level){
      $this->middlewareAdmin();
      $res = false;
      if(isset($_POST)){
        if($tut_level > 0){
          $page = "content_admin_update_lesson";
          $res = $this->tut_db->updateLessonById($_POST);
          $content_less_after_update = $this->tut_db->getContentByLessonId($lesson_id);
        }
        else{
          $page = "content_admin_update_basic_lesson";
          $res = $this->tut_db->updateBasicLessonById($_POST, $_FILES);
          $content_less_after_update = $this->tut_db->getContentByBasicLessonId($lesson_id);
        }
        if($res == 1)
          header("Location:../../getUpdateLesson/".$lesson_id."/".$tut_level);
      }
      $this->view("master_admin", [
        "page"             => $page,
        "avatar"           => $this->user_db->getUserAvatar(),
        "id_lesson_update" => $lesson_id,
        "content_lesson"   => $content_less_after_update,
        "post_content"     => $_FILES,
        "res_update"       => $res,
        "tut_level"        => $tut_level,
    
      ]);
    }
    public function getViewTutorial(){
      $this->middlewareAdmin();
      $this->view("master_admin", [
        "page"         => "content_admin_view_tut",
        "avatar"       => $this->user_db->getUserAvatar(),
        "all_tutorial" => $this->tut_db->loadAllInfoTutorial(),
        "num_lesson"   => $this->tut_db->getNumberLessonOfAllTut(),
        "admin_modify" => $this->user_db->getNameAdminModify(),
        "all_lesson"   => $this->tut_db->loadAllLessonForTutorial(),
        "all_topic"    => $this->tut_db->loadAllAdmin('topics','topic_name', 'topic_id'),
      ]);
    }

    public function postNewTutorial(){
      $this->middlewareAdmin();
      $res = false;
      if(!empty($_POST['new_tut_name'])){
        $id_admin_create = $this->user_db->getAdminId($_COOKIE['member_login']);
        if($id_admin_create != 0)
          $res = $this->tut_db->createNewTutorial($_POST, $id_admin_create);
        if($res)
          header("Location:../HomeAdmin/getViewTutorial");
      }
      if(!empty($_POST['new_lesson_name'])){
        $res = $this->tut_db->createNewLesson($_POST, $_FILES);
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
      $this->middlewareAdmin();
      $res = false;
      if(isset($_FILES)){
        // var_dump($_FILES);
      }
      if(isset($_POST)){
        if(!empty($_POST)){
          $res = $this->tut_db->updateContent($_POST, $_FILES);
        }
      }
      if(isset($_POST))
        header("Location:../HomeAdmin/getNewLesson");

      $this->view("master_admin", [
        "page"         => "content_admin_new_lesson",
        "avatar"       => $this->user_db->getUserAvatar(),
        "update_state" => $res,
        "post_up"      => $_POST,
      ]);
    }

    public function getViewUser(){
      $this->middlewareAdmin();
      $this->view("master_admin", [
        "page"     => "content_admin_view_user",
        "avatar"   => $this->user_db->getUserAvatar(),
        "all_user" => $this->user_db->loadAllUser(),
    
      ]);
    }

    public function getBlockUser(){
      $this->middlewareAdmin();
      if(isset($_POST)){
        $user_id = $_POST['user_id'];
        $res = $this->user_db->blockUserById($user_id);
      }
      else
        header("Location:../Home/");

      $this->view("master_blank", [
        "page"     => "get_block_user",
        "res_block" => $res,
      ]);
    }

    public function getViewTest(){
      $this->middlewareAdmin();
      $this->view("master_admin", [
        "page"         => "content_admin_view_test",
        "avatar"       => $this->user_db->getUserAvatar(),
        "all_test"     => $this->test_db->loadAllTestAdmin(),
        "all_question" => $this->test_db->loadAllQuestionForTest(),
        "admin_modify" => $this->user_db->getNameAdminModify(),
        "num_question" => $this->test_db->getNumberQuestionOfAllTest(),
    
      ]);
    }

    public function postNewTest(){
      $this->middlewareAdmin();

      $res = false;
      if(!empty($_POST['new_test_name'])){
        $id_admin_create = $this->user_db->getAdminId($_COOKIE['member_login']);
        if($id_admin_create != 0)
          $res = $this->test_db->createNewTest($_POST, $id_admin_create);
        if($res)
          header("Location:../HomeAdmin/getViewTest");
      }
      
      $this->view("master_admin", [
        "page"          => "content_admin_view_test",
        "avatar"        => $this->user_db->getUserAvatar(),
        "post_new_test" => $_POST,
        "res_new_test"  => $res,

      ]);
    }

    public function getCurrentNumQuestionOfEachTest(){
      $res = "";
      if(isset($_POST)){
        $res = $this->test_db->loadNumberQuestionCurrent($_POST['id']);
        $res2 = $this->test_db->loadTestById($_POST['id']);

      }
      $this->view("master_blank", [
        "page" => "get_curr_num_qs_of_each_test",
        "curr_num_qs" => $res,
        "curr_test" => $res2,
      ]);

    }


    public function getNewTestQuestion(){
      $this->middlewareAdmin();
      $this->view("master_admin", [
        "page"           => "content_admin_new_test",
        "avatar"         => $this->user_db->getUserAvatar(),
        "all_test"       => $this->test_db->loadAllTestAdmin(),
        "num_qs_current" => $this->test_db->loadNumberQuestionCurrent(1),

      ]);
    }


    public function postAppendTest(){
      $this->middlewareAdmin();

      $res = false;
      if(isset($_POST)){
        if(!empty($_POST))
          $res = $this->test_db->appendQuestionTest($_POST);
      }
      if(isset($_POST))
        header("Location:../HomeAdmin/getNewTestQuestion");

      $this->view("master_admin", [
        "page"         => "content_admin_new_lesson",
        "avatar"       => $this->user_db->getUserAvatar(),
        "update_state" => $res,
        // "post_up"      => $_POST,
      ]);
    }


    public function getUpdateTest($test_id, $test_level){
      $this->middlewareAdmin();
      $page = '';
      if($test_level > 0){
        $page = "content_admin_update_test";
        $content_test = $this->test_db->getContentByTestId($test_id);
      }
      else{
        $page = "content_admin_update_test";
        $content_test = $this->test_db->getContentByTestId($test_id);
      }

      $this->view("master_admin", [
        "page"             => $page,
        "avatar"           => $this->user_db->getUserAvatar(),
        "id_test_update"   => $test_id,
        "name_test_update" => $this->test_db->getNameTestById($test_id),
        "content_test"     => $content_test,
        "test_level"       => $test_level,
      ]);
    }

    public function postUpdateTest($test_id, $test_level){
      $this->middlewareAdmin();
      $res = false;
      if(isset($_POST)){
        if($test_level > 0){
          $page = "content_admin_update_test";
          $res = $this->test_db->updateTestById($_POST);
          $content_test_after_update = $this->test_db->getContentByTestId($test_id);
        }
        else{
          $page = "content_admin_update_test";
          $res = $this->test_db->updateTestById($_POST);
          $content_test_after_update = $this->test_db->getContentByTestId($test_id);
          if($res){
            header("Location:../../getUpdateTest/".$test_id."/".$test_level);
          }
        }
      }
      
      $this->view("master_admin", [
        "page"           => $page,
        "avatar"         => $this->user_db->getUserAvatar(),
        "id_test_update" => $test_id,
        "content_test"   => $content_test_after_update,
        "post_content"   => $_POST,
        "res_update"     => $res,
        "test_level"     => $test_level,
        "name_test_update" => $this->test_db->getNameTestById($test_id),
    
      ]);
    }

    
    public function getDeleteLesson(){
      $this->middlewareAdmin();
      $res = "fail";
      if(isset($_POST)){
        if(!empty($_POST))
          $res = $this->tut_db->getDeleteLessonById($_POST);
      }
      $this->view("master_blank", [
        "page"        => "get_mes_history",
        "mes_history" => $res,
      ]);
    }

    public function postEditTutorial(){
      $this->middlewareAdmin();
      $res = false;
      if(isset($_POST)){
        if(!empty($_POST['id_tut_edit']))
          $res = $this->tut_db->getEditTutorialById($_POST);
        if(!empty($_POST['id_les_edit'])){
          $res = $this->tut_db->getEditLessonById($_POST);
        }
      }
      if($res) 
        header("Location:../HomeAdmin/getViewTutorial");

      $this->view("master_admin", [
        "page"        => "content_admin_view_tut",
        "res_update" => $res,
      ]);
    }



  }


?>