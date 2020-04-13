<?php 
  include "../../php/database/data_users.php";

  if(isset($_POST["signup"]))
    include "../../php/signup_prs.php";

  if(isset($_POST["submit"]))
    include "../../php/login-prs.php";
  
  if(isset($_GET['get_login']))
    include "../form_source_html/consts/login.php";
  if(isset($_GET['get_signup']))
    include "../form_source_html/consts/signup.php";

  if(isset($_GET['logined'])){
    if($_GET['logined'] == "fail")
      include "../form_source_html/consts/login.php";
  }
  if(isset($_GET['signuped'])){
    if($_GET['signuped'] == "fail")
      include "../form_source_html/consts/signup.php";

  }
    
  include "../form_source_html/consts/Top_Page.php";
?>  
  <div class="clear"></div>
<?php 
  include "../form_source_html/consts/horizontal_nav.php";
  include "../form_source_html/nav_lefts/vertical_side_nav.php";
  if(isset($_GET['tutorial']) && isset($_GET['name_tutorial'])){
    if(isset($_GET['logined'])){
      if($_GET['logined'] == 'ok')
        include "../form_source_html/mains/user_page.php";
      else
        include "../form_source_html/mains/tut_content.php";
    }else
      include "../form_source_html/mains/tut_content.php";
  }else if(isset($_GET['homepage'])){
      include "../form_source_html/mains/user_page.php";
  }
  else{
    if(isset($_GET['logined'])){
      if($_GET['logined'] == 'ok')
        include "../form_source_html/mains/user_page.php";
      else
        include "../form_source_html/mains/main_content.php";
    }
    else
      include "../form_source_html/mains/main_content.php";
  }

 
  
?>
  <div class="clear"></div>
<?php
  include "../form_source_html/nav_rights/vertical_right_bar.php";
?>
  <div class="clear"></div>