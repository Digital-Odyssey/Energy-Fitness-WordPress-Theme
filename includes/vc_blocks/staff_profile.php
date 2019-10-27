<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_staff_profile extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"id" => '',
			"name_color" => '#2C5E83',
			"title_color" => '#f15b5a',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
			
			//Method to retrieve a single post
			$queried_post = get_post($id);
			$postID = $queried_post->ID;
			$postLink = $queried_post->guid;
			$postTitle = $queried_post->post_title;
			//$postTags = get_the_tags($postID);
			$postExcerpt = $queried_post->post_excerpt;
			$shortExcerpt = pm_ln_string_limit_words($postExcerpt, 20);
			
			$pm_staff_image_meta = get_post_meta($postID, 'pm_staff_image_meta', true);
			$pm_staff_title_meta = get_post_meta($postID, 'pm_staff_title_meta', true);
			$pm_staff_twitter_meta = get_post_meta($postID, 'pm_staff_twitter_meta', true);
			$pm_staff_facebook_meta = get_post_meta($postID, 'pm_staff_facebook_meta', true);
			$pm_staff_gplus_meta = get_post_meta($postID, 'pm_staff_gplus_meta', true);
			$pm_staff_linkedin_meta = get_post_meta($postID, 'pm_staff_linkedin_meta', true);
			
			$pm_staff_instagram_meta = get_post_meta($postID, 'pm_staff_instagram_meta', true);
			
			$pm_staff_email_address_meta = get_post_meta($postID, 'pm_staff_email_address_meta', true);
			$pm_staff_quote_meta = get_post_meta($postID, 'pm_staff_quote_meta', true);
		?>

        <!-- Element Code start -->
        
        <div class="pm-staff-profile-item-container" style="background-image:url(<?php echo esc_url($pm_staff_image_meta); ?>);">
            <div class="pm-staff-profile-item-details-container">
                <div class="pm-staff-profile-item-details">
                    <a href="#" class="pm-staff-profile-item-details-btn fa fa-chevron-up"></a>
                    <p class="pm-staff-profile-item-excerpt"><?php esc_attr_e($pm_staff_quote_meta); ?></p>
                    <div class="pm-staff-profile-item-details-divider"></div>
                    <a href="<?php echo get_permalink($postID); ?>" class="pm-staff-profile-item-view-profile"><?php esc_attr_e('View profile', 'energytheme'); ?></a>
                    <?php if($pm_staff_email_address_meta !== '') : ?>
                        <a href="mailto:<?php esc_attr_e($pm_staff_email_address_meta); ?>" class="pm-staff-profile-item-email-btn fa fa-envelope"></a>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="pm-staff-profile-item-social-icons-container">
            
                <ul class="pm-staff-profile-item-social-icons">
                
                    <?php if($pm_staff_twitter_meta !== '') : ?>
                    
                        <li>
                            <div class="pm-staff-item-social-icon-diamond"></div>
                            <a href="<?php esc_attr_e($pm_staff_twitter_meta); ?>" class="fa fa-twitter"></a>
                        </li>
                    
                    <?php endif; ?>
                    
                    <?php if($pm_staff_facebook_meta !== '') : ?>
                    
                        <li>
                            <div class="pm-staff-item-social-icon-diamond"></div>
                            <a href="<?php esc_attr_e($pm_staff_facebook_meta); ?>" class="fa fa-facebook"></a>
                        </li>
                    
                    <?php endif; ?>
                    
                    <?php if($pm_staff_gplus_meta !== '') : ?>
                    
                        <li>
                            <div class="pm-staff-item-social-icon-diamond"></div>
                            <a href="<?php esc_attr_e($pm_staff_gplus_meta); ?>" class="fa fa-google-plus"></a>
                        </li>
                    
                    <?php endif; ?>
                    
                    <?php if($pm_staff_linkedin_meta !== '') : ?>
                    
                        <li>
                            <div class="pm-staff-item-social-icon-diamond"></div>
                            <a href="<?php esc_attr_e($pm_staff_linkedin_meta); ?>" class="fa fa-linkedin"></a>
                        </li>
                    
                    <?php endif; ?>
                                    
                    <?php if($pm_staff_instagram_meta !== '') : ?>
                    
                        <li>
                            <div class="pm-staff-item-social-icon-diamond"></div>
                            <a href="<?php esc_attr_e($pm_staff_instagram_meta); ?>" class="fa fa-instagram"></a>
                        </li>
                    
                    <?php endif; ?>
                    
                </ul>
            
            </div>
        </div>
        
        <div class="pm-staff-profile-item-name">
            <p class="name" style="color:<?php esc_attr_e($name_color); ?>;"><?php esc_attr_e($postTitle); ?></p>
            <div class="pm-staff-item-divider"></div>
            <p class="title" style="color:<?php esc_attr_e($title_color); ?>;"><?php esc_attr_e($pm_staff_title_meta); ?></p>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_staff_profile",
    "name"      => __("Staff Profile", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Staff Post ID", 'energytheme'),
            "param_name" => "id",
            "description" => __("Enter the ID number of the staff post you wish to display.", 'energytheme'),
			"value" => ''
        ),

		array(
            "type" => "colorpicker",
            "heading" => __("Name Color", 'energytheme'),
            "param_name" => "name_color",
            //"description" => __("Choose the divider style you desire.", 'energytheme'),
			"value"      => '#2C5E83' //Add default value in $atts
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Title Color", 'energytheme'),
            "param_name" => "title_color",
            //"description" => __("Choose the divider style you desire.", 'energytheme'),
			"value"      => '#4B4B4B' //Add default value in $atts
        ),
		
		

    )

));