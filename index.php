<?php  include_once "models/config/init.php"; ?>
<?php session_start(); ?>
<?php
  $home = new Template("views/homepage.php");
  $tutorialpage = new Template("views/tutorialpage.php");
  $userpage = new Template("views/userpage.php");
  $testpage = new Template("views/testpage.php");
  $docpage = new Template("views/docpage.php");
  $user_db = new User();
  $tutorial_db = new Tutorial();
  $home_db = new Home();

  $user_db->checkUserSession();


  // if(isset($_GET["signuped"])){
  //   echo "co login";
  // }else{
  //   echo "ko login";
  // }

  
  // if(isset($_POST["save_avatar"])){
  //   $users->updateAvatar();
  // }
  // if(isset($GET['signuped']))
  //   $users->updateSignUp();

  // $template->title = "Speak More";
  if(isset($_GET["controller"])){
    $controller = $_GET["controller"];
  }else{
    $controller = "";
  }
  switch($controller){
    case "homepage":{
       require_once "controllers/home/index.php";
      break;
    }
    case "tutorialpage":{
       require_once "controllers/tut/index.php";
      break;
    }
    case "userpage":{
       require_once "controllers/user/index.php";
      break;
    }
    case "testpage":{
       require_once "controllers/test/index.php";
      break;
    }
    case "documentpage":{
       require_once "controllers/doc/index.php";
      break;
    }
    
  }
  
?>

