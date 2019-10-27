<?php
/**
 * The default template for displaying a post item.
 */
?>

<?php 
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 
	  $pm_disable_share_feature = get_post_meta(get_the_ID(), 'pm_disable_share_feature', true);
	              
?>

<!-- Class post -->
<div class="pm-class-post single-post" role="program">

	<img src="<?php echo esc_url(esc_html($image_url[0])); ?>" alt="<?php the_title(); ?>" />
    
    <div class="pm-class-post-details-container single-post">

        <div class="pm-class-post-info single-post">
            
            <p class="title"><?php the_title(); ?></p>
            
            <div class="pm-class-post-divider"></div>
            
            
        </div>
        
    </div>
    
</div>
<!-- Class post end -->

<?php the_content(); ?>

<?php if($pm_disable_share_feature === 'no') : ?>
	<?php get_template_part('content','sharewithfriends'); ?>
<?php endif; ?>