
<?php 
    if(!isset($_SESSION['last_post']))
      $_SESSION['last_post'] = [];
  class TestPage extends Controller{

    public $tut_db;
    public $user_db;
    public $test_db;
    public function __construct()
    {
      $this->tut_db  = $this->model("TutorialModel");
      $this->user_db = $this->model("UserModel");
      $this->test_db = $this->model("TestModel");
    }
    private function middlewareTest($back, $test = 'none'){
      if(empty($_SESSION['member_id'])){

        if(!empty($_COOKIE['member_login']))
          $this->user_db->checkSession($_COOKIE['member_login'], '');
        else
          header('Location:'.$back);
      }
      if($test == 'test'){
        if(empty($_SESSION['test']))
        header("Location:../../TestPage/");
      }

    }
    public function Init($lock = ''){
        $this->middlewareTest('Register/');
        if($lock = 'lock'){
          
        }

        $this->view("master_test", [
          "page"      => "test_index",
          "allTutsIndex"   => $this->tut_db->getAllTutorialIndex(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "OK",
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "all_test"  => $this->test_db->LoadAllTestAdmin(),
          "test_turn"  => $this->test_db->getTestTurnById($_COOKIE['member_login']),

        ]);
    }

    public function Test($test_id){
      $this->middlewareTest('../../Register/', 'test');

        $this->view("master_test", [
          "page"      => "test_page",
          "allTutsIndex"   => $this->tut_db->getAllTutorialIndex(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "OK",
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "test_qs"   => $this->test_db->LoadTestQuestion($test_id),
          "test_id"   => $test_id,
          "time_test"   => $this->test_db->getTimeTestById($test_id),
          // "post_last" => $_SESSION['last_post'],

        ]);
    }
    public function Check($test_id){
      $this->middlewareTest('../../Register/');
      $res  = '';
      if(!empty($_POST)){
        $res = $this->test_db->calculatePoint($_POST, $test_id);
        if(empty($res))
          $res =  "error";
      }
      else{
        header("Location:../../TestPage/");
      }

        $this->view("master_test", [
          "page"      => "test_res",
          "allTutsIndex"   => $this->tut_db->getAllTutorialIndex(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "OK",
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "test_res"  => $res,
          "test_qs"   => $this->test_db->LoadTestQuestion($test_id),
          "test_id"   => $test_id,
          "post_test" => $_POST,

        ]);
    }

    public function registerTest(){
      $res = "";
      if(isset($_POST)){
        $res = $this->test_db->getRegisterTest($_POST['test_id'], $_COOKIE['member_login']);
      }
      if(empty($_SESSION['test'])){
          // echo "set session test";
          $_SESSION['test'] = $_COOKIE['member_login'] ."-".$_POST['test_id'];
      }
  
      $this->view("master_blank", [
        "page" => "get_register_test",
        "res_register" => $res,
        "res_session" => $_SESSION['test'],
      ]);

    }

    public function destroySessionTest(){
      if(isset($_POST['destroy'])){
        if(!empty($_SESSION['test'])){
          $_SESSION['test'] = '';
        }
      }
    }

  }

?>