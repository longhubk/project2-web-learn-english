<div id="log-1" class="login-container-2">

  <form class="login-form animate animate2" method="POST" action="index.php">
    <div class="login-img">
      <i onclick="closeLogin()" class="fas fa-user"></i>
    </div>
    <div class="login-main">
      <label class="login-label">Username:</label>
      <input id="test" type="text" name="username" placeholder="Enter Username">
      <span class="error_log"><?php if (isset($user_log_err)) echo $user_log_err; ?></span><br>
      <label class="login-label">Password:</label>
      <input type="password" name="password" placeholder="Enter Password">
      <span class="error_log"><?php if (isset($password_log_err)) echo $password_log_err; ?></span><br>
      <div class="check_remember">
        <input type="checkbox" name="remember"><span id="remember_me">Remember me</span>
      </div>
      <input type="submit" name="submit" value="Login">
    </div>
    <div class="login-btn-2">
      <span class="login-forget">
        <a href="#">Forget password</a>
      </span>
      <span class="login-sign-up">
        <a href="#">Sign up new account</a>
      </span>
    </div>
  </form>

</div>