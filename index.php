<?php /* Template Name: Blog Template */ ?>
<?php get_header(); ?>

<?php 
$gethomePageLayout = get_theme_mod('homepageLayout');
$homepageLayout = $gethomePageLayout !== '' ? $gethomePageLayout : 'no-sidebar';

?>

<div class="container pm-containerPadding-top-100 pm-containerPadding-bottom-50">
    <div class="row">

		<?php if($homepageLayout === 'no-sidebar') { ?>
        
        	<div class="col-lg-12 col-md-12 col-sm-12 pm-main-posts">
            
            	<div id="pm-post-item-container">
            
					<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                    
                        <?php get_template_part( 'content', 'post' ); ?>
                    
                    <?php }//end of posts ?>
            
                    <?php } else { ?>
                         <p><?php esc_attr_e('No posts were found.', 'energytheme'); ?></p>
                    <?php } ?> 
                                    
                </div>
                
                <?php get_template_part( 'content', 'pagination' ); ?>
            
            </div>
        
        <?php } else if($homepageLayout === 'right-sidebar') {?>
                
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-8 pm-main-posts">
            
            	<div id="pm-post-item-container">
            
					<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                    
                        <?php get_template_part( 'content', 'post' ); ?>
                    
                    <?php }//end of posts ?>
            
                    <?php } else { ?>
                         <p><?php esc_attr_e('No posts were found.', 'energytheme'); ?></p>
                    <?php } ?> 
                                    
                </div>
                
                <?php get_template_part( 'content', 'pagination' ); ?>
            
            </div>
            
             <!-- Right Sidebar -->
             <?php get_sidebar('home'); ?>
             <!-- /Right Sidebar -->
        
        <?php } else if($homepageLayout === 'left-sidebar') { ?>
                
        	 <!-- Left Sidebar -->
             <?php get_sidebar('home'); ?>
             <!-- /Left Sidebar -->
        
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-8 pm-main-posts">
            
            	<div id="pm-post-item-container">
            
					<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                    
                        <?php get_template_part( 'content', 'post' ); ?>
                    
                    <?php }//end of posts ?>
            
                    <?php } else { ?>
                         <p><?php esc_attr_e('No posts were found.', 'energytheme'); ?></p>
                    <?php } ?> 
                                    
                </div>
                
                <?php get_template_part( 'content', 'pagination' ); ?>
            
            </div>
                    
        <?php } else {//default full width layout ?>
        
        	<div class="col-lg-12 col-md-12 col-sm-12 pm-main-posts">
            
            	<div id="pm-post-item-container">
            
					<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                    
                        <?php get_template_part( 'content', 'post' ); ?>
                    
                    <?php }//end of posts ?>
            
                    <?php } else { ?>
                         <p><?php esc_attr_e('No posts were found.', 'energytheme'); ?></p>
                    <?php } ?> 
                                    
                </div>
                
                <?php get_template_part( 'content', 'pagination' ); ?>
            
            </div>
        
        <?php }  ?>
    
	</div> <!-- /row -->
</div> <!-- /container -->
<?php get_footer(); ?>