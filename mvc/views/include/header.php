
<!DOCTYPE html>
<html>

<head>
  <base href = "http://localhost/speakmore/" />

  <meta name = "viewport" content = "width= device-width, initial-scale: 1.0">
  <meta charset = "UTF-8">
  <title>SPEAK MORE</title>

  <link href = "./public/css/navigation.css"     rel = "stylesheet" type = "text/css">
  <link href = "./public/css/container.css"      rel = "stylesheet" type = "text/css">
  <link href = "./public/css/login.css"          rel = "stylesheet" type = "text/css">
  <link href = "./public/css/calendar.css"       rel = "stylesheet" type = "text/css">
  <link href = "./public/css/header.css"         rel = "stylesheet" type = "text/css">
  <link href = "./public/css/ver-nav.css"        rel = "stylesheet" type = "text/css">
  <link href = "./public/css/question_right.css" rel = "stylesheet" type = "text/css">
  <link href = "./public/css/right_nav.css"      rel = "stylesheet" type = "text/css">
  <link href = "./public/css/footer.css"         rel = "stylesheet" type = "text/css">
  <link href = "./public/css/user_page.css"      rel = "stylesheet" type = "text/css">
  <link href = "./public/css/test_page.css"      rel = "stylesheet" type = "text/css">
  <link href = "./public/css/test_index.css"      rel = "stylesheet" type = "text/css">

  <link href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/views/views/css/font-awesome.min.css" rel = "stylesheet">
  <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href = "https://bootswatch.com/flatly/bootstrap.min.css"         rel="stylesheet">
  <script src="https://use.fontawesome.com/566df3ace8.js"></script>

  <script src = 'https://kit.fontawesome.com/a076d05399.js'></script>
  <script src = 'https://www.youtube.com/iframe_api'></script>
  <script src = './public/js/JQuery/jquery-3.4.1.js' type="text/javascript"></script>
  <script type = "text/javascript">
    window.onload = function() {
      generateDay();
      generateTime();
      hideBtnLogin();
    }
    window.onscroll = function() {
      // alert("onscroll")
      scrollFunction();
    }
  </script>
</head>

<body>
  <div id="top_head" class="header">

    <div title="<?php echo SITE_TITLE;  ?>" class="logo-icon">
      <a href="./Home"><img id="img-icon" src='./public/img/logo.PNG' height="30" width="160"></a>
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

      if ($show_btn_login) {
        echo "<button id='btn_login' class='login'>";
        echo "<a href='./Register/Login'>Log In</a>";
        echo "</button>";
      } else {
        if(!empty($data['avatar'])){
          $name_avt = $data['avatar'];
          $directory_avatar = "./public/img/uploads/" . $name_avt;
          echo "<img title='". $_COOKIE["member_login"]."' class='small-avt' src='". $directory_avatar ."'>" ;
        }
        echo "<button id='btn_login' class='login'>";
        echo "<a href='./UserPage'>User Page</a>";
        echo "</button>";
      }


      if (!empty($_COOKIE['member_login'])) {
        echo "<button class='signup'>";
        echo "<a href='./Register/LogOut'>Log out</a>";
        echo "</button>";
      } else {
        echo "<button class='signup'>";
        echo "<a href='./Register/SignUp'>Sign Up</a>";
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

    if(isset($data['login_part'])){
      $login_part = $data['login_part'];
      require_once "./mvc/views/include/" . $login_part . ".php";
    }
    if(isset($data['signup_part'])){
      $signup_part = $data['signup_part'];
      require_once "./mvc/views/include/" . $signup_part . ".php";
    }

  ?>


  <div class="clear"></div>


  <ul id="hor-nav" class="hori-nav">
    <li id="menu-li" title="menu"><button onclick="toggleSideBar()"><i class="material-icons">menu</i></button></li>
    <li id="home-li"><a href="./Home"><i class="fa fa-fw fa-home"></i>HOME</a></li>
    <li><a href="./Notify">NOTIFICATIONS</a></li>
    <li class="tutorial">
      <a href="./Tut/All" class="dropbtn">
        TUTORIALS
        <i class="fa fa-caret-down"></i>
      </a>
      <div class="inner-content">
        <?php
        foreach ($data['allTuts'] as $tutorial_item => $name) {
          echo "<a href='./Tut/One/". $tutorial_item ."'>$name</a>";
        }
        ?>
      </div>
    </li>
    <li><a href="./TestPage">TESTS</a></li>
    <li><a href="./Doc">DOCUMENTATIONS</a></li>
    <li><a href="./Res">RESOURCES</a></li>
    <li><a href="./Intro">ABOUT US</a></li>
    <li id=search_area>
      <div class="search-box" style="margin-left: 10px;">
        <i class="fa fa-search" style="color: white;"></i>
        <input id="search" onkeyup="showSuggest(this.value)" type="text" placeholder="Search on page">
        <button class="btn-search">Search</button>
      </div>
    </li>
  </ul>