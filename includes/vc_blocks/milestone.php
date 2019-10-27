<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_milestone extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(			
			"speed" => "",
			"stop" => "",
			"caption" => "",
			"icon" => "",
			"icon_color" => '#ffffff',
			"bg_color" => '#333333',
			"text_color" => '#333333',
			"stat_size" => 40,
			"text_size" => 24,
			"border_radius" => 99,
			"padding" => 10,
			"width" => 140,
			"height" => 140,
			"icon_size" => 60,
			"line_height" => 2.3,
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="milestone">
        
            <?php if($icon !== '') : ?>
            
            	<i class="<?php esc_attr_e($icon); ?>" style="background-color:<?php esc_attr_e($bg_color); ?>; line-height:<?php esc_attr_e($line_height); ?>; color:<?php esc_attr_e($icon_color); ?>; border-radius:<?php esc_attr_e($border_radius); ?>px; padding:<?php esc_attr_e($padding); ?>px; font-size:<?php esc_attr_e($icon_size); ?>px; width:<?php esc_attr_e($width); ?>px; height:<?php esc_attr_e($height); ?>px;"></i>
            
            <?php endif; ?>
            
            <div class="milestone-content" style="font-size:<?php esc_attr_e($font_size); ?>px;">                     
                <span data-speed="<?php esc_attr_e($speed); ?>" data-stop="<?php esc_attr_e($stop); ?>" class="milestone-value" style="color:<?php esc_attr_e($text_color); ?>; font-size:<?php esc_attr_e($stat_size); ?>px !important;;"></span>
                <div class="milestone-description" style="color:<?php esc_attr_e($text_color); ?>; font-size:<?php esc_attr_e($text_size); ?>px;"><?php esc_attr_e($caption); ?></div>
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

    "base"      => "pm_ln_milestone",
    "name"      => __("Milestone", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(	

		array(
            "type" => "textfield",
            "heading" => __("Speed", 'energytheme'),
            "param_name" => "speed",
            "description" => __("Enter a positive integer value.", 'energytheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Stop value", 'energytheme'),
            "param_name" => "stop",
            "description" => __("Enter a positive integer value.", 'energytheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Caption", 'energytheme'),
            "param_name" => "caption",
            "description" => __("Enter a short caption.", 'energytheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'energytheme'),
            "param_name" => "icon",
            "description" => __("Enter a Typicon icon or FontAwesome 4 icon value. (Ex. typcn typcn-cog / fa fa-ambulance)", 'energytheme'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'energytheme'),
            "param_name" => "icon_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'energytheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'energytheme'),
            "param_name" => "bg_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'energytheme'),
			"value" => '#333333'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'energytheme'),
            "param_name" => "text_color",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'energytheme'),
			"value" => '#333333'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Font size for stat value", 'energytheme'),
            "param_name" => "stat_size",
            "description" => __("Enter a positive integer value.", 'energytheme'),
			"value" => 40
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Font size for description", 'energytheme'),
            "param_name" => "text_size",
            "description" => __("Enter a positive integer value.", 'energytheme'),
			"value" => 24
        ),
		
		
		
		array(
            "type" => "textfield",
            "heading" => __("Border Radius", 'energytheme'),
            "param_name" => "border_radius",
            "description" => __("Enter a positive integer value between 0 and 99px.", 'energytheme'),
			"value" => 99
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Padding", 'energytheme'),
            "param_name" => "padding",
            "description" => __("Enter a positive integer value.", 'energytheme'),
			"value" => 10
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Width", 'energytheme'),
            "param_name" => "width",
            "description" => __("Enter a positive integer value.", 'energytheme'),
			"value" => 140
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Height", 'energytheme'),
            "param_name" => "height",
            "description" => __("Enter a positive integer value.", 'energytheme'),
			"value" => 140
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon Size", 'energytheme'),
            "param_name" => "icon_size",
            "description" => __("Enter a positive integer value.", 'energytheme'),
			"value" => 60
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Line Height", 'energytheme'),
            "param_name" => "line_height",
            "description" => __("Controls the vertical positioning of the icon.", 'energytheme'),
			"value" => 2.3
        ),

    )

));