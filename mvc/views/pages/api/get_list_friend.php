
<?php
  if(isset($data['friend_list'])){
    // var_dump($data['friend_list']);
    $content_friend = '
      <table>
        <tr class="first_row">
          <td>Name</td>
          <td>Status</td>
          <td>Action</td>
        </tr>
    ';
    $friend_list = $data['friend_list'];
  $friend_la = $data['last_active'];
  $count_unseen = $data['count_unseen'];
  // var_dump($count_unseen);
	date_default_timezone_set('Asia/Ho_Chi_Minh');
    for($i = 0; $i < sizeof($friend_list); $i++){

	  $status = '';
	  $curr_time = strtotime(date('Y-m-d H:i:s') . '-10 second');
	  //echo "curr time: ". $curr_time . "<br>";
	  $curr_time = date('Y-m-d H:i:s', $curr_time);
	  //echo "curr time: ". $curr_time . "<br>";
	  $user_last_active = $friend_la[$i][1];
	  //echo $user_last_active;
	  
	  if($user_last_active > $curr_time){
		$status = '<span class="label_online">Online</span>';
		//echo "sucess<br>";
	  }else{
		$status = '<span class="label_offline">Offline</span>';
		//echo "fail<br>";
	  }

	  $content_friend .='
        <tr class="switch">
          <td>'.$friend_list[$i][1].' '.$count_unseen[$i].'</td>
          <td>'.$status.'</td>
          <td><button class="start_chat" id="chat_to-'.$friend_list[$i][0].'" data-toFriendId="'.$friend_list[$i][0].'"  data-toFriendName="'.$friend_list[$i][1].'">Start Chat</button></td>
        </tr>

      
      ';
    }
    $content_friend .= "</table>";

    echo $content_friend;

  }else{
    echo "you don't have any friend";
  }

?>