

<?php

  if(isset($_POST)){
    if(isset($data['res_block']))
    echo json_encode(array("success" => $data['res_block']));
  }
  else
    echo json_encode(array("success" => "no_post"));



?>