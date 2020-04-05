<?php
    if(isset($_GET["action"])){
      $action = $_GET["action"];
    }
    else
      $action = "";

    switch($action){
      case "view": {
        $userpage->avatar = $user_db->getUserAvatar();
        $userpage->infors = $user_db->getInforLogin();
        $userpage->menu_user = $tutorial_db->getMenuUser();
        $userpage->url = "index.php?controller=userpage&action=view";
        echo $userpage;
      break;
      }
    }

?>