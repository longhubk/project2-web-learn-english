<h2>

  <?php
    echo $data['sothich'][2] ;

  ?>

  <?php
    echo "<br>";
    while($row = mysqli_fetch_array($data['SV'])){
      echo $row['hoten'] . "<br>";
    }
    
  ?>
  <br>
  <a href="./Register">Register now</a>

</h2>