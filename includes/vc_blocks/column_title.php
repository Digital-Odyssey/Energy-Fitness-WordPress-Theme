<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_column_title extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"default" => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        <h6 class="pm-column-title"><?php echo $content ?></h6>
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_column_title",
    "name"      => __("Column Title", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'energytheme'),
            "param_name" => "content",
            //"description" => __("Enter a short description for your service.", 'energytheme')
        ),
		

    )

));