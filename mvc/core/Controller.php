<?php 
  class Controller{
    protected $tut_db;
    protected $user_db;
    protected $test_db;
    protected $doc_db;

    public function __construct()
    {
      $this->tut_db  = $this->model("TutorialModel");
      $this->user_db = $this->model("UserModel");
      $this->test_db = $this->model("TestModel");
      $this->doc_db = $this->model("DocModel");
    }

    public function model($model){
        require_once "./mvc/models/".$model.".php";
        return new $model;
    }
    public function view($view, $data = []){

      require_once "./mvc/views/".$view.".php";

    }
    
  }

?>