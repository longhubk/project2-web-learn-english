<?php 
  class Controller{
    protected $tut_db;
    protected $user_db;
    protected $test_db;
    protected $doc_db;

    protected $all_tuts;
    protected $all_test;
    protected $all_lesson;
    protected $all_topic;
    protected $avatar;
    protected $tut_qs;

    protected $view_arr;

    public function __construct()
    {
      $this->tut_db  = $this->model("TutorialModel");
      $this->user_db = $this->model("UserModel");
      $this->test_db = $this->model("TestModel");
      $this->doc_db  = $this->model("DocModel");


      $this->tut_qs     = $this->tut_db->loadQuestion();
      $this->avatar     = $this->user_db->getUserAvatar();
      $this->all_tuts   = $this->tut_db->getAllTutorial();
      $this->all_test   = $this->test_db->loadAllTest();
      $this->all_lesson = $this->tut_db->loadAllLessonForTutorial();
      $this->all_topic = $this->tut_db->loadAllTopic();
    }

    protected function model($model){
        require_once "./mvc/models/".$model.".php";
        return new $model;
    }
    protected function view($view, $data = []){
      require_once "./mvc/views/".$view.".php";
    }

    protected function render($master, $view_more){
        $this->view_arr = array_merge($this->view_arr, $view_more);
        $this->view($master, $this->view_arr );
    }
    
  }

?>