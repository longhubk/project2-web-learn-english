<div id="ver_nav" class="ver-bar">
	<ul>
		<?php
		if (isset($_GET['tutorial'])) {
			if ($_GET['tutorial'] == "all_tutorial") {
				include "../php/tutorials/all_tutorial_prs.php";
			} else
				include "../php/tutorials/grammar_prs.php";
		} else if(isset($_GET["homepage"])){
				include "../php/tutorials/user_page_prs.php";
		}

		?>
	</ul>
</div>