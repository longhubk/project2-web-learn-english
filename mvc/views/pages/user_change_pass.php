<div class='main-container'>
  <?php
  // include "../controllers/uploadAvatar.php";
  if (isset($_COOKIE['member_login']))
    echo "<h1>Hello " . $_COOKIE['member_login'] . " This is your HomePage page</h1>";
  else
    echo "<h1>You are not login</h1>";
  ?>

  <p class="notification_avt">Change Your Password Here: </p>
  <div class="user_info_page">

    <div class="input_info">
      <form method="POST" action="./UserPage/change_pass">

        <div class="input_item">
          <div class="item_label">
            <label>Old Password:</label>
          </div>
          <div class="item_input">
            <input type="password" name="old_pass" placeholder="Enter your old password">
            <span></span>
          </div>
        </div>

        <div class="input_item">
          <div class="item_label">
            <label>New Password:</label>
          </div>
          <div class="item_input">
            <input type="password" name="new_pass" placeholder="Enter your new password">
          </div>
        </div>


        <div class="input_item">
          <div class="item_label">
            <label>New Password Again:</label>
          </div>
          <div class="item_input">
            <input type="password" name="new_pass_again" placeholder="Enter new password again">
          </div>
        </div>

        <button class="submit_more" type="submit" name="change_pw">Update</button>
        <?php
          if(isset($data['pass_update'])){
            if($data['pass_update'] == 'Update password success !')
              echo "<div class='label_ok'>".$data['pass_update']."</div>";
            else
              echo "<div class='label_res'>".$data['pass_update']."</div>";
          }

        ?>

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