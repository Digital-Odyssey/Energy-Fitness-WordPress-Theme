<?php

/*

Plugin Name: Quick Contact Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays a quick contact form
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_contact_widget');

//register our widget
function pm_contact_widget() {
	register_widget('pm_ln_quickcontact_widget');
}


//pm_ln_quickcontact_widget class
class pm_ln_quickcontact_widget extends WP_Widget {
	
	//process the new widget
	function pm_ln_quickcontact_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_ln_quickcontact_widget',
			'description' => esc_attr__('Insert a quick contact form','energytheme')
		);
		
		parent::__construct('pm_ln_quickcontact_widget', esc_attr__('[Micro Themes] - Quick Contact Form','energytheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => 'Get in touch with us!', 
			'subtitle' => 'Have a question?',
			'desc' => '',
			'color' => 'Light',
			'response_color' => 'Light',
			'email' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$subtitle = $instance['subtitle'];
		$desc = $instance['desc'];
		$color = $instance['color'];
		$response_color = $instance['response_color'];
		$email = $instance['email'];
		
		?>
        
        	<p><?php esc_attr_e('Sub-Title','energytheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" /></p>
        
        	<p><?php esc_attr_e('Title','energytheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

            <p><?php esc_attr_e('Description','energytheme') ?>: <textarea class="widefat" name="<?php echo esc_attr($this->get_field_name('desc')); ?>" cols="3" rows="3"><?php echo esc_attr($desc); ?></textarea></p>
            
            <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'color' )); ?>"><?php esc_attr_e('Form Color:', 'energytheme') ?></label>
            <select id="<?php echo esc_attr($this->get_field_id( 'color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'color' )); ?>" class="widefat">
                <option <?php if ( 'Light' == $instance['color'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('Light', 'energytheme') ?></option>
                <option <?php if ( 'Dark' == $instance['color'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('Dark', 'energytheme') ?></option>
            </select>
            </p>
            <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'response_color' )); ?>"><?php esc_attr_e('Response Color:', 'energytheme') ?></label>
            <select id="<?php echo esc_attr($this->get_field_id( 'response_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'response_color' )); ?>" class="widefat">
                <option <?php if ( 'Light' == $instance['response_color'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('Light', 'energytheme') ?></option>
                <option <?php if ( 'Dark' == $instance['response_color'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('Dark', 'energytheme') ?></option>
            </select>
            </p>
            <p><?php esc_attr_e('Email address','energytheme') ?>: <input class="widefat" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['desc'] = strip_tags( $new_instance['desc'] );
		$instance['color'] = strip_tags( $new_instance['color'] );
		$instance['response_color'] = strip_tags( $new_instance['response_color'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		$subtitle = empty($instance['subtitle']) ? '' : $instance['subtitle'];
		$desc = empty( $instance['desc'] ) ? '&nbsp;' : $instance['desc'];
		$color = $instance['color'];
		$response_color = $instance['response_color'];
		$email = empty( $instance['email'] ) ? '&nbsp;' : $instance['email'];
		
		if( !empty($title) ){
			
			echo '<h5 class="pm-fat-footer-sub-title">'.$subtitle.'</h5>' . $before_title . $title . $after_title;
			
		}//end of if
		
		//form code here
		
		if($desc != '&nbsp;'){
			echo '<p style="margin-bottom:20px;">'.esc_attr($desc).'</p>';
			
		}
		
		echo '
		<form action="#" method="post" id="quick-contact-form" class="validate" target="_blank" novalidate>  
			<input name="pm_full_name" id="pm_full_name" type="text" class="pm_quick_contact_field '.$color.' reset-pulse-sizing" placeholder="'.esc_attr__('full name','energytheme').'">
			<input name="pm_email_address" id="pm_email_address" type="email" class="pm_quick_contact_field '.$color.' reset-pulse-sizing" placeholder="'.esc_attr__('email address', 'energytheme').'">
			<textarea name="pm_message" id="pm_message" cols="" rows="" class="pm_quick_contact_textarea '.$color.' reset-pulse-sizing" placeholder="'.esc_attr__('message','energytheme').'"></textarea>
			<input name="subscribe" type="submit" value="Send" class="pm_quick_contact_submit"> ';
			
			?>
            
            <div id="pm_form_response" class="pm_form_response <?php echo esc_attr($response_color); ?>"></div>
			
            <?php wp_nonce_field("pm_ln_nonce_action","pm_ln_send_quick_contact_nonce");  ?>
            
		<?php echo '<input name="pm_email_address_contact" id="pm_email_address_contact" type="hidden" value="'.esc_attr($email).'">
			<input name="quick_contact_submitted" id="" type="hidden" value="true">
		</form>';
				
		echo $after_widget;
		
		// output template path to locate php file on server ?>
        <script> var templateDir = "<?php echo get_template_directory_uri(); ?>"; </script>
        
        <?php
		
	}//end of widget function
	
}//end of class

?>