<?php
/**
 * Use this file to quickly insert pagination where necessary
 */
 
?>


<div class="col-lg-12">

<?php 
            
	if(function_exists('pm_ln_kriesi_pagination')){
		pm_ln_kriesi_pagination();
	} else {
		posts_nav_link();	
	} 

?>

</div>