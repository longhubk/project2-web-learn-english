
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
        if(empty($_SESSION['member_id']))
          header("Location:Register/Login");
        // var_dump($_SESSION);

        $this->view("master_test", [
          "page"      => "test_index",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "OK",
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "all_test"  => $this->test_db->LoadAllTest(),

        ]);
    }

    public function Test($page){
      if(empty($_SESSION['member_id']))
        header("Location:Register/Login");
      if($page==0 && sizeof($_SESSION['last_post']) > 0) //_fist initial or reset SESSION
        $_SESSION['last_post'] = [];
      if($page <= 0) $page = 1;  //_prevent previous negative

      // var_dump($_SESSION['last_post']);

      // echo $page;
        $this->view("master_test", [
          "page"      => "test_page",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "OK",
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "test_qs"   => $this->test_db->LoadTestQuestion(),
          "first"     => $page-1,
          "post_last" => $_SESSION['last_post'],

        ]);
    }
    public function Check(){
      if(empty($_SESSION['member_id']))
        header("Location:Register/Login");
      $res       = "";
      $page_next = $_POST['page_next']+1;
      $test_qs   = $this->test_db->LoadTestQuestion();
      $array     = (array)$test_qs;
      $num_qs    = sizeof($array);
      // echo $num_qs;

      $this->test_db->changeDataTest($num_qs);

      if(isset($_POST['commit_test'])){
        $res = $this->test_db->calculatePoint($_SESSION['last_post']);
        if(empty($res))
          $res =  "error";
      }
      else if(isset($_POST['next_qs']))
        header("Location:Test/".$page_next);

        $this->view("master_test", [
          "page"      => "test_page",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "OK",
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "test_qs"   => $test_qs,
          "test_as"   => $res,
          "post_last" => $_SESSION['last_post'],

        ]);
    }
  }

?>