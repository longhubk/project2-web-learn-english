<?php 

  class Model {
    protected $path;

    private $question;
    public function __construct()
    {
      
    }

    public function readJsonData($path){
      $file = fopen($path, "r") or die("can't open file");
      $file_read = fread($file, filesize($path));
      $file_decoded = json_decode($file_read);
      fclose($file);
      return $file_decoded;
    }
    public function loadQuestion(){
      $this->question = $this->readJsonData("models/data/user_question.json");
      return $this->question;

    }


  }


?>