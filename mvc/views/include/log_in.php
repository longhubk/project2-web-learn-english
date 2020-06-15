<div id="log-1" class="login-container-2">
  <form class="login-form animate animate2" method="POST" action="./RegisterPage/Login">

    <div class="login-img">
      <img onclick="closeLogin()" class="img-50" src='public/icon/user_icon.png' >
    </div>

    <div class="login-main">
      <label class="login-label">Username:</label>
        <input id="test" type="text" name="username" placeholder="Enter Username">
        <span class="error_log"><?php if (isset($data['state'][1])) echo $data['state'][1]; ?></span><br>

      <label class="login-label">Password:</label>
        <input type="password" name="password" placeholder="Enter Password"> 
        <span class="error_log"><?php if (isset($data['state'][0])) echo $data['state'][0]; ?></span><br>

      <div class="check_remember">
        <input type="checkbox" id='remember_check' name="remember"><label for='remember_check' id="remember_me">Remember me</label>
      </div>
      <input type="submit" name="login" value="Login">
    </div>

    <div class="login-btn-2">
      <span class="login-forget">
        <a href="./RegisterPage/Forget">Forget password</a>
      </span>
      <span class="login-sign-up">
        <a href="./RegisterPage/SignUp">Sign up new account</a>
      </span>
    </div>

  </form>

</div>