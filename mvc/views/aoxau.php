<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="./public/js/main.js"></script>

  <title>Document</title>
</head>
<style>
  div{
    padding: 20px;

  }
  #header, #footer {
    background-color: green;
  }
</style>
<body>
  <div id="header"></div>
  <div id="content">
    <?php require_once "./mvc/views/pages/" . $data['page'] . ".php"; ?>


  </div>

</body>
</html>