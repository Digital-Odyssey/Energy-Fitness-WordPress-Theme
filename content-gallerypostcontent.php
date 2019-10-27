<?php
/**
 * The default template for displaying a gallery post item.
 */
?>

<?php 

	global $energy_options;
	$showCaption = $energy_options['ppShowTitle'];
            
	$pm_gallery_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_image_meta', true);
	$pm_gallery_item_caption_meta = get_post_meta(get_the_ID(), 'pm_gallery_item_caption_meta', true);
	$pm_gallery_video_meta = get_post_meta(get_the_ID(), 'pm_gallery_video_meta', true);
	$pm_gallery_display_video_meta = get_post_meta(get_the_ID(), 'pm_gallery_display_video_meta', true);
	
	$pm_disable_share_feature = get_post_meta(get_the_ID(), 'pm_disable_share_feature', true);
	
?>


    
<div class="pm-gallery-post-container single">

	<img src="<?php echo esc_url(esc_html($pm_gallery_image_meta)); ?>" alt="<?php echo the_title(); ?>" />
    
    <div class="pm-gallery-post-like-diamond-shadow single-post"></div>
    <div class="pm-gallery-post-like-diamond"></div>
    <a href="#" class="pm-gallery-post-like-btn pm-like-this-btn fa fa-thumbs-up" id="<?php echo get_the_ID(); ?>"></a>
    <?php $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);?>
    <div class="pm-gallery-post-like-counter" id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>">
        <?php echo esc_attr($likes); ?>
    </div>
    
    <div class="pm-gallery-post-gradient" style="background-position:40px top;"></div>
    
    <div class="pm-gallery-post-details single-post">
                
        <div class="pm-gallery-post-details-diamond-shadow single-post"></div>
        <div class="pm-gallery-post-details-diamond single-post"></div>
        
        <?php if($pm_gallery_display_video_meta ==='yes' ) { ?>
            <!-- Display video -->
            <a href="<?php echo esc_html($pm_gallery_video_meta); ?>" data-rel="prettyPhoto" class="pm-gallery-post-view-btn single-post fa fa-video-camera expand lightbox" <?php echo $showCaption === 'true' ? 'title="'. esc_attr($pm_gallery_item_caption_meta) .'"' : '' ?>></a>
        <?php } else { ?>
            <!-- Display image -->
            <a href="<?php echo esc_html($pm_gallery_image_meta); ?>" data-rel="prettyPhoto" class="pm-gallery-post-view-btn single-post fa fa-camera expand lightbox" <?php echo $showCaption === 'true' ? 'title="'. esc_attr($pm_gallery_item_caption_meta) .'"' : '' ?>></a>
        <?php } ?>
                     
    </div>

</div>


<?php the_content(); ?>

<?php if($pm_disable_share_feature === 'no') : ?>
	<?php get_template_part('content','sharewithfriends'); ?>
<?php endif; ?>