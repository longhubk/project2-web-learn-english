<?php 

	if(isset($data['list_user'])){
		$list_user = $data['list_user'];
		$out = "";
		$text_search = "";
		if(isset($data['text_search']))
			$text_search = $data['text_search'];
		// var_dump($list_user);

		$out .= "<table>";
		for($i = 0; $i < sizeof($list_user); $i++ ){
			if(!preg_match('/'.$text_search.'/', $list_user[$i][1])){
				unset($list_user[$i]);
			}else{

					$out .= "<tr>";
				if($list_user[$i][2] == 'friend')
				{
					$out .= "<td><span>".$list_user[$i][1]."</span></td>";
					$out .= "<td><button class='btn_friend' id='un_friend-".$list_user[$i][0]."'>unfriend</button></td>";
				}else{
					$out .= "<td><span>".$list_user[$i][1]."</span></td>";
					$out .= "<td><button class='btn_friend' id='add_friend-".$list_user[$i][0]."'>add friend</button><td>";
				}
					$out .= "</tr>";
			}
		}
		$out .= "</table>";



		echo $out;
	}


?>