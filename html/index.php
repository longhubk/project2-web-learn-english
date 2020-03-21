<?php
  include "../php/read_json.php";
  $general_nav_bar = "";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width= device-width, initial-scale: 1.0">
    <meta charset="UTF-8">
    <link href="../css/container.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/navigation.css" type="text/css">
    <link href="../css/login.css" type="text/css" rel="stylesheet">
    <link href="../css/calendar.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/ver-nav.css" rel="stylesheet" type="text/css">
    <link href="../css/question_right.css" rel="stylesheet" type="text/css">
    <link href="../css/right_nav.css" rel="stylesheet" type="text/css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="../js/calendar.js" type="text/javascript"></script>
    <script src="../js/scroll_nav.js" type="text/javascript"></script>
    <script src="../js/login.js" type="text/javascript"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  
    <script type="text/javascript">
      window.onload = function(){
        generateDay();
        generateTime();
      }
      window.onscroll = function(){
        scrollFunction();
      }
    </script>
  </head>
  <body>

    <div id="log-1" class="login-container-2">

      <form class="login-form animate animate2" method="POST" action="../php/login-success.php">
        <div class="login-img">
          <i class="fas fa-user"></i>
        </div>
        <div class="login-main">
          <label class="login-label">Username:</label>
          <input type="text" name="username" placeholder="Enter Username">
          <label class="login-label">Password:</label>
          <input type="password" name="password" placeholder="Enter Password">
          <input type="checkbox" name="remember"> Remember me!
          <input type="submit" name="submit">
        </div>
        <div class="login-btn-2">
          <span class="login-forget">
            <a href="#">Forget password</a>
          </span>
          <span class="login-sign-up">
            <a href="#">Sign up new account</a>
          </span>
        </div>
      </form>
    </div>

    <div id="top_head" class = "header">

      <div title="English free for every one" class="logo-icon">
        <a href="index.php"><img id="img-icon" src='../img/logo.PNG' height="50" width="200"></a>
      </div>
      <div class="login-container">
        <button onclick="openLogin()" class="login">
          <a href="#">Log In</a>
        </button>
       <button class="signup">
         <a href="#">Sign Up</a>
       </button>
      </div>
      <div class="language">
        <i class="material-icons">language</i>
          <div class="lang-choose"> 
            languages:
            <select>
              <option value="en">English</option>
              <option value="vn">Vietnamese</option>
              <option value="ja"></i>Japanese</option>
            </select>
          </div>
      </div>
    </div>

      <div class="clear"></div>

        <ul id="hor-nav" class="hori-nav">
          <li><a href="#">NEWS</a></li>
          <li><a href="#">NOTIFICATIONS</a></li> <li class="tutorial">
            <a href="#" class="dropbtn">TUTORIALS</a>
            <div class="inner-content">
              <a href="../php/tutorials/speaking_prs.php">Speaking</a>
              <a href="#">Reading</a>
              <a href="#">Grammars</a>
              <a href="#">Listening</a>
            </div>
          </li>
          <li><a href="#">TESTS</a></li>
          <li><a href="#">DOCUMENTATIONS</a></li>
          <li><a href="#">RESOURCE</a></li>
          <li><a href="#">ABOUT US</a></li>
          <li>
            <div class="search-box" style="margin-left: 10px;">
              <i class="fa fa-search" style="color: white;"></i>
              <input id="search" type="text" placeholder="Search on page">
              <button class="btn-search">Search</button>
            </div>
          </li>
        </ul>
       

    <div id="ver_nav" class="ver-bar">
      <ul><?php include "../php/tutorials/all_tutorial_prs.php"; ?> </ul>
    </div>


    <div class="main-container">
  
      <div class="video-card">
        <h1>Verb - Video</h1>
        <p>You can following to some step below to learn english! </p>
        <img src="../img/verb_gramar.png">
        <div class="tips">
          <h3>Guide to listen</h3>
          <?php include "../php/guide_prs.php";?>
        </div>
        <video class="vid1" width="600" controls>
          <source src="../video/englishVideo.mp4" type="video/mp4">
        </video>
        <div class="verb-video" >
          <h3>Translated Video:</h3>
          <iframe  width="560" height="315" src="https://www.youtube.com/embed/LfJPA8GwTdk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          
          <div class="subtitle">
            <ul><?php include "../php/subtitles/video1_sub.php" ?> </ul>
          </div>
        </div>
        

      </div>
    </div>

    <div class="clear"></div>

    <div id="ver_nav_2" class="right-nav">
        <div id="qs_right" class="question">
          <p class="qs-title">Top Question</p>
          <ol class="qs-list">
            <?php 
              include "../php/question_prs.php";
            ?>
          </ol>
        </div>
        <div id="cal" class="calendar">
          <div class="title">
            <i class="fa fa-calendar" style="color: browser;"></i>
            Calendar
            <div id="time"></div>
          </div>
          <div class="month">
            <button id="mon-prev">prev</button>
            <div id="month">March</div>
            <button id="mon-next">next</button>
          </div>
          <div id="day">
          </div>
        </div>
    </div>
    <div class="clear"></div>

    <div class = "footer">
      <p>@Copyright: Nguyen Thanh Long</p>
    </div>
  </body>
</html>