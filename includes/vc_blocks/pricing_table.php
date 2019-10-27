<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_pricing_table extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_title" => 'Silver',
			"el_featured" => 'no',
			"el_price" => '19',
			"el_currency_symbol" => '$',
			"el_subscript" => '/mo',
			"el_message" => '',
			"el_button_text" => 'Purchase Plan',
			"el_button_link" => '#',
			"el_bg_image" => '',
			"el_header_color" => '#2A313A',
			"el_border_color" => '#F6D600',
			"el_text_color" => '#ffffff',
			"el_btn_bg_color" => '#2A313A',
			"el_btn_text_color" => '#F6D600',
			"el_class" => 'wow fadeInUp',
			"el_animation_delay" => 0.3
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($el_bg_image, "large"); 
			$el_bg_image = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-pricing-table-container <?php echo esc_attr_e($el_class); ?>" data-wow-duration="1s" data-wow-offset="50" data-wow-delay="<?php esc_attr_e($el_animation_delay); ?>s">
            <div class="pm-pricing-table-title" style="background-color:<?php esc_attr_e($el_header_color); ?> !important; border-bottom:3px solid <?php esc_attr_e($el_border_color); ?>;">
                <p style="color:<?php esc_attr_e($el_text_color); ?> !important;"><?php esc_attr_e($el_title); ?></p>
            </div>
            <div class="pm-pricing-table-price" <?php echo ($el_bg_image !== '' ? 'style="background-image:url('. esc_url($el_bg_image) .');"' : ''); ?>>
                
                <?php if($el_featured === 'yes') : ?>
                    <div class="pm-pricing-table-featured-shadow"></div>
                    <div class="pm-pricing-table-featured"></div>
                    <i class="fa fa-thumbs-up"></i>
                <?php endif; ?>
                
                <p class="price" style="color:<?php esc_attr_e($el_text_color); ?> !important;"><sup><?php esc_attr_e($el_currency_symbol); ?></sup><?php esc_attr_e($el_price); ?><sub><?php esc_attr_e($el_subscript); ?></sub></p>
                <p class="details" style="color:<?php esc_attr_e($el_text_color); ?> !important;"><?php esc_attr_e($el_message); ?></p>
            </div>
            <?php echo $content; ?>
            <a href="<?php esc_attr_e($el_button_link); ?>" class="pm-pricing-table-btn pm-primary" style="color:<?php esc_attr_e($el_btn_text_color); ?> !important; background-color:<?php esc_attr_e($el_btn_bg_color); ?>;"><?php esc_attr_e($el_button_text); ?> &nbsp;<i class="fa fa-angle-right"></i></a>
            
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_pricing_table",
    "name"      => __("Pricing Table", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
	
		array(
            "type" => "dropdown",
            "heading" => __("Featured?", 'energytheme'),
            "param_name" => "el_featured",
            "description" => __("Display a featured icon symbol.", 'energytheme'),
			"value"      => array( 'no' => 'no', 'yes' => 'yes' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Title", 'energytheme'),
            "param_name" => "el_title",
			"value" => ''
            //"description" => __("Enter a CSS class if required.", 'energytheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Price", 'energytheme'),
            "param_name" => "el_price",
			"value" => '19'
            //"description" => __("Enter a CSS class if required.", 'energytheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Currency Symbol", 'energytheme'),
            "param_name" => "el_currency_symbol",
			"value" => '$'
            //"description" => __("Enter a CSS class if required.", 'energytheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Subscript", 'energytheme'),
            "param_name" => "el_subscript",
			"value" => '/mo'
            //"description" => __("Enter a CSS class if required.", 'energytheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Message", 'energytheme'),
            "param_name" => "el_message",
			"value" => ''
            //"description" => __("Enter a CSS class if required.", 'energytheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'energytheme'),
            "param_name" => "el_button_text",
			"value" => 'Purchase Plan'
            //"description" => __("Enter a CSS class if required.", 'energytheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button URL", 'energytheme'),
            "param_name" => "el_button_link",
			"value" => '#'
            //"description" => __("Enter a CSS class if required.", 'energytheme')
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Background Image", 'energytheme'),
            "param_name" => "el_bg_image",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'energytheme')
        ),

		array(
            "type" => "colorpicker",
            "heading" => __("Header Color", 'energytheme'),
            "param_name" => "el_header_color",
			"value" => '#2A313A',
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'energytheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Border Color", 'energytheme'),
            "param_name" => "el_border_color",
			"value" => '#F6D600',
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'energytheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'energytheme'),
            "param_name" => "el_text_color",
			"value" => '#ffffff',
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'energytheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Button Background Color", 'energytheme'),
            "param_name" => "el_btn_bg_color",
			"value" => '#2A313A',
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'energytheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Button Text Color", 'energytheme'),
            "param_name" => "el_btn_text_color",
			"value" => '#F6D600',
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'energytheme')
        ),
		
		
		array(
            "type" => "textfield",
            "heading" => __("Class", 'energytheme'),
            "param_name" => "el_class",
			"value" => 'wow fadeInUp',
            "description" => __("Apply a CSS class if required.", 'energytheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Animation  Delay", 'energytheme'),
            "param_name" => "el_animation_delay",
			"value" => 0.3,
            "description" => __("Control the CSS animation delay - this field accepts a postitive integer value.", 'energytheme')
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'energytheme'),
            "param_name" => "content",
			"value" => '',
            "description" => __("Format your content in an unordered list for proper formatting.", 'energytheme')
        ),
		

    )

));