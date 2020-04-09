<?php
    if(isset($_GET["action"])){
      $action = $_GET["action"];
    }
    else
      $action = "";

    switch($action){
      case "home": {
        $home->allTuts = $tutorial_db->getAllTutorial();
        $home->tut_question = $tutorial_db->loadQuestion();
        $home->url = "index.php?controller=homepage&action=home";
        echo $home;
      break;
      }
    }

?>