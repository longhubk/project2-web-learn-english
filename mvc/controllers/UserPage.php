<?php 
  class UserPage extends Controller{

    public $tut_db;
    public $user_db;
    public function __construct()
    {
      $this->tut_db      = $this->model("TutorialModel");
      $this->user_db     = $this->model("UserModel");
    }
    function Init(){
        $this->view("master_h", [
          "page"      => "content_user",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "login_res" => "OK",
          "avatar"    => $this->user_db->getUserAvatar()

        ]);
      }
    function upload(){
      if(isset($_FILES)){
        $f_name = $_FILES['file']['name'];
        $f_Temp_name = $_FILES['file']['tmp_name'];
        $f_Size = $_FILES['file']['tmp_name'];
        $f_Error = $_FILES['file']['type'];
        $f_Type = $_FILES['file']['error'];
        $this->user_db->uploadAvatar($f_name, $f_Temp_name, $f_Size, $f_Error, $f_Type);
      }
        $this->view("master_h", [
          "page"      => "content_user",
          "allTuts"   => $this->tut_db->getAllTutorial(),
          "tut_qs"    => $this->tut_db->loadQuestion(),
          "avatar"    => $this->user_db->getUserAvatar()

        ]);
      }
  }

?>