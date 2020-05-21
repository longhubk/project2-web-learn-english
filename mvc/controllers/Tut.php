
<?php 

  class Tut extends Controller{
    protected $Tut_db;
    protected $user_db;
    public function __construct()
    {
      $this->Tut_db  = $this->model("TutorialModel");
      $this->user_db = $this->model("UserModel");
    }
    public function Init(){
      $this->view("master_h",[
        "page"    => "content_tut",
        "allTuts" => $this->Tut_db->getAllTutorial(),
        "avatar"  => $this->user_db->getUserAvatar(),


      ]);
    }
    public function All(){
      $this->view("master_h",[
        "page"    => "content_tut",
        "allTuts" => $this->Tut_db->getAllTutorial(),
        "avatar"  => $this->user_db->getUserAvatar(),
        "tut_qs"  => $this->Tut_db->loadQuestion(),
      ]);
    }
    public function One($tut_name, $tut_lesson = "be_verb"){
      $page = "content_tut";
      $tutKnowledge =  $this->Tut_db->getTutKnowledge($tut_lesson);
      if($this->Tut_db->checkTutBasic($tut_name) < 1){

        $page = "content_tut_basic";
        $tutKnowledge =  $this->Tut_db->getTutKnowledgeBasic($tut_lesson);
      }
      $this->view("master_h",[
        "page"         => $page,
        "img_les"      => $tut_lesson,
        "tut_name"     => $tut_name,
        "allTuts"      => $this->Tut_db->getAllTutorial(),
        "ext_les"      => $this->Tut_db->getImageLesson($tut_lesson),
        "title_les"    => $this->Tut_db->getTitleLesson($tut_lesson),
        "tutContent"   => $this->Tut_db->getTutContent($tut_name),
        "tutKnowledge" => $tutKnowledge,
        "tut_guide"    => $this->Tut_db->loadGuide(),
        "tut_sub"      => $this->Tut_db->loadSub(),
        "tut_qs"       => $this->Tut_db->loadQuestion(),
        "avatar"       => $this->user_db->getUserAvatar(),


      ]);
    }
  
  }

?>