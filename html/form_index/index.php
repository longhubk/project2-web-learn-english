<?php

session_start();
  if(isset($_GET['logout'])){
    if($_GET['logout'] == "true")
      setcookie('member_login', "", time() - (10 * 365 * 24 * 60 * 60));
  }
$conn = new PDO("mysql:host=localhost;dbname=speakmore", "root" , "PtOGOOZuHq7aV4Pi");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(!empty($_POST["submit"])) {
  $sql = "SELECT * FROM users WHERE name = '" . $_POST["username"] . "'";
  if(!isset($_COOKIE["member_login"])) {
    $sql .= " AND password = '" . $_POST["password"] . "'";
  }
  $result = $conn->query($sql);
  $user = $result->fetch(PDO::FETCH_ASSOC);
	if($user){
    $_SESSION["member_id"] = $user["id"];
    if(!empty($_POST["remember"])) {
      setcookie ("member_login",$_POST["username"],time() + (10 * 365 * 24 * 60 * 60));
    }
    else{
      if(isset($_COOKIE["member_login"])) {
        setcookie("member_login","");
      }
    }
	}else{
    $message = "Invalid Login";
	}
}
if(isset($_COOKIE['member_login'])){
  $sql_check = "SELECT name FROM users WHERE name = '". $_COOKIE['member_login'] . "'";
  $res = $conn->query($sql_check);
  $user = $res->fetch(PDO::FETCH_ASSOC);
  if($_COOKIE['member_login'] == $user['name']){
    // echo '<script type="text/javascript">
    // alert("your cookie is:'. $_COOKIE['member_login'].' ")
    //    </script>';
  }else{
    // echo '<script type="text/javascript">
    // alert("your are not login ")
    // </script>';
  }
}

    
    include "../form_source_html/consts/header.php";
    include "../form_component/Home_page_components.php";
    include "../form_source_html/consts/footer.php";
    ?>
    
    
    