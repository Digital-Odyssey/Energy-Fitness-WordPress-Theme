<?php get_header(); ?>

<?php 
	$getPageLayout = get_post_meta(get_the_ID(), 'pm_page_layout_meta', true);
	$pageLayout = !empty($getPageLayout) ? $getPageLayout : 'no-sidebar';
	
	$disableContainer = get_post_meta(get_the_ID(), 'pm_page_disable_container_meta', true);
	$disableContainer == '' ? 'no' : $disableContainer;
	
	$getBootstrapContainerPadding = get_post_meta(get_the_ID(), 'pm_bootstrap_container_padding_meta', true);
	$bootstrapContainerPadding = $getBootstrapContainerPadding !== '' ? $getBootstrapContainerPadding : '80';
		
	$printAndShareOptions = get_post_meta(get_the_ID(), 'pm_page_print_share_meta', true);
	
?>

<?php if($pageLayout === 'no-sidebar') { //Render col-lg-12 ?>

		<?php 
			global $has_sidebar;  //we use this for woocommerce product loop
			$has_sidebar = false;
		?>

		<?php if($disableContainer === 'yes') { ?>
        
        	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
		    	<?php the_content(); ?>
            <?php endwhile; else: ?>
            	<p><?php echo esc_attr_e('No content was found.', 'energytheme'); ?></p>
            <?php endif; ?>
           
            <?php
				
				if($printAndShareOptions == 'on') {?>
                    <div class="pm-column-container container pm-containerPadding-bottom-60">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
								<?php
                                	get_template_part('content', 'pageoptions');
                                ?>
                    		</div>
                    	</div>
                    </div>
                    <?php
				}
				
			?>
        
        <?php } else { ?>
        
        	<div class="container pm-containerPadding-bottom-<?php echo $bootstrapContainerPadding; ?>">
          		<div class="row">
                	<div class="col-lg-12 col-md-12 col-sm-12">
                    	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
							<?php the_content(); ?>
                        <?php endwhile; else: ?>
                            <p><?php echo esc_attr_e('No content was found.', 'energytheme'); ?></p>
                        <?php endif; ?>
                        
                        <?php
						
							if($printAndShareOptions === 'on') {
								get_template_part('content', 'pageoptions');
							}
							
						?>
                                                
                    </div>
                </div>
            </div>
        
        <?php } ?>

<?php } ?>

<?php if($pageLayout === 'left-sidebar') { ?>

		<?php 
			global $has_sidebar;  //we use this for woocommerce product loop
			$has_sidebar = true;
		?>

		<div class="container pm-containerPadding60">
          	<div class="row">
            	<?php get_sidebar(); ?>
        
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; else: ?>
                        <p><?php echo esc_attr_e('No content was found.', 'energytheme'); ?></p>
                    <?php endif; ?>
                    
                    <?php
						
						if($printAndShareOptions == 'on') {
							get_template_part('content', 'pageoptions');
						}
						
					?>
                                        
                </div>
            </div>
        </div>

<?php } ?>

<?php if($pageLayout === 'right-sidebar') { ?>

		<?php 
			global $has_sidebar; //we use this for woocommerce product loop
			$has_sidebar = true;
		?>
        
        <div class="container pm-containerPadding60">
          	<div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; else: ?>
                        <p><?php echo esc_attr_e('No content was found.', 'energytheme'); ?></p>
                    <?php endif; ?>
                    
                    <?php
						
						if($printAndShareOptions == 'on') {
							get_template_part('content', 'pageoptions');
						}
						
					?>
                    
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>

<?php } ?>

<?php get_footer(); ?>