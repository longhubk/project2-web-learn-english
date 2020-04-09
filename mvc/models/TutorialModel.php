<?php 
  class TutorialModel extends DB{


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
    private $path;

    public function __construct()
    {
      $this->path = "./mvc/models/data/";
    }

    public function getTutKnowledge($getTutorial){
      $this->path_data = "$this->path" ."core_knowledge/" . $getTutorial . ".json";
      $this->content_data = parent::readJsonData($this->path_data);
      return $this->content_data;

    }

    public function test(){
      echo "hello every one";
    }

    public function loadGuide(){
      $this->guide = parent::readJsonData("$this->path"."guide_listen.json");
      return $this->guide;

    }
    
    
    public function loadSub(){
      $this->subtitle = parent::readJsonData("$this->path"."subtitles_data/video1_sub_data.json");
      return $this->subtitle;
    }
    public function getAllTutorial(){
        $this->all_tutorial = parent::readJsonData("$this->path"."tutorials/all_tutorial.json");

        return $this->all_tutorial;
    }
    
    public function getMenuUser(){
      $this->menu_user = parent::readJsonData("$this->path"."tutorials/menu_user.json");
      return $this->menu_user;
  }
    public function getTutContent($tut_name){
      $path_tutorials = "$this->path"."tutorials/" . $tut_name . ".json";
      $this->name_tutorial = parent::readJsonData($path_tutorials);
      return $this->name_tutorial;
   }  
   public function loadQuestion(){
    $this->question = $this->readJsonData("$this->path"."user_question.json");
    return $this->question;

  }


  }

?>