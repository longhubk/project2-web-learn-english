<?php  include_once "config/init.php"; ?>
<?php session_start(); ?>
<?php
  $template = new Template("templates/frontpage.php");
  $users = new User();
  $template->infors = $users->getInforLogin();
  $users->checkUserSession();
  $template->avatar = $users->getUserAvatar();

  if(isset($_GET["signuped"])){
    echo "co login";
  }else{
    echo "ko login";
  }
  
  if(isset($_POST["save_avatar"])){
    $users->updateAvatar();
  }
  if(isset($GET['signuped']))
    $users->updateSignUp();

  $template->title = "Speak More";

  echo $template;
?>

