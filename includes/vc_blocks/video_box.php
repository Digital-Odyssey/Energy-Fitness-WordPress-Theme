<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_videobox extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"icon" => 'typcn typcn-video',
			"video_link" => '',
			"video_image" => '',
			"gallery_link" => 'on',
			"gallery_link_text" => 'View more videos in our gallery',
			"gallery_link_color" => '#383838',
			"gallery_link_url" => '',
			"gallery_link_target" => '_self'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($video_image, "large"); 
			$video_image = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-video-container" style="background-image:url(<?php echo esc_url($video_image); ?>);">
            <div class="pm-video-overlay">
                <div class="pm-video-activator-border">
                    <div class="pm-video-activator-bg"></div>
                </div>
                <a href="<?php esc_attr_e($video_link); ?>" data-rel="prettyPhoto" class="pm-video-activator-btn <?php esc_attr_e($icon); ?> expand lightbox"></a>
            </div>
        </div>	
        <?php if($gallery_link === 'on'): ?>
            <a class="pm-right-align pm-primary" style="color:<?php esc_attr_e($gallery_link_color); ?>;" href="<?php esc_attr_e($gallery_link_url); ?>" target="<?php esc_attr_e($gallery_link_target); ?>"><?php esc_attr_e($gallery_link_text); ?> <i class="fa fa-angle-right"></i></a>	
        <?php endif; ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_videobox",
    "name"      => __("Video Box", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'energytheme'),
            "param_name" => "icon",
            "description" => __("Enter a FontAwesome 4 or Typicon icon value.", 'energytheme'),
			"value" => 'typcn typcn-video'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Video URL", 'energytheme'),
            "param_name" => "video_link",
            "description" => __("Enter a URL path for your video. (Ex. https://www.youtube.com/watch?v=XFPLSUZBCB8)", 'energytheme'),
			"value" => ''
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Background Image", 'energytheme'),
            "param_name" => "video_image",
            "description" => __("Upload a background image for your video box.", 'energytheme')
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Activate Video Link?", 'energytheme'),
            "param_name" => "gallery_link",
            "description" => __("Choose whether to activate the video link.", 'energytheme'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Video Link Text", 'energytheme'),
            "param_name" => "gallery_link_text",
            "description" => __("Enter a custom message for your video link button - only applies if Video link option is set to on.", 'energytheme'),
			"value" => 'View our gallery'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Video Link Color", 'energytheme'),
            "param_name" => "gallery_link_color",
            //"description" => __("Enter a custom message for your video link button - only applies if Video link option is set to on.", 'energytheme'),
			"value" => '#383838'
        ),
		
		
		array(
            "type" => "textfield",
            "heading" => __("Video Link URL", 'energytheme'),
            "param_name" => "gallery_link_url",
            "description" => __("Enter a custom URL for your video link button - only applies if Video link is active.", 'energytheme'),
			"value" => ''
        ),
				
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'energytheme'),
            "param_name" => "gallery_link_target",
            //"description" => __("Choose whether to activate the video link.", 'energytheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),

    )

));