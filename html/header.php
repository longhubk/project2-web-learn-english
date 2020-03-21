<?php
  include "../php/read_json.php";
  $general_nav_bar = "";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width= device-width, initial-scale: 1.0">
    <meta charset="UTF-8">
    <title>SPEAK MORE</title>
    <link href="../css/container.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/navigation.css" type="text/css">
    <link href="../css/login.css" type="text/css" rel="stylesheet">
    <link href="../css/calendar.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/ver-nav.css" rel="stylesheet" type="text/css">
    <link href="../css/question_right.css" rel="stylesheet" type="text/css">
    <link href="../css/right_nav.css" rel="stylesheet" type="text/css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="../js/calendar.js" type="text/javascript"></script>
    <script src="../js/scroll_nav.js" type="text/javascript"></script>
    <script src="../js/login.js" type="text/javascript"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  
    <script type="text/javascript">
      window.onload = function(){
        generateDay();
        generateTime();
      }
      window.onscroll = function(){
        scrollFunction();
      }
    </script>
  </head>
  <body>  