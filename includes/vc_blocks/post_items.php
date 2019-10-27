<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_post_items extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"num_of_posts" => '1',
			"post_order" => 'DESC',
			"class" => 'wow fadeInUp'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		
		//Fetch data
		$arguments = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			//'posts_per_page' => -1,
			'order' => (string) $post_order,
			'posts_per_page' => $num_of_posts,
			'ignore_sticky_posts' => 1
			//'tag' => get_query_var('tag')
		);
	
		$post_query = new WP_Query($arguments);
	
		$animationCounter = 3;

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div<?php echo ($num_of_posts > 3 ? ' id="pm-postItems-carousel"' : ''); ?>>
		
            <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
            
                <?php 
				
				$categories = get_the_category();
                $image_url = '';
                if ( has_post_thumbnail()) {
                  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
                }	
				
				?>		                
                
                <?php if($num_of_posts == "1"){ ?>
                    <div class="col-lg-12">
                <?php } elseif($num_of_posts == "2") { ?>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                <?php } elseif($num_of_posts == "3") { ?>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                <?php } else { ?>
                    <div class="pm-postItem-carousel-item">	
                <?php } ?>
                    <article class="pm-column-spacing <?php esc_attr_e($class); ?>" data-wow-delay="0.<?php $animationCounter ?>s" data-wow-offset="50" data-wow-duration="1s">
                        <div class="pm-standalone-news-post" <?php echo ($image_url !== '' ? 'style="background-image:url('. esc_url($image_url[0]) .');"' : ''); ?>>
                            <div class="pm-standalone-news-post-date-shadow"></div>
                            <div class="pm-standalone-news-post-date-bg"></div>
                            <div class="pm-standalone-news-post-date">
                                <p class="month"><?php echo get_the_time( 'M' ); ?></p>
                                <p class="day"><?php echo get_the_time( 'd' ); ?></p>
                            </div>
                            <?php $title = get_the_title(); ?>
                            <div class="pm-standalone-news-title">
                                <h6><?php echo pm_ln_set_primary_words($title); ?></h6>
                                <a href="<?php the_permalink(); ?>" class="pm-standalone-news-post-link fa fa-link"></a>
                            </div>
                        </div>		
                        <div class="pm-standalone-news-post-tags-and-excerpt">
                            <p><?php esc_attr_e('Posted in:', 'energytheme'); ?>
                            
                            <?php 
                            if($categories){
                                
                                $catCounter = 0;
                                $totalCats = count($categories);
                                
                                foreach($categories as $category) {
                                    
                                    $catCounter++;
                                    
                                    if($catCounter >= $totalCats){
                                        echo '<a href="'. get_category_link( $category->term_id ).' ">'. $category->cat_name .'</a>';
                                    } else {
                                        echo '<a href="'. get_category_link( $category->term_id ) .'">'. $category->cat_name .'</a>,'; 	
                                    }
                                        
                                }
                            }
							?>
                            
                            </p>
                            <div class="pm-standalone-news-post-divider"></div>
                            <?php $the_excerpt = get_the_excerpt(); ?>
                        </div>
                        <p class="pm-standalone-news-excerpt"><?php echo pm_ln_string_limit_words($the_excerpt, 20); ?> <a href="<?php the_permalink(); ?>">[...]</a> </p>
                    </article>
                </div>
                
                <?php $animationCounter += 3; ?>
            
            <?php endwhile; else: ?>
                <div class="col-lg-12 pm-column-spacing">
                 <p><?php esc_attr_e('No posts were found.', 'energytheme'); ?></p>
                </div>
            <?php endif; ?>
        
        </div>
                    
        <?php wp_reset_postdata(); ?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_post_items",
    "name"      => __("News Posts", 'energytheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Energy Shortcodes", 'energytheme'),
    "params"    => array(
		
		array(
            "type" => "dropdown",
            "heading" => __("Amount of News Posts to display:", 'energytheme'),
            "param_name" => "num_of_posts",
            "description" => __("Choose how many news posts you would like to display.", 'energytheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'energytheme'),
            "param_name" => "post_order",
            "description" => __("Set the order in which news posts will be displayed.", 'energytheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC'), //Add default value in $atts
        ),
				
		array(
            "type" => "textfield",
            "heading" => __("Class", 'energytheme'),
            "param_name" => "class",
            "description" => __("Apply a custom CSS class if required.", 'energytheme'),
			"value"      => 'wow fadeInUp', //Add default value in $atts
        ),


    )

));