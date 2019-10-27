<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_stat_box extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"title" => '',
			"icon" => '',
			"title_color" =>'#000000',
			"text_color" =>'#ffffff',
			"animation_delay" => 0.3,
			"class" => 'wow fadeInUp',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-value-item-container <?php esc_attr_e($class); ?>" data-wow-duration="1s" data-wow-offset="50" data-wow-delay="<?php esc_attr_e($animation_delay); ?>s">
            <div class="pm-value-diamond-shadow"></div>
            <div class="pm-value-diamond"></div>
            
            <div class="pm-value-title">
                <p class="<?php esc_attr_e($title_color); ?>"><?php esc_attr_e($title); ?></p>
                <i class="<?php esc_attr_e($icon); ?>"></i>
            </div>
            
            <div class="pm-value-quote-container">
                <p style="color:<?php esc_attr_e($text_color); ?>;"><?php echo do_shortcode($content); ?></p>
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

    "base"      => "pm_ln_stat_box",
    "name"      => __("Stat Box", 'energytheme'),
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
            "heading" => __("Icon", 'energytheme'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-clock)", 'energytheme'),
			"value" => ''
        ),
				
		array(
            "type" => "colorpicker",
            "heading" => __("Title Color", 'energytheme'),
            "param_name" => "title_color",
            //"description" => __("Choose the divider style you desire.", 'energytheme'),
			"value"      => "#000000"
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'energytheme'),
            "param_name" => "text_color",
            //"description" => __("Choose the divider style you desire.", 'energytheme'),
			"value"      => "#ffffff"
        ),
		
		
		array(
            "type" => "textfield",
            "heading" => __("Animation Delay", 'energytheme'),
            "param_name" => "animation_delay",
            "description" => __("Accepts a positive integer value", 'energytheme'),
			"value" => 0.3
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Class", 'energytheme'),
            "param_name" => "class",
            "description" => __("Apply a custom CSS class if required", 'energytheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'energytheme'),
            "param_name" => "content",
            //"description" => __("Apply a custom CSS class if required", 'energytheme'),
			"value" => ''
        ),
		
		

    )

));