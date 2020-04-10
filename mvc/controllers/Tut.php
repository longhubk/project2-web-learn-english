
<?php 

  class Tut extends Controller{
    protected $Tut_db;
    protected $user_db;
    public function __construct()
    {
      $this->Tut_db  = $this->model("TutorialModel");
      $this->user_db = $this->model("UserModel");
    }
    function Init(){
      $this->view("master_h",[
        "page"    => "content_tut",
        "allTuts" => $this->Tut_db->getAllTutorial(),
        "avatar"  => $this->user_db->getUserAvatar(),


      ]);
    }
    function All(){
      $this->view("master_h",[
        "page"    => "content_tut",
        "allTuts" => $this->Tut_db->getAllTutorial(),
        "avatar"  => $this->user_db->getUserAvatar(),


      ]);
    }
    function One($tut_name, $tut_lesson = "be_verb"){
      $this->view("master_h",[
        "page"         => "content_tut",
        "img_tut"      => $tut_lesson,
        "tut_name"     => $tut_name,
        "allTuts"      => $this->Tut_db->getAllTutorial(),
        "tutContent"   => $this->Tut_db->getTutContent($tut_name),
        "tutKnowledge" => $this->Tut_db->getTutKnowledge($tut_lesson),
        "tut_guide"    => $this->Tut_db->loadGuide(),
        "tut_sub"      => $this->Tut_db->loadSub(),
        "tut_qs"       => $this->Tut_db->loadQuestion(),
        "avatar"       => $this->user_db->getUserAvatar(),


      ]);
    }
  
 }

?>