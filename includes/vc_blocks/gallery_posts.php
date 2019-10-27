<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_gallery_posts extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"num_of_posts" => -1,
			"post_order" => 'DESC',
			"category" => '',
			"display_caption" => 'true'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

		if( $category !== '' ) {
		
			$arguments = array(
				'post_type' => 'post_galleries',
				'post_status' => 'publish',
				'order' => $post_order,
				'posts_per_page' => $num_of_posts,
				'tax_query' => array(
					array(
						'taxonomy' => 'gallerycats',
						'field' => 'slug',
						'terms' => array( $category )
					)
				),
			);
			
		} else {
			
			$arguments = array(
				'post_type' => 'post_galleries',
				'post_status' => 'publish',
				'order' => $post_order,
				'posts_per_page' => $num_of_posts,
				//'tag' => get_query_var('tag')
			);
			
		}	
	
		$blog_query = new WP_Query($arguments);

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="row">
	            
        <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
            <?php 
				$pm_gallery_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_image_meta', true);
				$pm_gallery_item_caption_meta = get_post_meta(get_the_ID(), 'pm_gallery_item_caption_meta', true);
				$pm_gallery_video_meta = get_post_meta(get_the_ID(), 'pm_gallery_video_meta', true);
				$pm_gallery_display_video_meta = get_post_meta(get_the_ID(), 'pm_gallery_display_video_meta', true);
			?>
            
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="pm-gallery-post-container" style="background-image:url(<?php echo esc_url($pm_gallery_image_meta); ?>);">
                    <div class="pm-gallery-post-title-container">
                        <span><?php the_title(); ?></span><a href="#" class="pm-expand-gallery-post fa fa-expand"></a>
                    </div>
                    <div class="pm-gallery-post-like-diamond-shadow"></div>
                    <div class="pm-gallery-post-like-diamond"></div>
                    <a href="#" class="pm-gallery-post-like-btn pm-like-this-btn fa fa-thumbs-up" id="<?php echo get_the_ID(); ?>"></a>
                    <?php $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true); ?>
                    <div class="pm-gallery-post-like-counter" id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"> <?php esc_attr_e($likes); ?></div>				
                    <div class="pm-gallery-post-gradient"></div>
                    <div class="pm-gallery-post-details shortcode">
                        <div class="pm-gallery-post-details-excerpt">
                            <?php $excerpt = get_the_excerpt(); ?>
                            <p><?php echo pm_ln_string_limit_words($excerpt, 30); ?> <a href="<?php the_permalink(); ?>">[...]</a></p>
                        </div>
                        <div class="pm-gallery-post-details-diamond-shadow"></div>
                        <div class="pm-gallery-post-details-diamond"></div>
                        
                        <?php if($pm_gallery_display_video_meta ==='yes' ) { ?>
                        
                            <a href="<?php esc_attr_e($pm_gallery_video_meta); ?>" data-rel="prettyPhoto[video]" class="pm-gallery-post-view-btn fa fa-video-camera expand lightbox" <?php echo ($display_caption === 'true' ? 'title="'. esc_attr($pm_gallery_item_caption_meta) .'"' : ''); ?>></a>
                            
                        <?php } else { ?>
                        
                            <a href="<?php esc_attr_e($pm_gallery_image_meta); ?>" data-rel="prettyPhoto[gallery]" class="pm-gallery-post-view-btn fa fa-camera expand lightbox" <?php echo ($display_caption === 'true' ? 'title="'. esc_attr($pm_gallery_item_caption_meta) .'"' : ''); ?>></a>
                            
                        <?php } ?>
                        
                        <ul class="pm-gallery-post-details-actions">
                            <li>
                                <a href="#" class="pm-gallery-post-close fa fa-chevron-left"></a>
                            </li>
                            <li><a href="<?php the_permalink(); ?>" class="pm-gallery-post-view-more"><?php esc_attr_e('View Post', 'energytheme'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        
        <?php endwhile; else: ?>
             
        <?php endif; ?>
        
        <?php wp_reset_postdata(); ?>
    
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_gallery_posts",
    "name"      => __("Gallery Posts", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(

		array(
            "type" => "dropdown",
            "heading" => __("Number of posts to display?", 'energytheme'),
            "param_name" => "num_of_posts",
            "description" => __("Choose the number of gallery posts you want to display. A value of -1 will display all gallery posts.", 'energytheme'),
			"value"      => array( '-1' => '-1', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'energytheme'),
            "param_name" => "post_order",
            "description" => __("Choose the divider style you desire.", 'energytheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Category", 'energytheme'),
            "param_name" => "category",
            "description" => __("Retrieve events based on a specific category slug.", 'energytheme')
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Caption?", 'energytheme'),
            "param_name" => "display_caption",
            "description" => __("Choose the divider style you desire.", 'energytheme'),
			"value"      => array( 'true' => 'true', 'false' => 'false' ), //Add default value in $atts
        ),
		

    )

));