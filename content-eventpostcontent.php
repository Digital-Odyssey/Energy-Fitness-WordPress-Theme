<?php
/**
 * The default template for displaying an event post item.
 */
?>

<?php 
            
	if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	}
	
	$re_start_date_event = get_post_meta(get_the_ID(), 're_start_date_event', true);
	$re_end_date_event = get_post_meta(get_the_ID(), 're_end_date_event', true);
	$month = date_i18n("M", strtotime($re_start_date_event));
	$day = date_i18n("d", strtotime($re_start_date_event));
	$year = date_i18n("Y", strtotime($re_start_date_event));
	$pm_event_fan_page_meta = get_post_meta(get_the_ID(), 'pm_event_fan_page_meta', true);
	
	$allday_eve = get_post_meta(get_the_ID(), 'allday_eve', true);
	$pm_event_start_time_meta = get_post_meta(get_the_ID(), 're_start_time', true);
	$pm_event_end_time_meta = get_post_meta(get_the_ID(), 're_end_time', true);
	$pm_reoc_event = get_post_meta(get_the_ID(), 'reoc_event', true);
	$display_event_info = get_post_meta(get_the_ID(), 'display_event_info', true);
	
	//add a default value as this was a later addition
	if( empty($display_event_info) ) :
	   $display_event_info = 'yes';
	endif;
	
	$todaysDate = date_i18n( 'Y-m-d' ); //This date format is required by WordPress to match dates
	
	$pm_disable_share_feature = get_post_meta(get_the_ID(), 'pm_disable_share_feature', true);
	
?>

    
<div class="pm-event-post-container single-post" style="height:auto;">

    <div class="pm-event-post-img-container single-post">
    
    	<img src="<?php echo esc_url(esc_html($image_url[0])); ?>" alt="<?php the_title(); ?>" />
    
    	<div class="pm-event-post-title-container single-post">
        
        	<div class="pm-event-post-img-diamond-shadow"></div>
            <div class="pm-event-post-img-diamond"></div>
            
            <div class="pm-event-post-img-diamond-date">
            
                <?php if($pm_reoc_event !== 'once') : ?>
                    
                    <i class="fa fa-calendar"></i>
                
                <?php else : ?>
                
                    <p class="month"><?php echo esc_attr($month); ?></p>
                    <p class="day"><?php echo esc_attr($day); ?></p>
                
                <?php endif; ?>
            </div>
            
            <div class="pm-event-post-img-title">
                <p><?php the_title(); ?></p>
            </div>
        
        </div>
    
    </div>

	
    
    <div class="pm-event-post-details">
        <p class="name"><?php esc_attr_e('Organized by','energytheme'); ?> <?php the_author(); ?></p>
        
        <?php if( $display_event_info === 'yes' ) : ?>
        
            <div class="pm-divider event"></div>
        
            <?php if($pm_reoc_event === 'once' && $re_end_date_event < $todaysDate) : ?>
                
                    <p class="time"><b><?php esc_attr_e('This event has ended','energytheme'); ?></b></p>
            
            <?php else : ?>
            
                <?php if($allday_eve) : ?>
                    <p class="time"><b><?php esc_attr_e('All day event','energytheme'); ?></b></p>
                <?php elseif($pm_event_start_time_meta !== '') : ?>
                    <p class="time"><b><?php esc_attr_e('Start:','energytheme'); ?></b> <?php echo esc_attr($pm_event_start_time_meta) ?> <b><?php esc_attr_e('End:','energytheme'); ?></b> <?php echo esc_attr($pm_event_end_time_meta) ?></p>
                <?php endif; ?>
            
            <?php endif; ?> 
        
        <?php endif; ?>  
        
    </div>

</div>	


<?php if( $display_event_info === 'yes' ) : ?>
        
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
			
			$text .= '<div class="pm-divider event"></div>';
			
			$text .= '<p class="pm-event-details-title" style="text-align:center;"><b>'.esc_attr__('Event Details', 'eventplugin').'</b></p>';
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
			
				$text .= '<p style="text-align:center;">'.esc_attr__('No upcoming dates for this event', 'eventplugin').'</p>';
			
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
				
				$text .= '<p style="text-align:center;">'.esc_attr__('This event is running from', 'eventplugin').' '. pm_ln_formatDate1($event_detail["re_start_date_event"][0]) .' '.$event_detail["re_start_time"][0] .' '.esc_attr__('until', 'eventplugin').' '.pm_ln_formatDate1($event_detail["re_end_date_event"][0])." ".$event_detail["re_end_time"][0].'</p>';
				
			} 
			
			$text .= '<div class="pm-divider event"></div>';
		}
		
		echo $text;
		
		
		?> 	
        
<?php endif; ?>

<?php the_content();  ?>

<div class="pm-event-post-details" style="padding-top:30px;">
                                    
    <?php if($pm_event_fan_page_meta !== '') : ?>
    
        <a href="<?php echo esc_attr($pm_event_fan_page_meta); ?>" class="pm-square-btn facebook" target="_blank"><?php esc_attr_e('View fan page','energytheme'); ?> &nbsp; <i class="fa fa-facebook"></i>&nbsp;</a>
    
    <?php endif; ?>
    
</div>

<?php if($pm_disable_share_feature === 'no') : ?>
	<?php get_template_part('content','sharewithfriends'); ?>
<?php endif; ?>

<?php 
	function pm_ln_formatDate1($date){
				
		$date = date_create($date);
		return date_format($date,"d M Y");
		
	}
	
	function pm_ln_formatDateTime1($date_time){
		
		$date_time = date_create($date_time);
		return date_format($date_time,"d M Y h:i A");
		
}
?>