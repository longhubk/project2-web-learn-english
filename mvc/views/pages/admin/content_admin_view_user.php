
<div class="admin_container">
  <h2>All Current User:</h2>

  <?php
    if(isset($data['all_user'])){
      $all_user = $data['all_user'];
      // var_dump($all_user);
    
      for($i = 0; $i < sizeof($all_user); $i++){
        $user_id = $all_user[$i][0];
        $user_name = $all_user[$i][1];
        echo "<div class='user_view'>";
          echo "<span class='user_name'>".$user_name."</span>";
          echo "<i class='option_user block_icon material-icons'>&#xe14b;</i>";
          echo "<i class='option_user view_info_icon material-icons'>&#xe88e;</i>";
          echo "<i class='option_user send_mes_icon material-icons'>&#xe0c9;</i>";
        echo"</div><br>";
        
      }

      echo "<i class='option_user btn_add_new_user add_user_icon material-icons'>&#xe7fe;</i>";
    }
  
  ?>

  <div class="add_new_user">

    <form method='POST' action='./HomeAdmin/postNewUser'>
      <input type="text" name='new_tut_name' placeholder="Enter new name of tutorial">
      <input type="submit" value='add new tutorial'>
    </form>

  </div>

</div>