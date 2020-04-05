<?php

  class User{
    private $db;
    
    public function __construct(){
      $this->db = new Database();
    }

    //Get users login information
    public function getInforLogin(){
      $this->db->query("SELECT name, password FROM users");
      $results = $this->db->resultSet();
      return $results;
    }
    
    public function upLoadAvatar(){
      $this->db->query("SELECT name, password FROM users");
      $results = $this->db->resultSet();
      return $results;
    }

    public function getUserAvatar(){
      if(isset($_COOKIE['member_login'])){
        $this->db->query("SELECT avatar FROM users WHERE name='". $_COOKIE['member_login'] ."'");
        $results = $this->db->single();
        return $results;
      }
    }
    public function checkUserSession(){
      if(isset($_GET['logout'])){
        if($_GET['logout'] == "true")
          setcookie('member_login', "", time() - (10 * 365 * 24 * 60 * 60));
      }
      if(!empty($_POST["submit"])) {
          $sql = "SELECT * FROM users WHERE name = '" . $_POST["username"] . "'";
        if(!isset($_COOKIE["member_login"])) 
          $sql .= " AND password = '" . $_POST["password"] . "'";

        $this->db->query($sql);
        $result = $this->db->single();

        if($result){
          $_SESSION["member_id"] = $result->id;
          if(!empty($_POST["remember"]))
            setcookie ("member_login",$_POST["username"],time() + (10 * 365 * 24 * 60 * 60));
          else if(isset($_COOKIE["member_login"]))
            setcookie("member_login","");
        }else
          $message = "Invalid Login";
      }
    }

    public function updateAvatar(){
      if($_POST['save_avatar']){
        $write_img_to_database = "UPDATE users SET avatar='" . $file_new_name. "' WHERE name='". $_COOKIE['member_login'] . "'";
        $this->db->query($write_img_to_database);
        $this->db->execute();
      }

    }

    public function updateSignUp(){
      if($_GET['signuped'] == "ok"){
        $sql = "INSERT INTO users(name, password, email) 
        VALUES('". $_POST["username_sp"]. "','". $_POST["password_sp"]. "','". $_POST["email_sp"]. "')";

        $this->db->query($sql);
        $this->db->execute();

      }
    }

  }


?>