<?php

  class Tutorial extends Model{
    private $path_data ;
    // = "views/data/core_knowledge/" . $getTutorial . ".json";
    private $content_data ;
    // = read_json($path_data);
    private $img ;
    // = $getTutorial . ".png";
    private $name_tutorial;
    private $all_tutorial;
    private $subtitle;
    private $guide;
    private $question;
    private $menu_user;

    public function __construct()
    {
      
    }
    public function getTutKnowledge($getTutorial){
      $this->path_data = "models/data/core_knowledge/" . $getTutorial . ".json";
      $this->content_data = parent::readJsonData($this->path_data);
      return $this->content_data;

    }

    public function test(){
      echo "hello every one";
    }

    public function loadGuide(){
      $this->guide = parent::readJsonData("models/data/guide_listen.json");
      return $this->guide;

    }
    
    
    public function loadSubtitle(){
      $this->subtitle = parent::readJsonData("models/data/subtitles_data/video1_sub_data.json");
      return $this->subtitle;
    }
    public function getAllTutorial(){
        $this->all_tutorial = parent::readJsonData("models/data/tutorials/all_tutorial.json");
        return $this->all_tutorial;
    }
  
    public function getMenuUser(){
      $this->menu_user = parent::readJsonData("models/data/tutorials/menu_user.json");
      return $this->menu_user;
  }
    public function getTutContent(){
      $tutorial_get = $_GET['tutorial'];
      $path_tutorials = "models/data/tutorials/" . $tutorial_get . ".json";
      $this->name_tutorial = parent::readJsonData($path_tutorials);
      return $this->name_tutorial;
   }  
 
 }



  


?>