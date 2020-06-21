<?php require_once "include/header.php" ?>


<?php 
  if(isset($data['test_turn']))
    require_once "include/nav_left.php"; 
  else
    require_once "include/nav_left_test.php"; 

?>


<?php require_once "./mvc/views/pages/test/" . $data['page'] . ".php"; ?>


<div class="clear"></div>

<?php require_once "include/nav_right.php"; ?>

<div class="clear"></div>

<?php require_once "include/footer.php" ?>
