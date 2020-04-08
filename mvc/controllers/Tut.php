
<?php 

  class Tut extends Controller{
    function Init(){
      $this->view("master_h",[
        "page" => "content_tut"
      ]);
    }
    function Abc($ho, $ten){
      echo "$ho - $ten";
    }
    function XuLy($page){
      echo "$page";
    }
  }

?>