<?php 
  class UserModel extends DB{

    private function InsertUser($username, $password, $email){
      $qr = "INSERT INTO users(name, password, email) VALUES('$username', '$password', '$email')";
      $result = false;
      if(mysqli_query($this->con, $qr)){
        $result = true;
      }
      return $result;

    }
    public function getUserType($un){
      $qr   = "SELECT user_type FROM users WHERE name = '$un'";
      $rows = mysqli_query($this->con, $qr);
      $res  = mysqli_fetch_array($rows);
      return $res['user_type'];
    }
    public function checkLogin($un, $pas){
      $qr     = "SELECT * FROM users WHERE name = '$un'";
      $rows   = mysqli_query($this->con, $qr);
      $kq     = false;
      $errors = [];

      if($rows){
        while($row = mysqli_fetch_array($rows)){
          if(password_verify( $pas, $row['password'])){
            $kq = true;
            return $kq;
          }
          else
            $errors[0] = "Password wrong";
          return $errors;
        }
      }
      $errors[0] = "Password wrong";
      $errors[1] = "Username wrong";
      return $errors;

    }
    
    public function loadAllTutorial(){
      $qr   = "SELECT * FROM tutorials";
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_array($rows);
      return $res;

    }

    public function loadAllUser(){
      $qr   = "SELECT id, name, is_block FROM users WHERE user_type = 'user'";
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_all($rows);
      return $res;

    }

    public function getNameAdminModify(){
      $qr   = "SELECT id, name FROM users WHERE user_type = 'admin'";
      return $this->queryAllArray($qr);
    }

    public function blockUserById($user_id){
      $qr   = "UPDATE `users` SET `is_block` = 'true' WHERE `users`.`id` = $user_id";
      $row = mysqli_query($this->con, $qr);
      if($row) return "ok";
      else return "fail";
    }


    public function checkIsAdmin($cookie){
      
      $qr   = "SELECT user_type FROM users WHERE name = '$cookie'";
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_assoc($rows);
      // var_dump( $res );
      if($res['user_type'] == 'admin')
        return true;
      else
        return false;

    }
    public function getAdminId($cookie){
      
      if($this->checkIsAdmin($cookie)){

        $qr   = "SELECT id FROM users WHERE name = '$cookie'";
        $rows = mysqli_query($this->con, $qr); 
        $res = mysqli_fetch_assoc($rows);
        if($res)
          return $res['id'];
      }
      return false;
    }
    public function checkUserNameExist($un){
      $qr   = "SELECT * FROM users WHERE name = '$un'";
      $rows = mysqli_query($this->con, $qr);
      $num_row = mysqli_num_rows($rows);
      if($num_row > 0)
        return true;
      else 
        return false;
    }
    public function checkEmailExist($email){
      $qr   = "SELECT * FROM users WHERE email = '$email'";
      $rows = mysqli_query($this->con, $qr);
      $num_row = mysqli_num_rows($rows);
      if($num_row > 0)
        return true;
      else 
        return false;
    }
    public function checkSignUp($un, $pas, $pas_ag, $email, $agree){
        $sign_err = [];
        //if(!empty($un) && !empty($pas) && !empty($pas_ag) && !empty($email) && !empty($agree)){
          
        if(empty($un)){
          $sign_err[0] = "username is require";
          
        }else
        if($this->checkUserNameExist($un)){
          $sign_err[0] = "username have existed";
        }
        else
        if(!preg_match("/^[a-zA-Z0-9]*$/", $un))
          $sign_err[0] = "username just contain a-z and A-Z or number";
        
        if(empty($email)){
          $sign_err[1] = "email is require";
        }else
        if($this->checkEmailExist($email))
          $sign_err[1] = "email is have existed";
        else
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
          $sign_err[1] = "email is invalid format";

        if(empty($pas))
          $sign_err[2] = "password is require";
        else
        if(strlen($pas) < 8)
          $sign_err[2] = "password must have more than 8 characters";
        else 
        if(!preg_match("/[a-z]/", $pas))
          $sign_err[2] = "password must contain at least 1 lowercase letter";
        else 
        if(!preg_match("/[A-Z]/", $pas))
          $sign_err[2] = "password must contain at least 1 uppercase letter";
        else 
        if(!preg_match("/[A-Z]/", $pas))
          $sign_err[2] = "password must contain at least 1 uppercase letter";
        else 
        if(!preg_match("/[0-9]/", $pas))
          $sign_err[2] = "password must contain at least 1 number";
        else 
        if(!preg_match("/[@_$&*#]/", $pas))
          $sign_err[2] = "password must contain at least 1 special letter";


        if(empty($pas_ag)){
          $sign_err[3] = "password again is require";
        }else
        if($pas_ag != $pas)
          $sign_err[3] = "password not match";

        if(empty($agree)){
          $sign_err[4] = "you have to agree the license and agreement";
        }
    
        if(empty($sign_err[0]) &&
          empty($sign_err[1]) &&
          empty($sign_err[2]) &&
          empty($sign_err[3]) &&
          empty($sign_err[4])
        ){
          $options = ['cost' => 11];
          $pas     = password_hash($pas, PASSWORD_BCRYPT, $options);
          $res     = $this->InsertUser($un, $pas, $email);
          return $res;
        }
        else
          return $sign_err;
       //}
    }
    public function getUserAvatar(){
      if(isset($_COOKIE['member_login'])){
        $qr  = "SELECT avatar FROM users WHERE name='". $_COOKIE['member_login'] ."'";
        $res = mysqli_query($this->con, $qr);
        $ret = "";
        while($avt = mysqli_fetch_array($res)){
          $ret = $avt['avatar'];
        }
        return $ret;
      }
      else return "";
    }
    public function updateAvatar($f_name){
        $qr  = "UPDATE users SET avatar='" .$f_name. "' WHERE name='". $_COOKIE['member_login'] . "'";
        $res = mysqli_query($this->con, $qr);
        return $res ? true : false;
        

    }
    public function uploadAvatar($f_name, $ft_name, $f_size, $f_err, $f_type){
      $res = false;
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
              $res = $up_avt ? true : false;
            }else
              echo "file bigger than 5M";
          }else
            echo "There are error";
        }else
          echo "you can not upload file that is not image";
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
    public function userLogout() {
      setcookie('member_login', "", time() - (10 * 365 * 24 * 60 * 60), "/");
      $_SESSION['member_id'] = "";
      $_SESSION['user_type'] = "";
    }


    public function checkSession($un, $pas, $re){
        if(isset($_POST['login'])){
          $qr = "SELECT * FROM users WHERE name = '$un'";
          if(!empty($_COOKIE["member_login"])) 
            $qr .= " AND password = '$pas'";

          $res = mysqli_query($this->con, $qr);

          if($res){
            while($row = mysqli_fetch_array($res)){
              $_SESSION["member_id"] = $row['id'];
              $_SESSION["user_type"] = $row['user_type'];
              
            }
            if(!empty($re)){
              setcookie("member_login",$un ,time() + (10 * 365 * 24 * 60 * 60), '/');
            }
            else if(isset($_COOKIE["member_login"]))
              setcookie("member_login","");
          }
        }
      } 

      public function getUserMenu(){
        return parent::readJsonData("./mvc/models/data/tutorials/menu_user.json");
      }

      public function updateUserInfo($un, $f_name, $l_name, $birth, $gender, $school, $toeic){

      $id     = $this->getUserId($un);
      $qr1    = "SELECT * FROM info_users WHERE user_id = '$id'";
      $check  = mysqli_query($this->con, $qr1);
      $numrow = mysqli_num_rows($check);
      if($numrow == 0){
        $qr2 = "INSERT INTO info_users(user_id, fname, lname, birthday, gender, school, toeic) 
        VALUE( '$id','$f_name', '$l_name', '$birth', '$gender', '$school', '$toeic')";
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
        $qr1   = "SELECT id FROM users WHERE name = '$username'";
        $resid = mysqli_query($this->con, $qr1);
        $id    = mysqli_fetch_assoc($resid)['id'];
        return $id;
      }

      public function getUserInfo($username){
        $id      = $this->getUserId($username);
        $qr2     = "SELECT * FROM info_users WHERE user_id = '$id'";
        $resinfo = mysqli_query($this->con, $qr2);
        $numrow  = mysqli_num_rows($resinfo);
        $resArr  = [];
        if($numrow > 0){
          $row = mysqli_fetch_assoc($resinfo);

          $resArr['f_name']   = $row['fname'];
          $resArr['l_name']   = $row['lname'];
          $resArr['birthday'] = $row['birthday'];
          $resArr['gender']   = $row['gender'];
          $resArr['school']   = $row['school'];
          $resArr['toeic']    = $row['toeic'];
  
        }
        return $resArr;

      }

  }
