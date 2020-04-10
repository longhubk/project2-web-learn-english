<?php 
  class TutorialModel extends DB{

    private $path;

    public function __construct()
    {
      $this->path = "./mvc/models/data/";
    }

    public function getTutKnowledge($getTutorial){
      return parent::readJsonData("$this->path" ."core_knowledge/" . $getTutorial . ".json");
    }

    public function loadGuide(){
      return parent::readJsonData("$this->path"."guide_listen.json");
    }
    
    public function loadSub(){
      return parent::readJsonData("$this->path"."subtitles_data/video1_sub_data.json");
    }

    public function getAllTutorial(){
      return parent::readJsonData("$this->path"."tutorials/all_tutorial.json");
    }
    
    public function getMenuUser(){
      return parent::readJsonData("$this->path"."tutorials/menu_user.json");
    }

    public function getTutContent($tut_name){
      return parent::readJsonData("$this->path"."tutorials/" . $tut_name . ".json");
    }  

    public function loadQuestion(){
      return parent::readJsonData("$this->path"."user_question.json");
    }

}

?>