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


    // private function queryAssoc($qr, $tr){
    //   $rows = mysqli_query($this->con, $qr);
    //   $res = mysqli_fetch_assoc($rows);
    //   return $res[$tr];
    // }

    // protected function queryAllArray($qr){
    //   $rows = mysqli_query($this->con, $qr);
    //   $res = mysqli_fetch_all($rows);
    //   return $res;
    // }

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

    public function getAllIdLessonOfTut($tut_id){
      $qr   = "SELECT lesson_id FROM lesson_tut WHERE tut_id = '$tut_id'";
      return $this->queryAllArray($qr);
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


    
    // public function getAllTutorialIndex(){
    //   // return parent::readJsonData("$this->path"."tutorials/all_tutorial.json");
    //   $qr   = "SELECT tut_name, tut_query FROM tutorials";
    //   return $this->queryAllArray($qr);
    // }

    public function getAllTutorialIndex(){
      $qr   = "SELECT * FROM tutorials";
      return $this->queryAllArray($qr);
    }

    public function getIsLockTutUser($us_id){
      $qr   = "SELECT status, tut_id FROM user_tuts WHERE user_id = '$us_id'";
      return $this->queryAllArray($qr);
    }
    private function getTutIdByTutName($tut_name){
      $qr   = "SELECT id FROM tutorials WHERE tut_query = '$tut_name'";
      return $this->queryAssoc($qr, 'id');
    }

    public function checkIsLockInThisTutorial($us_id, $tut_name){
      $tut_id = $this->getTutIdByTutName($tut_name);
      $qr   = "SELECT status FROM user_tuts WHERE user_id = '$us_id' AND tut_id = '$tut_id'";
      return $this->queryAssoc($qr, 'status');
    }


    public function updateTutorialNewSignUp($us_id, $tut){
      $res = [];
      for($i = 0; $i < sizeof($tut); $i++){
        $tut_id = $tut[$i][0];
        $qr   = "INSERT INTO user_tuts VALUES('$us_id','$tut_id','lock','false')";
        $res[$i] = mysqli_query($this->con, $qr);
      }
      $resAll = true;
      for($i = 0; $i < sizeof($res); $i++){
        $resAll = $resAll && $res[$i];
      }
      return $resAll;
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
    
    public function uploadFile($file){
      $qr   = "SELECT id, name FROM users WHERE user_type = 'admin'";
      return $this->queryAllArray($qr);
    }

    public function getContentByLessonId($les_id){
      $qr   = "SELECT * FROM content_lesson WHERE lesson_id = '$les_id'";
      return $this->queryAllArray($qr);
    }
    public function getContentIdByLessonId($les_id){
      $qr   = "SELECT content_id FROM content_lesson WHERE lesson_id = '$les_id'";
      return $this->queryAllArray($qr);
    }

    public function getContentByBasicLessonId($les_id){
      $qr   = "SELECT * FROM basic_content_lesson WHERE lesson_id = '$les_id'";
      return $this->queryAllArray($qr);
    }

    public function getDeleteContentById($les_id, $ct_id){
      $qr   = "DELETE FROM content_lesson WHERE content_id = '$ct_id' AND lesson_id = '$les_id'";
      $res =  mysqli_query($this->con, $qr);
      if($res) return 'ok';
      else return 'fail';
    }


    public function updateLessonById($post_ct){
      $res = true;
      foreach($post_ct as $key => $value){
          $keys = explode("-", $key);
          $qr = 'UPDATE content_lesson SET '.$keys[0].' = "'.$value.'" WHERE content_id = '.$keys[1];
          $up = mysqli_query($this->con, $qr);

          if(!$up){
            $res = false;
            // echo "false <br>";
          }
          // else
            // echo "true <br>";
      }
      return $res;
    }

    public function updateBasicLessonById($post_ct, $file_ct){
      $res = true;
      // echo "hello basic";
      $res_arr = [];
      foreach($post_ct as $key => $value){
        $qr2 = '';
        // if(!empty($value)){
          $keys = explode("-", $key);
          $qr2 = 'UPDATE basic_content_lesson SET '.$keys[0].' = "'.$value.'" WHERE content_id = '.$keys[1];
          $up = mysqli_query($this->con, $qr2);

          // echo $qr2 . "<br>";
          if(!$up){
            $res = false;
          }
      }
      foreach($file_ct as $key => $value){
        $qr2 = '';
        if($value['error'] == 0){
          $keys = explode('-', $key);

          $kind = explode('_',$keys[0]);
          $type = '';
          if($kind[0] == 'image' || $kind[0] == 'img'){
            $type = 'image';
          }
          else $type = 'music';

          $this->uploadFileLesson($value['name'],$value['tmp_name'], $value['size'],$value['error'], $type);

          $qr2 = 'UPDATE basic_content_lesson SET '.$keys[0].' = "'.$value['name'].'" WHERE content_id = '.$keys[1];
          $up = mysqli_query($this->con, $qr2);
          // echo $qr2 . "<br>";

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

    public function getEditTutorialById($post){

      $id_tut = $post['id_tut_edit'];
      $new_level = $post['new_level_tut'];
      $new_name = $post['new_tutorial_name'];
      $new_topic = $post['new_topic'];
      $new_qr_name = $this->stripVN($new_name);
      $qr   = "UPDATE `tutorials` SET `tut_level` = '$new_level' WHERE `tutorials`.`id` = '$id_tut'";
      $res1 =  mysqli_query($this->con, $qr);

      $qr2   = "UPDATE `tutorials` SET `tut_name` = '$new_name' WHERE `tutorials`.`id` = '$id_tut'";
      $res2 =  mysqli_query($this->con, $qr2);

      $qr3   = "UPDATE `tutorials` SET `tut_query` = '$new_qr_name' WHERE `tutorials`.`id` = '$id_tut'";
      $res3 =  mysqli_query($this->con, $qr3);

      $qr4   = "UPDATE `tutorials` SET `topic_id` = '$new_topic' WHERE `tutorials`.`id` = '$id_tut'";
      $res4 =  mysqli_query($this->con, $qr4);

      if($res1 && $res2 && $res3 && $res4) return true;
      else return false;

    }
    public function getEditLessonById($post){

      $id_les = $post['id_les_edit'];
      $new_title = $post['new_lesson_title'];
      $new_tut = $post['new_tut_edit'];
      
      $res1 = false;
      if(!empty($new_title)){
        $qr   = "UPDATE `lesson_tut` SET `title_lesson` = '$new_title' WHERE `lesson_tut`.`lesson_id` = '$id_les'";
        $res1 =  mysqli_query($this->con, $qr);
      }else{
        $res1 = true;
      }

      $qr2   = "UPDATE `lesson_tut` SET `tut_id` = '$new_tut' WHERE `lesson_tut`.`lesson_id` = '$id_les'";
      $res2 =  mysqli_query($this->con, $qr2);

      if($res1 && $res2 ) return true;
      else return false;

    }

    public function getDeleteLessonById($post){
      $les_id = $post['lesId'];
      $qr2 = "SELECT image FROM lesson_tut WHERE lesson_id = '$les_id'";
      $img = $this->queryAssoc($qr2, 'image');
      $f_name_check = './public/img/'.$img;
      if(file_exists($f_name_check)){
        unlink($f_name_check);
      }

      $qr   = "DELETE FROM `lesson_tut` WHERE `lesson_tut`.`lesson_id` = '$les_id'";
      $exe  = mysqli_query($this->con, $qr);


      if($exe) return "ok";
      else return "fail";
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

    public  function createNewLesson($post_les, $file_les){
      
      $file_name = "";
      if($file_les['select_img_les']['error'] == 0){
        $file_img = $file_les['select_img_les'];
        $file_name = $file_img['name'];
        $this->uploadFileLesson($file_img['name'], $file_img['tmp_name'], $file_img['size'],$file_img['error'],"image_les");
      }

      $qr = "INSERT INTO `lesson_tut` (`lesson_id`, `tut_id`, `name_lesson`, `title_lesson`, `image`) VALUES (NULL, '$post_les[tut_lesson]', '$post_les[new_lesson_name]', '$post_les[new_lesson_title]', '$file_name');";
      
      $res = mysqli_query($this->con, $qr);
      if($res)
        return true;
      else
        return false;
    }

    public function updateContent($post, $file){
      if(!empty($post['choose_les']))
        $les_id = $post['choose_les'];
      else 
        return false;
      $tut_level = $post['tut_level_input'];
      $num_content = $post['number_content'];
      if($tut_level > 0){

        // foreach($post as $key => $val){
        //   $val = $this->filterBreak($val);
        // }
        
        for($i = 1; $i <= $num_content; $i++){
          $main_ct    = '';
          $guide_ct   = '';
          $main_ct_p  = "main_content-".$i;
          $guide_ct_p = "guide_content-".$i;

          if(!empty($post[$main_ct_p]))
            $main_ct = $this->filterBreak($post[$main_ct_p]);
          if(!empty($post[$guide_ct_p]))
            $guide_ct = $this->filterBreak($post[$guide_ct_p]);

          $str = 'exp-'.$i.'-';
          $exp = [];
          for($j = 1; $j <= 10; $j++){
            $id = $str . $j;
            if(isset($post[$id])){
              $exp[$j] = $this->filterBreak($post[$id]);
            }else
              $exp[$j] = '';
          }

          $qr = 'INSERT INTO content_lesson VALUES(NULL, "' .$les_id .'","' .$main_ct. '","'.$guide_ct.'","'.$exp[1].'","'.$exp[2].'","'.$exp[3].'","'.$exp[4].'","'.$exp[5].'","'.$exp[6].'","'.$exp[7].'","'.$exp[8].'","'.$exp[9].'","'.$exp[10].'")';

          // echo $qr . "<br>";
          
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
            $main_ct = $this->filterBreak($post[$main_ct_p]);
          if(!empty($file[$image_ct_p]['name'])){
            $image_ct = $file[$image_ct_p]['name'];
            $this->uploadFileLesson($file[$image_ct_p]['name'], $file[$image_ct_p]['tmp_name'], $file[$image_ct_p]['size'],$file[$image_ct_p]['error'], 'image');

          }

          $str1 = 'sub-'.$i.'-';
          $str2 = 'aud-'.$i.'-';
          $str3 = 'img-'.$i.'-';
          $sub = $aud = $img = [];

          for($j = 1; $j <= 3; $j++){
            $id1 = $str1 . $j;
            $id2 = $str2 . $j;
            $id3 = $str3 . $j;
            if(isset($post[$id1])){
              $sub[$j] = $this->filterBreak($post[$id1]);
            }else
              $sub[$j] = '';

            if(isset($file[$id2]['name'])){
              $aud[$j] = $file[$id2]['name'];
              $this->uploadFileLesson($file[$id2]['name'], $file[$id2]['tmp_name'], $file[$id2]['size'],$file[$id2]['error'], 'music');
            }else
              $aud[$j] = '';

            if(isset($file[$id3]['name'])){
              $img[$j] = $file[$id3]['name'];
              $this->uploadFileLesson($file[$id3]['name'], $file[$id3]['tmp_name'], $file[$id3]['size'],$file[$id3]['error'], 'image');
            }else
              $img[$j] = '';
          }

          $qr = 'INSERT INTO basic_content_lesson VALUES(NULL, "' .$les_id .'","' .$image_ct. '","'.$img[1].'","'.$img[2].'","'.$img[3].'","'.$main_ct.'","'.$sub[1].'","'. $sub[2].'","'.$sub[3]. '","' . $aud[1]. '","'. $aud[2].'","' .$aud[3].'")';

          $rows = mysqli_query($this->con, $qr);

          if(!$rows) return false;
        }

      }
      return true;
    }


    private function uploadFileLesson($f_name, $ft_name, $f_size, $f_err, $f_type){
        $res = false;
        $f_Ext        = explode('.', $f_name);
        $f_Actual_Ext = strtolower(end($f_Ext));
        // $f_new_name   = $f_Ext[0] . "." . $f_Actual_Ext;
        $f_new_name   = $f_name;
        // $f_Actual_Ext = [];
        $f_des        = '';
        if($f_type == 'music'){
          $f_Ext_Allowed = array('mp3', 'wav');
          $f_des         = "./public/audio/" . $f_new_name;
        }
        if($f_type == 'image'){
          $f_Ext_Allowed = array('jpg', 'png', 'jpeg', 'gif');
          $f_des         = "./public/img/basic_img/" . $f_new_name;
        }
        if($f_type == 'image_les'){
          $f_Ext_Allowed = array('jpg', 'png', 'jpeg', 'gif');
          $f_des         = "./public/img/" . $f_new_name;
        }
    
        $out = '';
        if(in_array($f_Actual_Ext, $f_Ext_Allowed)){
          if($f_err == 0){
            if($f_size < 5000000){
              move_uploaded_file($ft_name, $f_des);
              $this->check_name_file_exist($f_Ext[0], $f_Ext_Allowed, $f_Actual_Ext, $f_type);
            }else
              $out = "file bigger than 5M";
          }else
            $out = "There are error";
        }
          $out = "you can not upload file that is not allowed extensions";
      return $out;
    }

    private function check_name_file_exist($f_name, $f_Ext_Allowed, $f_Actual_Ext, $f_type){
      foreach($f_Ext_Allowed as $ext){
        if($ext !== $f_Actual_Ext){
          $f_name_check = '';
          if($f_type == 'music')
            $f_name_check = "./public/audio/".$f_name .".". $ext;
          if($f_type == 'image')
            $f_name_check = "./public/img/basic_img/".$f_name .".". $ext;
          if($f_type == 'image_les')
            $f_name_check = "./public/img/".$f_name .".". $ext;

          if(file_exists($f_name_check)){
            unlink($f_name_check);
            echo "Deleted your old file ".$f_name." <br>";
          }
        }
      }
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