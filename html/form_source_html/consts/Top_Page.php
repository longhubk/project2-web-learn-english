<div id="top_head" class = "header">

<div title="English free for every one" class="logo-icon">
  <a href="index.php"><img id="img-icon" src='../../img/logo.PNG' height="30" width="160"></a>
</div>
<div class="login-container">
  <?php
   echo "<button id='btn_login' class='login'>";
    $path_login = "index.php?get_login=login";
    $path_signup = "index.php?get_signup=signup";
    foreach($_GET as $key => $value){
      if(isset($_GET[$key])&& $key != "get_login" && $key != "get_signup" && $key != "logined")
        $path_login = $path_login . "&$key=$value";
      if(isset($_GET[$key])&& $key != "get_signup" && $key != "get_login" && $key != "logined")
        $path_signup= $path_signup . "&$key=$value";
      
    }
    echo "<a href='$path_login'>Log In</a>";
    echo "</button>";
    
 echo "<button  class='signup'>";
   echo "<a href='$path_signup'>Sign Up</a>";

 echo "</button>";
  ?>
</div>
<div class="language">
  <i class="material-icons">language</i>
    <div class="lang-choose"> 
      languages:
      <select>
        <option value="en">English</option>
        <option value="vn">Vietnamese</option>
        <option value="ja"></i>Japanese</option>
      </select>
    </div>
</div>
</div>