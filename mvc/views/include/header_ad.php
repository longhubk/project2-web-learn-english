<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>

  <base href = "http://localhost/speakmore/" />
  <link rel="apple-touch-icon" sizes="57x57" href="./public/img/favicon_ad/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="./public/img/favicon_ad/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="./public/img/favicon_ad/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="./public/img/favicon_ad/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="./public/img/favicon_ad/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="./public/img/favicon_ad/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="./public/img/favicon_ad/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="./public/img/favicon_ad/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="./public/img/favicon_ad/apple-icon-180x180.png">
  
  <link rel="icon" type="image/png" sizes="192x192"  href="./public/img/favicon_ad/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./public/img/favicon_ad/favicon_ad-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="./public/img/favicon_ad/favicon_ad-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./public/img/favicFon_ad/favicon_ad-16x16.png">
  <link rel="manifest" href="./public/img/favicon_ad/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="./public/img/favicon_ad/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <link href = "./public/css/admin.css"     rel = "stylesheet" type = "text/css">
  <link href = "./public/css/admin_user.css"     rel = "stylesheet" type = "text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src = './public/js/JQuery/jquery-3.4.1.js'  type = "text/javascript"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>
<body>
  <div class="admin_header">
      <div class="admin_back" title="go back to speakmore page"><a href="./Home/"><i class="material-icons">&#xe88a;</i></a></div>
      <div class="admin_logo"><a href="./HomeAdmin/">SpeakMore Admin</a></div>
      <!-- <p>Hello</p> -->

      <div class="admin_info">
        <?php 
          if(!empty($data['avatar'])){
            $name_avt = $data['avatar'];
            $directory_avatar = "./public/img/uploads/" . $name_avt;
            echo "<img title='". $_COOKIE["member_login"]."' class='small-avt' src='". $directory_avatar ."'>" ;
            echo "<a title='go to home page' href='./UserPage/'>".$_COOKIE['member_login']."</a>";
          }
        ?>
      </div>
  </div>