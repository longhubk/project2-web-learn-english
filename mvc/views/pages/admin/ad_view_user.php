
<div class="admin_container">
  <h2 class="title_ad_page" >All Current User:</h2>

  <?php
    if(isset($data['all_user'])){
      $all_user = $data['all_user'];
      // var_dump($all_user);

      echo "<div>Number user: <span id='number_user'>".sizeof($all_user)."</span></div>";
    
      $arr_us_id = [];
      for($i = 0; $i < sizeof($all_user); $i++){
        $user_id = $all_user[$i][0];
        $user_name = $all_user[$i][1];
        $is_block = $all_user[$i][2];
        $user_type = '';
        if(isset($all_user[$i][3]))
          $user_type = $all_user[$i][3];

        array_push($arr_us_id, $user_id);


        echo "<div class='user_view'>";
          echo "<span class='user_name'>".$user_name."</span>";
          if(!empty($user_type))
            echo "<span class='user_type'>".$user_type."</span>";

          if($is_block == 'false')
            echo "<img title='block user' id='block-".$user_id."' class='option_user block_icon icon-120' src='public/icon/block_user_icon.png'>";
          else if($is_block == 'true')
            echo "<img title='unblock user' id='un_block-".$user_id."' class='option_user block_icon icon-120' src='public/icon/reload_icon.png'>";

          echo "<img title='view info user' id='info-".$user_id."' class='option_user view_info_icon icon-120' src='public/icon/info_icon.png'>";

          echo "<img title='message to user' id='mes-".$user_id."' class='option_user send_mes_icon icon-120' src='public/icon/message_add.png'>";

          if($_SESSION['user_type'] == 'admin'){
            echo "<img title='delete user' id='delete_user-".$user_id."' class='option_user send_mes_icon icon-120' src='public/icon/delete_icon_2.png'>";
  
            if($user_type == 'teacher'){
              echo "<img title='Un permission this Teacher' id='down_permission-".$user_id."' class='option_user send_mes_icon icon-120' src='public/icon/down_icon.png'>";
            }else
              echo "<img title='Permission this User' id='up_permission-".$user_id."' class='option_user send_mes_icon icon-120' src='public/icon/up_icon.png'>";
          }

        echo"</div><br>";

      }
      echo "<div id='us_id_ad' style='display: none'>";
        for($i = 0; $i < sizeof($arr_us_id); $i++){
          echo $arr_us_id[$i];
          if($i < sizeof($arr_us_id) -1)  echo ",";
        }
      echo "</div>";

      echo "<img title='add teacher' class='option_user btn_add_new_user add_user_icon icon-120' src='public/icon/add_user_icon.png'>";
    }
  
  ?>

  <div class="add_new_user">

    <form method='POST' action='./AdminPage/postNewUser'>
      <input type="text" name='new_tut_name' placeholder="Enter new name of tutorial">
      <input type="submit" value='add new tutorial'>
    </form>

  </div>

</div>

<div id='info_user_contain'>
    <div id='info_user'></div>
</div>