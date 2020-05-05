
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
          "page"      => "test_page",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "OK",
          "avatar"    => $this->user_db->getUserAvatar(),
          "menu_user" => $this->user_db->getUserMenu(),
          "test_qs"   => $this->test_db->LoadTestQuestion(),

        ]);
    }

    public function Check(){

      $res = "";
      // var_dump($_POST);
      if(isset($_POST['commit_test'])){
        $user_answer = json_encode($_POST);
        // print($user_answer);
        // $json_string = json_encode($_POST, JSON_PRETTY_PRINT);

        // echo "your point:" . $res;
        
        
        // $data = json_decode($json_string, true);

        // $data = $_POST;
        
        // foreach($data2 as $key => $value){
        //   echo $key . "<br>";
        //   print_r( $value);
        //   echo "<br>";
        // }
        
        $res = $this->test_db->calculatePoint($_POST);
        if(!empty($res)){
          // echo $res;
        }else
          $res =  "error";
        
        // echo $json_string;


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