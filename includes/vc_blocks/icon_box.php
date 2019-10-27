<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_icon_box extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"margin_top" => 0,
			"margin_bottom" => 0,
			"icon" => 'typcn typcn-vendor-microsoft',
			"color" => '#7d7d7d',
			"border_radius" => 0,
			"alignment" => "left", 
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-icon-container" style="margin:<?php esc_attr_e($margin_top); ?>px <?php echo ($alignment === 'center' ? 'auto' : ''); ?> <?php esc_attr_e($margin_bottom); ?>px; border:6px solid <?php esc_attr_e($color); ?>; border-radius:<?php esc_attr_e($border_radius); ?>px;">
            <i class="<?php esc_attr_e($icon); ?>" style="color:<?php esc_attr_e($color); ?>;"></i>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_icon_box",
    "name"      => __("Icon Box", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Margin Top", 'energytheme'),
            "param_name" => "margin_top",
            //"description" => __("Leave this field blank if you wish to only display the icon.", 'energytheme'),
			"value" => 0
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Bottom", 'energytheme'),
            "param_name" => "margin_bottom",
            //"description" => __("Leave this field blank if you wish to only display the icon.", 'energytheme'),
			"value" => 0
        ),
		
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'energytheme'),
            "param_name" => "icon",
            "description" => __("Accepts a Typicon icon value. (Ex. typcn typcn-vendor-microsoft)", 'energytheme'),
			"value" => 'typcn typcn-vendor-microsoft'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Color", 'energytheme'),
            "param_name" => "color",
            //"description" => __("Accepts a FontAwesome 4 or Lineicons value.", 'energytheme'),
			"value" => '#7d7d7d'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Border Radius", 'energytheme'),
            "param_name" => "border_radius",
            "description" => __("Accepts a positive integer value.", 'energytheme'),
			"value" => 0
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Alignment", 'energytheme'),
            "param_name" => "alignment",
            //"description" => __("Choose the divider style you desire.", 'energytheme'),
			"value"      => array( 'left' => 'left', 'center' => 'center' ), //Add default value in $atts
        ),

    )

));