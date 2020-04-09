<?php

$menu_user = read_json("../data/tutorials/menu_user.json");
foreach($menu_user as $user_item => $name){
   echo "<li><a href='index.php?user=$user_item'>$name</a></li>";   
}

?>