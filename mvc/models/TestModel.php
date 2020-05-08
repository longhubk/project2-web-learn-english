
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
        // var_dump($data['as_qs_1']);
      foreach($data_correct as $key => $value){
        $str .= $i;
        // echo $str;
        // echo $key;
        
        if($key == $str){
          // echo "hello";
          foreach($data[$str] as $key2 => $value2){
              if($key2 == $key && $value2 == $value)
                $point++;
          }

        }
        $str = "as_qs_";
        $i++;
        $count_num_qs++;

      }
      $res = $point . '/' . $count_num_qs;
        return $res;
      }

}

?>