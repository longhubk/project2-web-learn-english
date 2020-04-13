<div id="top_head" class = "header">

<div title="English free for every one" class="logo-icon">
  <a href="index.php"><img id="img-icon" src='../../img/logo.PNG' height="30" width="160"></a>
</div>
<div id="head-intro">
  <p id='intro'>"Every courses are free for every one"</p>
  <i id='hide_intro' title="hide" class="fas fa-times"></i>
</div>
<div class="login-container">
  <?php
    $show_btn_login = true;
    // if(isset($_GET['logined'])){
    //   if($_GET['logined'] == 'ok'){
    //     $show_btn_login = false;
    //   }else{
    //     $show_btn_login = true;
    //   }
    // }
    if(!empty($_COOKIE['member_login'])){
        $show_btn_login = false;
    }else{
      $show_btn_login = true;
    }
  
    


    $path_login = "index.php?get_login=login";
    $path_signup = "index.php?get_signup=signup";
    foreach($_GET as $key => $value){
      if(isset($_GET[$key])&& $key != "get_login" && $key != "get_signup" && $key != "logined")
        $path_login = $path_login . "&$key=$value";
      if(isset($_GET[$key])&& $key != "get_signup" && $key != "get_login" && $key != "logined")
        $path_signup= $path_signup . "&$key=$value";
      
    }

    if($show_btn_login){
      echo "<button id='btn_login' class='login'>";
      echo "<a href='$path_login'>Log In</a>";
      echo "</button>";
    }else{
      echo "<button id='btn_login' class='login'>";
      echo "<a href='index.php?homepage=" .$_COOKIE['member_login']. "'>Home Page</a>";
      echo "</button>";
    }
    

    
    if(!empty($_COOKIE['member_login'])){
      echo "<button class='signup'>";
      echo "<a href='index.php?logout=true'>Log out</a>";
      echo "</button>";
    }else{
      echo "<button class='signup'>";
      echo "<a href='$path_signup'>Sign Up</a>";
      echo "</button>";
    }
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