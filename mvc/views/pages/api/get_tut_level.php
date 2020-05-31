
<?php
  if(isset($_POST)){
    if(isset($data['tut_level']))
    echo json_encode(array("success" => $data['tut_level']));
  }
  else
    echo json_encode(array("success" => "fail"));



?>