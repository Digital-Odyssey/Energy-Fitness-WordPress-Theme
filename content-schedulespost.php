<?php
/**
 * The default template for displaying a schedule post item.
 */
?>

<?php 
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 
	 $re_start_date_event = get_post_meta(get_the_ID(), 're_start_date_event', true);
	 $month = date_i18n("M", strtotime($re_start_date_event));
	 $day = date_i18n("d", strtotime($re_start_date_event));
	 $year = date_i18n("Y", strtotime($re_start_date_event));
	 
	 $display_schedule_info = get_post_meta(get_the_ID(), 'display_schedule_info', true);	
	 
	 //add a default value as this was a later addition
	 if( empty($display_schedule_info) ) :
	 	$display_schedule_info = 'yes';
	 endif;
	 
	 $allday_eve = get_post_meta(get_the_ID(), 'allday_eve', true);
	 $re_start_time = get_post_meta(get_the_ID(), 're_start_time', true);
	 $re_end_time = get_post_meta(get_the_ID(), 're_end_time', true);
	 $pm_schedule_location_meta = get_post_meta(get_the_ID(), 'pm_schedule_location_meta', true);
	 $pm_schedule_cancellation_meta = get_post_meta(get_the_ID(), 'pm_schedule_cancellation_meta', true);
	 $pm_reoc_event = get_post_meta(get_the_ID(), 'reoc_event', true);
	 
	 $todaysDate = date_i18n( 'Y-m-d' ); //This date format is required by WordPress to match dates
	              
?>

<!-- Schedule post 6 -->
<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 pm-isotope-item">
    
    <div class="pm-schedule-post-container" style="background-image:url(<?php echo esc_html($image_url[0]); ?>);">
    
        <a href="#" class="pm-schedule-post-expand-btn fa fa-chevron-up"></a>
    
        <div class="pm-schedule-post-info-container">
            
            <div class="pm-schedule-post-info">
                
                <p class="title"><?php the_title(); ?></p>
                
                <?php if( $display_schedule_info === 'yes' ) : ?>
                
                	<?php if($pm_schedule_cancellation_meta === 'yes') { ?>
                        <p class="time"><?php esc_attr_e('Cancelled', 'energytheme');  ?></p>
                    <?php } else { ?>
                        <p class="time"><?php echo esc_attr($re_start_time); ?> - <?php echo esc_attr($re_end_time); ?> / <?php echo esc_attr($pm_schedule_location_meta); ?></p>
                    <?php } ?>
                
                <?php endif; ?>
                                
                <?php $excerpt = get_the_excerpt(); ?>
                
                <p class="excerpt"><?php echo pm_ln_string_limit_words($excerpt, 15); ?> <a href="<?php the_permalink(); ?>">[...]</a></p>
                
                <?php if($pm_schedule_cancellation_meta === 'yes') { ?>
                
                	<a href="<?php the_permalink(); ?>" class="pm-square-btn schedule-btn"><?php esc_attr_e('View info','energytheme'); ?></a>
                    
                <?php } else { ?>
                
                	<a href="<?php the_permalink(); ?>" class="pm-square-btn schedule-btn"><?php esc_attr_e('View Details','energytheme'); ?></a>
                	
                <?php } ?>
                
            </div>
            
        </div>
        
        <div class="pm-schedule-post-diamond-shadow"></div>
        <div class="pm-schedule-post-diamond"></div>
        
        <?php if( $display_schedule_info === 'yes' ) { ?>
        
        	<div class="pm-schedule-post-date">
            
				<?php if($pm_schedule_cancellation_meta === 'yes') { ?>
            
                     <i class="fa fa-ban"></i>
                     
                <?php } else { ?>
                
                    <?php if($pm_reoc_event !== 'once') : ?>
                        
                        <i class="fa fa-calendar"></i>
                    
                    <?php else : ?>
                    
                        <p class="month"><?php echo esc_attr($month); ?></p>
                        <p class="day"><?php echo esc_attr($day); ?></p>
                    
                    <?php endif; ?>
                     
                <?php } ?>
               
            </div>
        
        <?php } else { ?>
        
        	<div class="pm-schedule-post-date">
            	<i class="fa fa-calendar"></i>
            </div>
        
        <?php } ?>
    
    </div>                    
    
</div>
<!-- Schedule post 6 end -->