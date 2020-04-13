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
				$tut_name = $data['tut_name'];
				foreach ($tutContent as $lesson => $name) {
						echo "<li><a href='./Tut/One/$tut_name/" . $lesson."'>$name</a></li>";
				}
			}
			else
			if(isset($data['allTuts'])){
				$allTuts = $data['allTuts'];
				foreach ($allTuts as $tutorial => $name)
					echo "<li><a href='./Tut/One/".$tutorial."'>$name</a></li>";
			}

		?>
	</ul>
</div>