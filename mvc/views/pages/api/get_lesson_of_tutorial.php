<?php
  // echo "get lesson of tutorial";
  if(isset($_POST)){
    // echo json_encode(array("success" => $_POST['id']));
    if(isset($data['data_lesson']))
    echo json_encode($data['data_lesson']);
  }
  else
    echo json_encode(array("success" => "fail"));



?>