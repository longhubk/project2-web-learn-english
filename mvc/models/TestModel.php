
<?php 
  class TestModel extends DB{

    private $path;

    public function __construct()
    {
      $this->path = "./mvc/models/data/";
    }

    public function loadTestQuestion(){
      return parent::readJsonData("$this->path"."test_question/grammar_qs.json");
    }

    public function loadAllTest(){
      return parent::readJsonData("$this->path"."test_question/test_all.json");
    }

    public function calculatePoint($data){

      $data_correct = parent::readJsonData("$this->path"."test_question/grammar_as.json");
        $str = 'as_qs_';
        $i = 1;
        $point = 0;
        $count_num_qs = 0;
      foreach($data_correct as $key => $value){
        $str .= $i;

        if($key == $str){
          for($k = 0; $k < sizeof($data); $k++){
            if(isset($data[$k][$str])){
              foreach($data[$k][$str] as $key2 => $value2){
                  if($value2 == $value)
                    $point++;
              }
            }
          }

        }
        $str = "as_qs_";
        $i++;
        $count_num_qs++;

      }
      $res = $point . '/' . $count_num_qs;
        return $res;
      }
      public function changeDataTest($num_qs){
        // $res = "";
        $page_next = $_POST['page_next']+1;
        // if($_SESSION['last_post'][$page_next-2]['page_next'] !== $page_next) //_don't push again
        // var_dump($_SESSION['last_post']);
        // var_dump($_POST);
        $isExist = false;
        $i = 0;
        $str = 'as_qs_';
        $count_filled = 0;
        // $size = sizeof($_POST);
        while($num_qs--){
          foreach($_POST as $key => $value){
            $id = $str . $i;
            // echo "key:".$key . "  ";
            if($key == $id){
              $count_filled++;
              for($j = 0; $j < sizeof($_SESSION['last_post']); $j++){
                if(isset($_SESSION['last_post'][$j][$id]))
                  $_SESSION['last_post'][$j][$id] = $value; //_new value
              }
            }

          }
          $i++;
        }
        // echo "counted: ". $count_filled;

        for($j = 0; $j < sizeof($_SESSION['last_post']); $j++){
          if(isset($_SESSION['last_post'][$j]['page_next']))
            if($_SESSION['last_post'][$j]['page_next'] == $page_next-1)
              $isExist = true;
        }
        if($isExist == false && $count_filled > 0){
          array_push($_SESSION['last_post'], $_POST); //_push last one page
        }

        // return $$_SESSION['last_post'];

      }

}

?>