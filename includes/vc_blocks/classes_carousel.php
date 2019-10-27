<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_classes_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"post_order" => 'DESC',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		$todaysDate = date( 'Y-m-d' ); //This date format is required by WordPress to match dates
	
		//Fetch data
		$arguments = array(
			'post_type' => 'post_schedules',
			'post_status' => 'publish',
			'order' => (string) $post_order,
			/*'orderby' => 'meta_value',
			'meta_key' => 're_start_date_event',*/
			'posts_per_page' => '-1',
			'meta_query' => array(
				array(
					'key' => 'is_expired',
					'value' => 'true',
					'compare' => '!=',
				)
			),
		);
	
		$post_query = new WP_Query($arguments);

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="flexslider pm-post-slider" id="pm-flexslider-classes">
            <ul class="slides">
        
                <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
                      
                    <?php 
					               
                    $pm_schedule_start_time_meta = get_post_meta(get_the_ID(), 're_start_time', true);
                    $pm_schedule_end_time_meta = get_post_meta(get_the_ID(), 're_end_time', true);
                    $pm_schedule_location_meta = get_post_meta(get_the_ID(), 'pm_schedule_location_meta', true);
                    $pm_schedule_cancellation_meta = get_post_meta(get_the_ID(), 'pm_schedule_cancellation_meta', true);
					
					$display_schedule_info = get_post_meta(get_the_ID(), 'display_schedule_info', true);	
	 
					 //add a default value as this was a later addition
					 if( empty($display_schedule_info) ) :
						$display_schedule_info = 'yes';
					 endif;
                
                    if ( has_post_thumbnail()) {
                      $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
                    }
					
					?>
                    
                    <li>
                        <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title(); ?>" class="img-repsonsive" />
                        <div class="pm-flexslider-details">
                            <p class="title"><?php the_title(); ?></p>
                            
                            <?php if( $display_schedule_info === 'yes' ) { ?>
                            
                            	<?php if($pm_schedule_cancellation_meta === 'yes') { ?>
                                    <p class="details"><?php esc_attr_e('Cancelled', 'energytheme'); ?></p>
                                <?php } else { ?>
                                    <p class="details"><?php esc_attr_e($pm_schedule_start_time_meta); ?> - <?php esc_attr_e($pm_schedule_end_time_meta); ?> / <?php esc_attr_e($pm_schedule_location_meta); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="pm-event-item-details"><?php esc_attr_e('View details', 'energytheme'); ?></a>
                                <?php }   ?>
                            
                            <?php } else { ?>
                            
                            	<a href="<?php the_permalink(); ?>" class="pm-event-item-details"><?php esc_attr_e('View details', 'energytheme'); ?></a>
                            
                            <?php } ?>
                            
                        </div>
                        
                    </li>
                
                <?php endwhile; else: ?>
                     <p><?php esc_attr_e('No scheduled classes were found.', 'energytheme'); ?></p>
                <?php endif; ?>
                
            </ul>
        </div>
        
        <!-- Element Code / END -->
        
        <?php wp_reset_postdata(); ?>

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_classes_carousel",
    "name"      => __("Classes Carousel", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(

		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'energytheme'),
            "param_name" => "post_order",
            "description" => __("Choose the divider style you desire.", 'energytheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC' ), //Add default value in $atts
        ),
		


    )

));