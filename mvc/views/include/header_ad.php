<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>

  <base href = "http://localhost/speakmore/" />

  <link href = "./public/css/admin.css"     rel = "stylesheet" type = "text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src = './public/js/JQuery/jquery-3.4.1.js'  type = "text/javascript"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>
<body>
  <div class="admin_header">
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