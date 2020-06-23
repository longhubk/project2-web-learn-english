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
      if(isset($data['all_test'])){
        $all_test = $data['all_test'];
          if(!empty($all_test)){
            for($i = 0; $i < sizeof($all_test); $i++){
              $name_test    = $all_test[$i][1];
              echo "<li id='test-small".$i."'><label>".$name_test."</label></li>";
            }
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
			if(isset($data['allDocCategory'])){
				$allDocCategory = $data['allDocCategory'];
				for($i = 0; $i < sizeof($allDocCategory); $i++)
					echo "<li><a href='./DocsPage/".$allDocCategory[$i][2]."'>".$allDocCategory[$i][1]."</a></li>";
			}
			else
			if(isset($data['all_doc_list'])){
				$allDocList = $data['all_doc_list'];
				$doc_ca_name = $data['doc_ca_name'];
				for($i = 0; $i < sizeof($allDocList); $i++)
					echo "<li><a href='./DocsPage/Read/".$doc_ca_name."/".$allDocList[$i][5]."'>".$allDocList[$i][3]."</a></li>";
			}
			else
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


		?>
	</ul>
</div>