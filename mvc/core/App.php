<?php
  //!process controller-action-params
  //!for display
  class App{
    // *http://localhost/MVC/Home/action/1/2/3
    protected $controller = "Home";
    protected $action     = "Init";  //!default
    protected $params     = [];

    public function __construct()
    {
      // *Array ( [0] => Home [1] => action [2] => 1 [3] => 2 [4] => 3 )
      $arr = $this->UrlProcess();


      // *Process and call controller
      if(isset($arr[0])){
        if(file_exists("./mvc/controllers/". $arr[0] .".php")){
          $this->controller = $arr[0];
          unset($arr[0]);
        }
      }
      require_once("./mvc/controllers/". $this->controller .".php");

      // * this init object before call model
      $this->controller = new $this->controller;
      
      // * assign action for this action
      if(isset($arr[1])){
        if( method_exists($this->controller, $arr[1])){
          $this->action = $arr[1];
        }
        unset($arr[1]);
      }
  
      // *Call method of controller(class) and pass array param to method(action)
      $this->params = $arr ? array_values($arr) : [];

      call_user_func_array([$this->controller, $this->action], $this->params);
      
    
    }
    // * split string url return list controller, action, params
    private function UrlProcess(){
      //*return array
      if(isset($_GET["url"])){
        return explode("/",  filter_var(trim($_GET["url"], "/")));
      }

    }
  }

?>