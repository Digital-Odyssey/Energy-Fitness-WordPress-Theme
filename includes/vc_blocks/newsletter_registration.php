<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_newsletter_registration extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_mailchimp_url" => '',
			"el_name_placeholder" => 'Your Name',
			"el_email_placeholder" => 'Email Address',
			"el_display_name" => 'on'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_video_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->      
        
        <div class="pm-workshop-newsletter-form-container">
            <form action="<?php echo esc_html($el_mailchimp_url); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            
            	<?php if($el_display_name === 'on') : ?>
                	<input type="text" placeholder="<?php echo esc_attr($el_name_placeholder); ?>" id="MERGE1" name="MERGE1">
                <?php endif; ?>
              
                <input type="text" placeholder="<?php echo esc_attr($el_email_placeholder); ?>" id="MERGE0" name="MERGE0">
                <input name="subscribe" id="mc-embedded-subscribe" type="submit" value="<?php esc_html_e('Subscribe', 'energytheme'); ?>" class="pm-trial-form-submit">
            </form>
         </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_newsletter_registration",
    "name"      => __("Newsletter Registration", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Mailchimp URL", 'energytheme'),
            "param_name" => "el_mailchimp_url",
            "description" => __("Enter your MailChimp Subscribe URL (ex. http://pulsarmedia.us4.list-manage.com/subscribe/post?u=2aa9334fc1bc18c8d05500b41&id=dbcb577c4d).", 'energytheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Name field placeholder", 'energytheme'),
            "param_name" => "el_name_placeholder",
            "description" => __("Enter a placeholder value for the name field.", 'energytheme'),
			"value" => 'Your Name'
        ),
		
		
		array(
            "type" => "textfield",
            "heading" => __("Email field placeholder", 'energytheme'),
            "param_name" => "el_email_placeholder",
            "description" => __("Enter a placeholder value for the email field.", 'energytheme'),
			"value" => 'Email Address'
        ),	
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Name Field?", 'energytheme'),
            "param_name" => "el_display_name",
            "description" => __("Choose whether or not to display the name field.", 'energytheme'),
			"value"      => array( 'on' => 'on', 'off' => 'off'), //Add default value in $atts
        ),


    )

));