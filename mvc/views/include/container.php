<?php include "nav_left.php"; ?>

<?php

if (isset($_GET['tutorial']) && isset($_GET['name_tutorial']))
  include "content_tut.php";
else 
if (isset($_GET['homepage']))
  include "content_user.php";
else 
  include "content_main.php";

?>




<div class="clear"></div>


<?php
  if(!isset($_GET["homepage"]))
    include "nav_right.php"; 
  ?>


<div class="clear"></div>