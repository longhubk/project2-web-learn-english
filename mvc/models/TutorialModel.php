<?php 
  class TutorialModel extends Database{

    


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

    public function getInfoLesson($name_lesson){
      $qr   = "SELECT image, video, audio, title_lesson, name_lesson FROM lesson_tut WHERE name_lesson = '$name_lesson'";
      return $this->queryAssocAll($qr);
    }

    public function getSubAudio($name_lesson){
      $file_dir = "$this->path"."sub_aud/" . $name_lesson . ".json";
      if(file_exists($file_dir))
        return parent::readJsonData($file_dir);
      else
        return "";
    }


    public function getQuizAudio($name_lesson){

      $file_dir = "$this->path"."quiz_aud/" . $name_lesson . ".json";
      if(file_exists($file_dir))
        return parent::readJsonData($file_dir);
      else
        return "";
    }

    public function countQuizPoint($arr_quiz, $name_lesson){
      $point = 0;
      $arr_right = parent::readJsonData("$this->path"."quiz_aud/" . $name_lesson . ".json");
      for($i = 0; $i < sizeof($arr_right); $i++){
        $arr_right_each = (array)$arr_right[$i];
        $count = 0;
        for($j = 0; $j < sizeof($arr_right_each['ans']); $j++){
          $arr_ans = (array)$arr_right_each['ans'][$j];
          if($arr_ans['is_right'] == $arr_quiz[$i][$j]){
            $count++;
          }
        }
        if($count == 4){
          $point++;
        }
      }
      $qr1 = "SELECT lesson_id FROM lesson_tut WHERE name_lesson = '$name_lesson'";
      $lesson_id = $this->queryAssoc($qr1, 'lesson_id');

      $user_id = $_SESSION['member_id'];
      $qr = "SELECT point  FROM user_lesson WHERE user_id = '$user_id' AND lesson_id = '$lesson_id'";
      $old_point = 0;
      $update = false;
      if($this->queryNumRow($qr) > 0){
        $old_point = $this->queryAssoc($qr, 'point');
        $update = true;
      }
      else{
        $qr3 = "INSERT INTO user_lesson VALUE('$user_id', '$lesson_id', '$point', now())";
        $res_ins = mysqli_query($this->con, $qr3);
      }


      if($point > $old_point && $update){
        $qr2 = "UPDATE user_lesson SET point = ".$point." WHERE user_id = '$user_id' AND lesson_id = '$lesson_id'";
        $res_up = mysqli_query($this->con, $qr2);
      }


      return $point;
      
    }


    public function loadGuide(){
      return parent::readJsonData("$this->path"."guide_listen.json");
    }
    
    public function loadSub(){
      // return parent::readJsonData("$this->path"."subtitles_data/video1_sub_data.json");
      return parent::readJsonData("$this->path"."subtitles_data/sub_demo.json");
    }


    public function getAllTutorial(){
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

    public function loadAllTopic(){
      $qr   = "SELECT * FROM topics";
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

    public function loadAllLessonForTutorial(){
      $qr   = "SELECT * FROM lesson_tut";
      return $this->queryAllArray($qr);
    }
    
    // public function uploadFile($file){
    //   $qr   = "SELECT id, name FROM users WHERE user_type = 'admin'";
    //   return $this->queryAllArray($qr);
    // }

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

    public function getDeleteContentBasicById($ct_id){
      $f_dir_img = './public/img/basic_img/';
      $f_dir_aud = './public/audio/';
        
      $qr_img_main = "SELECT image_main FROM basic_content_lesson WHERE content_id = '$ct_id' ";
        $img_main = $this->queryAssoc($qr_img_main, 'image_main');
        
      $f_dir4 = $f_dir_img . $img_main;
      if(file_exists($f_dir4))
        unlink($f_dir4);
      
      for($i = 1; $i <= 3; $i++){
        $srt_img = "img_" . $i;
        $srt_aud = "aud_" . $i;
        $qr_img = "SELECT ".$srt_img." FROM basic_content_lesson WHERE content_id = '$ct_id' ";
        $img_f = $this->queryAssoc($qr_img, $srt_img);

        $qr_aud = "SELECT ".$srt_aud." FROM basic_content_lesson WHERE content_id = '$ct_id' ";
        $aud_f = $this->queryAssoc($qr_aud, $srt_aud);

        $f_dir2 = $f_dir_img . $img_f;
        $f_dir3 = $f_dir_aud . $aud_f;

        if(file_exists($f_dir2))
          unlink($f_dir2);
        if(file_exists($f_dir3))
          unlink($f_dir3);

      }
      

      $qr   = "DELETE FROM basic_content_lesson WHERE content_id = '$ct_id'";
      $res = $this->queryOne($qr);

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
          $stt = $kind[1];
          $f_Ext_Allowed = [];
          $f_dir = '';
          $new_name = '';
          if($kind[0] == 'image' || $kind[0] == 'img'){
            $f_Ext_Allowed = array('jpg', 'png', 'jpeg', 'gif');
            $f_dir         = "./public/img/basic_img/";
            $new_name = 'img_basic_les_' . $keys[1] . "_" .$stt;
          }
          else {
            $f_Ext_Allowed = array('mp3', 'wav');
            $f_dir = "./public/audio/";
            $new_name = 'aud_basic_les_' . $keys[1] . "_" .$stt;
          }
          $f_new_name = $this->uploadFile($value['name'],$value['tmp_name'],$new_name, $value['size'],$value['error'], $f_Ext_Allowed, $f_dir);

          $qr2 = 'UPDATE basic_content_lesson SET '.$keys[0].' = "'.$f_new_name.'" WHERE content_id = '.$keys[1];
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
      $qr_img = "SELECT image FROM lesson_tut WHERE lesson_id = '$les_id'";
      $img_les = $this->queryAssoc($qr_img, 'image');
      $f_dir = "./public/img/les_img/" . $img_les;
      if(file_exists($f_dir))
        unlink($f_dir);
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

      $qr1 = "SELECT MAX(lesson_id) AS max_id FROM lesson_tut";
      $max_id = $this->queryAssoc($qr1, 'max_id');
      
      $file_name = "";


      if($file_les['select_img_les']['error'] == 0){
        $file_img = $file_les['select_img_les'];
        $new_name_lesson = $this->stripVN($post_les['new_lesson_name']);
        $file_name = $file_img['name'];
        $f_Ext_Allowed = array('jpg', 'png', 'jpeg', 'gif');
        $f_dir         = "./public/img/les_img/";

        $qr = "INSERT INTO `lesson_tut` (`lesson_id`, `tut_id`, `name_lesson`, `title_lesson`, `image`) VALUES (NULL, '$post_les[tut_lesson]', '$new_name_lesson', '$post_les[new_lesson_title]', '$file_name');";
        $res = mysqli_query($this->con, $qr);

        $qr_id = "SELECT lesson_id FROM lesson_tut WHERE name_lesson = '$new_name_lesson' ";
        $lesson_id = $this->queryAssoc($qr_id, 'lesson_id');

        $new_name = 'img_les_' . ($lesson_id);

        $f_new_name = $this->uploadFile($file_img['name'], $file_img['tmp_name'], $new_name, $file_img['size'],$file_img['error'], $f_Ext_Allowed, $f_dir);

        $qr_update_img = "UPDATE lesson_tut SET image = '$f_new_name' WHERE lesson_id = '$lesson_id'";
        $res1 = $this->queryOne($qr_update_img);
      }



      
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
          $qr_max = "SELECT MAX(content_id) AS max_id FROM basic_content_lesson";
          $max_id = $this->queryAssoc($qr_max, 'max_id');

          $qr = 'INSERT INTO basic_content_lesson VALUES(NULL, "'.$les_id.'","","","","","","","","","","","")';
          $rows = mysqli_query($this->con, $qr); 

          $qr_id = "SELECT content_id FROM basic_content_lesson WHERE image_main = '' ";
          $ct_new_id = $this->queryAssoc($qr_id, 'content_id');

          if(!empty($post[$main_ct_p])){
            $main_ct = $this->filterBreak($post[$main_ct_p]);
            $qr = "UPDATE basic_content_lesson SET content_main = '$main_ct' WHERE content_id = '$ct_new_id' ";
            $res2 = $this->queryOne($qr); 
          }
          if(!empty($file[$image_ct_p]['name'])){
            $image_ct = $file[$image_ct_p]['name'];
            $f_Ext_Allowed = array('jpg', 'png', 'jpeg', 'gif');
            $f_dir         = "./public/img/basic_img/";
            $new_name = "img_basic_les_" . ($ct_new_id) . "_main";
            $image_ct = $this->uploadFile($file[$image_ct_p]['name'], $file[$image_ct_p]['tmp_name'],$new_name, $file[$image_ct_p]['size'],$file[$image_ct_p]['error'], $f_Ext_Allowed, $f_dir);

            $qr = "UPDATE basic_content_lesson SET image_main = '$image_ct' WHERE content_id = '$ct_new_id' ";
            $res2 = $this->queryOne($qr); 

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
            $str_sub = 'sub_' . $j;
              
            $qr = "UPDATE basic_content_lesson SET ".$str_sub." = '".$sub[$j]."' WHERE content_id = '$ct_new_id' ";
            $res2 = $this->queryOne($qr); 

            if(isset($file[$id2]['name'])){
              $aud[$j] = $file[$id2]['name'];
              $str_aud = 'aud_' . $j;
              $f_Ext_Allowed = array('mp3', 'wav');
              $f_dir = "./public/audio/";
              $new_name = 'aud_basic_les_' . ($ct_new_id) . "_" . $j;
              $aud[$j] = $this->uploadFile($file[$id2]['name'], $file[$id2]['tmp_name'],$new_name, $file[$id2]['size'],$file[$id2]['error'], $f_Ext_Allowed, $f_dir);

            $qr = "UPDATE basic_content_lesson SET ".$str_aud." = '".$aud[$j]."' WHERE content_id = '$ct_new_id' ";
              $res2 = $this->queryOne($qr); 
            }else
              $aud[$j] = '';

            if(isset($file[$id3]['name'])){
              $img[$j] = $file[$id3]['name'];
              $str_img = 'img_'. $j;
              $f_Ext_Allowed = array('jpg', 'png', 'jpeg', 'gif');
              $f_dir         = "./public/img/basic_img/";
              $new_name = 'img_basic_les_' . ($ct_new_id) . "_" . $j;
              $img[$j] = $this->uploadFile($file[$id3]['name'], $file[$id3]['tmp_name'],$new_name, $file[$id3]['size'],$file[$id3]['error'], $f_Ext_Allowed, $f_dir);

            $qr = "UPDATE basic_content_lesson SET ".$str_img." = '".$img[$j]."' WHERE content_id = '$ct_new_id' ";
              $res2 = $this->queryOne($qr); 
            }else
              $img[$j] = '';
          }



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