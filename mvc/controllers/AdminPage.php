<?php 
  class AdminPage extends Controller{

    protected $all_user;
    public function __construct()
    {
      
      parent::__construct();
      if($_SESSION['user_type'] == "admin"){
        $this->all_user = $this->user_db->loadAllUser();
      }
      else if($_SESSION['user_type'] == 'teacher'){
        $this->all_user = $this->user_db->loadAllStudent();
      }

      $this->view_arr = [
          "avatar"    => $this->avatar,
      ];
    }

    private function middlewareAdmin(){
      if(empty($_SESSION['member_id'])){
        if(!empty($_COOKIE['member_login']))
          $this->user_db->checkSession($_COOKIE['member_login'], '');
        else
          header('Location:RegisterPage/');
      }
      if(($_SESSION['user_type'] !== 'admin' &&
        $_SESSION['user_type'] !== 'teacher') ||
        $this->user_db->checkIsAdmin($_COOKIE['member_login']) == false
      )
        header("Location:HomePage/");
    }

    public function Init(){
      $this->middlewareAdmin();
      $view_more = [
        "page"         => "ad_new_lesson",
        "all_tuts" => $this->all_tuts,
        "all_lesson"   => $this->all_lesson,
        "all_topic"    => $this->all_topic,
      ];
      $this->render('master_admin',$view_more);
    }

    public function getNewLesson(){
      $this->middlewareAdmin();
      $view_more =  [
        "page"         => "ad_new_lesson",
        "all_tuts" => $this->all_tuts,
        "all_lesson"   => $this->all_lesson,
      ];
      $this->render('master_admin',$view_more);
    }
    public function getLessonOfTutorial(){
      $res = "";
      if(isset($_POST))
        $res = $this->tut_db->getAllLessonOfTutorialById($_POST['id']);

      $this->view("master_empty", [
        "page" => "get_lesson_of_tutorial",
        "data_lesson" => $res,
      ]);
    }

    public function getTutLevel(){
      $res = "";
      if(isset($_POST)){
        $res = $this->tut_db->getTutLevelById($_POST['id']);
      }
      $this->view("master_empty", [
        "page" => "get_tut_level",
        "tut_level" => $res,
      ]);
    }

    public function getUpdateLesson($lesson_id, $tut_level){
      $this->middlewareAdmin();
      $page = '';
      if($tut_level > 0){
        $page = "ad_update_lesson";
        $content_less = $this->tut_db->getContentByLessonId($lesson_id);
      }
      else{
        $page = "ad_update_basic_lesson";
        $content_less = $this->tut_db->getContentByBasicLessonId($lesson_id);
      }

      $view_more =  [
        "page"             => $page,
        "id_lesson_update" => $lesson_id,
        "content_lesson"   => $content_less,
        "tut_level"        => $tut_level,
      ];

      $this->render('master_admin',$view_more);
    }
    
    public function postUpdateLesson($lesson_id, $tut_level){
      $this->middlewareAdmin();
      $res = false;
      if(isset($_POST)){
        if($tut_level > 0){
          $page = "ad_update_lesson";
          $res = $this->tut_db->updateLessonById($_POST);
          $content_less_after_update = $this->tut_db->getContentByLessonId($lesson_id);
        }
        else{
          $page = "ad_update_basic_lesson";
          $res = $this->tut_db->updateBasicLessonById($_POST, $_FILES);
          $content_less_after_update = $this->tut_db->getContentByBasicLessonId($lesson_id);
        }
        if($res == 1)
          header("Location:../../getUpdateLesson/".$lesson_id."/".$tut_level);
      }
      $view_more = [
        "page"             => $page,
        "id_lesson_update" => $lesson_id,
        "content_lesson"   => $content_less_after_update,
        "post_content"     => $_FILES,
        "res_update"       => $res,
        "tut_level"        => $tut_level,
      ];

      $this->render('master_admin',$view_more);
    }
    public function getViewTutorial(){
      $this->middlewareAdmin();
      $view_more =  [
        "page"         => "ad_view_tut",
        "all_tuts" => $this->all_tuts,
        "num_lesson"   => $this->tut_db->getNumberLessonOfAllTut(),
        "admin_modify" => $this->user_db->getNameAdminModify(),
        "all_lesson"   => $this->all_lesson,
        "all_topic"    => $this->all_topic,
      ];

      $this->render('master_admin',$view_more);
    }

    public function postNewTutorial(){
      $this->middlewareAdmin();
      $res = false;
      if(!empty($_POST['new_tut_name'])){
        $id_admin_create = $this->user_db->getAdminId($_COOKIE['member_login']);
        if($id_admin_create != 0)
          $res = $this->tut_db->createNewTutorial($_POST, $id_admin_create);
        if($res)
          header("Location:../AdminPage/getViewTutorial");
      }
      if(!empty($_POST['new_lesson_name'])){
        $res = $this->tut_db->createNewLesson($_POST, $_FILES);
        if($res)
          header("Location:../AdminPage/getViewTutorial");
      }
      
      $view_more = [
        "page"         => "ad_view_tut",
        "post_new_tut" => $_POST,
        "res_new_tut"  => $res,
      ];
      $this->render('master_admin',$view_more);
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
        header("Location:../AdminPage/getNewLesson");

      $view_more = [
        "page"         => "ad_new_lesson",
        "update_state" => $res,
        "post_up"      => $_POST,
      ];
      $this->render('master_admin',$view_more);

    }

    public function getViewUser(){
      $this->middlewareAdmin();
      $view_more = [
        "page"     => "ad_view_user",
        "all_user" => $this->all_user,
      ];
      $this->render('master_admin',$view_more);
    }

    public function getBlockUser(){
      $this->middlewareAdmin();
      $res = 'fail';
      if(isset($_POST))
        $res = $this->user_db->blockUserById($_POST['user_id']);

      $this->view("master_empty", [
          "page"      => "get_id_lesson",
          "id_lesson" => $res,
      ]);
    }

    public function getUnBlockUser(){
      $this->middlewareAdmin();
      $res = 'fail';
      if(isset($_POST))
        $res = $this->user_db->unBlockUserById($_POST['user_id']);

      $this->view("master_empty", [
          "page"      => "get_id_lesson",
          "id_lesson" => $res,
      ]);
    }

    public function getDownPermission(){
      $this->middlewareAdmin();
      $res = 'fail';
      if(isset($_POST))
        $res = $this->user_db->downPermissionTeacher($_POST['user_id']);

      $this->view("master_empty", [
          "page"      => "get_id_lesson",
          "id_lesson" => $res,
      ]);
    }

    public function getUpPermission(){
      $this->middlewareAdmin();
      $res = 'fail';
      if(isset($_POST))
        $res = $this->user_db->upPermissionUser($_POST['user_id']);

      $this->view("master_empty", [
          "page"      => "get_id_lesson",
          "id_lesson" => $res,
      ]);
    }

    public function getDeleteUser(){
      $this->middlewareAdmin();
      $res = 'fail';
      if(isset($_POST))
        $res = $this->user_db->deleteUserById($_POST['user_id']);

      $this->view("master_empty", [
          "page"      => "get_id_lesson",
          "id_lesson" => $res,
      ]);
    }


    public function getViewTest(){
      $this->middlewareAdmin();
      $view_more = [
        "page"         => "ad_view_test",
        "all_test"     => $this->all_test,
        "all_question" => $this->test_db->loadAllQuestionForTest(),
        "admin_modify" => $this->user_db->getNameAdminModify(),
        "num_question" => $this->test_db->getNumberQuestionOfAllTest(),
      ];
      $this->render('master_admin',$view_more);
    }

    public function postNewTest(){
      $this->middlewareAdmin();

      $res = false;
      if(!empty($_POST['new_test_name'])){
        $id_admin_create = $this->user_db->getAdminId($_COOKIE['member_login']);
        if($id_admin_create != 0)
          $res = $this->test_db->createNewTest($_POST, $id_admin_create);
        if($res)
          header("Location:../AdminPage/getViewTest");
      }
      
      $view_more = [
        "page"          => "ad_view_test",
        "post_new_test" => $_POST,
        "res_new_test"  => $res,
      ];
      $this->render('master_admin',$view_more);
    }

    public function getCurrentNumQuestionOfEachTest(){
      $res = "";
      if(isset($_POST)){
        $res = $this->test_db->loadNumberQuestionCurrent($_POST['id']);
        $res2 = $this->test_db->loadTestById($_POST['id']);

      }
      $this->view("master_empty", [
        "page" => "get_curr_num_qs_of_each_test",
        "curr_num_qs" => $res,
        "curr_test" => $res2,
      ]);

    }


    public function getNewTestQuestion(){
      $this->middlewareAdmin();
      $view_more = [
        "page"           => "ad_new_test",
        "all_test"       => $this->all_test,
        "num_qs_current" => $this->test_db->loadNumberQuestionCurrent(1),
      ];
      $this->render('master_admin',$view_more);
    }


    public function postAppendTest(){
      $this->middlewareAdmin();

      $res = false;
      if(isset($_POST)){
        if(!empty($_POST))
          $res = $this->test_db->appendQuestionTest($_POST);
      }
      if(isset($_POST))
        header("Location:../AdminPage/getNewTestQuestion");

      $view_more = [
        "page"         => "ad_new_lesson",
        "update_state" => $res,
      ];
      $this->render('master_admin',$view_more);
    }


    public function getUpdateTest($test_id, $test_level){
      $this->middlewareAdmin();
      $page = '';
      if($test_level > 0){
        $page = "ad_update_test";
        $content_test = $this->test_db->getContentByTestId($test_id);
      }
      else{
        $page = "ad_update_test";
        $content_test = $this->test_db->getContentByTestId($test_id);
      }

      $view_more = [
        "page"             => $page,
        "id_test_update"   => $test_id,
        "name_test_update" => $this->test_db->getNameTestById($test_id),
        "content_test"     => $content_test,
        "test_level"       => $test_level,
      ];
      $this->render('master_admin',$view_more);
    }

    public function postUpdateTest($test_id, $test_level){
      $this->middlewareAdmin();
      $res = false;
      if(isset($_POST)){
        if($test_level > 0){
          $page = "ad_update_test";
          $res = $this->test_db->updateTestById($_POST);
          $content_test_after_update = $this->test_db->getContentByTestId($test_id);
        }
        else{
          $page = "ad_update_test";
          $res = $this->test_db->updateTestById($_POST);
          $content_test_after_update = $this->test_db->getContentByTestId($test_id);
          if($res){
            header("Location:../../getUpdateTest/".$test_id."/".$test_level);
          }
        }
      }
      
      $view_more = [
        "page"           => $page,
        "id_test_update" => $test_id,
        "content_test"   => $content_test_after_update,
        "post_content"   => $_POST,
        "res_update"     => $res,
        "test_level"     => $test_level,
        "name_test_update" => $this->test_db->getNameTestById($test_id),
      ];
      $this->render('master_admin',$view_more);
    }

    
    public function getDeleteLesson(){
      $this->middlewareAdmin();
      $res = "fail";
      if(isset($_POST)){
        if(!empty($_POST))
          $res = $this->tut_db->getDeleteLessonById($_POST);
      }
      $this->view("master_empty", [
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
        header("Location:../AdminPage/getViewTutorial");

      $view_more = [
        "page"        => "ad_view_tut",
        "res_update" => $res,
      ];
      $this->render('master_admin',$view_more);
    }


    public function getContentIdToDelete(){
      $this->middlewareAdmin();
      $res = "fail";
      if(isset($_POST)){
        if(!empty($_POST)){
          $res = $this->tut_db->getContentIdByLessonId($_POST['les_id']);
        }
        
      }
      $this->view("master_empty", [
        "page"        => "get_mes_history",
        "content_id" => $res,
      ]);
    }


    public function getDeleteContent(){
      $this->middlewareAdmin();
      $res = "fail";
      if(isset($_POST)){
        if(!empty($_POST)){
          $res = $this->tut_db->getDeleteContentById($_POST['les_id'], $_POST['content_id']);
        }
        
      }
      $this->view("master_empty", [
        "page"        => "get_mes_history",
        "delete_res" => $res,
      ]);
    }

    
    public function postEditTest(){
      $this->middlewareAdmin();
      $res = "fail";
      if(isset($_POST)){
        if(!empty($_POST)){
          $res = $this->test_db->getEditTestById($_POST);
        }
      }
      if($res)
        header("Location:../AdminPage/getViewTest");

      $view_more = [
        "page"       => "ad_view_test",
        "upload_res" => $res,
      ];

      $this->render('master_admin',$view_more);
    }


  }


?>