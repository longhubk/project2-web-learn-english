
  <?php 
  class RegisterPage extends Controller{

    public function __construct()
    {
      parent::__construct();

      $this->view_arr = [
          "all_tuts"   => $this->all_tuts,
          "avatar"    => $this->avatar,
          "tut_qs"    => $this->tut_qs,
      ];
    }
    private function middlewareRegister(){
      // var_dump($_SESSION);
      if(!empty($_COOKIE['member_login']) || !empty($_SESSION['member_id'])){
        if($this->user_db->checkIsLogin($_COOKIE['member_login']) > 0){
          // echo "ehllo ";
          header("Location:../HomePage/");
        }
      }
      // else{
      //   $this->LogOut();
      // }
    }

    public function Init(){
      $view_more = [
        "page"       => "content_main",
        "login_part" => "log_in",
      ];
      $this->render('master_home',$view_more);
    }
    public function Login(){
      $this->middlewareRegister();
    
      $res      = false;
      $remember = "";
      if(isset($_POST['login'])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if($this->user_db->checkIsLogin($username) > 0){
          header("Location:../RegisterPage/");
        }
        else{
          if(isset($_POST["remember"]))
            $remember = "OK";
          $res      = $this->user_db->checkLogin($username, $password);
        }
      }

      if($res == 1){
        $this->user_db->checkSession($username, $remember);
        // $user_type = $this->user_db->getUserType($username);

        if($_SESSION['user_type'] == 'admin' || $_SESSION['user_type'] == 'teacher')
          header(('Location:../AdminPage/'));
        else
          header("Location:../HomePage/");
        $view_more = [
          "page"      => "login_success",
          "login_res" => "Login Successfully",
        ];
      }
      else{
        $view_more = [
          "page"       => "content_main",
          "login_part" => "log_in",
          "state"      => $res
        ];
      }

      $this->render('master_home',$view_more);
    }

    public function SignUp(){

      $this->middlewareRegister();
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
        $us_id = $this->user_db->getUserIdByName($un);
        $this->tut_db->updateTutorialNewSignUp($us_id, $this->all_tuts);

        $view_more = [
          "page"      => "login_success",
          "login_res" => "Sign Up Successfully"
        ];
        
      }else{
        $view_more = [
          "page"        => "content_main",
          "sign_err"    => $res,
          "signup_part" => "sign_up",
        ];
      }
      $this->render('master_home',$view_more);
    }

    public function LogOut(){
      $res = $this->user_db->userLogout($_COOKIE['member_login']);
      if($res == 'ok')
          header("Location:../HomePage/");
      $view_more = [
        "page"        => "content_main",
      ];
      $this->render('master_home',$view_more);
    }
}

  ?>