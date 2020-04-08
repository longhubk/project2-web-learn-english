<div id="ver_nav" class="ver-bar">
	<ul>
		<?php
		if (isset($_GET['tutorial'])) {
			if ($_GET['tutorial'] == "all_tutorial") {
				foreach ($allTuts as $tutorial => $name)
					$tut_item_url = $tut_url . "&tutorial=$tutorial_all&name_tutorial=$tutorial";
					echo "<li><a href='index.php?tutorial=$tutorial'>$name</a></li>";
			}
			else{
				foreach ($tutContent as $tutorial => $name) {
					if (isset($_GET['tutorial'])) {
						$tutorial_all = $_GET['tutorial'];
						$tut_item_url = $each_url . "&tutorial=$tutorial_all&name_tutorial=$tutorial";
						echo "<li><a href=$tut_item_url>$name</a></li>";
					} else
						echo "<li><a href='index.php?name_tutorial=$tutorial'>$name</a></li>";
				}
			}
		} else if (isset($_GET["homepage"])) {
			
				foreach($menu_user as $user_item => $name){
					$path_item = $url . "&user=$user_item";
				 echo "<li><a href=". $path_item .">$name</a></li>";   
			}
		}

		?>
	</ul>
</div>