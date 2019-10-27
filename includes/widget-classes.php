<?php

/*

Plugin Name: Classes Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays scheduled fitness classes / programs
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_classes_widget');

//register our widget
function pm_classes_widget() {
	register_widget('pm_classposts_widget');
}

//pm_classposts_widget class
class pm_classposts_widget extends WP_Widget {
	
	//process the new widget
	function pm_classposts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_classposts_widget',
			'description' => esc_attr__('Display your scheduled classes / programs.','energytheme')
		);
		
		parent::__construct('pm_classposts_widget', esc_attr__('[Micro Themes] - Scheduled Classes','energytheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => 'Upcoming Classes', 
			'subtitle' => '',
			'numOfPosts' => '2',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$subtitle = $instance['subtitle'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        	<p><?php esc_attr_e('Sub-Title','energytheme') ?>: <input class="widefat" name="<?php echo  esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" /></p>
        	<p><?php esc_attr_e('Title:', 'energytheme'); ?> <input class="widefat" name="<?php echo  esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <p><?php esc_attr_e('Number of Scheduled items to display:', 'energytheme'); ?> <input class="widefat" name="<?php echo  esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
            
                    
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
		$subtitle = empty( $instance['subtitle'] ) ? '' : $instance['subtitle'];
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
		
		$todaysDate = date( 'Y-m-d' ); //This date format is required by WordPress to match dates
		
		//retrieve recent posts
		$args = array(
					'numberposts' => $numOfPosts,
					'offset' => 0,
					'category' => 0,
					'orderby' => 'post_date',
					'order' => 'ASC',
					'include' => '',
					'exclude' => '',
					'meta_key' => '',
					'meta_value' => '',
					'post_type' => 'post_schedules',
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
			 $month = date("M", strtotime($re_start_date_event));
			 $day = date("d", strtotime($re_start_date_event));
			 $year = date("Y", strtotime($re_start_date_event));
			 
			 $allday_eve = get_post_meta($recent["ID"], 'allday_eve', true);
			 $re_start_time = get_post_meta($recent["ID"], 're_start_time', true);
			 $re_end_time = get_post_meta($recent["ID"], 're_end_time', true);
			 $pm_schedule_location_meta = get_post_meta($recent["ID"], 'pm_schedule_location_meta', true);
			 $pm_schedule_cancellation_meta = get_post_meta($recent["ID"], 'pm_schedule_cancellation_meta', true);
			 $pm_reoc_event = get_post_meta($recent["ID"], 'reoc_event', true);
			 
			 $pm_disable_share_feature = get_post_meta($recent["ID"], 'pm_disable_share_feature', true);
			 
			 $todaysDate = date( 'Y-m-d' ); //This date format is required by WordPress to match dates
			
			?>
				<div class="pm-widget-class-post-container">
                            
					<div class="pm-widget-class-post-diamond"></div>
					<div class="pm-widget-class-post-date">
                    
                    	<?php if($pm_reoc_event !== 'once') : ?>
                
                              <i class="fa fa-calendar"></i>
                            
                        <?php else : ?>
                            
                              <p class="month"><?php echo esc_attr($month); ?></p>
                              <p class="day"><?php echo esc_attr($day); ?></p>
                            
                        <?php endif; ?>

					</div>
					
					<div class="pm-widget-class-post-details">
						<p class="class-name"><?php echo $recent["post_title"] ?></p>
						
                        <?php if($pm_schedule_cancellation_meta === 'yes') { ?>
                            <p class="time"><?php esc_attr_e('Cancelled', 'energytheme');  ?></p>
                        <?php } else { ?>
                            <p class="time"><?php echo esc_attr($re_start_time); ?> - <?php echo esc_attr($re_end_time); ?> / <?php echo esc_attr($pm_schedule_location_meta); ?></p>
                        <?php } ?>
                        
					</div>
					        
                    
                    <?php if($pm_reoc_event !== 'once') : ?>
                    
                    	<a href="<?php echo get_permalink($recent["ID"]) ?>" class="pm-square-btn class-widget"><?php esc_attr_e('View Dates & Details','energytheme'); ?></a>
                    
                    <?php else: ?>
                    
                    	<a href="<?php echo get_permalink($recent["ID"]) ?>" class="pm-square-btn class-widget"><?php esc_attr_e('View Details','energytheme'); ?></a>
                    
                    <?php endif; ?>
                    				
				</div>	
                
			<?php

			
		}//end of foreach
						
		echo $after_widget;
		
	}//end of widget function
	
}//end of class

?>