<?php
  session_start();

  include "class_user.php";
  if(isset($_POST['ChatText'])){
    $chat = new chat();
    $chat->setChatUserId($_SESSION["UserId"]);
    $chat->setChatText($_POST["ChatText"]);
    $chat->InsertChatMessage();
  }


?>