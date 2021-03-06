
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
  <link href = "./public/css/chat.css"           rel = "stylesheet" type = "text/css">
  <link href = "./public/css/friend_list.css"    rel = "stylesheet" type = "text/css">
  <link href = "./public/css/admin_lesson.css"   rel = "stylesheet" type = "text/css">
  <link href = "./public/css/loading.css"        rel = "stylesheet" type = "text/css">
  <link href = "./public/css/doc.css"            rel = "stylesheet" type = "text/css">

  <!-- <link href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/views/views/css/font-awesome.min.css" rel = "stylesheet"> -->
  <!-- <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
  <!-- <link href = "https://bootswatch.com/flatly/bootstrap.min.css"         rel="stylesheet"> -->
  
  <!-- <script src = "https://use.fontawesome.com/566df3ace8.js"></script> -->
  <!-- <script src = 'https://kit.fontawesome.com/a076d05399.js'></script> -->
  <!-- <script src = 'https://www.youtube.com/iframe_api'></script> -->
  <script src = './public/js/JQuery/jquery-3.4.1.js' type = "text/javascript"></script>

  <script type = "text/javascript">

    window.onload = function() {
      generateDay();
      generateTime();
      // hideBtnLogin();
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
          let ver_nav = document.getElementById('ver_nav')
          if(ver_nav != null)
            ver_nav.style.width = "230px"
        }
        if(w < 500){
          let ver_nav = document.getElementById('ver_nav')
          if(ver_nav != null)
            ver_nav.style.width = "0"
        }
        // Display result inside a div element
        // console.log("Width: " + w + ", " + "Height: " + h);
    }
    window.addEventListener("resize", displayWindowSize);
    
    // Calling the function for the first time
    displayWindowSize();
  </script>
</head>

<body>
  <div id="top_head" class="header">

    <div title="SpeakMore Web Learn English" class="logo-icon">
      <a href="./HomePage"><img id="img-icon" src='./public/img/triceratop.png'><span id='logo_tx'>SPEAK <span id='logo_bg'>MORE</span></span></a>
    </div>

    <marquee id="run_text" behavior="scroll" direction="left" scrolldelay='130'>
      <div id="head-intro">
        <p id='intro'>"Every courses are free for every one"</p>
        <!-- <i id='hide_intro' title="hide" class="fas fa-times"></i> -->
      </div>
    </marquee>
  
    <div class="login-container">
      <?php
      // $show_btn_login = true;
      // if (!empty($_COOKIE['member_login'])) {
      //   $show_btn_login = false;
      // } else {
      //   $show_btn_login = true;
      // }

      if(empty($_SESSION['member_id'])) {
        echo "<button id='btn_login' class='login'>
                <a href='./RegisterPage/Login'>Log In</a>
              </button>";
      } 
      else{

        if(!empty($data['avatar'])){
          $name_avt = $data['avatar'];
          $directory_avatar = "./public/img/uploads/" . $name_avt;
          echo "<img id='sm_avt' title='". $_COOKIE["member_login"]."' class='small-avt' src='". $directory_avatar ."'>" ;
        }


        if($_SESSION['user_type'] == 'admin' && !isset($data['home_btn'])){
          echo "<button id='btn_login' class='login'>
                  <a href='./AdminPage'>Admin Page</a>
              </button>";
        }
        else if($_SESSION['user_type'] == 'teacher' && !isset($data['home_btn'])){
          echo "<button id='btn_login' class='login'>
                  <a href='./AdminPage'>Teacher Page</a>
              </button>";
        }
        else
        {
          echo "<button id='btn_login' class='login'>
                  <a href='./UserPage'>User Page</a>
              </button>";
        }
      }


      if(!empty($_SESSION['member_id'])) {
        echo "<button class='signup'>
                <a href='./RegisterPage/LogOut'>Log out</a>
              </button>";
      }else{
        echo "<button class='signup'>
                <a href='./RegisterPage/SignUp'>Sign Up</a>
              </button>";
      }

      // $_GET["hello"] = true;

      ?>
    </div>

    <div class="language">
      <!-- <i class="material-icons">language</i> -->
      <img class="icon-20" src='public/icon/global_icon.png'>
      <div class="lang-choose">
      <span>languages</span>
        <select>
          <option value="en">English</option>
          <option value="vn">Vietnamese</option>
          <option value="jp">Japanese</option>
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
        <!-- <i class="material-icons">menu</i> -->
        <img alt='Menu' class="icon-20" src='public/icon/menu_icon.png'>
      </button>
    </li>
    <li id="HomePage-li">
      <a href="./HomePage">
        <img title="HomePage" class="icon-20" src='public/icon/home_color_icon.png'>
        <span class="text_nav text_to_hide home_hide">Home</span>
      </a>
    </li>
    <li id='notify-li'>
      <a href="./Notify">
        <img title="NOTIFICATIONS" class="icon-23" src='public/icon/bell_icon_2.png'>
        <span class="text_nav text_to_hide notify_hide">NOTIFICATIONS</span>
      </a>

    </li>
    <li class="tutorial">
      <a href="./TutorialPage/all_tutorials" class="dropbtn">
        <img title="TEST" class="icon-25" src='public/icon/lesson_icon.png'>
        <span class="text_nav text_to_hide tut_hide">TUTORIALS
          <!-- <i class="fa fa-caret-down"></i> -->
        </span>
      </a>
      <div class="inner-content">
        <?php


      if(isset($data['all_tuts'])){
        $all_tuts = $data['all_tuts'];
        for($i = 0; $i < sizeof($all_tuts); $i++){

          echo "<a href='./TutorialPage/Lesson/".$all_tuts[$i][5]."'>".$all_tuts[$i][1];

          if(!empty($data['is_lock'])){
            $is_lock = $data['is_lock'];
            if($is_lock[$i][1] == $all_tuts[$i][0] && $is_lock[$i][0] == 'lock')   
              echo "<img class='icon-20' src='public/icon/lock_icon.png'>";
          }
          
          echo "</a>";
        }

      }


        ?>
      </div>
    </li>
    <li>
      <a href="./TestPage">
        <img title="TEST" class="icon-25" src='public/icon/test_color_2.png'>
        <span class="text_nav text_to_hide test_hide">TESTS</span>
      </a>
    </li>
    <li>
      <a href="./DocsPage">
        <!-- <i title="DOCUMENTATIONS" class="fa fa-book-open hide"></i> -->
        <img title="TEST" class="icon-20" src='public/icon/document_color_2.png'>
        <span class="text_nav text_to_hide doc_hide">DOCUMENTATIONS</span>
      </a>
    </li>
    <!-- <li><a href="./Res">RESOURCES</a></li> -->
    <li>
      <a href="./Intro">
        <!-- <i title="ABOUT US" class="fa fa-exclamation-circle hide"></i> -->
        <img title="TEST" class="icon-23" src='public/icon/info_icon.png'>
        <span class="text_nav text_to_hide about_us" >ABOUT US</span>
      </a>
    </li>
    <li id=search_area>
      <div class="search-box" style="margin-left: 10px;">
        <i class="fa fa-search" style="color: white;"></i>
        <!-- <input id="search" onkeyup="showSuggest(this.value)" type="text" placeholder="Search on page"> -->
        <input id="search" type="text" placeholder="Search on page">
        <button id="btn-search">Search</button>
      </div>
    </li>
  </ul>