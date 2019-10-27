<?php
/**
 * The default template for displaying an event post item.
 */
?>

<?php 
            
	if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	}
	
	$pm_event_date_meta = get_post_meta(get_the_ID(), 're_start_date_event', true);
	$month = date_i18n("M", strtotime($pm_event_date_meta));
	$day = date_i18n("d", strtotime($pm_event_date_meta));
	$year = date_i18n("Y", strtotime($pm_event_date_meta));
	$pm_event_fan_page_meta = get_post_meta(get_the_ID(), 'pm_event_fan_page_meta', true);
	
	$display_event_info = get_post_meta(get_the_ID(), 'display_event_info', true);	
	
	//add a default value as this was a later addition
	if( empty($display_event_info) ) :
	   $display_event_info = 'yes';
	endif;
	
	$allday_eve = get_post_meta(get_the_ID(), 'allday_eve', true);
	$pm_event_start_time_meta = get_post_meta(get_the_ID(), 're_start_time', true);
	$pm_event_end_time_meta = get_post_meta(get_the_ID(), 're_end_time', true);
	$pm_reoc_event = get_post_meta(get_the_ID(), 'reoc_event', true);
	
	$todaysDate = date_i18n( 'Y-m-d' ); //This date format is required by WordPress to match dates
	
?>

<?php 
$terms = get_the_terms($post->ID, 'event_categoriess' );
$terms_slug_str = '';
if ($terms && ! is_wp_error($terms)) :
	$term_slugs_arr = array();
	foreach ($terms as $term) {
	    $term_slugs_arr[] = $term->slug;
	}
	$terms_slug_str = join( " ", $term_slugs_arr);
endif;
?>

<!-- Event post -->
<div class="pm-isotope-item col-lg-4 col-md-6 col-sm-12 col-xs-12 <?php echo $terms_slug_str != '' ? esc_attr($terms_slug_str) : ''; ?> all">
    
    <div class="pm-event-post-container">
    
        <div class="pm-event-post-img-container" style="background-image:url(<?php echo esc_html($image_url[0]); ?>);">
                
            <div class="pm-event-post-img-diamond-shadow"></div>
            <div class="pm-event-post-img-diamond"></div>
            
            <div class="pm-event-post-img-diamond-date">
            
            	<?php if( $display_event_info === 'yes' ) { ?>
                
                	<?php if($pm_reoc_event !== 'once') : ?>
                
                        <i class="fa fa-calendar"></i>
                    
                    <?php else : ?>
                    
                        <p class="month"><?php echo esc_attr($month); ?></p>
                        <p class="day"><?php echo esc_attr($day); ?></p>
                    
                    <?php endif; ?>
                
                <?php } else { ?>
                
                	<i class="fa fa-calendar"></i>
                
                <?php } ?>
                
            </div>
            
            <div class="pm-event-post-img-title">
                <p><?php the_title(); ?></p>
            </div>
        
        </div>
    
        <div class="pm-event-post-details">
            <p class="name"><?php esc_attr_e('Organized by','energytheme'); ?> <?php the_author(); ?></p>
            <div class="pm-divider event"></div>
            
            <?php //echo $pm_reoc_event; ?>
            
            <?php if( $display_event_info === 'yes' ) : ?>
            
            	<?php if($pm_reoc_event === 'once' && $pm_event_date_meta < $todaysDate) : ?>
            
                        <p class="time"><b><?php esc_attr_e('This event has ended','energytheme'); ?></b></p>
                
                <?php else : ?>
                
                    <?php if($allday_eve) : ?>
                        <p class="time"><b><?php esc_attr_e('All day event','energytheme'); ?></b></p>
                    <?php elseif($pm_event_start_time_meta !== '') : ?>
                        <p class="time"><b><?php esc_attr_e('Start:','energytheme'); ?></b> <?php echo esc_attr($pm_event_start_time_meta) ?> <b><?php esc_attr_e('End:','energytheme'); ?></b> <?php echo esc_attr($pm_event_end_time_meta); ?></p>
                    <?php endif; ?>
                
                <?php endif; ?>
            
            <?php endif; ?>
			            
            <a href="<?php the_permalink(); ?>" class="pm-square-btn event"><?php esc_attr_e('View event info','energytheme'); ?></a>            
            
            <?php if($pm_event_fan_page_meta !== '') : ?>
            
            	<a href="<?php echo esc_attr($pm_event_fan_page_meta); ?>" class="pm-square-btn facebook" target="_blank"><i class="fa fa-facebook"></i></a>
            
            <?php endif; ?>
            
        </div>
    
    </div>	
    
</div>
<!-- Event post end -->