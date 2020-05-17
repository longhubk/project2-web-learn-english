<?php 
  class TutorialModel extends DB{

    private $path = "./mvc/models/data/";

    // public function __construct()
    // {
    //   parent::__construct();
    //   $this->path = "./mvc/models/data/";
    // }

    public function getTutKnowledge($getTutorial){
      return parent::readJsonData("$this->path" ."core_knowledge/" . $getTutorial . ".json");
    }

    public function loadGuide(){
      return parent::readJsonData("$this->path"."guide_listen.json");
    }
    
    public function loadSub(){
      return parent::readJsonData("$this->path"."subtitles_data/video1_sub_data.json");
    }

    public function getAllTutorial(){
      return parent::readJsonData("$this->path"."tutorials/all_tutorial.json");

    }

    public function loadAllAdmin($name_tb, $name_col, $name_id){
      $qr   = "SELECT $name_col, $name_id FROM $name_tb";
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_all($rows);
      return $res;

    }
    public function getNumberLessonOfAllTut(){
      $qr   = "SELECT tut_id, COUNT(lesson_id) FROM lesson_tut GROUP BY tut_id";
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_all($rows);
      return $res;
    }

    public function loadAllInfoTutorial(){
      $qr   = "SELECT * FROM tutorials";
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_all($rows);
      return $res;
    }

    public function loadAllLessonForTutorial(){
      $qr   = "SELECT * FROM lesson_tut";
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_all($rows);
      return $res;
    }
    
    public function getNameAdminModify(){
      $qr   = "SELECT id, name FROM users WHERE user_type = 'admin'";
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_all($rows);
      return $res;
    }
    public function updateContent($post){
      if(!empty($post['choose_les']))
        $les_id = $post['choose_les'];
      else 
        return false;
      $main_ct = '';
      $guide_ct = '';
      if(!empty($post['main_content']))
        $main_ct = $post['main_content'];
      if(!empty($post['guide_content']))
        $guide_ct = $post['guide_content'];
      $str = 'exp_';
      $exp = [];
      for($i = 1; $i <= 5; $i++){
        $id = $str . $i;
        if(isset($post[$id])){
          $exp[$i] = $post[$id];
        }else
          $exp[$i] = '';
      }

      $qr = "INSERT INTO content_lesson VALUES(NULL, '$les_id', '$main_ct', '$guide_ct' , '$exp[1]', '$exp[2]', '$exp[3]', '$exp[4]', '$exp[5]')";
      
      
      $rows = mysqli_query($this->con, $qr);
      if($rows) return true;
      else return false;

    }
    public function getMenuUser(){
      return parent::readJsonData("$this->path"."tutorials/menu_user.json");
    }

    public function getTutContent($tut_name){
      return parent::readJsonData("$this->path"."tutorials/" . $tut_name . ".json");
    }  

    public function loadQuestion(){
      return parent::readJsonData("$this->path"."user_question.json");
    }

}

?>