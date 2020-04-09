<div class='main-container'>
  <?php
  // include "../controllers/uploadAvatar.php";
  if (isset($_COOKIE['member_login']))
    echo "<h1>Hello " . $_COOKIE['member_login'] . " This is your home page</h1>";
  else
    echo "<h1>You are not login</h1>";
  ?>

  <p class="notification_avt">Hãy cập nhật nhật thông tin mà bạn: </p>
  <div class="user_info_page">

    <div class="input_info">
      <form method="POST">

        <div class="input_item">
          <div class="item_label">
            <label>First Name</label>
          </div>
          <div class="item_input">
            <input type="text" name="f_name">
          </div>
        </div>

        <div class="input_item">
          <div class="item_label">
            <label>Last Name</label>
          </div>
          <div class="item_input">
            <input type="text" name="l_name">
          </div>
        </div>

        <div class="input_item">
          <div class="item_label">
            <label>Birth Day</label>
          </div>
          <div class="item_input">
            <input type="date" name="birthday">
          </div>
        </div>

        <div class="input_item">
          <div class="item_label">
            <label>Gender</label>
          </div>
          <div class="item_input">
            <input type="radio" value="male" name="gender">
            <label>Male</label>
            <input type="radio" value="female" name="gender">
            <label>Female</label>
            <input type="radio" value="other" name="gender">
            <label>Other</label>
          </div>
        </div>

        <div class="input_item">
          <div class="item_label">
            <label>School/University</label>
          </div>
          <div class="item_input">
            <input type="text" name="school">
          </div>
        </div>

        <div class="input_item">
          <div class="item_label">
            <label>Toeic Score</label>
          </div>
          <div class="item_input">
            <input type="number" name="toeic_score" min="0" max="990">
          </div>
        </div>

        <div class="input_item">
          <div class="item_label">
            <label>Old Password</label>
          </div>
          <div class="item_input">
            <input type="text" name="old_password">
          </div>
        </div>

        <div class="input_item">
          <div class="item_label">
            <label>New Password</label>
          </div>
          <div class="item_input">
            <input type="text" name="new_password">
          </div>
        </div>

        <button id="submit_more" type="submit" name="update">Update</button>

      </form>
    </div>

    <div class="output_info">
      <div class="user_avatar">
        <?php

        if(isset($data['avatar'])){
          $name_avt = $data['avatar'];
          $directory_avatar = "./public/img/uploads/" . $name_avt;
          echo "<img class='photo_avt' src='" . $directory_avatar . "'>";
        }
        ?>
        <div class='name_in_avt'><?php echo $_COOKIE['member_login']; ?></div>
        <form id="form_img" action="./UserPage/upload"  method="POST" enctype="multipart/form-data">
          <input id="file_rp" type="file" name="file" accept=".png,.jpg,.gif,.jpeg">
          <label id="rp_input_file" for="file_rp">Choose Image</label>
          <input id="submit_avt" type="submit" name='upload' value="upload">
        </form>
      </div>
    </div>
  </div>
</div>