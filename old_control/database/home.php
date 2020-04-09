<?php 
  session_start();
  include "data_users.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <script type="text/javascript" src="jquery-3.4.1.js"></script>
  <link href="home.css" type="text/css" rel="stylesheet">
  <script type="text/javascript">
    $(document).ready(function(){
      $("#ChatText").keyup(function(e){
        if(e.keyCode == 13){
          var ChatText = $("#ChatText").val();
          $.ajax({
            type: "POST",
            url: "InsertMessage.php",
            data: {ChatText:ChatText},
            success: function(){
              $("#ChatMessages").load("DisplayMessage.php")
              $("#ChatText").val("")
            }
          })
        }
      })

      setInterval(function(){
        $("#ChatMessages").load("DisplayMessage.php")
      }, 1500)

      $("#ChatMessages").load("DisplayMessage.php")

    })
</script>
</head>
<body>
  <center>
    <h2>Welcome <?php echo $_SESSION['UserName']; ?></h2> 
  </center>
  <div id="ChatBig">
    <div id="ChatMessages" class='scrollbar'>
    </div>
      <textarea id="ChatText" name="ChatText" placeholder="Type message..."></textarea>
  </div>
  <div id="ListUser">
    <table>
      <tr>
        <th>Name</th>
        <th>Add friend</th>
      </tr>

<?php
  $sql = "SELECT name FROM users";
  $res = $connect->query($sql);

  foreach($res as $row){

    echo "<tr>";
      echo "<td>" .$row['name'] ."</td>";
      echo "<td> <button onclick=''>add friend</a></td>";

    echo "</tr>";
  }
  
      
?>
    </table>
  </div>
  
</body>
</html>