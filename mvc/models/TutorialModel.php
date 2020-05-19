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

    private function queryAllArray($qr){
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_all($rows);
      return $res;
    }

    public function loadAllAdmin($name_tb, $name_col, $name_id){
      $qr   = "SELECT $name_col, $name_id FROM $name_tb";
      return $this->queryAllArray($qr);

    }
    public function getNumberLessonOfAllTut(){
      $qr   = "SELECT tut_id, COUNT(lesson_id) FROM lesson_tut GROUP BY tut_id";
      return $this->queryAllArray($qr);
    }

    public function loadAllInfoTutorial(){
      $qr   = "SELECT * FROM tutorials";
      return $this->queryAllArray($qr);
    }

    public function loadAllLessonForTutorial(){
      $qr   = "SELECT * FROM lesson_tut";
      return $this->queryAllArray($qr);
    }
    
    public function getNameAdminModify(){
      $qr   = "SELECT id, name FROM users WHERE user_type = 'admin'";
      return $this->queryAllArray($qr);
    }

    public function getContentByLessonId($les_id){
      $qr   = "SELECT * FROM content_lesson WHERE lesson_id = '$les_id'";
      return $this->queryAllArray($qr);
    }
    public function updateLessonById($post_ct){
      $res = true;
      foreach($post_ct as $key => $value){
        $qr = "";
        if(!empty($value)){
          $keys = explode("-", $key);
          // echo $keys[0] ." and ". $keys[1] . "<br>";
          $qr = "UPDATE `content_lesson` SET `$keys[0]` = '$value' WHERE `content_lesson`.`content_id` = $keys[1]";

          $up = mysqli_query($this->con, $qr);
          if(!$up)
            $res = false;
        }
      }
      return $res;

    }

    public  function createNewTutorial($post_tut, $id_ad_create){

      $qr = "INSERT INTO `tutorials` (`id`, `tut_name`, `admin_id_create`, `time_modify`, `topic_id`) VALUES (NULL, '$post_tut[new_tut_name]', '$id_ad_create', current_timestamp(), '$post_tut[choose_topic]')";

      $res = mysqli_query($this->con, $qr);
      if($res)
        return true;
      else
        return false;
    }

    public  function createNewLesson($post_les){
      $qr = "INSERT INTO `lesson_tut` (`lesson_id`, `tut_id`, `name_lesson`, `title_lesson`, `image`) VALUES (NULL, '$post_les[tut_lesson]', '$post_les[new_lesson_name]', '$post_les[new_lesson_title]', '$post_les[select_ext_img]');";


      $res = mysqli_query($this->con, $qr);
      if($res)
        return true;
      else
        return false;
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