
<?php 
  class TestModel extends DB{

    private $path = "./mvc/models/data/";

    // public function __construct()
    // {
    //   $this->path = "./mvc/models/data/";
    // }

    public function loadTestQuestion(){
      return parent::readJsonData("$this->path"."test_question/grammar_qs.json");
    }

    public function loadAllTest(){
      return parent::readJsonData("$this->path"."test_question/test_all.json");
    }
    
    // private function queryAllArray($qr){
    //   $rows = mysqli_query($this->con, $qr);
    //   $res = mysqli_fetch_all($rows);
    //   return $res;
    // }

    public function loadAllTestAdmin(){
      $qr = "SELECT * FROM test";
      // $row = mysqli_query($this->con, $qr);
      // $res = mysqli_fetch_all($row);
      // if($res)
      //   return $res;
      // else
      //   return false;
      return $this->queryAllArray($qr);
    }


    public function appendQuestionTest($post){
      if(!empty($post['choose_test']))
        $test_id = $post['choose_test'];
      else 
        return false;
      $test_level = $post['test_level_input'];
      $num_question = $post['number_question'];
      if($test_level > 0){

      }else{

        for($i = 1; $i <= $num_question; $i++){
          $name_ct    = '';
          $qs_ct   = '';
          $name_qs  = "name-".$i;
          $content_qs = "question-".$i;

          if(!empty($post[$name_qs]))
            $name_ct = $post[$name_qs];
          if(!empty($post[$content_qs]))
            $qs_ct = $post[$content_qs];

          $str = 'ans_';
          $ans = [];
          for($j = 1; $j <= 4; $j++){
            $id = $str . $j . "-".$i; 
            if(isset($post[$id])){
              $ans[$j] = $post[$id];
            }
            else{
              $ans[$j] = "";
            }
          }

          $qr = 'INSERT INTO test_qs VALUES(NULL, "' .$name_ct .'","' .$qs_ct. '","'.$ans[1].'","'.$ans[2].'","'.$ans[3].'","'.$ans[4].'","'.$test_id.'")';

          $rows = mysqli_query($this->con, $qr);

          if(!$rows) return false;
        }

      }
      return true;
    }

    public function loadNumberQuestionCurrent( $test_id){
      $qr   = "SELECT COUNT(test_qs_id) as 'curr_num_qs' FROM test_qs WHERE test_id = $test_id GROUP BY test_id";
      $res = $this->queryAllArray($qr);
      return $res;
    }

    public function loadTestById( $test_id){
      $qr   = "SELECT * FROM test WHERE test_id = $test_id";
      return $this->queryAllArray($qr);
    }

    public function loadAllQuestionForTest(){
      $qr   = "SELECT * FROM test_qs";
      return $this->queryAllArray($qr);
    }

    public function getNumberQuestionOfEachTest(){
      $qr   = "SELECT test_id, COUNT(test_qs_id) FROM test_qs GROUP BY test_id";
      return $this->queryAllArray($qr);
    }

    
    public  function createNewTest($post_test, $id_ad_create){
      
      $qr = "INSERT INTO `test` (`test_id`, `test_name`, `test_time`, `num_qs`, `description`, `ad_create_id`, `time_modify`, `test_level`) VALUES (NULL, '$post_test[new_test_name]', '$post_test[test_time]', '$post_test[number_qs]', '$post_test[test_description]', '$id_ad_create', current_timestamp(), '$post_test[choose_level]')";

      $res = mysqli_query($this->con, $qr);
      if($res)
        return true;
      else
        return false;
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