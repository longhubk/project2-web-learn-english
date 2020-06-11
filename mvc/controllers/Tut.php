
<?php 

  class Tut extends Controller{

    public function Init(){
      $this->view("master_h",[
        "page"    => "content_tut",
        "allTuts" => $this->tut_db->getAllTutorialIndex(),
        "avatar"  => $this->user_db->getUserAvatar(),


      ]);
    }
    public function All(){
      $is_lock = [];
      if(!empty($_SESSION['member_id']))
        $is_lock = $this->tut_db->getIsLockTutUser($_SESSION['member_id']);

      $this->view("master_h",[
        "page"    => "content_tut",
        "allTuts" => $this->tut_db->getAllTutorialIndex(),
        "avatar"  => $this->user_db->getUserAvatar(),
        "tut_qs"  => $this->tut_db->loadQuestion(),
        "is_lock" => $is_lock,
      ]);
    }
    public function One($tut_name, $tut_lesson = "be_verb"){
      $page = "content_tut";
      if(!empty($_SESSION['member_id']) && $_SESSION['user_type'] !== 'admin'){
        $check_is_lock = $this->tut_db->checkIsLockInThisTutorial($_SESSION['member_id'], $tut_name);

      if($check_is_lock == 'lock')
          header('Location:../../TestPage/lock');
      }else if($_SESSION['user_type'] == 'user')
          header('Location:../../Register/');



      $tutKnowledge =  $this->tut_db->getTutKnowledge($tut_lesson);
      if($this->tut_db->checkTutBasic($tut_name) < 1){
        $tut_lesson = 'words_to_ask';
        $page = "content_tut_basic";
        $tutKnowledge =  $this->tut_db->getTutKnowledgeBasic($tut_lesson);
      }
      $this->view("master_h",[
        "page"         => $page,
        "tut_name"     => $tut_name,
        "allTuts"      => $this->tut_db->getAllTutorialIndex(),
        "ext_les"      => $this->tut_db->getImageLesson($tut_lesson),
        "img_les"      => $this->tut_db->getImageLesson($tut_lesson),
        "vid_les"      => $this->tut_db->getVideoLesson($tut_lesson),
        "aud_les"      => $this->tut_db->getAudioLesson($tut_lesson),
        "title_les"    => $this->tut_db->getTitleLesson($tut_lesson),
        "tutContent"   => $this->tut_db->getTutContent($tut_name),
        "tutKnowledge" => $tutKnowledge,
        "tut_guide"    => $this->tut_db->loadGuide(),
        "tut_sub"      => $this->tut_db->loadSub(),
        "tut_qs"       => $this->tut_db->loadQuestion(),
        "avatar"       => $this->user_db->getUserAvatar(),


      ]);
    }
  
  }

?>