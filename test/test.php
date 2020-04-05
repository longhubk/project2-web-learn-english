<?php

  echo getcwd() . "<br>";
  chdir("new");
  echo getcwd() . "<br>";

  ob_start();
  echo "HELLO <br>"; 
  $out = ob_get_clean();
  strtolower($out);
  var_dump($out);

  echo dirname("project2/lib/new/newfile.txt") . "<br>";
  echo basename("project2/lib/new/newfile.txt");


?>