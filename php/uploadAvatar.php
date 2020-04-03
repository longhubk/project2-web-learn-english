
<?php 
  if(isset($_POST['upload'])){

    $file_name = $_FILES['file']['name'];
    $file_Temp_name = $_FILES['file']['tmp_name'];
    $file_Size = $_FILES['file']['tmp_name'];
    $file_Error = $_FILES['file']['type'];
    $file_Type = $_FILES['file']['error'];

    $file_Ext = explode('.', $file_name);
    //convert all PNG JPG to png and jpg..
    $file_Actual_Ext = strtolower(end($file_Ext));

    $file_Ext_Allowed = array('jpg', 'png', 'jpeg', 'gif');
    $file_new_name = $_COOKIE['member_login'] . "." . $file_Actual_Ext;
    $file_destination = "../../img/uploads/" . $file_new_name;

    if(in_array($file_Actual_Ext,$file_Ext_Allowed)){

      if($file_Error == 0){
        if($file_Size < 5000000){
            move_uploaded_file($file_Temp_name, $file_destination);
            $write_img_to_database = "UPDATE users SET avatar='" .$file_new_name . "' WHERE name='". $_COOKIE['member_login'] . "'";
            $connect->exec($write_img_to_database);
            check_name_file_exist($_COOKIE['member_login'], $file_Ext_Allowed, $file_Actual_Ext);
            echo "Upload successfully <br>";
        }else{
          echo "File bigger than 5M";
        }
      }else{
        echo "There are error";
      }
    }else{
      echo "you can not upload file that is not image";
    }
  }


 function check_name_file_exist($file_name, $file_Ext_Allowed, $file_Actual_Ext){
    foreach($file_Ext_Allowed as $ext){
      if($ext != $file_Actual_Ext){
        $file_name_check = "../../img/uploads/".$file_name .".". $ext;
        if(file_exists($file_name_check)){
          unlink($file_name_check);
          echo "Deleted your old avatar <br>";
        }
      }
    }
  }



?>