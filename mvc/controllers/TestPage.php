
<?php 
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
      
        if($page <= 0) $page = 1;
        $this->view("master_test", [
          "page"      => "test_page",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "OK",
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "test_qs"   => $this->test_db->LoadTestQuestion(),
          "first"      => $page-1,

        ]);
    }
    public function Check(){

      $res = "";
      if(isset($_POST['commit_test'])){
        
        $res = $this->test_db->calculatePoint($_POST);
        if(!empty($res)){
          // echo $res;
        }else
          $res =  "error";

      }

        $this->view("master_test", [
          "page"      => "test_page",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "OK",
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "test_qs"   => $this->test_db->LoadTestQuestion(),
          "test_as"   => $res,

        ]);
    }
  }

?>