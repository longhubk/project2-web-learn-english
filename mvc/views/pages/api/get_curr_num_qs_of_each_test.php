
<?php

  if(isset($_POST)){
    if(isset($data['curr_num_qs']) && isset($data['curr_test']))
    if(empty($data['curr_num_qs'])){
      $curr_num_qs = "0";
    }
    else{
      $curr_num_qs = $data['curr_num_qs'][0][0];
    }
    echo json_encode(array("curr_num_qs" => $curr_num_qs, "test_curr" => $data['curr_test'][0]));
  }
  else
    echo json_encode(array("success" => "fail"));



?>