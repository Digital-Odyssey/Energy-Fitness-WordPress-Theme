<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_content_divider extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $margin_top = $margin_bottom = $divider_style = $fancy_title = $color_selection = '' ;

        extract(shortcode_atts(array(  			
			"height" => 1,
			"width" => 80,
			"bg_color" => '#F6D600',
			"margin_top" => 20,
			"margin_bottom" => 20,
			"divider_style" => 'standard'
		), $atts)); 


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>

        <!-- Element Code start -->
        
		<?php if($divider_style === 'diamond'){ ?>
            
            <div class="pm-diamond-divider" style="margin-top:<?php esc_attr_e($margin_top); ?>px; margin-bottom:<?php esc_attr_e($margin_bottom); ?>px;"><div class="pm-diamond" style="background-color:<?php esc_attr_e($bg_color); ?>;"></div><div class="pm-diamond" style="background-color:<?php esc_attr_e($bg_color); ?>;"></div><div class="pm-diamond" style="background-color:<?php esc_attr_e($bg_color); ?>;"></div></div>
            
        <?php } else { ?>
            
            <div class="pm-divider" style="height:<?php esc_attr_e($height); ?>px; width:<?php esc_attr_e($width); ?>px; background-color:<?php esc_attr_e($bg_color); ?>; margin-top:<?php esc_attr_e($margin_top); ?>px; margin-bottom:<?php esc_attr_e($margin_bottom); ?>px;"></div>
            
        <?php } ?>
                   
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_content_divider",
    "name"      => __("Content Divider", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(

	
		array(
            "type" => "textfield",
            "heading" => __("Height", 'energytheme'),
            "param_name" => "height",
            //"description" => __("Enter a positive integer for the top margin spacing.", 'energytheme'),
			"value" => 1
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Width", 'energytheme'),
            "param_name" => "width",
            //"description" => __("Enter a positive integer for the bottom margin spacing.", 'energytheme'),
			"value" => 80
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'energytheme'),
            "param_name" => "bg_color",
            //"description" => __("Enter a positive integer for the bottom margin spacing.", 'energytheme'),
			"value" => '#F6D600'
        ),		
	
		array(
            "type" => "textfield",
            "heading" => __("Top Margin", 'energytheme'),
            "param_name" => "margin_top",
            "description" => __("Enter a positive integer for the top margin spacing.", 'energytheme'),
			"value" => 20
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Bottom Margin", 'energytheme'),
            "param_name" => "margin_bottom",
            "description" => __("Enter a positive integer for the bottom margin spacing.", 'energytheme'),
			"value" => 20
        ),
		
		
		array(
            "type" => "dropdown",
            "heading" => __("Divider Style", 'energytheme'),
            "param_name" => "divider_style",
            //"description" => __("Choose the divider style you desire.", 'energytheme'),
			"value"      => array( 'standard' => 'standard', 'diamond' => 'diamond' ),
        ),
		
	

    )

));