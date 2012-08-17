
<div class="main-content">
	<?php 
	if(file_exists($view->get_template())){
		include($view->get_template());
	}
	?>
</div>