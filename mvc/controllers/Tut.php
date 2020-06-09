
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
        "allTutsIndex" => $this->Tut_db->getAllTutorialIndex(),
        "avatar"  => $this->user_db->getUserAvatar(),


      ]);
    }
    public function All(){
      $is_lock = [];
      if(!empty($_SESSION['member_id']))
        $is_lock = $this->Tut_db->getIsLockTutUser($_SESSION['member_id']);

      $this->view("master_h",[
        "page"    => "content_tut",
        "allTutsIndex" => $this->Tut_db->getAllTutorialIndex(),
        "avatar"  => $this->user_db->getUserAvatar(),
        "tut_qs"  => $this->Tut_db->loadQuestion(),
        "is_lock" => $is_lock,
      ]);
    }
    public function One($tut_name, $tut_lesson = "be_verb"){
      $page = "content_tut";
      if(!empty($_SESSION['member_id']) && $_SESSION['user_type'] !== 'admin'){
        $check_is_lock = $this->Tut_db->checkIsLockInThisTutorial($_SESSION['member_id'], $tut_name);

      if($check_is_lock == 'lock')
          header('Location:../../TestPage/lock');
      }else if($_SESSION['user_type'] == 'user')
          header('Location:../../Register/');



      $tutKnowledge =  $this->Tut_db->getTutKnowledge($tut_lesson);
      if($this->Tut_db->checkTutBasic($tut_name) < 1){
        $tut_lesson = 'words_to_ask';
        $page = "content_tut_basic";
        $tutKnowledge =  $this->Tut_db->getTutKnowledgeBasic($tut_lesson);
      }
      $this->view("master_h",[
        "page"         => $page,
        "img_les"      => $tut_lesson,
        "tut_name"     => $tut_name,
        "allTutsIndex"      => $this->Tut_db->getAllTutorialIndex(),
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