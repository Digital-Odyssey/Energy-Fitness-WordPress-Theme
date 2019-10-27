<?php
/**
 * The default template for displaying a gallery post item.
 */
?>

<?php 

	global $energy_options;
	$showCaption = $energy_options['ppShowTitle'];
            
	$pm_video_thumbnail_image_meta = get_post_meta(get_the_ID(), 'pm_video_thumbnail_image_meta', true);
	$pm_video_youtube_id_meta = get_post_meta(get_the_ID(), 'pm_video_youtube_id_meta', true);
	$pm_video_display_youtube_thumbnail_meta = get_post_meta(get_the_ID(), 'pm_video_display_youtube_thumbnail_meta', true);
	
	
?>

<?php 
$terms = get_the_terms($post->ID, 'videocats' );
$terms_slug_str = '';
if ($terms && ! is_wp_error($terms)) :
	$term_slugs_arr = array();
	foreach ($terms as $term) {
	    $term_slugs_arr[] = $term->slug;
	}
	$terms_slug_str = join( " ", $term_slugs_arr);
endif;
?>

<!-- Gallery post -->
<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 pm-isotope-item <?php echo $terms_slug_str != '' ? esc_attr($terms_slug_str) : ''; ?> all">
    
    
    <?php if($pm_video_display_youtube_thumbnail_meta === 'yes') { ?>
    
    	<?php $youtubeThumb = pm_ln_parse_yturl($pm_video_youtube_id_meta);  ?>
    
    	<div class="pm-gallery-post-container" style="background-image:url(<?php echo 'http://img.youtube.com/vi/'.$youtubeThumb.'/0.jpg;' ?>);">
    
    <?php } else { ?>
    
    	<div class="pm-gallery-post-container" style="background-image:url(<?php echo esc_html($pm_video_thumbnail_image_meta); ?>);">
    
    <?php } ?>
    
        <div class="pm-gallery-post-title-container">
            <p><?php the_title(); ?></p>
            <a href="#" class="pm-expand-gallery-post fa fa-expand"></a>
        </div>
        
        <div class="pm-gallery-post-like-diamond-shadow"></div>
        <div class="pm-gallery-post-like-diamond"></div>
        <a href="#" class="pm-gallery-post-like-btn pm-like-this-btn fa fa-thumbs-up" id="<?php echo get_the_ID(); ?>"></a>
        <?php $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);?>
        <div class="pm-gallery-post-like-counter" id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>">
            <?php echo esc_attr($likes); ?>
        </div>
        
        <div class="pm-gallery-post-gradient"></div>
        
        <div class="pm-gallery-post-details">
            
            <div class="pm-gallery-post-details-excerpt">
            	<?php $excerpt = get_the_excerpt(); ?>
                <p><?php echo pm_ln_string_limit_words($excerpt, 30); ?> <a href="<?php the_permalink(); ?>">[...]</a></p>
            </div>
            
            <div class="pm-gallery-post-details-diamond-shadow"></div>
            <div class="pm-gallery-post-details-diamond"></div>
            
            <!-- Display video -->
            <a href="<?php echo esc_attr($pm_video_youtube_id_meta); ?>" data-rel="prettyPhoto[video]" class="pm-gallery-post-view-btn fa fa-video-camera expand lightbox" <?php echo $showCaption === 'true' ? 'title="'. get_the_title() .'"' : '' ?>></a>
                        
            <ul class="pm-gallery-post-details-actions">
                <li>
                    <a href="#" class="pm-gallery-post-close fa fa-chevron-left"></a>
                </li>
                <li><a href="<?php the_permalink(); ?>" class="pm-gallery-post-view-more"><?php esc_attr_e('View Post', 'energytheme'); ?></a></li>
            </ul>
            
        </div>
    
    </div>
    
</div>
<!-- Gallery post end -->