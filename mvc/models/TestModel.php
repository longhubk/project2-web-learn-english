
<?php 
  class TestModel extends Database{


    public function loadTestQuestion($test_id){
      $qr = "SELECT * FROM test_qs WHERE test_id = $test_id ";
      return $this->queryAllArray($qr);
    }

    
    public function loadAllTest(){
      $qr = "SELECT * FROM test";
      return $this->queryAllArray($qr);
    }


    public function getNumberQuestionOfAllTest(){
      $qr   = "SELECT test_id, COUNT(test_qs_id) FROM test_qs GROUP BY test_id";
      return $this->queryAllArray($qr);
    }

    public function getContentByTestId($test_id){
      $qr   = "SELECT * FROM test_qs WHERE test_id = '$test_id'";
      return $this->queryAllArray($qr);
    }

    public function getTimeTestById($test_id){
      $qr   = "SELECT test_time FROM test WHERE test_id = '$test_id'";
      return $this->queryAssoc($qr, 'test_time');
    }

    public function getTestGuide(){
      return parent::readJsonData("$this->path"."test_guide.json");
    }
    
    public function getTestTurnById($us_name){
      
      $qr1   = "SELECT id FROM users WHERE name = '$us_name'";
      $us_id = $this->queryAssoc($qr1, 'id');

      $qr   = "SELECT test_id, num_turn FROM user_tests WHERE user_id = '$us_id'";
      return $this->queryAllArray($qr);
    }


    private function updateByNameId($key, $val, $where, $id){
      $qr   = "UPDATE `test` SET $key = '$val' WHERE $where = '$id'";
      $res =  mysqli_query($this->con, $qr);
      if($res) return true;
      else return false;
    }



    public function getEditTestById($post){
      $test_id = $post['test_id'];
      $test_name = $post['new_name_test']; 
      $test_time = $post['new_time_test']; 
      $test_des = $post['new_des_test'];
      $test_num = $post['new_num_test'];
      $test_lev = $post['new_level_test'];

      $res1 = $this->updateByNameId('test_name', $test_name, 'test_id', $test_id);
      $res2 = $this->updateByNameId('test_time', $test_time, 'test_id', $test_id);
      $res3 = $this->updateByNameId('num_qs', $test_num, 'test_id', $test_id);
      $res4 = $this->updateByNameId('description', $test_des, 'test_id', $test_id);
      $res5 = $this->updateByNameId('test_level', $test_lev, 'test_id', $test_id);

      return $res1 && $res2 && $res3 && $res4 && $res5;
    }



    public function updateTestById($post_ct){
      $res = true;
      $qr = "";
      foreach($post_ct as $key => $value){
        $qr2 = "";
        if(!empty($value)){
          $keys = explode("-", $key);
          $qr2 = 'UPDATE test_qs SET '.$keys[0].' = "'.$value.'" WHERE test_qs_id = '.$keys[1];

            $up = mysqli_query($this->con, $qr2);
            if(!$up){
              $res = false;
            }
        }
      }
      return $res;
    }

    public function appendQuestionTest($post){
      if(!empty($post['choose_test']))
        $test_id = $post['choose_test'];
      else 
        return false;
      $test_level = $post['test_level_input'];
      $num_question = $post['number_question'];
      if($test_level > 0){

      }else{

        for($i = 1; $i <= $num_question; $i++){
          $name_ct    = '';
          $qs_ct   = '';
          $name_qs  = "name-".$i;
          $content_qs = "question-".$i;

          if(!empty($post[$name_qs]))
            $name_ct = $post[$name_qs];
          if(!empty($post[$content_qs]))
            $qs_ct = $post[$content_qs];

          $str = 'ans_';
          $str2 = 'isRight_';
          $ans = [];
          $isRight = [];
          for($j = 1; $j <= 4; $j++){
            $id = $str . $j . "-".$i; 
            $id2 = $str2 . $j . "-".$i; 
            if(isset($post[$id])){
              $ans[$j] = $post[$id];
              if(isset($post[$id2]))
                $isRight[$j] = $post[$id2];
              else
                $isRight[$j] = "false";
            }
            else{
              $ans[$j] = "";
              $isRight[$j] = "false";
            }
          }

          $qr = 'INSERT INTO test_qs VALUES(NULL, "' .$name_ct .'","' .$qs_ct. '","'.$ans[1].'","'.$ans[2].'","'.$ans[3].'","'.$ans[4].'","'.$test_id.'","'. $isRight[1].'","'.$isRight[2].'","'.$isRight[3].'","'.$isRight[4].'")';

          $rows = mysqli_query($this->con, $qr);

          if(!$rows) return false;
        }

      }
      return true;
    }

    public function loadNumberQuestionCurrent( $test_id){
      $qr   = "SELECT COUNT(test_qs_id) as 'curr_num_qs' FROM test_qs WHERE test_id = $test_id GROUP BY test_id";
      $res = $this->queryAllArray($qr);
      return $res;
    }

    public function loadTestById( $test_id){
      $qr   = "SELECT * FROM test WHERE test_id = $test_id";
      return $this->queryAllArray($qr);
    }

    public function getNameTestById( $test_id){
      $qr   = "SELECT test_name FROM test WHERE test_id = $test_id";
      return $this->queryAssoc($qr, "test_name");
    }

    public function loadAllQuestionForTest(){
      $qr   = "SELECT * FROM test_qs";
      return $this->queryAllArray($qr);
    }

    public function getNumberQuestionOfEachTest(){
      $qr   = "SELECT test_id, COUNT(test_qs_id) FROM test_qs GROUP BY test_id";
      return $this->queryAllArray($qr);
    }

    public function getRegisterTest($test_id, $cookie){
      $qr1 = "SELECT * FROM users WHERE name = '$cookie'";
      $res1 = $this->queryAssocAll($qr1);
      $feedback = [];
      $test_turn = 0;
      $user_id = "";

      $feedback[5] = $cookie;

      if($res1){
        $feedback[0] = "user_ok";
        $user_id = $res1['id'];
      $feedback[4] = $user_id;
      } 
      else $feedback[0] = "no_user";


      $qr2 = "SELECT * FROM user_tests WHERE test_id = $test_id AND user_id = $user_id";
      $num_row = $this->queryNumRow($qr2);
      $insert = true;
      if($num_row > 0){
        $insert = false;
        $res2 = $this->queryAssocAll($qr2);
        if($res2['num_turn']  > 0){
          $test_turn = $res2['num_turn'] - 1;
          $feedback[1] = "had_to_test";
          $feedback[5] = $test_turn;
        }
        else{
          $feedback[1] = "has_no_turn";
        }
      }else{
          $feedback[1] = "new_time_do";

          if($res1['user_type'] == 'admin'){
            $test_turn = 100;
          }else{
            $test_turn = 5;
          }
      }

      if($insert){
        $qr3 = "INSERT INTO `user_tests` (`user_id`, `test_id`, `total_score`, `num_turn`) VALUES ('$user_id', '$test_id', '0', '$test_turn')";
        $row3 = mysqli_query($this->con, $qr3);

        if($row3) $feedback[2] = "insert_ok";
        else $feedback[2] = "cant_insert";
      }else{
        $feedback[2] = "had_insert";
        $qr3 = "UPDATE `user_tests` SET `num_turn` = '$test_turn' WHERE `user_tests`.`user_id` = '$user_id' AND `user_tests`.`test_id` = '$test_id'";
        $row3 = mysqli_query($this->con, $qr3);
        if($row3) $feedback[6] = "update_ok";
        else $feedback[6] = "cant_update";
      }

      if($feedback[0] == 'user_ok' && ($feedback[2] == "had_insert" || $feedback[2] == "insert_ok") && $feedback[1] != 'has_no_turn') $feedback[3] = "ok";
      else
        $feedback[3] = "fail";
      return $feedback;
    }
    
    public  function createNewTest($post_test, $id_ad_create){
      
      $qr = "INSERT INTO `test` (`test_id`, `test_name`, `test_time`, `num_qs`, `description`, `ad_create_id`, `time_modify`, `test_level`) VALUES (NULL, '$post_test[new_test_name]', '$post_test[test_time]', '$post_test[number_qs]', '$post_test[test_description]', '$id_ad_create', current_timestamp(), '$post_test[choose_level]')";

      $res = mysqli_query($this->con, $qr);
      if($res)
        return true;
      else
        return false;
    }


    public function calculatePoint($post, $test_id){
        $qr = "SELECT * FROM test_qs WHERE test_id = $test_id";
        $res = $this->queryAllArray($qr);

        $count_num_qs = sizeof($res);
        $point = 0;
        $store = $result = [];
        $i = 0;
        $j = 1;


        foreach($post as $key => $value){
          $val[$i] = [];
          $keys = explode("-", $key);
          if($keys[0] !== "commit_test"){
            $isRights = explode("_", $keys[0]);
            if($isRights[1] == $j){
                $store[$i][0] = $keys[1]; //!id_test_qs
                $store[$i][$isRights[1]+7] = $value;
                $j++;
            }

            if($j == 5){
              // echo "i: ".$i."<br>";
              $i++;
              $store[$i] = [];
              $j = 1;
            }

          }
        }

        for($i = 0; $i < $count_num_qs; $i++){
          $count = 0;
            if($res[$i][0] == $store[$i][0]){
              for($j = 1; $j <= 4; $j++){
                if($store[$i][$j+7] == $res[$i][$j+7]){
                  $count++;
                }
              }
            }
          if($count == 4) $point++;
        }
        $name_us = $_COOKIE['member_login'];
        $qr1 = "SELECT id FROM users WHERE name = '$name_us'";
        $us_id = $this->queryAssoc($qr1, 'id');

        $qr2 = "SELECT * FROM user_tests WHERE user_id ='$us_id' AND test_id = '$test_id'";
        $num_row = $this->queryNumRow($qr2);
        $update = true;
        if($num_row > 0){
          $pointOld = $this->queryAssoc($qr2, 'total_score');
          if($point < $pointOld) $update = false;
        }

        if($update){
          $qr3 = "UPDATE `user_tests` SET `total_score` = '$point' WHERE `user_tests`.`user_id` = '$us_id' AND `user_tests`.`test_id` = '$test_id'";
          $row = mysqli_query($this->con, $qr3);
          
          $qr4 = "UPDATE user_tests SET last_date_test = now() WHERE user_id = '$us_id' AND test_id = '$test_id'";
          
          $real_point = 0;
          $real_point = ($point / $count_num_qs);
          
          $result[3] = $this->updateTutUserAccess($real_point);

        }
        else{
          $result[3] = 5;
        }

        $result[1] = $point ;
        $result[2] = $count_num_qs;

        // echo $result;
        return $result;
        
    }

    protected function updateTutUserAccess($real_point){
          if($real_point < 1 && $real_point > 0.7){
            $res =  $this->getTutorialByLevel(4);
            if($res) return 4;
          }
          else if($real_point <= 0.7 && $real_point > 0.5){
            $res = $this->getTutorialByLevel(3);
            if($res) return 3;
          }
          else if($real_point <= 0.5 && $real_point > 0.3){
            $res = $this->getTutorialByLevel(2);
            if($res) return 2;
          }
          else if($real_point <= 0.3 && $real_point > 0){
            $res = $this->getTutorialByLevel(1);
            if($res) return 1;
          }else{
            return 0; 
          }

    }

    private function getTutorialByLevel($tut_level){
      $qr1 = "SELECT id FROM tutorials WHERE tut_level <= '$tut_level'";
      $tut_id = $this->queryAllArray($qr1);
      $us_id = $_SESSION['member_id'];
      if($tut_id){
        for($i = 0; $i < sizeof($tut_id); $i++){
          $id = $tut_id[$i][0];
          $qr2 = "UPDATE user_tuts SET status = 'unlock' WHERE user_id = '$us_id' AND tut_id = '$id'";
          $res = mysqli_query($this->con, $qr2);
          if(!$res) return false;
        }
        return true;
      }
    }

      public function getTutIdByIdByLevel_2($qs_level){
        // $res = "";
        $page_next = $_POST['page_next']+1;
        // if($_SESSION['last_post'][$page_next-2]['page_next'] !== $page_next) //_don't push again
        // var_dump($_SESSION['last_post']);
        // var_dump($_POST);
        $isExist = false;
        $i = 0;
        $str = 'as_qs_';
        $count_filled = 0;
        $num_qs = 4;
        // $size = sizeof($_POST);
        while($num_qs--){
          foreach($_POST as $key => $value){
            $id = $str . $i;
            // echo "key:".$key . "  ";
            if($key == $id){
              $count_filled++;
              for($j = 0; $j < sizeof($_SESSION['last_post']); $j++){
                if(isset($_SESSION['last_post'][$j][$id]))
                  $_SESSION['last_post'][$j][$id] = $value; //_new value
              }
            }

          }
          $i++;
        }
        // echo "counted: ". $count_filled;

        for($j = 0; $j < sizeof($_SESSION['last_post']); $j++){
          if(isset($_SESSION['last_post'][$j]['page_next']))
            if($_SESSION['last_post'][$j]['page_next'] == $page_next-1)
              $isExist = true;
        }
        if($isExist == false && $count_filled > 0){
          array_push($_SESSION['last_post'], $_POST); //_push last one page
        }

        // return $$_SESSION['last_post'];

      }


}

?>