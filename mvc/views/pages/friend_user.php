
<div class='main-container'>

  <div class="user_info_page">
  <?php
    if(isset($data['user_id'])){
      echo "<div id='user_send_id'>".$data['user_id']."</div>";
    }
  
    if(isset($data['friend_data'])){
      var_dump($friend);
      $data_friend = $data['friend_data'];
      echo "
        <table>
          <th>
            <td>name</td>
            <td>message</td>
            <td>view info</td>
          </th>";
      for($i = 0; $i < sizeof($data['friend_data']); $i++){
        echo "
          <tr>
            <td>".$data_friend[$i][0]."</td>
            <td><button id='mes_".$data_friend[$i][1]."'><img class='icon-120' src='public/icon/message_icon.png'></button></td>
            <td><button id='info_".$data_friend[$i][1]."'><img class='icon-120' src='public/icon/info_user_icon.png'></button></td>
          </tr>
        
        ";
      }

      echo "</table>";
    }
    else{
      
      echo "<button id='btn_find_friend' ><img class='icon-120' src='public/icon/add_user_icon.png'></button>";
      echo "<div id='toggle_find_friend'>
        <input id='input_find_friend' type='text' placeholder='Enter name user'>
        <button id='btn_search_friend' value='find'>find</button>
        </div><br><br>";
      echo "
        <div id='list_user'>

        </div>
      ";
    }

  
  ?>

  </div>
</div>