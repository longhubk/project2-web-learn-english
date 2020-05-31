
<?php
  if(isset($_POST)){
    if(isset($data['res_register']))
    echo json_encode(array("success" => $data['res_register']));
  }
  else
    echo json_encode(array("success" => "fail"));



?>