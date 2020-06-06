
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
        array_push($arr_us_id, $user_id);


        echo "<div class='user_view'>";
          echo "<span class='user_name'>".$user_name."</span>";
          if($is_block == 'false')
            echo "<a><img title='block user' id='block-".$user_id."' class='option_user block_icon icon-120' src='public/icon/block_user_icon.png'>";
          else if($is_block == 'true')
            echo "<img title='block user' id='un_block-".$user_id."' class='option_user block_icon icon-120' src='public/icon/reload_icon.png'>";

          echo "<img title='view info user' id='info-".$user_id."' class='option_user view_info_icon icon-120' src='public/icon/info_icon.png'>";

          echo "<img title='message to user' id='mes-".$user_id."' class='option_user send_mes_icon icon-120' src='public/icon/message_add.png'>";
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

    <form method='POST' action='./HomeAdmin/postNewUser'>
      <input type="text" name='new_tut_name' placeholder="Enter new name of tutorial">
      <input type="submit" value='add new tutorial'>
    </form>

  </div>

</div>