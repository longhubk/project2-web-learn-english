<div id="log-1" class="login-container-2">
  <form id="sign_up" class="login-form animate animate2" method="POST" action="index.php">
    <div class="login-img">
      <i onclick="closeLogin()" class="fas fa-user"></i>
    </div>
    <div class="login-main">
      <label class="login-label">Username:</label>
      <input type="text" name="username_sp" placeholder="Enter Username">
      <span class="error_log"><?php if(isset($username_err)) echo $username_err; ?></span><br>

      <label class="login-label">Email:</label>
      <input type="text" name="email_sp" placeholder="Enter Email">
      <span class="error_log"><?php if(isset($email_err)) echo $email_err; ?></span><br>

      <label class="login-label">Password:</label>
      <input type="password" name="password_sp" placeholder="Enter Password">
      <span class="error_log"><?php if(isset($password_err)) echo $password_err; ?></span><br>

      <label class="login-label">Password again:</label>
      <input type="password" name="password_again_sp" placeholder="Enter Password again">
      <span class="error_log"><?php if(isset($password_again_err)) echo $password_again_err; ?></span><br>

      <div class="check_remember">
        <input type="checkbox" name="remember"><span id="remember_me">I agree your License and Agreement</span>
      </div>
      <input type="submit" name="signup" value="sign up">
    </div>

  </form>
</div>

