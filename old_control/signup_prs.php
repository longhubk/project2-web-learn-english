<?php 
 
  $username_err = $password_err = $email_err = $password_again_err = "";
  if(isset($_POST["signup"])){
    if(!empty($_POST["username_sp"]) &&
    !empty($_POST["password_sp"]) &&
    !empty($_POST["email_sp"]) &&
    !empty($_POST["password_again_sp"]) 
   ){
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
     )
      $_GET['signuped'] = "ok";
    else
      $_GET['signuped'] = "fail";

      echo "signup = " . $_GET["signuped"];
   }
  }

?>