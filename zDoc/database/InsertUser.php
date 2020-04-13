<?php

  include "class_user.php";

  $user = new user();

  echo $_POST['UserName'];
  echo $_POST['UserPassword'];
  echo $_POST['UserMail'];
  if(isset($_POST['UserName']) && isset($_POST['UserPassword']) && isset($_POST['UserMail'])){
    echo "hello";
    $user->setUserName($_POST['UserName']);
    $user->setUserMail($_POST['UserMail']);
    $user->setUserPassword($_POST['UserPassword']);
    $user->InsertUser();
    header("Location:index.php?success=1");
  }

?>