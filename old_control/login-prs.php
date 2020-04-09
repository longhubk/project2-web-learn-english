
<?php 
  if(isset($_POST['submit'])){
    if(isset($_POST['username']) && isset($_POST['password'])){

      $username = $_POST['username'];
      $password = $_POST['password'];
      $check = 0;
      foreach($infors as $infor){
        $check = 0;
          if($infor->name == $username)
            $check ++;
          else
            $user_log_err = "Username wrong";
          
          if($infor->password == $password)
            $check ++;
          else
            $password_log_err = "Password wrong";

          if($check == 2){
            $_GET['logined'] = "ok";
            break;
          }
      }
    }
    if($check != 2)
      $_GET['logined'] = "fail";
     
  }

?>