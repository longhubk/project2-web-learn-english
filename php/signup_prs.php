<?php 
 
  $username_err = $password_err = $email_err = $password_again_err = "";
  if(isset($_POST["signup"])){
    if(!isset($_POST["username_sp"]) ||
    !isset($_POST["password_sp"]) ||
    !isset($_POST["email_sp"]) ||
    !isset($_POST["password_again_sp"]) 
   ){

   }else{
     $username_new = $_POST['username_sp'];
     $email_new = $_POST['email_sp'];
     $password_new = $_POST['password_sp'];
     $password_again_new = $_POST['password_again_sp'];

     if(empty($username_new)){
       $username_err = "User is require";
     }
     if(empty($email_new)){
       $email_err = "User is require";
     }
     if(empty($password_new)){
       $password_err = "User is require";
     }
     if(empty($password_again_new)){
       $password_again_err = "User is require";
     }


     if(empty($email_err) &&
      empty($username_err) &&
      empty($password_err) &&
      empty($password_again_err)
     ){
      $_GET['signuped'] = "ok";

      $user_infor = array("username" => $username_new ,
      "email" => $email_new,
      "password" => $password_new,
     "password_again" => $password_again_new);

     $iput = file_get_contents("../../data/data_users/user_login.json");
     $tempArr = json_decode($iput, true);
     $tempArr[] = $user_infor;

     $final_data = json_encode($tempArr);
     file_put_contents("../../data/data_users/user_login.json", $final_data);

     }else{
      $_GET['signuped'] = "fail";
     }


   }
  }

?>