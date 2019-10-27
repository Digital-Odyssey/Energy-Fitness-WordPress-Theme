<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_event_posts extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"num_of_posts" => 1,
			"post_order" => 'DESC',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

		//Fetch data
		$arguments = array(
			'post_type' => 'post_event',
			'post_status' => 'publish',
			'order' => (string) $post_order,
			'posts_per_page' => $num_of_posts,
			'orderby' => 'meta_value', //Order posts by scheduled dates
			'meta_key' => 're_start_date_event',
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
        
        <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
	
    		<?php 
            $re_start_date_event = get_post_meta(get_the_ID(), 're_start_date_event', true);
            $re_end_date_event = get_post_meta(get_the_ID(), 're_end_date_event', true);
            $month = date("M", strtotime($re_start_date_event));
            $day = date("d", strtotime($re_start_date_event));
            $year = date("Y", strtotime($re_start_date_event));
            $pm_event_fan_page_meta = get_post_meta(get_the_ID(), 'pm_event_fan_page_meta', true);
            
            $pm_event_start_time_meta = get_post_meta(get_the_ID(), 're_start_time', true);
            $pm_event_end_time_meta = get_post_meta(get_the_ID(), 're_end_time', true);
            
            $pm_reoc_event = get_post_meta(get_the_ID(), 'reoc_event', true);
			
			$display_event_info = get_post_meta(get_the_ID(), 'display_event_info', true);	
	
			//add a default value as this was a later addition
			if( empty($display_event_info) ) :
			   $display_event_info = 'yes';
			endif;
			
			?>
            
            <div class="pm-event-item-container">
                <div class="pm-event-item-details">
                    <p><?php the_title(); ?></p>
                    
                    <?php if( $display_event_info === 'yes' ) { ?>
                    	<p><span><?php esc_attr_e('Start:', 'energytheme'); ?></span><?php esc_attr_e($pm_event_start_time_meta); ?> <span><?php esc_attr_e('End:', 'energytheme'); ?></span> <?php esc_attr_e($pm_event_end_time_meta); ?></p>
                    <?php } ?>
                    
                    <a href="<?php the_permalink(); ?>" class="pm-primary"><?php esc_attr_e('View event info', 'energytheme'); ?> <i class="fa fa-angle-double-right"></i></a>
                    
                    
                </div>
                <div class="pm-event-item-date-bg"></div>
                
                <?php if( $display_event_info === 'yes' ) { ?>
                
                	<div class="pm-event-item-date">
						<?php if($pm_reoc_event !== 'once') { ?>
                            <i class="fa fa-calendar"></i>
                        <?php } else { ?>
                            <p class="month"><?php esc_attr_e($month); ?></p>
                            <p class="day"><?php esc_attr_e($day); ?></p>
                        <?php } ?>
                    </div>
                
                <?php } else { ?>
                
                	<div class="pm-event-item-date">
						<i class="fa fa-calendar"></i>
                    </div>
                
                <?php } ?>
                
                
            </div>
        
        <?php endwhile; else: ?>
             <p><?php esc_attr_e('No scheduled events were found.', 'energytheme'); ?></p>
        <?php endif; ?>
        
        <!-- Element Code / END -->
        
        <?php wp_reset_postdata(); ?>

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_event_posts",
    "name"      => __("Event Posts", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
	
		array(
            "type" => "dropdown",
            "heading" => __("Number of posts to display?", 'energytheme'),
            "param_name" => "num_of_posts",
            //"description" => __("Choose the divider style you desire.", 'energytheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'energytheme'),
            "param_name" => "post_order",
            "description" => __("Set the order in which the event posts will be displayed. DESC = Descending / ASC = Ascending", 'energytheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC' ), //Add default value in $atts
        ),

    )

));