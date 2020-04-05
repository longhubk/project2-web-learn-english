<?php
    if(isset($_GET["action"])){
      $action = $_GET["action"];
    }
    else
      $action = "";

    switch($action){
      case "all": {
       
        $tutorialpage->allTuts = $tutorial_db->getAllTutorial();
        $tutorialpage->tutContent = $tutorial_db->getTutContent();
        $tutorialpage->each_url = "index.php?controller=tutorialpage&action=each";
        $tutorialpage->all_url = "index.php?controller=tutorialpage&action=all";
        $name_tut_get = 'be_verb';
        $tutorialpage->tutKnowledge = $user_db->getTutKnowledge($name_tut_get);
        $tutorialpage->tut_img = $name_tut_get . ".png";
        
        $tutorialpage->tut_subtitle = $tutorial_db->loadSubtitle();
        $tutorialpage->tut_guide = $tutorial_db->loadGuide();
        $tutorialpage->tut_question = $tutorial_db->loadQuestion();
        echo $tutorialpage;
        break;
      }
      case "each":{
        $tutorialpage->allTuts = $tutorial_db->getAllTutorial();
        $tutorialpage->tutContent = $tutorial_db->getTutContent();
        $tutorialpage->each_url = "index.php?controller=tutorialpage&action=each";
        if(isset($_GET["name_tutorial"])){
          $name_tut_get = $_GET["name_tutorial"];
          $tutorialpage->tutKnowledge = $tutorial_db->getTutKnowledge($name_tut_get);
          $tutorialpage->tut_img = $name_tut_get . ".png";
        }
        $tutorialpage->tut_subtitle = $tutorial_db->loadSubtitle();
        $tutorialpage->tut_guide = $tutorial_db->loadGuide();
        $tutorialpage->tut_question = $tutorial_db->loadQuestion();
        echo $tutorialpage;
        break;
      }
    }

?>