<?php 
  class LessonModel extends DB{

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
    
    public function loadAllTutorial(){
      $qr   = "SELECT * FROM tutorials";
      $rows = mysqli_query($this->con, $qr);
      $res = mysqli_fetch_array($rows);
      return $res;

    }

  }