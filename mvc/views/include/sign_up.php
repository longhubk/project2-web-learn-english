<div id="log-1" class="login-container-2">

  <form id="sign_up" class="login-form animate animate2" method="POST" action="./Register/SignUp">
    <div class="login-img">
      <!-- <i onclick="closeLogin()" class="fas fa-user"></i> -->
      <img onclick="closeLogin()" class="img-50" src='public/icon/user_icon.png' >
    </div>
    <div class="login-main">
      <label class="login-label">Username:</label>
      <input type="text" name="username_sp" placeholder="Enter Username">
      <span class="error_log"><?php if (isset($data['sign_err'][0])) echo $data['sign_err'][0]; ?></span><br>

      <label class="login-label">Email:</label>
      <input type="text" name="email_sp" placeholder="Enter Email">
      <span class="error_log"><?php if (isset($data['sign_err'][1])) echo $data['sign_err'][1]; ?></span><br>

      <label class="login-label">Password:</label>
      <input type="password" name="password_sp" placeholder="Enter Password">
      <span class="error_log"><?php if (isset($data['sign_err'][2])) echo $data['sign_err'][2]; ?></span><br>

      <label class="login-label">Password again:</label>
      <input type="password" name="password_again_sp" placeholder="Enter Password again">
      <span class="error_log"><?php if (isset($data['sign_err'][3])) echo $data['sign_err'][3]; ?></span><br>

      <div class="check_remember">
        <input type="checkbox" name="agree"><span id="remember_me">I agree your License and Agreement</span>
        <span class="error_log"><?php if (isset($data['sign_err'][4])) echo $data['sign_err'][4]; ?></span><br>
      </div>
      <input type="submit" name="signup" value="sign up">
    </div>
  </form>

</div>