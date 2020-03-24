<div class="main-container">
  <div class="video-card">
  
    <?php
    if(isset($username))
      echo "<h1>Hello $username This is your home page</h1>";
    else
      echo "<h1>You are not login</h1>";
    ?>
    <p>Hãy thực hiện các bước đưới đây để học tiếng anh nha!</p>
    <img id="intro" src="../../img/user_page.png">
    <div class="tips">
      <h3>Hướng dẫn học:</h3>
      <?php include "../../php/guide_prs.php";?>
    </div>
    <div class="knowledge"> 
      <?php include "../../php/core_knowledge/be_verb.php" ?>
    </div>
    <div class="verb-video" >
      <h3>Video có phụ đề:</h3>
      <iframe  width="560" height="315" src="https://www.youtube.com/embed/LfJPA8GwTdk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      
      <div class="subtitle">
        <ul><?php include "../../php/subtitles/video1_sub.php" ?> </ul>
      </div>
    </div>
  </div>
</div>