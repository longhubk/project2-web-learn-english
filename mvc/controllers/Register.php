
  <?php 
  class Register extends Controller{

    public $user_db;
    public $tut_db;

    public function __construct()
    {
      $this->user_db = $this->model("UserModel");
      $this->tut_db  = $this->model("TutorialModel");
    }
    public function Init(){
      $this->view("master_h", [
        "page"       => "content_main",
        "allTuts"    => $this->tut_db->getAllTutorial(),
        "tut_qs"     => $this->tut_db->loadQuestion(),
        "login_part" => "log_in",
      
      ]);
    }
    public function Login(){
      $res      = false;
      $remember = "";
      if(isset($_POST['login'])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if(isset($_POST["remember"]))
          $remember = "OK";
        $res      = $this->user_db->checkLogin($username, $password);
      }

      if($res == 1){
        $this->user_db->checkSession($username, $password, $remember);
        $user_type = $this->user_db->getUserType($username);
        if($user_type == 'admin')
          header(('Location:../HomeAdmin/'));
        
        $this->view("master_h", [
          "page"      => "login_success",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "Login Successfully"
        ]);
      }
      else{
          $this->view("master_h", [
            "page"       => "content_main",
            "allTuts"    => $this->tut_db->getAllTutorial(),
            "tut_qs"     => $this->tut_db->loadQuestion(),
            "login_part" => "log_in",
            "state"      => $res
          ]);
      }
    }
    public function SignUp(){
      $res = false;
      if(isset($_POST['signup'])){
        $un     = $_POST["username_sp"];
        $pas    = $_POST["password_sp"];
        $pas_ag = $_POST["password_again_sp"];
        $email  = $_POST["email_sp"];
        $agree  = "";
        if(isset($_POST['agree']))
          $agree  = "OK";
        $res    = $this->user_db->checkSignUp($un, $pas, $pas_ag, $email, $agree);
      }
    if($res == 1){
      $this->view("master_h", [
        "page"      => "login_success",
        "allTuts"   => $this->tut_db->getAllTutorial(),
        "tut_qs"    => $this->tut_db->loadQuestion(),
        "login_res" => "Sign Up Successfully"
      ]);
    }else{
      $this->view("master_h", [
        "page"        => "content_main",
        "allTuts"     => $this->tut_db->getAllTutorial(),
        "tut_qs"      => $this->tut_db->loadQuestion(),
        "signup_part" => "sign_up",
        "sign_err"    => $res
    
      ]);
    }
  }
    public function LogOut(){
        $this->user_db->userLogout();
        $this->view("master_h", [
          "page"       => "content_main",
          "allTuts"    => $this->tut_db->getAllTutorial(),
          "tut_qs"     => $this->tut_db->loadQuestion(),
      
        ]);
    }
}

  ?>