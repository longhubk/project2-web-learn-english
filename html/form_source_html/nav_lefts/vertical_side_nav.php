<div id="ver_nav" class="ver-bar">
  <ul>
		<?php 
			if(isset($_GET['name_tutorial']))
			{
				$get_tutorial_global = $_GET['name_tutorial'];
				$path_tutoral = "../../php/tutorials/" . $get_tutorial_global . "_prs.php";
				include $path_tutoral;
			}else{
				include "../../php/tutorials/all_tutorial_prs.php";
			}
		
		?> 
  </ul>
</div>