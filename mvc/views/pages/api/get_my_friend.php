
<?php
  if(isset($_POST)){
    if(isset($data['res_list']))
    echo json_encode(array("success" => $data['res_list']));
  }
  else
    echo json_encode(array("success" => "fail"));



?>