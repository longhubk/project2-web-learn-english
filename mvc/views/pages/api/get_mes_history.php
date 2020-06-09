
<?php
  if(isset($data['mes_history']))
    echo $data['mes_history'];
  else
  if(isset($data['content_id'])){
    $res = $data['content_id'];
    for($i = 0; $i < sizeof($res); $i++){
      echo $res[$i][0].",";
    }
  }
  if(isset($data['delete_res'])){
    echo $data['delete_res'];
  }
  // else
    // echo "not found";

?>