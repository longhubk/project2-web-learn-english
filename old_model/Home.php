<?php

class Home extends Model{

  private $tutorial;
  public function __construct()
  {
    $this->tutorial = new Tutorial();
  }
  public function __call($method, $arg = null){
    $this->tutorial->$method($arg);
  }

}


?>