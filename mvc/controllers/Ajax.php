<?php

class Ajax extends Controller{
  public $user_db;

  public function __construct()
  {
    $this->user_db = $this->model('UserModel');
  }

  public function checkUsername(){
    $un = $_POST["un"];
    echo $a =  $this->user_db->checkUsername($un);

  }

}

?>