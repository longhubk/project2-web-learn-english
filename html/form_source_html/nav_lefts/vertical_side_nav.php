<div id="ver_nav" class="ver-bar">
  <ul>
		<?php 
			if(isset($_GET['tutorial']))
			{
				$get_tutorial_global = $_GET['tutorial'];
				$path_tutorial = "../../php/tutorials/" . $get_tutorial_global . "_prs.php";
				include $path_tutorial;
			}else{
				include "../../php/tutorials/all_tutorial_prs.php";
			}
		
		?> 
  </ul>
</div>