<?php 
  class UserModel extends Database{

    private function InsertUser($username, $password, $email){
      $qr = "INSERT INTO users(name, password, email) VALUES('$username', '$password', '$email')";
      $res = mysqli_query($this->con, $qr);
      if($res) return true;
      else return false;

    }
    public function getUserType($un){
      $qr   = "SELECT user_type FROM users WHERE name = '$un'";
      return $this->queryAssoc($qr, 'user_type');
    }
    public function checkLogin($un, $pas){
      $qr     = "SELECT name, password FROM users WHERE name = '$un'";
      $res   = $this->queryAssocAll($qr);
      $num_row   = $this->queryNumRow($qr);

      $kq     = false;
      $errors = [];

      if($res && $num_row == 1){
          if(password_verify( $pas, $res['password'])){
            $kq = true;
            return $kq;
          }
          else
            $errors[0] = "Password wrong";
          if($un !== $res['name'])
            $errors[1] = "Username wrong";
      }else{
        $errors[1] = "Username wrong";
      }
      return $errors;

    }
    

    public function loadAllUser(){
      $qr   = "SELECT id, name, is_block, user_type FROM users WHERE user_type != 'admin'";
      return $this->queryAllArray($qr);
    }

    public function loadAllStudent(){
      $qr   = "SELECT id, name, is_block FROM users WHERE user_type = 'user'";
      return $this->queryAllArray($qr);
    }

    public function getListUserNotMe($my_id){

      $qr   = "SELECT id FROM users WHERE id != '$my_id' AND id != 'admin' AND id != 'teacher'";
      if($_SESSION['user_type'] == 'admin'){
        $qr   = "SELECT id FROM users WHERE id != '$my_id' AND id !='admin' ";
      }
      return $this->queryAllArray($qr);
    }

    public function getAcceptRequest($my_id, $friend_id){
      $qr   = "UPDATE friends SET status = 'friend' WHERE (user_id = '$my_id' AND my_friend_id = '$friend_id') OR ( user_id = '$friend_id' AND my_friend_id = '$my_id')";
      $res = mysqli_query($this->con, $qr);
      if($res) return "ok";
      else return "fail";
    }

    public function getRemoveRequest($my_id, $friend_id){
      $qr   = "UPDATE friends SET status = 'unfriend' WHERE (user_id = '$my_id' AND my_friend_id = '$friend_id') OR ( user_id = '$friend_id' AND my_friend_id = '$my_id')";
      $res = mysqli_query($this->con, $qr);
      if($res) return "ok";
      else return "fail";
    }

    public function findFriendForUser($us_id){

      $friend_id = $this->getListFriendByUserId($us_id);
      $qr   = "SELECT id, name FROM users WHERE user_type != 'admin' AND id != '$us_id'";
      $res = $this->queryAllArray($qr);
      for($i = 0; $i <sizeof($res); $i++){
        $res[$i][2] = "un_friend";
        for($j = 0; $j < sizeof($friend_id); $j++){
          if($res[$i][0] == $friend_id[$j][0]){
            $res[$i][2] = "friend";
            break;
          }
        }
      }
      return $res;
    }


    public function getNameAdminModify(){
      $qr   = "SELECT id, name FROM users WHERE user_type = 'admin'";
      return $this->queryAllArray($qr);
    }

    public function getUserListFriendRequest($user_id){
      $qr   = "SELECT my_friend_id name FROM friends WHERE user_id = '$user_id' AND status = 'have_rq'";
      $res = $this->queryAllArray($qr);
      for($i = 0; $i < sizeof($res); $i++){
        $fr_id = $res[$i][0];
        $qr1 = "SELECT name FROM users WHERE id = '$fr_id' ";
        $res1 = $this->queryAssoc($qr1, 'name');
        if($res1) $res[$i][1] = $res1;
      }
      return $res;
    }

    public function getUserListMyRequest($user_id){
      $qr   = "SELECT my_friend_id name FROM friends WHERE user_id = '$user_id' AND status = 'send_rq'";
      $res = $this->queryAllArray($qr);
      for($i = 0; $i < sizeof($res); $i++){
        $fr_id = $res[$i][0];
        $qr1 = "SELECT name FROM users WHERE id = '$fr_id' ";
        $res1 = $this->queryAssoc($qr1, 'name');
        if($res1) $res[$i][1] = $res1;
      }
      return $res;
    }

    public function getSendFriendRequest($my_id, $us_want_id){

      $qr1   = "INSERT INTO friends VALUES('$my_id', $us_want_id, 'send_rq')";
      $qr2   = "INSERT INTO friends VALUES('$us_want_id', $my_id, 'have_rq')";
      $res1 = mysqli_query($this->con, $qr1);
      $res2 = mysqli_query($this->con, $qr2);

      if($res1 && $res2) return "ok";
      else return "fail";
    }


    public function getAcceptFriendRequest($my_id, $us_want_id){

      $qr   = "UPDATE friends SET status = 'friend' WHERE (user_id = '$my_id' AND my_friend_id = '$us_want_id') OR (user_id = '$us_want_id' AND my_friend_id = '$my_id')";
      $res = mysqli_query($this->con, $qr);
      if($res) return "ok";
      else return "fail";
    }

    public function blockUserById($user_id){
      $qr   = "UPDATE `users` SET `is_block` = 'true' WHERE `users`.`id` = $user_id";
      $row = mysqli_query($this->con, $qr);
      if($row) return "ok";
      else return "fail";
    }

    public function unBlockUserById($user_id){
      $qr   = "UPDATE `users` SET `is_block` = 'false' WHERE `users`.`id` = $user_id";
      $row = mysqli_query($this->con, $qr);
      if($row) return "ok";
      else return "fail";
    }


    public function downPermissionTeacher($user_id){
      $qr   = "UPDATE `users` SET `user_type` = 'user' WHERE `users`.`id` = $user_id";
      $row = mysqli_query($this->con, $qr);
      if($row) return "ok";
      else return "fail";
    }

    public function upPermissionUser($user_id){
      $qr   = "UPDATE `users` SET `user_type` = 'teacher' WHERE `users`.`id` = $user_id";
      $row = mysqli_query($this->con, $qr);
      if($row) return "ok";
      else return "fail";
    }

    public function deleteUserById($user_id){
      $qr   = "DELETE FROM `users` WHERE `users`.`id` = $user_id";
      $row = mysqli_query($this->con, $qr);
      if($row) return "ok";
      else return "fail";
    }

    public function checkIsAdmin($cookie){
      $qr   = "SELECT user_type FROM users WHERE name = '$cookie'";
      $res = $this->queryAssoc($qr, 'user_type');
      if($res == 'admin' || $res == 'teacher') return true;
      else return false;

    }
    public function getAdminId($cookie){
      if($this->checkIsAdmin($cookie)){
        $qr   = "SELECT id FROM users WHERE name = '$cookie'";
        return $this->queryAssoc($qr, 'id');
      }
      return false;
    }
    private function checkUserNameExist($un){
      $qr   = "SELECT * FROM users WHERE name = '$un'";
      $num_row = $this->queryNumRow($qr);
      if($num_row > 0) return true;
      else return false;
    }
    private function checkEmailExist($email){
      $qr   = "SELECT * FROM users WHERE email = '$email'";
      $num_row = $this->queryNumRow($qr);
      if($num_row > 0) return true;
      else return false;
    }

    private function checkPassword($pas){
        $res = "";
        if(empty($pas))
          $res = "password is require";
        else if(strlen($pas) < 8)
          $res = "password must have more than 8 characters";
        else if(!preg_match("/[a-z]/", $pas))
          $res = "password must contain at least 1 lowercase letter";
        else if(!preg_match("/[A-Z]/", $pas))
          $res = "password must contain at least 1 uppercase letter";
        else if(!preg_match("/[A-Z]/", $pas))
          $res = "password must contain at least 1 uppercase letter";
        else if(!preg_match("/[0-9]/", $pas))
          $res = "password must contain at least 1 number";
        else if(!preg_match("/[@_$&*#]/", $pas))
          $res = "password must contain at least 1 special letter";
      return $res;
    }
    public function checkSignUp($un, $pas, $pas_ag, $email, $agree){
        $sign_err = [];
        //if(!empty($un) && !empty($pas) && !empty($pas_ag) && !empty($email) && !empty($agree)){
          
 //_--------------------Username----------------------------       
        if(empty($un))
          $sign_err[0] = "username is require";
        else if($this->checkUserNameExist($un))
          $sign_err[0] = "username have existed";
        else if(!preg_match("/^[a-zA-Z0-9]*$/", $un))
          $sign_err[0] = "username just contain a-z and A-Z or number";

 //_--------------------Email-------------------------------       
        if(empty($email))
          $sign_err[1] = "email is require";
        else if($this->checkEmailExist($email))
          $sign_err[1] = "email is have existed";
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
          $sign_err[1] = "email is invalid format";

 //_--------------------Password----------------------------       
          $sign_err[2] = $this->checkPassword($pas);

 //_--------------------Password again---------------------       
        if(empty($pas_ag))
          $sign_err[3] = "password again is require";
        else if($pas_ag != $pas)
          $sign_err[3] = "password not match";

 //_--------------------Agree license---------------------       
        if(empty($agree))
          $sign_err[4] = "you have to agree the license and agreement";
        
    
        if(empty($sign_err[0]) &&
          empty($sign_err[1]) &&
          empty($sign_err[2]) &&
          empty($sign_err[3]) &&
          empty($sign_err[4])){
          $options = ['cost' => 11];
          $pas     = password_hash($pas, PASSWORD_BCRYPT, $options);
          $res     = $this->InsertUser($un, $pas, $email);
          return $res;
        }
        else
          return $sign_err;
       //}
    }

    public function updatePass($un, $old_pass, $new_pass, $new_pass_ag){

      $qr     = "SELECT password FROM users WHERE name = '$un'";
      $res   = $this->queryAssocAll($qr);
      $out = [];
      if($res){
        if(password_verify( $old_pass, $res['password'])){
          $options = ['cost' => 11];
          $out = $this->checkPassword($new_pass);
          if($old_pass == $new_pass) return "Your password not change!";
          if($new_pass !== $new_pass_ag) return "Your 2 passwords not match!";
          if(empty($out)){
            $new_pass     = password_hash($new_pass, PASSWORD_BCRYPT, $options);
            $qr2 = "UPDATE users SET password = '$new_pass' WHERE name = '$un'";
            $res2 = $this->queryOne($qr2);
            if($res2) $out = "Update password success !";
            else $out = 'Update fail !';
          } 
        }else
        $out = 'Old password is wrong !!!';

      }
      return $out;

    }

    public function getUserAvatar(){
      if(isset($_COOKIE['member_login'])){
        $qr  = "SELECT avatar FROM users WHERE name='". $_COOKIE['member_login'] ."'";
        return $this->queryAssoc($qr, 'avatar');
      }
      else return "";
    }
    private function getUserAvatarById($user_id){
        $qr  = "SELECT avatar FROM users WHERE id ='".$user_id."'";
        return $this->queryAssoc($qr, 'avatar');
    }
    public function updateAvatar($f_name){
        $qr  = "UPDATE users SET avatar='" .$f_name. "' WHERE name='". $_COOKIE['member_login'] . "'";
        $res = mysqli_query($this->con, $qr);
        return $res ? true : false;
        
    }
    
    public function uploadAvatar($f_name, $ft_name, $f_size, $f_type, $f_err){
      $res = "";
      if(isset($_POST['upload'])){

        $f_Ext         = explode('.', $f_name);
        $f_Actual_Ext  = strtolower(end($f_Ext));
        $f_Ext_Allowed = array('jpg', 'png', 'jpeg', 'gif');
        $f_new_name    = $_COOKIE['member_login'] . "." . $f_Actual_Ext;
        $f_des         = "./public/img/uploads/" . $f_new_name;
    
        if(in_array($f_Actual_Ext, $f_Ext_Allowed)){
          if($f_err == 0){
            if($f_size < 5000000){
              move_uploaded_file($ft_name, $f_des);
              $up_avt = $this->updateAvatar($f_new_name);
              $this->check_name_file_exist($_COOKIE['member_login'], $f_Ext_Allowed, $f_Actual_Ext);
              $res = $up_avt ? "ok" : "fail";
            }else
              $res = "file bigger than 5M";
          }else
            $res = "There are error";
        }else
          $res = "you can not upload file that is not image";
      }
      return $res;
    }

    private function check_name_file_exist($f_name, $f_Ext_Allowed, $f_Actual_Ext){
      foreach($f_Ext_Allowed as $ext){
        if($ext != $f_Actual_Ext){
          $f_name_check = "./public/img/uploads/".$f_name .".". $ext;
          if(file_exists($f_name_check)){
            unlink($f_name_check);
            echo "Deleted your old avatar <br>";
          }
        }
      }
    }
    public function userLogout($user_name) {

      $qr = "UPDATE users SET is_login = 'false' WHERE name = '$user_name'";
      $res = mysqli_query($this->con, $qr);

      setcookie('member_login', "", time() - (10 * 365 * 24 * 60 * 60), "/");
      $_SESSION['member_id'] = "";
      $_SESSION['user_type'] = "";
      if(empty($_SESSION['member_id']) && empty($_SESSION['user_type']))
        return "ok";
      else return "fail";
    }


    public function checkSession($un, $re){
    
          $qr = "SELECT * FROM users WHERE name = '$un'";
          $res = $this->queryAllArray($qr);

          $qr2 = "UPDATE users SET is_login = 'true' WHERE name = '$un'";
          $res2 = mysqli_query($this->con, $qr2);

          if($res){
              $_SESSION["member_id"] = $res[0][0];
              $_SESSION["user_type"] = $res[0][5];

            if(!empty($re)){
              setcookie("member_login",$un ,time() + (10 * 365 * 24 * 60 * 60), '/');
            }
            else if(isset($_COOKIE['member_login']))
              setcookie("member_login","");
          }
      
      } 

      public function getUserMenu(){
        return parent::readJsonData("./mvc/models/data/menu_user.json");
      }

      public function getListUserById($user_name, $us_find){

        $qr    = "SELECT name, id FROM users WHERE name != '$user_name' AND user_type != 'admin' AND name = '$us_find'";
        return $this->queryAllArray($qr);

      }
      public function countRequestFriend($user_id){
        $qr    = "SELECT * FROM friends WHERE user_id = '$user_id' AND status = 'have_rq'";
        return $this->queryNumRow($qr);
      }

      public function checkIsLogin($user_name){

        $qr    = "SELECT * FROM users WHERE name = '$user_name' AND is_login = 'true'" ;
        return $this->queryNumRow($qr);

      }

      public function getUserIdByName($cookie){
        $qr    = "SELECT id FROM users WHERE name = '$cookie' ";
        return $this->queryAssoc($qr, 'id');
      }


      public function getListFriendByUserId($user_id){ 
        $qr    = "SELECT my_friend_id FROM friends WHERE user_id = '$user_id' AND status = 'friend' GROUP BY my_friend_id "; 
        return $this->queryAllArray($qr);
      }

      public function getUserPointLesson($user_id){ 
        $qr    = "SELECT lesson_id, point, last_date_test FROM user_lesson WHERE user_id = '$user_id' "; 
        $res =  $this->queryAllArray($qr);
        for($i = 0; $i < sizeof($res); $i++){
          $les_id = $res[$i][0];
          $qr1    = "SELECT title_lesson FROM lesson_tut WHERE lesson_id = '$les_id'"; 
          $res1 = $this->queryAssoc($qr1, 'title_lesson');
          array_push($res[$i], $res1);
        }
        return $res;
      }


      public function getUserPointTest($user_id){ 
        $qr    = "SELECT test_id, total_score, last_date_test FROM user_tests WHERE user_id = '$user_id' "; 
        $res =  $this->queryAllArray($qr);
        for($i = 0; $i < sizeof($res); $i++){
          $test_id = $res[$i][0];
          $qr1    = "SELECT test_name FROM test WHERE test_id = '$test_id'"; 
          $res1 = $this->queryAssoc($qr1, 'test_name');
          array_push($res[$i], $res1);
        }
        return $res;
      }

      public function countMessageTwoPeople($user_id, $friend_id){ 
        $qr    = "SELECT COUNT(*) as 'num_mes' FROM chat_message WHERE (from_user_id = '$user_id' AND to_user_id = '$friend_id') OR (from_user_id = '$friend_id' AND to_user_id = '$user_id') "; 
        $res = $this->queryAssoc($qr, 'num_mes');
        return $res;
      }

      public function getLastActiveById($friend_id){
  
		$friend_last_active = [];
        for($i = 0; $i < sizeof($friend_id); $i++){
          //echo "friend $i:". $friend_id[$i][0] . "<br>";
          $friend_last_active[$i][0] = $friend_id[$i][0];
          $qr    = "SELECT last_active FROM users WHERE id = '".$friend_id[$i][0]."'";
          $friend_last_active[$i][1] = $this->queryAssoc($qr, 'last_active');
        }
        return $friend_last_active;
      }

      private function getNameUserSendById($user_send_id){
        $qr = "SELECT name FROM users WHERE id = '$user_send_id'";
        return $this->queryAssoc($qr,'name');
      }
      
      public function count_unseen_message($user_id, $friend_id){
        // echo "user id: ".$user_id. "<br>";
        // var_dump($friend_id);
        $outPut = [];
        for($i = 0; $i < sizeof($friend_id); $i++){
          $outPut[$i] = "";
          $qr = "SELECT * FROM chat_message WHERE to_user_id = '$user_id' AND from_user_id = '".$friend_id[$i][0]."' AND status = 'unseen'";

          $num_row = $this->queryNumRow($qr);
          if($num_row > 0){
            $outPut[$i] .= '<span class="label_unseen">'.$num_row.'</span>';
          }else{
            $outPut[$i] .= '<span></span>';
          }
        }
        return $outPut;
      }

      public function getUserChatHistory($user_id, $friend_id){

          $qr    = "SELECT * FROM chat_message WHERE (from_user_id ='$user_id' AND to_user_id = '$friend_id') OR ( from_user_id = '$friend_id' AND to_user_id = '$user_id') ORDER BY chat_time ASC ";

          $outPut = '<ul class="list_history">';
          $res = $this->queryAllArray($qr);

          $send = $this->getUserAvatarById($user_id);
          $recv = $this->getUserAvatarById($friend_id);
          // var_dump($recv);
          // echo "us1: ".$us_send_avt. "<br>";
          // echo "us2: ".$us_recv_avt. "<br>";
          for($i = 0; $i < sizeof($res); $i++){
            $user_name = '';
            $align = 'left';
            $mes_class_content = 'mes_content_sender';
            if($res[$i][1] == $user_id){

              $directory_avatar = "./public/img/uploads/" . $send;

              $user_name = '<div class="name_sender">
              <img title="'. $_COOKIE["member_login"].'" class="small-avt" src="'. $directory_avatar .'"></div>';

              $align = 'right';
            }
            else{

              $directory_avatar = "./public/img/uploads/" . $recv;
              $user_name = '<div class="name_receiver">
              <img title="'.$this->getNameUserSendById($res[$i][1]).'" class="small-avt" src="'. $directory_avatar .'"></div>
              </div>';
              $mes_class_content = 'mes_content_receiver';
            }
            $outPut .= '
              <li>
                <div align="'.$align.'">'.$user_name.'<span class="mes_content '.$mes_class_content.'">'.$res[$i][3].'</span></div>
                <div align="'.$align.'">
                  <small><em>'.$res[$i][5].'</em></small>
                </div>
              </li>
            
            ';


          }

          $outPut .= '</ul>';

          $qr2 = "UPDATE chat_message SET status = 'seen' WHERE from_user_id = '$friend_id' AND to_user_id = '$user_id' AND status = 'unseen'";
          $up = mysqli_query($this->con, $qr2);

          return $outPut;
          

      }

      public function getUpdateMyActive($user_id){
        $qr    = "UPDATE users SET last_active = now() WHERE id = '$user_id'";
        $row = mysqli_query($this->con, $qr);
      }

      public function getInsertChatMessage($user_id, $friend_id, $chat_mes){
        $qr    = "INSERT INTO `chat_message` (`message_id`, `from_user_id`, `to_user_id`, `chat_content`, `chat_time`) VALUES (NULL, '$user_id', '$friend_id', '$chat_mes', current_timestamp())
        ";
        $row = mysqli_query($this->con, $qr);
        if($row) return $this->getUserChatHistory($user_id, $friend_id);
        else return 'fail';
      }
      public function getNameFriendByFriendId($friend_id){
        // var_dump($friend_id);
        $friend_name = [];
        for($i = 0; $i < sizeof($friend_id); $i++){
          // echo "friend $i:". $friend_id[$i][0] . "<br>";
          $friend_name[$i][0] = $friend_id[$i][0];
          $qr    = "SELECT name FROM users WHERE id = '".$friend_id[$i][0]."'";
          $friend_name[$i][1] = $this->queryAssoc($qr, 'name');
        }
        return $friend_name;

      }
      public function getInfoUser($user_id){
        $qr    = "SELECT * FROM info_users WHERE user_id = '$user_id'";
        return $this->queryAssocAll($qr);
      }

      public function updateUserInfo($un, $f_name, $l_name, $birth, $gender, $school, $toeic){

      $id     = $this->getUserId($un);
      $qr1    = "SELECT * FROM info_users WHERE user_id = '$id'";
      $num_row = $this->queryNumRow($qr1);
      if($num_row == 0){
        $qr2 = "INSERT INTO info_users(user_id, fname, lname, birthday, gender, school, toeic) VALUE( '$id','$f_name', '$l_name', '$birth', '$gender', '$school', '$toeic')";
        $res = mysqli_query($this->con, $qr2);
        return $res ? true : false;
      }else{
        $qr3 = "UPDATE info_users 
        SET   fname    = '$f_name',
              lname    = '$l_name',
              birthday = '$birth',
              gender   = '$gender',
              school   = '$school',
              toeic    = '$toeic'
        WHERE user_id  = $id ";
        $res = mysqli_query($this->con,$qr3);
        return $res ? true : false;

      }

      }
      private function getUserId($username){
        $qr   = "SELECT id FROM users WHERE name = '$username'";
        return $this->queryAssoc($qr, 'id');
      }

      public function getUserInfo($username){
        $id      = $this->getUserId($username);
        $qr      = "SELECT * FROM info_users WHERE user_id = '$id'";
        $num_row = $this->queryNumRow($qr);
        if($num_row > 0)
          return $this->queryAssocAll($qr);
        else return [];

      }

  }
