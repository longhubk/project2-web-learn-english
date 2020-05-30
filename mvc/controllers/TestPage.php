
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
    public function Init(){
        // var_dump($_COOKIE);
        if(empty($_COOKIE['member_login']))
          header("Location:Register/Login");
        // var_dump($_SESSION);

        $this->view("master_test", [
          "page"      => "test_index",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "OK",
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "all_test"  => $this->test_db->LoadAllTestAdmin(),
          "test_turn"  => $this->test_db->getTestTurnById($_COOKIE['member_login']),

        ]);
    }

    public function Test($test_id){
      if(empty($_COOKIE['member_login']))
        header("Location:../../Register/Login");
        // var_dump($_SESSION);
      else if(empty($_SESSION['test']))
        header("Location:../../TestPage/");
      // if($page==0 && sizeof($_SESSION['last_post']) > 0) //_fist initial or reset SESSION
      //   $_SESSION['last_post'] = [];
      // if($page <= 0) $page = 1;  //_prevent previous negative

      // var_dump($_SESSION['last_post']);

      // echo $page;
        $this->view("master_test", [
          "page"      => "test_page",
          "allTuts"   => $this->tut_db->getAllTutorial(),
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
      if(empty($_COOKIE['member_login']))
        header("Location:Register/Login");
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
          "allTuts"   => $this->tut_db->getAllTutorial(),
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