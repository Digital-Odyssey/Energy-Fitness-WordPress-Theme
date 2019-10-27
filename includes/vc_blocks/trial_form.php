<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_trial_form extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"icon" => 'typcn typcn-document-text',
			"small_title" => 'Sign up for your',
			"large_title" => '5 day free trial',
			"recipient_email" => 'info@microthemes.ca',
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
        
        <div class="pm-trial-form-container">
            <div class="pm-trial-form-title">				
                <i class="<?php esc_attr_e($icon); ?>"></i>
                <p class="pm-trial-form-small-title"><?php esc_attr_e($small_title); ?></p>
                <p class="pm-trial-form-large-title"><?php esc_attr_e($large_title); ?></p>
                <div class="pm-trial-form-title-diamond"></div>
            </div>
            <div class="pm-trial-form-inputs">
                <form action="#" method="post" name="pm_trial_form" id="pm-trial-form">
                    <input name="pm_trial_form_name" id="pm_trial_form_name" type="text" class="pm-trial-form-field" placeholder="<?php esc_attr_e('Your Name *', 'energytheme'); ?>">
                    <input name="pm_trial_form_email" id="pm_trial_form_email" type="email" class="pm-trial-form-field" placeholder="<?php esc_attr_e('Email Address *', 'energytheme'); ?>">
                    <input name="pm_trial_form_phone" id="pm_trial_form_phone" type="tel" class="pm-trial-form-field" placeholder="<?php esc_attr_e('Phone Number', 'energytheme'); ?>">
                    <textarea name="pm_trial_form_message" id="pm_trial_form_message" class="pm-trial-form-textarea" placeholder="<?php esc_attr_e('Message', 'energytheme'); ?>"></textarea>
                    
                    <?php if($consent_checkbox === 'on') : ?>
                    
                    	<div class="form-group">
                        	<input type="checkbox" name="pm_trial_consent_box" id="pm_trial_consent_box" />
                            <?php echo $content ?>
                        </div>
                    
                    <?php endif; ?>
                    
                    <input type="submit" value="<?php esc_attr_e('Sign up', 'energytheme'); ?>" class="pm-trial-form-submit" id="pm-trial-form-btn">
                    <div id="pm-trial-form-response"></div>	
                    <input name="pm_trial_form_recipient_email" id="pm_trial_form_recipient_email" type="hidden" value="<?php esc_attr_e($recipient_email); ?>">
                    <?php wp_nonce_field('pm_ln_nonce_action','pm_ln_send_trial_nonce'); ?>
                </form>
            </div>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_trial_form",
    "name"      => __("Trial Form", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'energytheme'),
            "param_name" => "icon",
            "description" => __("Accepts a Typicon icon value. (Ex. typcn typcn-document-text)", 'energytheme'),
			"value" => 'typcn typcn-document-text'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Small Title", 'energytheme'),
            "param_name" => "small_title",
            //"description" => __("Accepts a Typicon icon value. (Ex. typcn typcn-document-text)", 'energytheme'),
			"value" => 'Sign up for your'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Large Title", 'energytheme'),
            "param_name" => "large_title",
            //"description" => __("Accepts a Typicon icon value. (Ex. typcn typcn-document-text)", 'energytheme'),
			"value" => '5 day free trial'
        ),		
		
		array(
            "type" => "textfield",
            "heading" => __("Recipient Email", 'energytheme'),
            "param_name" => "recipient_email",
            //"description" => __("Accepts a Typicon icon value. (Ex. typcn typcn-document-text)", 'energytheme'),
			"value" => 'info@microthemes.ca'
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