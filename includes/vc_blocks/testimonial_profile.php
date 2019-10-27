<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_testimonial_profile extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"name" => '',
			"title" => '',
			"date" => '',
			"image" => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($image, "large"); 
			$image = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-single-testimonial">
            <?php if($image !== '') : ?>
                <img width="270" height="270" src="<?php echo esc_url($image); ?>">
            <?php endif; ?>
            <p class="name"><?php esc_attr_e($name); ?></p>
            <p class="title"><?php esc_attr_e($title); ?></p>
            <div class="pm-single-testimonial-divider"></div>
            <p class="quote"><?php echo $content ?></p>
            <div class="pm-single-testimonial-divider"></div>
            <p class="date"><?php esc_attr_e($date); ?></p>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_testimonial_profile",
    "name"      => __("Testimonial Profile", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Name", 'energytheme'),
            "param_name" => "name",
			"value" => ''
            //"description" => __("Enter a CSS class if required.", 'energytheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Title", 'energytheme'),
            "param_name" => "title",
			"value" => '',
            //"description" => __("Enter a CSS class if required.", 'energytheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Date", 'energytheme'),
            "param_name" => "date",
			"value" => '',
            "description" => __("Enter a date if required.", 'energytheme')
        ),

		
		array(
            "type" => "attach_image",
            "heading" => __("Avatar", 'energytheme'),
            "param_name" => "image",
            "description" => __("Upload an avatar for your testimonial. Recommended size 230x230px", 'energytheme')
        ),		
		
		array(
            "type" => "textarea_html",
            "heading" => __("Quote", 'energytheme'),
            "param_name" => "content",
            "description" => __("Enter your testimonial quote.", 'energytheme')
        ),	
		

    )

));