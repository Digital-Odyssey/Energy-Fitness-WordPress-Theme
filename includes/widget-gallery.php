<?php

/*

Plugin Name: Gallery Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays gallery items
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_gallery_widget');

//register our widget
function pm_gallery_widget() {
	register_widget('pm_galleryposts_widget');
}

//pm_galleryposts_widget class
class pm_galleryposts_widget extends WP_Widget {
	
	//process the new widget
	function pm_galleryposts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_galleryposts_widget',
			'description' => esc_attr__('Display gallery items.','energytheme')
		);
		
		parent::__construct('pm_galleryposts_widget', esc_attr__('[Micro Themes] - Gallery','energytheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => 'Latest from our gallery', 
			'subtitle' => 'Fueling the fire',
			'galleryLink' => '',
			'numOfPosts' => '4',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$subtitle = $instance['subtitle'];
		$galleryLink = $instance['galleryLink'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        	<p><?php esc_attr_e('Sub-Title','energytheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" /></p>
        	<p><?php esc_attr_e('Title:', 'energytheme'); ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <p><?php esc_attr_e('Gallery Link','energytheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('galleryLink')); ?>" type="text" value="<?php echo esc_attr($galleryLink); ?>" /></p>
            <p><?php esc_attr_e('Number of gallery posts to display:', 'energytheme'); ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['galleryLink'] = strip_tags( $new_instance['galleryLink'] );
		$instance['numOfPosts'] = strip_tags( $new_instance['numOfPosts'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		$subtitle = empty($instance['subtitle']) ? '' : $instance['subtitle'];
		$galleryLink = $instance['galleryLink'];
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
		
		//retrieve recent posts
		$args = array(
					'numberposts' => $numOfPosts,
					'offset' => 0,
					'category' => 0,
					'order' => 'DESC',
					'include' => '',
					'exclude' => '',
					'meta_key' => '',
					'meta_value' => '',
					'post_type' => 'post_galleries',
					'post_status' => 'publish',
					'suppress_filters' => true 
					);
						
		$recent_posts = wp_get_recent_posts($args, ARRAY_A);
		
		
		
		echo '<ul class="pm-gallery-widget-items">';
		
			//front-end widget code here
			foreach( $recent_posts as $recent ){
				
				$pm_gallery_image_meta = get_post_meta($recent["ID"], 'pm_gallery_image_meta', true);
				$pm_gallery_item_caption_meta = get_post_meta($recent["ID"], 'pm_gallery_item_caption_meta', true);
				$pm_gallery_video_meta = get_post_meta($recent["ID"], 'pm_gallery_video_meta', true);
				$pm_gallery_display_video_meta = get_post_meta($recent["ID"], 'pm_gallery_display_video_meta', true);
				
				if($pm_gallery_display_video_meta ==='yes' ) {
					
					?>
                    <!-- Display video -->
                    <li style="background-image:url(<?php echo esc_html($pm_gallery_image_meta); ?>);">
                    	<a href="<?php echo esc_html($pm_gallery_video_meta); ?>" data-rel="prettyPhoto[video]" class="pm-gallery-widget-item-expand fa fa-expand expand lightbox" <?php echo $pm_gallery_item_caption_meta !== '' ? 'title="'. esc_attr($pm_gallery_item_caption_meta) .'"' : '' ?>></a>
                    </li>
                    <?php
					
				} else {
					
					?>
                    <!-- Display image -->
                    <li style="background-image:url(<?php echo $pm_gallery_image_meta; ?>);">
            			<a href="<?php echo esc_html($pm_gallery_image_meta); ?>" data-rel="prettyPhoto[gallery]" class="pm-gallery-widget-item-expand fa fa-expand expand lightbox" <?php echo $pm_gallery_item_caption_meta !== '' ? 'title="'. esc_attr($pm_gallery_item_caption_meta) .'"' : '' ?>></a>
                    </li>
                    <?php
					
				}				
					  
			}//end of foreach
		
		echo '</ul>';
		
		echo '<br>';
		
		if($galleryLink !== '') :
			echo '<p class="pm-right-align"><a class="pm-gallery-widget-view-more" href="'.esc_html($galleryLink).'">'. esc_attr__('View Gallery', 'energytheme') .' &nbsp;<i class="fa fa-angle-right"></i></a></p>';
		endif;
		
						
		echo $after_widget;
		
	}//end of widget function
	
}//end of class

?>