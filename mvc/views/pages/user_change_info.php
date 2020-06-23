<div class='main-container'>
  <?php

  // var_dump($_SESSION);
  if (isset($_COOKIE['member_login']))
    echo "<h1>Hello " . $_COOKIE['member_login'] . "</h1><h2>Đây là Trang cá nhân của bạn</h2>";
  else
    echo "<h1>You are not login</h1>";
    
  if(isset($data['info'])){
      $info = $data['info'];
      // var_dump($info);
  }
  ?>
  


  <p class="notification_avt">Hãy cập nhật nhật thông tin của bạn: </p>
  <div class="user_info_page">

    <div class="input_info">
      <form method="POST" action="./UserPage/updateInfo">


        <div class="input_item">
          <div class="item_label">
            <label>First Name:</label>
          </div>
          <div class="item_input">
            <input type="text" name="f_name" <?php if(!empty($info['fname'])) echo "value ='". $info['fname']."'" ?>>
          </div>
        </div>


        <div class="input_item">
          <div class="item_label">
            <label>Last Name:</label>
          </div>
          <div class="item_input">
            <input type="text" name="l_name" <?php if(!empty($info['lname'])) echo "value ='". $info['lname']."'" ?>>
          </div>
        </div>

        <div class="input_item">
          <div class="item_label">
            <label>Birth Day:</label>
          </div>
          <div class="item_input">
            <input type="date" name="birthday" <?php if(!empty($info['birthday'])) echo "value ='". $info['birthday']."'" ?>>

          </div>
        </div>

        <div class="input_item">
          <div class="item_label">
            <label>Gender:</label>
          </div>
          <div class="item_input">
            <input type="radio" value="male" name="gender" <?php if(!empty($info['gender'])) {if($info['gender'] == 'male') echo "checked";}?>>
            <label>Male</label>
            <input type="radio" value="female" name="gender"<?php if(!empty($info['gender'])) {if($info['gender'] == 'female') echo "checked";} ?>>
            <label>Female</label>
            <input type="radio" value="other" name="gender" <?php if(!empty($info['gender'])) { if($info['gender'] == 'other') echo "checked";} ?>>
            <label>Other</label>
          </div>
        </div>

        <div class="input_item">
          <div class="item_label">
            <label>School/University:</label>
          </div>
          <div class="item_input">
            <input type="text" name="school" <?php if(!empty($info['school'])) echo "value ='". $info['school']."'" ?>>
          </div>
        </div>

        <div class="input_item">
          <div class="item_label">
            <label>Toeic Score:</label>
          </div>
          <div class="item_input">
            <input type="number" name="toeic_score" min="0" max="990" <?php if(!empty($info['toeic'])) echo "value ='". $info['toeic']."'" ?>>
          </div>
        </div>

        <button class="submit_more" type="submit" name="update_info">Update</button>

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
        <?php
          if(isset($data['res_upload']))
            echo "<div class='label_res'>" .$data['res_upload'] . "</div>";
        ?>

      </div>
    </div>
  </div>
</div>