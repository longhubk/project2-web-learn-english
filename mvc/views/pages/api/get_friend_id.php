<?php

	if(isset($data['friend_list'])){
		$friend_list = $data['friend_list'];
		for($i = 0; $i < sizeof($friend_list); $i++){
			echo $friend_list[$i][0] . ",";
		}
	}
	else{
		echo 'not have friend';

	}

 ?>