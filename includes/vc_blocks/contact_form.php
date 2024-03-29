<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_contact_form extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"recipient_email" => 'info@microthemes.ca',
			"text_color" => '#ffffff',
			"response_color" => '#7F6631',
			"message" => 'Fields marked with * are required',
			"consent_checkbox" => 'off'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
		<div class="pm-contact-form-container">
	
			<form action="#" method="post" id="pm-contact-form">
							
				<div class="col-lg-6 col-md-6 col-sm-12">
					<input name="pm_s_first_name" id="pm_s_first_name" class="pm-form-textfield" type="text" placeholder="<?php esc_attr_e('First Name *', 'energytheme'); ?>">
				</div>
				
				<div class="col-lg-6 col-md-6 col-sm-12">
					<input name="pm_s_last_name" id="pm_s_last_name" class="pm-form-textfield" type="text" placeholder="<?php esc_attr_e('Last Name *', 'energytheme'); ?>">
				</div>
				
				<div class="col-lg-6 col-md-6 col-sm-12">
					<input name="pm_s_email_address" id="pm_s_email_address" class="pm-form-textfield" type="text" placeholder="<?php esc_attr_e('Email Address *', 'energytheme'); ?>">
				</div>
				
				<div class="col-lg-6 col-md-6 col-sm-12">
					<input name="pm_s_phone_number" id="pm_s_phone_number" class="pm-form-textfield" type="tel" placeholder="<?php esc_attr_e('Phone Number', 'energytheme'); ?>">
				</div>
				
				<div class="col-lg-12 pm-clear-element">
					<textarea name="pm_s_message" id="pm_s_message" class="pm-form-textarea" cols="50" rows="10" placeholder="<?php esc_attr_e('Message *', 'energytheme'); ?>"></textarea>
				</div>
                
                <?php if($consent_checkbox === 'on') : ?>
                    
                    <div class="form-group pm-center">
                        <input type="checkbox" name="pm_contact_consent_box" id="pm_contact_consent_box" />
                        <?php echo $content ?>
                    </div>
                
                <?php endif; ?>
				
				<div class="col-lg-12 pm-center">
					<input type="button" value="<?php esc_attr_e('Submit Form', 'energytheme'); ?>" name="pm-form-submit-btn" class="pm-form-submit-btn" id="pm-contact-form-btn">
					<div id="pm-contact-form-response" style="color:<?php esc_attr_e($response_color); ?>;"></div>	
					<p class="pm-required" style="color:<?php esc_attr_e($text_color); ?>;"><?php esc_attr_e($message); ?></p>
				</div>
				
				<input type="hidden" name="pm_s_email_address_contact" id="pm_s_email_address_contact" value="<?php esc_attr_e($recipient_email); ?>" />
				
				<?php wp_nonce_field('pm_ln_nonce_action','pm_ln_send_contact_nonce'); ?>
			
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

    "base"      => "pm_ln_contact_form",
    "name"      => __("Contact Form", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Recipient email address", 'energytheme'),
            "param_name" => "recipient_email",
            "description" => __("Enter the email address where the message will be sent to.", 'energytheme'),
			"value" => 'info@microthemes.ca'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Form Message", 'energytheme'),
            "param_name" => "message",
            //"description" => __("Enter a CSS class if required.", 'energytheme'),
			"value" => 'Fields marked with * are required'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'energytheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a CSS class if required.", 'energytheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Response Color", 'energytheme'),
            "param_name" => "response_color",
            //"description" => __("Enter a CSS class if required.", 'energytheme'),
			"value" => '#7F6631'
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Consent Checkbox", 'energytheme'),
            "param_name" => "consent_checkbox",
            //"description" => __("Choose the divider style you desire.", 'energytheme'),
			"value" => array( 'off' => 'off', 'on' => 'on' ),
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Consent Message", 'energytheme'),
            "param_name" => "content",
            //"description" => __("Enter a short description for your service.", 'energytheme')
        ),


    )

));