<div class="main-container">
  <div class="video-card">

    <?php
    if (isset($_COOKIE['member_login']))
      echo "<h1>Hello " . $_COOKIE['member_login'] . " This is your home page</h1>";
    else
      echo "<h1>You are not login</h1>";
    ?>
    <p>Hãy cập nhật nhật thông tin mà bạn: </p>

    <form action="../../php/uploadAvatar.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="file">
      <button type="submit" name="upload">Upload</button>
    </form>

    <img id="intro" src="../../img/user_page.png">
    <div class="tips">
      <h3>Hướng dẫn học:</h3>
      <?php include "../../php/guide_prs.php"; ?>
    </div>
    <div class="knowledge">
      <?php include "../../php/core_knowledge/be_verb.php" ?>
    </div>
    <div class="verb-video">
      <h3>Video có phụ đề:</h3>
      <iframe width="560" height="315" src="https://www.youtube.com/embed/LfJPA8GwTdk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

      <div class="subtitle">
        <ul><?php include "../../php/subtitles/video1_sub.php" ?> </ul>
      </div>
    </div>
  </div>
</div>