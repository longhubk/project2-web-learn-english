
<!DOCTYPE html>
<html>

<head>
  <?php echo '<base href = "http://'.$_SERVER['SERVER_NAME'] .'/speakmore/" />'?>

  <meta name = "viewport" content = "width= device-width, initial-scale: 1.0">
  <meta charset = "UTF-8">
  <title>Speak More</title>

  <link rel="apple-touch-icon" sizes="57x57" href="./public/img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="./public/img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="./public/img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="./public/img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="./public/img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="./public/img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="./public/img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="./public/img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="./public/img/favicon/apple-icon-180x180.png">
  
  <link rel="icon" type="image/png" sizes="192x192"  href="./public/img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./public/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="./public/img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./public/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="./public/img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="./public/img/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

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
  <link href = "./public/css/test_index.css"     rel = "stylesheet" type = "text/css">

  <link href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/views/views/css/font-awesome.min.css" rel = "stylesheet">
  <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href = "https://bootswatch.com/flatly/bootstrap.min.css"         rel="stylesheet">
  
  <script src = "https://use.fontawesome.com/566df3ace8.js"></script>
  <script src = 'https://kit.fontawesome.com/a076d05399.js'></script>
  <script src = 'https://www.youtube.com/iframe_api'></script>
  <script src = './public/js/JQuery/jquery-3.4.1.js' type = "text/javascript"></script>

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
    function displayWindowSize(){
        // Get width and height of the window excluding scrollbars
        var w = document.documentElement.clientWidth;
        var h = document.documentElement.clientHeight;
        
        if(w > 1000){
          document.getElementById('ver_nav').style.width = "230px"
        }
        if(w < 500){
          document.getElementById('ver_nav').style.width = "0"
        }
        // Display result inside a div element
        console.log("Width: " + w + ", " + "Height: " + h);
    }
    window.addEventListener("resize", displayWindowSize);
    
    // Calling the function for the first time
    displayWindowSize();
  </script>
</head>

<body>
  <div id="top_head" class="header">

    <div title="SpeakMore Web Learn English" class="logo-icon">
      <a href="./Home"><img id="img-icon" src='./public/img/logo-2.png'></a>
    </div>
    <!-- <marquee id="run_text" behavior="scroll" direction="left">
    <div id="head-intro">
      <p id='intro'>"Every courses are free for every one"</p>
      <i id='hide_intro' title="hide" class="fas fa-times"></i>
    </div>
    </marquee> -->
  
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
        $show_user_btn = true;

        if(isset($data['isAdmin'])){
          if($data['isAdmin']){
            $show_user_btn = false;
          }
        }
        if($show_user_btn)
        {
          echo "<button id='btn_login' class='login'>";
            echo "<a href='./UserPage'>User Page</a>";
          echo "</button>";
        }
        else{
          echo "<button id='btn_login' class='login'>";
            echo "<a href='./HomeAdmin'>Admin Page</a>";
          echo "</button>";
        }
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
    <li id="menu-li" title="menu">
      <button onclick="toggleSideBar()">
        <i class="material-icons">menu</i>
      </button>
    </li>
    <li id="home-li">
      <a href="./Home">
        <i class="fa fa-fw fa-home hide"></i>
        <span class="text_to_hide">HOME</span>
      </a>
    </li>
    <li>
      <a href="./Notify">
        <i title="NOTIFICATIONS" class="fa fa-bell hide"></i>
        <span class="text_to_hide">NOTIFICATIONS</span>
      </a>

    </li>
    <li class="tutorial">
      <a href="./Tut/All" class="dropbtn">
        <i title="TUTORIALS" class="fa fa-book hide"></i>
        <span class="text_to_hide">TUTORIALS
          <i class="fa fa-caret-down"></i>
        </span>
      </a>
      <div class="inner-content">
        <?php
        foreach ($data['allTuts'] as $tutorial_item => $name) {
          echo "<a href='./Tut/One/". $tutorial_item ."'>$name</a>";
        }
        ?>
      </div>
    </li>
    <li>
      <a href="./TestPage">
        <i title="TESTS" class="fa fa-question hide"></i>
        <span class="text_to_hide">TESTS</span>
      </a>
    </li>
    <li>
      <a href="./Docs">
        <i title="DOCUMENTATIONS" class="fa fa-book-open hide"></i>
        <span class="text_to_hide">DOCUMENTATIONS</span>
      </a>
    </li>
    <!-- <li><a href="./Res">RESOURCES</a></li> -->
    <li>
      <a href="./Intro">
        <i title="ABOUT US" class="fa fa-exclamation-circle hide"></i>
        <span class="text_to_hide">ABOUT US</span>
      </a>
    </li>
    <li id=search_area>
      <div class="search-box" style="margin-left: 10px;">
        <i class="fa fa-search" style="color: white;"></i>
        <input id="search" onkeyup="showSuggest(this.value)" type="text" placeholder="Search on page">
        <button class="btn-search">Search</button>
      </div>
    </li>
  </ul>