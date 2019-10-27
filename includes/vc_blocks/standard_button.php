<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_standard_button extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(	
			"btn_text" => '',		
			"link" => '#',
			"margin_top" => 0,
			"margin_bottom" => 0,
			"target" => '_self',
			"icon" => '',
			"text_color" => '#ffffff',
			"flip_colors" => "no",
			"animated" => 'off',
			"class" => ''
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <a class="pm-rounded-btn <?php echo ($class !== '' ? $class : ''); ?> <?php echo ($flip_colors === 'yes' ? 'flip_color' : ''); ?> <?php echo ( $animated == 'on' ? 'animated' : '' ); ?>" href="<?php esc_attr_e($link); ?>" target="<?php esc_attr_e($target); ?>" style="margin-top:<?php esc_attr_e($margin_top); ?>px; color:<?php esc_attr_e($text_color); ?> !important; margin-bottom:<?php esc_attr_e($margin_bottom); ?>px;"><?php esc_attr_e($btn_text); ?> <?php echo ($icon !== '' ? ' &nbsp;<i class="'. esc_attr($icon) .'"></i>' : '') ?></a>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_standard_button",
    "name"      => __("Button", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'energytheme'),
            "param_name" => "btn_text",
            //"description" => __("Enter a CSS class if required.", 'energytheme'),
			"value" => ''
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Link", 'energytheme'),
            "param_name" => "link",
            //"description" => __("Enter a CSS class if required.", 'energytheme'),
			"value" => '#'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Top", 'energytheme'),
            "param_name" => "margin_top",
            "description" => __("Enter a positive integer value.", 'energytheme'),
			"value" => 0
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Bottom", 'energytheme'),
            "param_name" => "margin_bottom",
            "description" => __("Enter a positive integer value.", 'energytheme'),
			"value" => 0
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'energytheme'),
            "param_name" => "target",
            "description" => __("Set the target window for the button.", 'energytheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'energytheme'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-angle-right)", 'energytheme'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'energytheme'),
            "param_name" => "text_color",
            //"description" => __("Enter an icon value.", 'energytheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Flip Colors?", 'energytheme'),
            "param_name" => "flip_colors",
            "description" => __("Reverse the order of the button colors.", 'energytheme'),
			"value"      => array( 'no' => 'no', 'yes' => 'yes' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Button Animation?", 'energytheme'),
            "param_name" => "animated",
            "description" => __("Adds a rollover animation effect to the icon.", 'energytheme'),
			"value"      => array( 'off' => 'off', 'on' => 'on' ), //Add default value in $atts
        ),
		
		/*array(
            "type" => "dropdown",
            "heading" => __("Button Type", 'energytheme'),
            "param_name" => "button_type",
            //"description" => __("Adds a rollover animation effect to the icon.", 'energytheme'),
			"value"      => array( 'opaque' => 'opaque', 'transparent' => 'transparent' ), //Add default value in $atts
        ),*/
				
		array(
            "type" => "textfield",
            "heading" => __("Class", 'energytheme'),
            "param_name" => "class",
            "description" => __("Apply a custom CSS class if required.", 'energytheme'),
			"value" => ''
        ),


    )

));