
<?php 


  if(isset($_POST['submit'])){
    if(isset($_POST['username']) && isset($_POST['password'])){
      $query = "SELECT name,password FROM users";
      $result = $connect->query($query);
      $username = $_POST['username'];
      $password = $_POST['password'];
      $check = 0;
      foreach($result as $row => $data){
        $check = 0;
        foreach($data as $key => $value){
          if($key == "username" && $value == $username){
            $check ++;
          }else{
            $user_log_err = "Username wrong";
          }
          if($key == "password" && $value == $password){
            $check ++;
          }else{
            $password_log_err = "Password wrong";
          }
          
        }
        if($check == 2){
          $_GET['logined'] = "ok";
          break;
        }
      }
      if($check != 2)
        $_GET['logined'] = "fail";
     
    }
  }
  $connect = null;

?>