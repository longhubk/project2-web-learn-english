<?php 
  class UserModel extends DB{

    private function InsertUser($username, $password, $email){
      $qr = "INSERT INTO users(name, password, email) VALUES('$username', '$password', '$email' )";
      $result = false;
      if(mysqli_query($this->con, $qr)){
        $result = true;
      }
      return $result;

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
    public function checkSignUp($un, $pas, $pas_ag, $email){
        $sign_err = [];
        if(!empty($un) && !empty($pas) && !empty($pas_ag) && !empty($email)){
         $username_new       = $un;
         $email_new          = $email;
         $password_new       = $pas;
         $password_again_new = $pas_ag;
    
         if(empty($username_new)){
           $sign_err[0] = "UserName is require";
         }
         if(empty($email_new)){
           $sign_err[1] = "Email is require";
         }
         if(empty($password_new)){
           $sign_err[2] = "Password is require";
         }
         if(empty($password_again_new)){
           $sign_err[3] = "Password again is require";
         }
    
         if(empty($sign_err[0]) &&
          empty($sign_err[1]) &&
          empty($sign_err[2]) &&
          empty($sign_err[3])
         ){
          $res = $this->InsertUser($un, $pas, $email);
          return $res;
         }
        else
         return $sign_err;
       }
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

        $f_Ext = explode('.', $f_name);
        // *convert all PNG JPG to png and jpg..
        $f_Actual_Ext = strtolower(end($f_Ext));
    
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
    }


    public function checkSession($un, $pas, $re){
        if(isset($_POST['login'])){
          $qr = "SELECT * FROM users WHERE name = '$un'";
          if(!isset($_COOKIE["member_login"])) 
            $qr .= " AND password = '$pas'";

          $res = mysqli_query($this->con, $qr);

          if($res){
            while($row = mysqli_fetch_array($res)){
              $_SESSION["member_id"] = $row['id'];
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
        $res = parent::readJsonData("./mvc/models/data/tutorials/menu_user.json");
        return $res;
    }



  }

  


?>