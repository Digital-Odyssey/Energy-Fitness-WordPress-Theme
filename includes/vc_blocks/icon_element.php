<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_icon_element extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"link" => '', 
			"icon" => 'fa fa-twitter',
			"icon_color" => '#ffffff',
			"font_size" => '24',
			"padding" => '14',
			"line_height" => '24'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <a href=" <?php echo esc_url($link); ?>" class="pm-icon-element  <?php esc_attr_e($icon); ?>" style="color: <?php esc_attr_e($icon_color); ?>; font-size: <?php esc_attr_e($font_size); ?>px; padding: <?php esc_attr_e($padding); ?>px; line-height: <?php esc_attr_e($line_height); ?>px;"></a>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_icon_element",
    "name"      => __("Icon Element", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Link", 'energytheme'),
            "param_name" => "link",
            //"description" => __("Leave this field blank if you wish to only display the icon.", 'energytheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'energytheme'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-twitter)", 'energytheme'),
			"value" => 'fa fa-twitter'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'energytheme'),
            "param_name" => "icon_color",
            //"description" => __("Accepts a FontAwesome 4 or Lineicons value.", 'energytheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Font Size", 'energytheme'),
            "param_name" => "font_size",
            "description" => __("Accepts a positive integer value.", 'energytheme'),
			"value" => '24'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Padding", 'energytheme'),
            "param_name" => "padding",
            "description" => __("Accepts a positive integer value.", 'energytheme'),
			"value" => '14'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Line Height", 'energytheme'),
            "param_name" => "line_height",
            "description" => __("Accepts a positive integer value.", 'energytheme'),
			"value" => '24'
        ),

    )

));