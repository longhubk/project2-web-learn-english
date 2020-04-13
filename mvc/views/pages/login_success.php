<div class="main-container">
  <div class="video-card">

    <?php
      //header('Location: '.$_SERVER['PHP_SELF']); 
      if(isset($data['login_res'])){
        echo "<h1>" . $data['login_res'] . "</h1>";
      }
    ?>
    
    <img id="intro" src="public/img/Welcome.jpg">

    </div>
  </div>
</div>