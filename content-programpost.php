<?php
/**
 * The default template for displaying a post item.
 */
?>

<?php 
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	              
?>

<!-- Column 1 -->
<div class="col-lg-4 col-md-6 col-sm-12">
    
    <!-- Class post -->
    <div class="pm-class-post" role="program" style="background-image:url(<?php echo esc_html($image_url[0]); ?>);">
        
        <div class="pm-class-post-details-container">
            
            <a href="#" class="pm-class-post-details-btn fa fa-chevron-up">
                <div class="pm-class-post-diamond-shadow"></div>
                <div class="pm-class-post-diamond"></div>
            </a>
            
            <div class="pm-class-post-info">
                
                <p class="title"><?php the_title(); ?></p>
                
                <div class="pm-class-post-divider"></div>
                
                <?php $excerpt = get_the_excerpt(); ?>
                
                <p class="excerpt"><?php echo pm_ln_string_limit_words($excerpt, 20); ?> <a href="<?php the_permalink(); ?>">[...]</a></p>
                
                <a href="<?php the_permalink(); ?>" class="pm-square-btn"><?php esc_attr_e('Read more', 'energytheme') ?></a>
                
            </div>
            
        </div>
        
    </div>
    <!-- Class post end -->
    
</div>
<!-- Column 1 end -->