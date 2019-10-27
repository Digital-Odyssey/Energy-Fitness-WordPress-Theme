<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_countdown extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"date" => '2017/08/25',	
			"id" => 1,
			"text_size" => 30,
			"text_color" => "#333333"
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
       <div class="pm-countdown-container" id="pm-countdown-container-<?php esc_attr_e($id); ?>" style="font-size:<?php esc_attr_e($text_size); ?>px; color:<?php esc_attr_e($text_color); ?>;"></div>
	   
	   <?php 
	   
	   		echo '<script type="text/javascript">(function($) { $(document).ready(function(e) { $("#pm-countdown-container-'.esc_attr($id).'").countdown("'.esc_attr($date).'", function(event) { $(this).html(event.strftime("%w weeks %d days %H:%M:%S")); }); }); })(jQuery);</script>';
	   
	   ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_countdown",
    "name"      => __("Countdown", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(

		array(
            "type" => "dropdown",
            "heading" => __("Element ID", 'energytheme'),
            "param_name" => "id",
            "description" => __("Assign a unique numeric ID value to prevent conflicts with multiple countdowns on a single page.", 'energytheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Date", 'energytheme'),
            "param_name" => "date",
            "description" => __("Enter a date in the following format: 2017/08/25", 'energytheme'),
			"value" => '2017/08/25'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Text Size", 'energytheme'),
            "param_name" => "text_size",
            "description" => __("Accepts a positive integer for the font size.", 'energytheme'),
			"value" => 30
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'energytheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a date in the following format: 2016/08/25", 'energytheme'),
			"value" => '#333333'
        ),
		
		
		
		

    )

));