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
	 
	 $pm_disable_share_feature = get_post_meta(get_the_ID(), 'pm_disable_share_feature', true);
	 
	 $todaysDate = date_i18n( 'Y-m-d' ); //This date format is required by WordPress to match dates
	              
?>

    
<div class="pm-schedule-post-container single-post">

	<img src="<?php echo esc_url(esc_html($image_url[0])); ?>" alt="<?php the_title(); ?>" />
    
    <div class="pm-schedule-post-info-main-container">
    
        <div class="pm-schedule-post-info-container single-post">
        
            <div class="pm-schedule-post-info single-post">
                
                <p class="title"><?php the_title(); ?></p>
                
                <?php if( $display_schedule_info === 'yes' ) : ?>
                
                	<?php if($pm_schedule_cancellation_meta === 'yes') { ?>
                        <p class="time"><?php esc_attr_e('Cancelled', 'energytheme');  ?></p>
                    <?php } else { ?>
                        <p class="time"><?php echo esc_attr($re_start_time); ?> - <?php echo esc_attr($re_end_time); ?> / <?php echo esc_attr($pm_schedule_location_meta); ?></p>
                    <?php } ?>
                
                <?php endif; ?>    
                
            </div>
            
        </div>
        
        <div class="pm-schedule-post-diamond-shadow single-post"></div>
        <div class="pm-schedule-post-diamond single-post"></div>
        
        <div class="pm-schedule-post-date single-post">
        
        	<?php if( $display_schedule_info === 'yes' ) { ?>
            
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
            
            <?php } else { ?>
            
            	<i class="fa fa-calendar"></i>
            
            <?php } ?>
            
        </div>
    
    </div>

</div>      

<?php if( $display_schedule_info === 'yes' ) : ?>

	<?php if($pm_schedule_cancellation_meta !== 'yes') { ?>

		<?php 
            global $post;
            $event_detail = get_post_custom(get_the_ID()); 
            
            //print_r($event_detail);
            
            $today = date_i18n('Y-m-d');
            
            if(strtotime($event_detail["re_start_date_event"][0]) > strtotime($today)){
                
                $today = $event_detail["re_start_date_event"][0];
                
            }
            
            $todayWeekDay = date_i18n('w',strtotime($today));
            $weekdaysNum = ["Sunday" => 0 , "Monday" => 1, "Tuesday" => 2, "Wednesday" => 3, "Thursday" => 4, "Friday" => 5, "Saturday" => 6 ];
            $weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            
            
            $text = '';	
            
            if ($event_detail["allday_eve"][0] == '0') {
                
                $text .= '<p class="pm-event-details-title" style="text-align:center;"><b>'.esc_attr__('Information', 'eventplugin').'</b></p>';
            } 
            
            if ($event_detail["reoc_event"][0] != 'once'){
            
                $text .= '<div class="pm-event-details-info">' . $event_detail["event_duration"][0].'. '.$event_detail["next_upcoming"][0].'</div>';
                
                $text .= '<div class="pm-divider event"></div>';
                
                $text .= '<p class="pm-event-details-title" style="text-align:center;"><b>'.esc_attr__('Upcoming Dates', 'eventplugin').'</b></p>';
            
                $year = date_i18n('Y',strtotime($event_detail["re_start_date_event"][0]));
                $mon = date_i18n('m',strtotime($event_detail["re_start_date_event"][0]));
                $da = date_i18n('d',strtotime($event_detail["re_start_date_event"][0]));
                $currentDate = ($year + $event_detail["freq_event"][0]) ."-". $mon ."-". $da;
            
                if(strtotime($event_detail["re_until"][0])< strtotime($today) || ($event_detail["reoc_event"][0] == 'yearly' && strtotime($event_detail["re_until"][0])< strtotime($currentDate))){
                
                    $text .= '<p style="text-align:center;">'.esc_attr__('No upcoming dates for this program', 'eventplugin').'</p>';
                
                } else {
                
                    $upcoming_dates = explode(',' , $event_detail["upcoming_dates"][0]);
                    $text .= '<ul class="pm-event-upcoming-dates" id="pm-event-upcoming-dates">';
                    
                    foreach($upcoming_dates as $date){
                        $text.='<li>'.$date.'</li>';
                    }
                    
                    $text .= '</ul>';
                    
                    //echo count($upcoming_dates);
                    
                    if(count($upcoming_dates) > 5){
                        $text .= '<br /><p style="text-align:center;"><a href="#" id="loadMore">'.esc_attr__('Show more', 'eventplugin').'</a> &nbsp; <a href="#" id="showLess">'.esc_attr__('Show less', 'eventplugin').'</a></p><div class="pm-divider event"></div>';
                    } else {
                        $text .= '<div class="pm-divider event"></div>';	
                    }
                    
                }
            
            } else {
            
                if ($event_detail["allday_eve"][0] == '0') {
                    
                    $text .= '<p style="text-align:center;">'.esc_attr__('This program is running from', 'eventplugin').' '. pm_ln_formatInternalDate($event_detail["re_start_date_event"][0])." ".$event_detail["re_start_time"][0] .' '.esc_attr__('until', 'eventplugin').' '.pm_ln_formatInternalDate($event_detail["re_end_date_event"][0])." ".$event_detail["re_end_time"][0].'</p>';
                    
                } 
                
                $text .= '<div class="pm-divider event"></div>';
            }
            
            echo $text;		
            
    ?>
    
    
    <?php } else { ?>
    
        <?php echo '<p class="pm-event-details-title" style="text-align:center;"><b>'.esc_attr__('This program has been cancelled.', 'eventplugin').'</b></p>'; ?>
    
    <?php } ?>  

<?php endif; ?>



<?php the_content(); ?>

<?php if($pm_disable_share_feature === 'no') : ?>
	<?php get_template_part('content','sharewithfriends'); ?>
<?php endif; ?>