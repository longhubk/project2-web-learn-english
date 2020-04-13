<!DOCTYPE html>
<html></html>
<head>
  <title></title>
</head>
</head>
<body>
  <div>
    <form method="POST" id="form2" action="InsertUser.php">
      <input type="text" name="UserName" placeholder="Enter username"><br>
      <input type="text" name="UserMail" placeholder="Enter useremail"><br>
      <input type="password" name="UserPassword" placeholder="Enter userpassword"><br>
      <input type="submit"  value="SignUp">
    </form>
    <?php 
      if(isset($_GET['success'])){
        echo "User is inserted";
      }
    ?>
  </div>
</body>
</html>