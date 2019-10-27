<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_client_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_target" => '_blank',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

		//Redux options
		global $energy_options;

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php
		
			echo '<div id="pm-brands-carousel" class="owl-carousel owl-theme">';
		
			if($energy_options){
		
				$clients = $energy_options['opt-client-slides'];
				
				if(count($clients) > 0){
					
					foreach($clients as $c) {
						
						echo '<div class="pm-brand-item">';
							echo '<span></span>';
							echo '<a href="http://'.$c['url'].'" target="'.$el_target.'">'.$c['url'].'</a>';
							echo '<img src="'.$c['image'].'" class="img-responsive" alt="'.$c['title'].'">';
						echo '</div>';				
						
					}//end of foreach
					
				}//end of if
				
			}//end of if
					
			echo '</div>';
			
			echo '<div class="pm-brand-carousel-btns">';
				echo '<a class="btn pm-owl-prev fa fa-chevron-left"></a>';
				echo '<a class="btn pm-owl-play fa fa-play" id="pm-owl-play"></a>';
				echo '<a class="btn pm-owl-next fa fa-chevron-right"></a>';
			echo '</div>';
		
		?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_client_carousel",
    "name"      => __("Client Carousel", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
	
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'energytheme'),
            "param_name" => "el_target",
            "description" => __("Set the target window for the client link.", 'energytheme'),
			"value"      => array( '_blank' => '_blank', '_self' => '_self' ), //Add default value in $atts
        ),

    )

));