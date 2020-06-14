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
					echo "<li><a href='./TutorialPage/Lesson/$tut_name/" . $tutContent[$i][0]."'>".$tutContent[$i][1]."</a></li>";
				
			}
			else
			// else
			// if(isset($data['all_tuts'])){
			// 	$all_tuts = $data['all_tuts'];
			// 	for($i = 0; $i < sizeof($all_tuts); $i++)
			// 		echo "<li><a href='./TutorialPage/Lesson/".$all_tuts[$i][1]."'>".$all_tuts[$i][0]."</a></li>";
				
			// }

			if(isset($data['all_tuts'])){
				$all_tuts = $data['all_tuts'];

				for($i = 0; $i < sizeof($all_tuts); $i++){
					echo "<li><a href='./TutorialPage/Lesson/".$all_tuts[$i][5]."'>".$all_tuts[$i][1]."</a>";

				if(!empty($data['is_lock'])){
					$is_lock = $data['is_lock'];
					if(!empty($is_lock[$i][0]) && !empty($is_lock[$i][0])){
						if($is_lock[$i][1] == $all_tuts[$i][0] && $is_lock[$i][0] == 'lock')
							echo "<img class='icon-20' src='public/icon/lock_icon.png'>";
					}
					else
							echo "<img class='icon-20' src='public/icon/lock_icon.png'>";

				}

					echo "</li>";
				}
				
			}

			else
			if(isset($data['allDocCatalog'])){
				$allDocCatalog = $data['allDocCatalog'];
				for($i = 0; $i < sizeof($allDocCatalog); $i++)
					echo "<li><a href='./DocsPage/expands/".$allDocCatalog[$i][2]."'>".$allDocCatalog[$i][1]."</a></li>";
			}

		?>
	</ul>
</div>