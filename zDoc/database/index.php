<!DOCTYPE html>
<html lang="en">
<head>
  <title>Document</title>
</head>

<body>
  <form id='form' method="POST" action="userLogin.php">
  <link rel="stylesheet" hrel="login.css" type="text/css">
    <h2>Login Form</h2>
    <table>
      <tr>
        <td><input type="Email" name="UserMailLogin" placeholder="Enter Your Email" ></td>
      </tr>
      <tr>
        <td><input type="password" name="UserPasswordLogin" placeholder="Enter Your Password" ></td>
      </tr>
      <tr>
        <td><input type="submit" value="Login"></td>
      </tr>
      <?php 
        if(isset($_GET['error'])){
          echo "error";
        }else{
          echo "success";
        }
      ?>
    </table>

  </form>
  
</body>
</html>