
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
            echo "upload ok";
          
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





?>