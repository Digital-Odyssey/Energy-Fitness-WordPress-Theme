<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_progress_bar extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"percentage" => '50',
			"text" => '',
			"id" => 1
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-progress-bar-description" id="pm-progress-bar-desc-<?php esc_attr_e($id); ?>">
            <?php esc_attr_e($text); ?>
            <div class="pm-progress-bar-diamond"></div>
            <span><?php esc_attr_e($percentage); ?>%</span>
        </div>
        <div class="pm-progress-bar"> 
            <span data-width="<?php esc_attr_e($percentage); ?>" class="pm-progress-bar-outer" id="pm-progress-bar-<?php esc_attr_e($id); ?>">
                <span class="pm-progress-bar-inner"></span> 
            </span>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_progress_bar",
    "name"      => __("Progress Bar", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
		
		array(
            "type" => "dropdown",
            "heading" => __("Element ID Number", 'energytheme'),
            "param_name" => "id",
            "description" => __("Enter a unique ID number to avoid conflicts with multiple progress bars on the same page.", 'energytheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Percentage", 'energytheme'),
            "param_name" => "percentage",
            "description" => __("Enter a positive integer value between 0 and 100.", 'energytheme'),
			"value" => '50'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Short Message", 'energytheme'),
            "param_name" => "text",
            "description" => __("Enter a short message to display.", 'energytheme'),
			"value" => ''
        ),
				

    )

));