
<?php 
    if(!isset($_SESSION['last_post']))
      $_SESSION['last_post'] = [];
  class TestPage extends Controller{

    protected $test_turn;

    public function __construct()
    {
      parent::__construct();
      $this->test_turn  = $this->test_db->getTestTurnById($_COOKIE['member_login']);
      $this->test_guide  = $this->test_db->getTestGuide();

      $this->view_arr = [
          "all_tuts" => $this->all_tuts,
          "avatar"   => $this->avatar,
          "test_guide" => $this->test_guide,
      ];
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
        $this->middlewareTest('RegisterPage/');
        if($lock = 'lock'){
        }
      $view_more = [
        "page"      => "test_index",
        "all_test"  => $this->all_test,
        "test_turn" => $this->test_turn,
      ];
      $this->render('master_test',$view_more);

    }

    public function Test($test_id){
      $this->middlewareTest('../../RegisterPage/', 'test');
      $time_test = $this->test_db->getTimeTestById($test_id);
      $test_qs   = $this->test_db->LoadTestQuestion($test_id);

      $view_more = [
        "page"      => "test_page",
        "all_test"  => $this->all_test,
        "time_test" => $time_test,
        "test_qs"   => $test_qs,
        "test_id"   => $test_id,

      ];
      $this->render('master_test',$view_more);
    }

    public function Check($test_id){
      $this->middlewareTest('../../RegisterPage/');
      $res  = '';
      if(!empty($_POST)){
        $res = $this->test_db->calculatePoint($_POST, $test_id);
        if(empty($res))
          $res =  "error";
      }
      else{
        header("Location:../../TestPage/");
      }
      $test_qs   = $this->test_db->LoadTestQuestion($test_id);

      $view_more = [
        "page"      => "test_res",
        "post_test" => $_POST,
        "test_id"   => $test_id,
        "test_qs"   => $test_qs,
        "test_res"  => $res,
      ];
      $this->render('master_test',$view_more);
    }

    public function registerTest(){
      $res = "";
      if(isset($_POST)){
        $res = $this->test_db->getRegisterTest($_POST['test_id'], $_COOKIE['member_login']);
      }
      if(empty($_SESSION['test'])){
        $_SESSION['test'] = $_COOKIE['member_login'] ."-".$_POST['test_id'];
      }
  
      $this->view("master_empty", [
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