<?php

/*

Plugin Name: Events Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays event posts
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_events_widget');

//register our widget
function pm_events_widget() {
	register_widget('pm_eventposts_widget');
}

//pm_eventposts_widget class
class pm_eventposts_widget extends WP_Widget {
	
	//process the new widget
	function pm_eventposts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_eventposts_widget',
			'description' => esc_attr__('Display event posts.','energytheme')
		);
		
		parent::__construct('pm_eventposts_widget', esc_attr__('[Micro Themes] - Events','energytheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => 'Upcoming Events', 
			'subtitle' => '',
			'numOfPosts' => '1',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$subtitle = $instance['subtitle'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        	<p><?php esc_attr_e('Sub-Title','energytheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" /></p>
        	<p><?php esc_attr_e('Title:', 'energytheme'); ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <p><?php esc_attr_e('Number of Events to display:', 'energytheme'); ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['numOfPosts'] = strip_tags( $new_instance['numOfPosts'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		$subtitle = empty($instance['subtitle']) ? '' : $instance['subtitle'];
		$numOfPosts = empty( $instance['numOfPosts'] ) ? '3' : $instance['numOfPosts'];
		
		if( !empty($title) ){
			
			echo  '<h5 class="pm-fat-footer-sub-title">'.$subtitle.'</h5>' . $before_title . $title . $after_title;
			
		}//end of if
		
		/*
		post_author 
		post_date
		post_date_gmt
		post_content
		post_title
		post_category
		post_excerpt
		post_status
		comment_status 
		ping_status
		post_name
		comment_count 
		*/
		
		//$eventsPostOrderByEventDate = get_theme_mod('eventsPostOrderByEventDate', 'on');
		$todaysDate = date( 'Y-m-d' ); //This date format is required by WordPress to match dates
		$eventsPostOrder = get_theme_mod('eventsPostOrder', 'on');
		
		$args = array(
					'numberposts' => $numOfPosts,
					'offset' => 0,
					'category' => 0,
					'order' => $eventsPostOrder,
					'include' => '',
					'exclude' => '',
					'meta_key' => '',
					'meta_value' => '',
					'post_type' => 'post_event',
					'post_status' => 'publish',
					'meta_query' => array(
						array(
							'key' => 're_end_date_event',
							'value' => $todaysDate,
							'compare' => '>=',
							'type' => 'DATE'
						)
					),
					'suppress_filters' => true 
					);
		
		//Check for total number of posts that aren't expired
		$count_args = array(
				'post_type' => 'post_event',
				'post_status' => 'publish',
				'meta_query' => array(
					array(
						'key' => 'pm_event_date_meta',
						'value' => $todaysDate,
						'compare' => '>=',
						'type' => 'DATE'
					)
				),
			);
		
		$my_query = new WP_Query( $count_args );
							
		//retrieve recent posts
		$recent_posts = wp_get_recent_posts($args, ARRAY_A);
		
		$total_posts = count($recent_posts);
		
		if($total_posts === 0){
			echo '<p style="text-align:center;">'.esc_attr__('No scheduled classes were found.', 'energythemewee').'</p>';
		}
				
		//front-end widget code here
		foreach( $recent_posts as $recent ){
			
			if ( has_post_thumbnail($recent["ID"])) {
			   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($recent["ID"]), 'full');
			}
			
			$re_start_date_event = get_post_meta($recent["ID"], 're_start_date_event', true);
			$re_end_date_event = get_post_meta($recent["ID"], 're_end_date_event', true);
			$month = date("M", strtotime($re_start_date_event));
			$day = date("d", strtotime($re_start_date_event));
			$year = date("Y", strtotime($re_start_date_event));
			$pm_event_fan_page_meta = get_post_meta($recent["ID"], 'pm_event_fan_page_meta', true);
			
			$allday_eve = get_post_meta($recent["ID"], 'allday_eve', true);
			$pm_event_start_time_meta = get_post_meta($recent["ID"], 're_start_time', true);
			$pm_event_end_time_meta = get_post_meta($recent["ID"], 're_end_time', true);
			$pm_reoc_event = get_post_meta($recent["ID"], 'reoc_event', true);
			
			$todaysDate = date( 'Y-m-d' ); //This date format is required by WordPress to match dates
			
			?>
			
			<!-- Event post -->
			<div class="pm-widget-event-post-container">
			
				<div class="pm-widget-event-post-img-container" style="background-image:url(<?php echo esc_html($image_url[0]); ?>);">
				
					<div class="pm-widget-event-post-img-diamond-shadow"></div>
					<div class="pm-widget-event-post-img-diamond"></div>
					
					<div class="pm-widget-event-post-img-diamond-date">
                    
                    	<?php if($pm_reoc_event !== 'once') : ?>
                
                            <i class="fa fa-calendar"></i>
                        
                        <?php else : ?>
                        
                            <p class="month"><?php echo esc_attr($month); ?></p>
                            <p class="day"><?php echo esc_attr($day); ?></p>
                        
                        <?php endif; ?>
                    
					</div>
					
					<div class="pm-widget-event-post-img-title">
						<h5><?php echo $recent["post_title"] ?></h5>
					</div>
				
				</div>
                
                <div class="pm-widget-event-post-time-container">
                
                	<?php if($pm_reoc_event === 'once' && $re_end_date_event < $todaysDate) : ?>
            
                            <p class="time"><b><?php esc_attr_e('This event has ended','energytheme'); ?></b></p>
                    
                    <?php else : ?>
                    
                        <?php if($allday_eve) : ?>
                            <p class="time"><b><?php esc_attr_e('All day event','energytheme'); ?></b></p>
                        <?php elseif($pm_event_start_time_meta !== '') : ?>
                            <p class="time"><b><?php esc_attr_e('Start:','energytheme'); ?></b> <?php echo esc_attr($pm_event_start_time_meta) ?> <b><?php esc_attr_e('End:','energytheme'); ?></b> <?php echo esc_attr($pm_event_end_time_meta) ?></p>
                        <?php endif; ?>
                    
                    <?php endif; ?>
                
                </div>
                     
			
				<div class="pm-widget-event-post-details">
                
                	<?php if($pm_reoc_event !== 'once') : ?>
                    
                    	<a href="<?php echo get_permalink($recent["ID"]) ?>" class="pm-square-btn event"><?php esc_attr_e('View Dates & Details','energytheme'); ?></a>
                    
                    <?php else: ?>
                    
                    	<a href="<?php echo get_permalink($recent["ID"]) ?>" class="pm-square-btn event"><?php esc_attr_e('View Details','energytheme'); ?></a>
                    
                    <?php endif; ?>
                
				</div>
			
			</div>	
			<!-- Event post end -->
			
			<?php			
				  
		}//end of foreach
		
						
		echo $after_widget;
		
	}//end of widget function
	
}//end of class

?>