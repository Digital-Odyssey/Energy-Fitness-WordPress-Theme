<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_panels_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_target" => '_self',
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
        
        <ul class="pm-interactive-panels-carousel" id="pm-interactive-panels-owl">
        
        	<?php
			
				if($energy_options){
		
					$panels = $energy_options['opt-panel-slides'];
					
					if(count($panels) > 0){
						
						foreach($panels as $p) {
							
							$pieces = explode(" - ", $p['url']);
							
							$icon = $pieces[0];
							$url = $pieces[1];
							
							echo '<li>';
								echo '<div class="pm-icon-bundle">';
									echo '<i class="'.$icon.'"></i>';
									echo '<div class="pm-icon-bundle-content">';
										echo '<p><a href="'.$url.'" target="'.$el_target.'">'.$p['title'].' <i class="fa fa-angle-right"></i></a></p>';
									echo '</div>';
									echo '<div class="pm-icon-bundle-info">';
										echo '<p>'.$p['description'].'</p>';
									echo '</div>';
								 echo '</div>';
							echo '</li>';
							
						}//end of foreach
						
					}//end of if
					
				}//end of if
			
			?>
                
        </ul>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_panels_carousel",
    "name"      => __("Panels Carousel", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(

		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'energytheme'),
            "param_name" => "el_target",
            "description" => __("Set the target window panel link.", 'energytheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),
		
		

    )

));