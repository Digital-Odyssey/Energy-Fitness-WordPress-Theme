<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_cta_box extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"title" => '',
			"text_color" => '#ffffff',
			"link" => '',
			"button_text" => "Purchase Now",
			"button_text_color" => "#000000",
			"target" => "_blank"
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-cta-message">
            <p class="pm-quantum-alert-title" style="color:<?php esc_attr_e($text_color); ?>"><?php esc_attr_e($title); ?></p>
            <p class="pm-quantum-alert-details" style="color:<?php esc_attr_e($text_color); ?>"><?php echo $content ?></p>
            <p class="pm-quantum-alert-btn"><a href="<?php $link ?>" class="pm-rounded-btn cta-btn" style="color:<?php esc_attr_e($button_text_color) ?> !important;" target="<?php esc_attr_e($target); ?>"><?php esc_attr_e($button_text); ?></a></p>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_cta_box",
    "name"      => __("Call to Action", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Title", 'energytheme'),
            "param_name" => "title",
            //"description" => __("Enter a CSS class if required.", 'energytheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Link", 'energytheme'),
            "param_name" => "link",
            //"description" => __("Enter a CSS class if required.", 'energytheme'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'energytheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a CSS class if required.", 'energytheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'energytheme'),
            "param_name" => "button_text",
            //"description" => __("Enter a CSS class if required.", 'energytheme'),
			"value" => 'Purchase Now'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Button Text Color", 'energytheme'),
            "param_name" => "button_text_color",
            //"description" => __("Enter a CSS class if required.", 'energytheme'),
			"value" => '#000000'
        ),
				
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'energytheme'),
            "param_name" => "target",
            //"description" => __("Choose the divider style you desire.", 'energytheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank'), //Add default value in $atts
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'energytheme'),
            "param_name" => "content",
            //"description" => __("Enter a CSS class if required.", 'energytheme'),
			//"value" => 'Purchase Now'
        ),
		
		

    )

));