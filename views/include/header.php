<?php
$general_nav_bar = "";
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width= device-width, initial-scale: 1.0">
  <meta charset="UTF-8">
  <title>SPEAK MORE</title>
  <link href="views/css/navigation.css" rel="stylesheet" type="text/css">
  <link href="views/css/container.css" rel="stylesheet" type="text/css">
  <link href="views/css/login.css" type="text/css" rel="stylesheet">
  <link href="views/css/calendar.css" rel="stylesheet" type="text/css">
  <link href="views/css/header.css" rel="stylesheet" type="text/css">
  <link href="views/css/ver-nav.css" rel="stylesheet" type="text/css">
  <link href="views/css/question_right.css" rel="stylesheet" type="text/css">
  <link href="views/css/right_nav.css" rel="stylesheet" type="text/css">
  <link href="views/css/footer.css" rel="stylesheet" type="text/css">
  <link href="views/css/user_page.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/views/views/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://bootswatch.com/flatly/bootstrap.min.css" rel="stylesheet">

  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src='https://www.youtube.com/iframe_api'></script>
  <script src='views/js/JQuery/jquery-3.4.1.js' type="text/javascript"></script>
  <script type="text/javascript">
    window.onload = function() {
      generateDay();
      generateTime();
      hideBtnLogin();
    }
    window.onscroll = function() {
      scrollFunction();
    }
  </script>
</head>

<body>
  <div id="top_head" class="header">

    <div title="<?php echo SITE_TITLE;  ?>" class="logo-icon">
      <a href="index.php"><img id="img-icon" src='views/img/logo.PNG' height="30" width="160"></a>
    </div>
    <div id="head-intro">
      <p id='intro'>"Every courses are free for every one"</p>
      <i id='hide_intro' title="hide" class="fas fa-times"></i>
    </div>
    <div class="login-container">
      <?php
      $show_btn_login = true;
      if (!empty($_COOKIE['member_login'])) {
        $show_btn_login = false;
      } else {
        $show_btn_login = true;
      }

      $path_login = "index.php?get_login=login";
      $path_signup = "index.php?get_signup=signup";
      foreach ($_GET as $key => $value) {
        if (isset($_GET[$key]) && $key != "get_login" && $key != "get_signup" && $key != "logined")
          $path_login = $path_login . "&$key=$value";
        if (isset($_GET[$key]) && $key != "get_signup" && $key != "get_login" && $key != "logined")
          $path_signup = $path_signup . "&$key=$value";
      }

      if ($show_btn_login) {
        echo "<button id='btn_login' class='login'>";
        echo "<a href='$path_login'>Log In</a>";
        echo "</button>";
      } else {
        if(isset($avatar)){
          $name_avt = $avatar->avatar;
          $directory_avatar = "views/img/uploads/" . $name_avt;
          echo "<img title='". $_COOKIE["member_login"]."' class='small-avt' src='". $directory_avatar ."'>" ;
        }

        echo "<button id='btn_login' class='login'>";
        echo "<a href='index.php?controller=userpage&action=view&homepage=true'>Home Page</a>";
        echo "</button>";
      }


      if (!empty($_COOKIE['member_login'])) {
        echo "<button class='signup'>";
        echo "<a href='index.php?logout=true'>Log out</a>";
        echo "</button>";
      } else {
        echo "<button class='signup'>";
        echo "<a href='$path_signup'>Sign Up</a>";
        echo "</button>";
      }
      $_GET["hello"] = true;
      ?>
    </div>
    <div class="language">
      <i class="material-icons">language</i>
      <div class="lang-choose">
        languages:
        <select>
          <option value="en">English</option>
          <option value="vn">Vietnamese</option>
          <option value="ja">Japanese</option>
        </select>
      </div>
    </div>
  </div>

  <?php
  if (isset($_POST["signup"]))
    include "../controllers/signup_prs.php";

  if (isset($_POST["submit"]))
    include "../controllers/login-prs.php";

  if (isset($_GET['get_login']))
    include "log_in.php";
  if (isset($_GET['get_signup']))
    include "log_up.php";

  if (isset($_GET['logined'])) {
    if ($_GET['logined'] == "fail")
      include "log_in.php";
    else if($_GET["logined"] == "ok")
      header('Location: index.php?homepage');
  }
  if (isset($_GET['signuped'])) {
    if ($_GET['signuped'] == "fail")
      include "log_up.php";
    else if($_GET["signuped"] == "ok")
      $title_h1 = "You are Sign Up success";
  }
  ?>


  <div class="clear"></div>


  <ul id="hor-nav" class="hori-nav">
    <li id="menu-li" title="menu"><button onclick="toggleSideBar()"><i class="material-icons">menu</i></button></li>
    <li id="home-li"><a href="index.php?controller=homepage&action=home"><i class="fa fa-fw fa-home"></i>HOME</a></li>
    <li><a href="#">NOTIFICATIONS</a></li>
    <li class="tutorial">
      <a href="index.php?controller=tutorialpage&action=all&tutorial=all_tutorial" class="dropbtn">
        TUTORIALS
        <i class="fa fa-caret-down"></i>
      </a>
      <div class="inner-content">
        <?php
        foreach ($allTuts as $tutorial_item => $name) {
          $path_tut = $each_url . "&tutorial=$tutorial_item";
          echo "<a href=". $path_tut .">$name</a>";
        }
        ?>
      </div>
    </li>
    <li><a href="#">TESTS</a></li>
    <li><a href="#">DOCUMENTATIONS</a></li>
    <li><a href="#">RESOURCES</a></li>
    <li><a href="#">ABOUT US</a></li>
    <li id=search_area>
      <div class="search-box" style="margin-left: 10px;">
        <i class="fa fa-search" style="color: white;"></i>
        <input id="search" onkeyup="showSuggest(this.value)" type="text" placeholder="Search on page">
        <button class="btn-search">Search</button>
      </div>
    </li>
  </ul>