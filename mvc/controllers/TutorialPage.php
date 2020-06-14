
<?php 

  class TutorialPage extends Controller{

    protected $is_lock = [];

    public function __construct()
    {
      parent::__construct();
      $this->is_lock = $this->tut_db->getIsLockTutUser($_SESSION['member_id']);

      $this->view_arr = [
          "all_tuts"   => $this->all_tuts,
          "avatar"    => $this->avatar,
      ];
    }
    public function Init(){
      $view_more = [
        "page"    => "content_tut",
      ];
      $this->render('master_home',$view_more);
    }

    public function all_tutorials(){
      if(!empty($_SESSION['member_id']))
      $view_more = [
        "page"    => "content_tut",
        "tut_qs"  => $this->tut_qs,
        "is_lock" => $this->is_lock,
      ];
      $this->render('master_home',$view_more);
    }

    public function Lesson($tut_name, $tut_lesson = "be_verb"){
      $page = "content_tut";
      if(!empty($_SESSION['member_id']) && $_SESSION['user_type'] !== 'admin'){
        $check_is_lock = $this->tut_db->checkIsLockInThisTutorial($_SESSION['member_id'], $tut_name);

      if($check_is_lock == 'lock')
          header('Location:../../TestPage/lock');
      }else if($_SESSION['user_type'] == 'user')
          header('Location:../../RegisterPage/');


      $tutKnowledge =  $this->tut_db->getTutKnowledge($tut_lesson);
      if($this->tut_db->checkTutBasic($tut_name) < 1){
        $tut_lesson = 'words_to_ask';
        $page = "content_tut_basic";
        $tutKnowledge =  $this->tut_db->getTutKnowledgeBasic($tut_lesson);
      }

      $info_les      = $this->tut_db->getInfoLesson($tut_lesson);
      $tut_content      = $this->tut_db->getTutContent($tut_name);

      $view_more = [
        "page"         => $page,
        "tut_qs"       => $this->tut_qs,
        "tut_name"     => $tut_name,
        "tutKnowledge" => $tutKnowledge,
        "tut_sub"      => $this->tut_db->loadSub(),
        "tut_guide"    => $this->tut_db->loadGuide(),
        "info_les"     => $info_les,
        "tutContent"   => $tut_content,
      ];
      $this->render('master_home',$view_more);
    }
  
  }

?>