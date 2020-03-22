<?php 
  include "../form_source_html/consts/login.php";
  include "../form_source_html/consts/Top_Page.php";
?>  
  <div class="clear"></div>
<?php 
  include "../form_source_html/consts/horizontal_nav.php";
  include "../form_source_html/nav_lefts/vertical_side_nav.php";
  if(isset($_GET['tutorial']) && isset($_GET['name_tutorial']))
    include "../form_source_html/mains/tut_content.php";
  else 
    include "../form_source_html/mains/main_content.php";
?>
  <div class="clear"></div>
<?php
  include "../form_source_html/nav_rights/vertical_right_bar.php";
?>
  <div class="clear"></div>