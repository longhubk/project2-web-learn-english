<div id="top_head" class = "header">

<div title="English free for every one" class="logo-icon">
  <a href="index.php"><img id="img-icon" src='../../img/logo.PNG' height="30" width="160"></a>
</div>
<div class="login-container">
   <button id='btn_login' class='login'>
  <?php
    $path_login = "index.php?get_login=login";
    foreach($_GET as $key => $value){
      if(isset($_GET[$key])&& $key != "get_login")
        $path_login = $path_login . "&$key=$value";

    }
    echo "<a href='$path_login'>Log In</a>";
  ?>
  </button>

 <button  onclick="openSignUp()" class="signup">
   <a href="#">Sign Up</a>
 </button>
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