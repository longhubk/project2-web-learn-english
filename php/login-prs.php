<?php 
  $data_user = read_json("../../data/data_users/user_login.json");
  if(isset($_POST['submit'])){
    if(isset($_POST['username']) && isset($_POST['password'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      foreach($data_user as $user_num => $data){
        $check = 0;
        foreach($data as $key => $value){
          if($key == "username" && $value == $username){
            $check ++;
          }
          else if($key == "password" && $value == $password){
            $check ++;
          }
          if($check == 2){
            $_GET['logined'] = "ok";
          }else{
            $_GET['logined'] = "fail";
          }
        }
      }
    }
  }

?>