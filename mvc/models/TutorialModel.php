<?php 
  class TutorialModel extends DB{

    private $path = "./mvc/models/data/";

    // public function __construct()
    // {
    //   parent::__construct();
    //   $this->path = "./mvc/models/data/";
    // }

    // public function getTutKnowledge($getTutorial){
    //   return parent::readJsonData("$this->path" ."core_knowledge/" . $getTutorial . ".json");
    // }


    private function queryAssoc($qr, $tr){
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_assoc($rows);
      return $res[$tr];
    }

    public function getTutKnowledge($getTutorial){
      $qr   = "SELECT lesson_id FROM lesson_tut WHERE name_lesson = '$getTutorial'";
      $les_id = $this->queryAssoc($qr,'lesson_id');
      $qr2   = "SELECT * FROM content_lesson WHERE lesson_id = '$les_id'";
      return $this->queryAllArray($qr2);
    }

    public function getTutKnowledgeBasic($getTutorial){
      $qr   = "SELECT lesson_id FROM lesson_tut WHERE name_lesson = '$getTutorial'";
      $les_id = $this->queryAssoc($qr,'lesson_id');
      // var_dump($les_id);
      $qr2   = "SELECT * FROM basic_content_lesson WHERE lesson_id = '$les_id'";
      return $this->queryAllArray($qr2);
    }

    public function getAllLessonOfTutorialById($id){
      $qr   = "SELECT name_lesson, lesson_id FROM lesson_tut WHERE tut_id = '$id'";
      return $this->queryAllArray($qr);
    }

    public function getTutLevelById($id){
      $qr   = "SELECT tut_level FROM tutorials WHERE id = '$id'";
      return $this->queryAssoc($qr, 'tut_level');
    }

    public function getImageLesson($getTutorial){
      $qr   = "SELECT image FROM lesson_tut WHERE name_lesson = '$getTutorial'";
      return $this->queryAssoc($qr,'image');
    }

    public function getTitleLesson($getTutorial){
      $qr   = "SELECT title_lesson FROM lesson_tut WHERE name_lesson = '$getTutorial'";
      return $this->queryAssoc($qr,'title_lesson');
    }

    public function loadGuide(){
      return parent::readJsonData("$this->path"."guide_listen.json");
    }
    
    public function loadSub(){
      return parent::readJsonData("$this->path"."subtitles_data/video1_sub_data.json");
    }


    private function queryAllArray($qr){
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_all($rows);
      return $res;
    }
    
    public function getAllTutorial(){
      // return parent::readJsonData("$this->path"."tutorials/all_tutorial.json");
      $qr   = "SELECT tut_name, tut_query FROM tutorials";
      return $this->queryAllArray($qr);
    }


    public function loadAllAdmin($name_tb, $name_col, $name_id){
      $qr   = "SELECT $name_col, $name_id FROM $name_tb";
      return $this->queryAllArray($qr);
    }

    public function loadAllAdminTutLevel($name_tb, $name_col, $name_id, $tut_level){
      $qr   = "SELECT $name_col, $name_id, $tut_level FROM $name_tb";
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

    public function checkTutBasic($tut_name){
      $qr   = "SELECT tut_level FROM tutorials WHERE tut_query = '$tut_name'";
      return  $this->queryAssoc($qr, 'tut_level');
    }


    private function  stripVN($str) {

    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);

    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = preg_replace("/ /", "_", $str);
    return $str;

  }
    public  function createNewTutorial($post_tut, $id_ad_create){
    // $string = "Cộng hòa xã hội chủ nghĩa Việt Nam";
      $link_string = $this->stripVN($post_tut['new_tut_name']);

      echo $link_string;
      $qr = "INSERT INTO `tutorials` (`id`, `tut_name`, `admin_id_create`, `time_modify`, `topic_id`, `tut_query`, `tut_level`) VALUES (NULL, '$post_tut[new_tut_name]', '$id_ad_create', current_timestamp(), '$post_tut[choose_topic]', '$link_string', '$post_tut[choose_level]')";

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
      $tut_level = $post['tut_level_input'];
      $num_content = $post['number_content'];
      if($tut_level > 0){
        
        for($i = 1; $i <= $num_content; $i++){
          $main_ct    = '';
          $guide_ct   = '';
          $main_ct_p  = "main_content-".$i;
          $guide_ct_p = "main_content-".$i;

          if(!empty($post[$main_ct_p]))
            $main_ct = $post[$main_ct_p];
          if(!empty($post[$guide_ct_p]))
            $guide_ct = $post[$guide_ct_p];

          $str = 'exp-'.$i.'-';
          $exp = [];
          for($j = 1; $j <= 5; $j++){
            $id = $str . $j;
            if(isset($post[$id])){
              $exp[$j] = $post[$id];
            }else
              $exp[$j] = '';
          }

          $qr = 'INSERT INTO content_lesson VALUES(NULL, "' .$les_id .'","' .$main_ct. '","'.$guide_ct.'","'.$exp[1].'","'.$exp[2].'","'.$exp[3].'","'.$exp[4].'","'.$exp[5].'")';
          
          $rows = mysqli_query($this->con, $qr);
          if(!$rows) return false;
        }

      }else{

        for($i = 1; $i <= $num_content; $i++){
          $main_ct    = '';
          $image_ct   = '';
          $main_ct_p  = "content_main-".$i;
          $image_ct_p = "image_main-".$i;

          if(!empty($post[$main_ct_p]))
            $main_ct = $post[$main_ct_p];
          if(!empty($post[$image_ct_p]))
            $image_ct = $post[$image_ct_p];

          $str1 = 'sub-'.$i.'-';
          $str2 = 'aud-'.$i.'-';
          $str3 = 'img-'.$i.'-';
          $sub = [];
          $aud = [];
          $img = [];
          for($j = 1; $j <= 3; $j++){
            $id1 = $str1 . $j;
            $id2 = $str2 . $j;
            $id3 = $str3 . $j;
            if(isset($post[$id1])){
              $sub[$j] = $post[$id1];
            }else
              $sub[$j] = '';

            if(isset($post[$id2])){
              $aud[$j] = $post[$id2];
            }else
              $aud[$j] = '';

            if(isset($post[$id3])){
              $img[$j] = $post[$id3];
            }else
              $img[$j] = '';
          }

          $qr = 'INSERT INTO basic_content_lesson VALUES(NULL, "' .$les_id .'","' .$image_ct. '","'.$img[1].'","'.$img[2].'","'.$img[3].'","'.$main_ct.'","'.$sub[1].'","'. $sub[2].'","'.$sub[3]. '","' . $aud[1]. '","'. $aud[2].'","' .$sub[3].'")';

          $rows = mysqli_query($this->con, $qr);

          if(!$rows) return false;
        }

      }
      return true;
    }

    public function getMenuUser(){
      return parent::readJsonData("$this->path"."tutorials/menu_user.json");
    }

    public function getTutContent($tut_query){
      // return parent::readJsonData("$this->path"."tutorials/" . $tut_name . ".json");
      $qr   = "SELECT id FROM tutorials WHERE tut_query = '$tut_query'";
      $id =  $this->queryAssoc($qr, 'id');
      
      $qr2   = "SELECT name_lesson, title_lesson FROM lesson_tut WHERE tut_id = $id";
      return $this->queryAllArray($qr2);
  
    }  

    public function loadQuestion(){
      return parent::readJsonData("$this->path"."user_question.json");
    }

}

?>