

<div class='main-container'>

  <div class="user_info_page">
  <?php

    if(isset($data['friend_request'])){
      $fri_req = $data['friend_request'];
      // var_dump($fri_req);

        $tb1 = 
          "<table  class='table_style1'>
            <tr class='first_row'>
              <td colspan='3'>Friend send request to you</td>
            </tr>";
        for($i = 0; $i < sizeof($fri_req); $i++){
          $tb1 .= "<tr>
            <td>".$fri_req[$i][1]."</td>
            <td><button id = 'accept_rq-".$fri_req[$i][0]."'>accept</button></td>
            <td><button id = 'remove_rq-".$fri_req[$i][0]."'>remove</button></td>
          </tr>";
        }
        $tb1 .= "</table>";
        echo $tb1;
    }

    echo "<hr>";

    if(isset($data['my_request'])){
      $my_req = $data['my_request'];
      // var_dump($my_req);
        $tb1 = 
          "<table class='table_style1'>
            <tr class='first_row'>
              <td colspan='2'>You friend request</td>
            </tr>";
        for($i = 0; $i < sizeof($my_req); $i++){
          $tb1 .= 
          "<tr>
            <td>".$my_req[$i][1]."</td>
            <td><button id = 'remove_rq-".$my_req[$i][0]."'>remove</button></td>
          </tr>";
        }
        $tb1 .= "</table>";
        echo $tb1;
    }


  ?>

  </div>
</div>