<?php /* Template Name: Blog Template */ ?>
<?php get_header(); ?>

<?php 
	$getPageLayout = get_post_meta(get_the_ID(), 'pm_page_layout_meta', true);
	$pageLayout = $getPageLayout !== '' ? $getPageLayout : 'no-sidebar';
	
	$toggleAjaxLoadMorePosts = get_theme_mod('toggleAjaxLoadMorePosts', 'off');
	$posts_per_load = get_theme_mod('posts_per_load', '3');
?>


<?php
	//global $paged;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	if($toggleAjaxLoadMorePosts === 'on'){
		
		//Ajax args
		$arguments = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'paged' => $paged,
			'posts_per_page' => $posts_per_load,
			//'tag' => get_query_var('tag')
		);
		
		
	} else {
	
		//WordPress args
		$arguments = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'paged' => $paged,
			//'tag' => get_query_var('tag')
		);
		
	}

	$blog_query = new WP_Query($arguments);

	pm_ln_set_query($blog_query);
?>

<div class="container pm-containerPadding-top-90 pm-containerPadding-bottom-60" role="pm-posts-container">
    <div class="row">

		<?php if($pageLayout === 'no-sidebar') { ?>
        
        	<div class="col-lg-12 col-md-12 col-sm-12 pm-main-posts">
            
            	<div id="pm-post-item-container">
            
					<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
                        <?php get_template_part( 'content', 'post' ); ?>
                    
                    <?php endwhile; else: ?>
                         <p><?php esc_attr_e('No posts were found.', 'energytheme'); ?></p>
                    <?php endif; ?> 
                                    
                </div>
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
                <?php pm_ln_restore_query(); ?> 
            
            </div>
            
        <?php }  ?>
        
        <?php if($pageLayout === 'right-sidebar') {?>
                        
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-8 pm-main-posts sidebar">
            
            	<div id="pm-post-item-container">
            
					<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
                        <?php get_template_part( 'content', 'post' ); ?>
                    
                    <?php endwhile; else: ?>
                         <p><?php esc_attr_e('No posts were found.', 'energytheme'); ?></p>
                    <?php endif; ?> 
                                        
                    
                
                </div>
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
                <?php pm_ln_restore_query(); ?> 
                            
             </div>
            
            
             <!-- Right Sidebar -->
             <?php get_sidebar(); ?>
             <!-- /Right Sidebar -->
             
        <?php }  ?>
        
        <?php if($pageLayout === 'left-sidebar') { ?>
                
        	 <!-- Left Sidebar -->
             <?php get_sidebar(); ?>
             <!-- /Left Sidebar -->
        
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-8 pm-main-posts sidebar">
            
            	<div id="pm-post-item-container">
            
					<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
                        <?php get_template_part( 'content', 'post' ); ?>
                    
                    <?php endwhile; else: ?>
                         <p><?php esc_attr_e('No posts were found.', 'energytheme'); ?></p>
                    <?php endif; ?> 
                                         
                </div>
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
                <?php pm_ln_restore_query(); ?> 
            
            </div>
        
        <?php }  ?>
    
	</div> <!-- /row -->
</div> <!-- /container -->

<?php get_footer(); ?>