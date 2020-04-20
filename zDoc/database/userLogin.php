<?php
  session_start();
  include "class_user.php";

  if(isset($_POST['UserMailLogin']) &&isset($_POST['UserPasswordLogin'])){
    $user = new user();
    $user->setUserMail($_POST['UserMailLogin']);
    $user->setUserPassword($_POST['UserPasswordLogin']);
    if($user->UserLogin() == true){
      $_SESSION['UserId'] = $user->getUserId();
      $_SESSION['UserName'] = $user->getUserName();
      echo $_SESSION['UserName'];
      $_SESSION['UserMail'] = $user->getUserMail();
    }
  }


?>