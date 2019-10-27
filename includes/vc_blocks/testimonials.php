<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_testimonials extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"default" => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		global $energy_options;
	
		

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_icon_image, "large"); 
			//$el_icon_image = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php
		
			if($energy_options){
		
				$testimonials = $energy_options['opt-testimonials-slides'];
				
				if(is_array($testimonials)){
					
					$counter = 0;
					
					echo '<div class="pm-testimonials-carousel" id="pm-testimonials-carousel">';
						echo '<ul class="pm-testimonial-items">';
					
							foreach($testimonials as $t) {
								
								echo '<li>';
									echo '<p class="pm-testimonial-quote">'.$t['description'].'</p>';
									echo '<p class="pm-testimonial-name">'.$t['title'].' / '.$t['url'].'</p>';
									echo '<div class="pm-testimonial-img">';
										echo '<img src="'.$t['image'].'" alt="'.$t['title'].'" />';
									echo '</div>';
								echo '</li>';
								
							}//end of foreach
					
						echo '</ul>';				
					echo '</div>';
					
				}
				
			}
		
		?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_testimonials",
    "name"      => __("Testimonials", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
	
		/*array(
            "type" => "textfield",
            "heading" => __("Icon", 'energytheme'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-globe)", 'energytheme'),
			"value" => ''
        ),*/

    )

));