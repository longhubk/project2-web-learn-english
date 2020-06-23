<?php

	if(isset($data['user_list'])){
		$user_list = $data['user_list'];
		for($i = 0; $i < sizeof($user_list); $i++){
			echo $user_list[$i][0] . ",";
		}
	}
	else{
		echo 'not have user';

	}

 ?>