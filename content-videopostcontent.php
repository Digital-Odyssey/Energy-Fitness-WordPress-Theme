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
	
	$pm_disable_share_feature = get_post_meta(get_the_ID(), 'pm_disable_share_feature', true);
	
	$videoID = pm_ln_parse_youtube_id($pm_video_youtube_id_meta);
	
?>


<iframe src="https://www.youtube.com/embed/<?php echo $videoID; ?>" height="500" allowfullscreen></iframe>


<?php the_content(); ?>

<?php if($pm_disable_share_feature === 'no') : ?>
	<?php get_template_part('content','sharewithfriends'); ?>
<?php endif; ?>