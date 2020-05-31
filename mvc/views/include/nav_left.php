<div id="ver_nav" class="ver-bar">
	<ul>
		<?php
			
			if(isset($data['menu_user'])){
				$menu_user = $data['menu_user'];
				foreach($menu_user as $user_item => $name){
					echo "<li><a href='./UserPage/".$user_item."'>$name</a></li>";   
				}
			}
			else
			if(isset($data['tutContent'])){
				$tutContent = $data['tutContent'];
				// var_dump($tutContent);
				$tut_name = $data['tut_name'];
				for($i = 0; $i < sizeof($tutContent); $i++)
					echo "<li><a href='./Tut/One/$tut_name/" . $tutContent[$i][0]."'>".$tutContent[$i][1]."</a></li>";
				
			}
			else
			if(isset($data['allTuts'])){
				$allTuts = $data['allTuts'];
				for($i = 0; $i < sizeof($allTuts); $i++)
					echo "<li><a href='./Tut/One/".$allTuts[$i][1]."'>".$allTuts[$i][0]."</a></li>";
				
			}

		?>
	</ul>
</div>