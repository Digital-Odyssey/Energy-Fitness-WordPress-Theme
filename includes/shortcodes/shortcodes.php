<?php
/*-----------------------------------------------------------------------------------*/
/*	Theme Shortcodes
/*-----------------------------------------------------------------------------------*/

// This function will run to make sure that column shortcodes run after wp_texturize so that stray paragraph and line break tags aren't added.
function pm_ln_run_shortcode( $content ) {
    //global $shortcode_tags;
    // Backup current registered shortcodes and clear them all out
    //$orig_shortcode_tags = $shortcode_tags;
    //remove_all_shortcodes();	
		
	//add_shortcode("customSlider", "customSlider");
	add_shortcode("tabGroup", "tabGroup");//COMPLETE
	add_shortcode("tabItem", "tabItem");//COMPLETE	
	
	add_shortcode("accordionGroup", "accordionGroup");//COMPLETE
	add_shortcode("accordionItem", "accordionItem");//COMPLETE	
	add_shortcode("sliderCarousel", "sliderCarousel");//COMPLETE
	add_shortcode("sliderItem", "sliderItem");//COMPLETE	
	add_shortcode("dataTableGroup", "dataTableGroup");//COMPLETE
	add_shortcode("dataTableItem", "dataTableItem");//COMPLETE	
	add_shortcode("newsletterSignup", "newsletterSignup");//COMPLETE	
	add_shortcode("progressBar", "progressBar");//COMPLETE		
	add_shortcode("iconElement", "iconElement");//COMPLETE	
	add_shortcode("youtubeVideo", "youtubeVideo");//COMPLETE	
	add_shortcode("vimeoVideo", "vimeoVideo");//COMPLETE	
	add_shortcode("html5Video", "html5Video");//COMPLETE	
	add_shortcode("googleMap", "googleMap");//COMPLETE	
	add_shortcode("divider", "divider");//COMPLETE	
	add_shortcode("standardButton", "standardButton");//COMPLETE	
	add_shortcode("iconBox", "iconBox");//COMPLETE	
	add_shortcode("countdown", "countdown");//COMPLETE	
	add_shortcode("milestone", "milestone");//COMPLETE	
	add_shortcode("piechart", "piechart");//COMPLETE	
	add_shortcode("ctaBox", "ctaBox");//COMPLETE
	add_shortcode("testimonialProfile", "testimonialProfile");//COMPLETE		
	add_shortcode("postItems", "postItems");//COMPLETE	
	add_shortcode("videoBox", "videoBox");//COMPLETE	
	add_shortcode("staffProfile", "staffProfile");//COMPLETE	
	add_shortcode("pricingTable", "pricingTable");//COMPLETE	
	add_shortcode("statBox", "statBox");//COMPLETE	
	add_shortcode("columnTitle", "columnTitle");//COMPLETE	
	add_shortcode("galleryPosts", "galleryPosts");//COMPLETE	
	add_shortcode("trialForm", "trialForm");//COMPLETE		
	add_shortcode("classesCarousel", "classesCarousel");//COMPLETE	
	add_shortcode("eventItems", "eventItems");//COMPLETE
	add_shortcode("panelsCarousel", "panelsCarousel");//COMPLETE
	add_shortcode("clientCarousel", "clientCarousel");//COMPLETE
	add_shortcode("testimonials", "testimonials");//COMPLETE
	add_shortcode("alert", "alert");//COMPLETE
	add_shortcode("quoteBox", "quoteBox"); //COMPLETE
	add_shortcode("contactForm", "contactForm");//COMPLETE
	
	//Bootstrap 3
	add_shortcode("bootstrapContainer", "bootstrapContainer");//COMPLETE
	add_shortcode("bootstrapRow", "bootstrapRow");//COMPLETE
	add_shortcode("bootstrapColumn", "bootstrapColumn");//COMPLETE
	add_shortcode("nestedRow", "nestedRow");//COMPLETE
	add_shortcode("nestedColumn", "nestedColumn");//COMPLETE
	
    // Do the shortcode (only the one above is registered)
    //$content = do_shortcode( $content );
    // Put the original shortcodes back
    //$shortcode_tags = $orig_shortcode_tags;
    return $content;
}
add_filter( 'the_content', 'pm_ln_run_shortcode', 7 );
add_filter( 'widget_text', 'pm_ln_run_shortcode', 7 );


//GALLERY POSTS
function galleryPosts($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"total_posts" => '3',
		"post_order" => 'DESC',
		"category" => ''
		), 
	$atts));
		
	if( $category !== '' ) {
		
		$arguments = array(
			'post_type' => 'post_galleries',
			'post_status' => 'publish',
			'order' => $post_order,
			'posts_per_page' => $total_posts,
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
			'posts_per_page' => $total_posts,
			//'tag' => get_query_var('tag')
		);
		
	}	

	$blog_query = new WP_Query($arguments);

	pm_ln_set_query($blog_query);
	
	$html = '';
	
	$html .= '<div class="row">';
	
	global $energy_options;
	$showCaption = $energy_options['ppShowTitle'];

		
	if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post();
				
		$pm_gallery_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_image_meta', true);
		$pm_gallery_item_caption_meta = get_post_meta(get_the_ID(), 'pm_gallery_item_caption_meta', true);
		$pm_gallery_video_meta = get_post_meta(get_the_ID(), 'pm_gallery_video_meta', true);
		$pm_gallery_display_video_meta = get_post_meta(get_the_ID(), 'pm_gallery_display_video_meta', true);
		
		$html .= '<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">';
			$html .= '<div class="pm-gallery-post-container" style="background-image:url('. esc_html($pm_gallery_image_meta) .');">';
				$html .= '<div class="pm-gallery-post-title-container">';
					$html .= '<span>'. get_the_title() .'</span><a href="#" class="pm-expand-gallery-post fa fa-expand"></a>';
				$html .= '</div>';
				$html .= '<div class="pm-gallery-post-like-diamond-shadow"></div>';
				$html .= '<div class="pm-gallery-post-like-diamond"></div>';
				$html .= '<a href="#" class="pm-gallery-post-like-btn pm-like-this-btn fa fa-thumbs-up" id="'. get_the_ID() .'"></a>';
				$likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);
				$html .= '<div class="pm-gallery-post-like-counter" id="pm-post-total-likes-count-'. get_the_ID() .'"> '.esc_attr($likes).' </div>';				
				$html .= '<div class="pm-gallery-post-gradient"></div>';
				$html .= '<div class="pm-gallery-post-details shortcode">';
					$html .= '<div class="pm-gallery-post-details-excerpt">';
						$excerpt = get_the_excerpt();
						$html .= '<p>'. pm_ln_string_limit_words($excerpt, 30) .' <a href="'. get_the_permalink() .'">[...]</a></p>';
					$html .= '</div>';
					$html .= '<div class="pm-gallery-post-details-diamond-shadow"></div>';
					$html .= '<div class="pm-gallery-post-details-diamond"></div>';
					if($pm_gallery_display_video_meta ==='yes' ) {
						$html .= '<a href="'. esc_attr($pm_gallery_video_meta) .'" data-rel="prettyPhoto[video]" class="pm-gallery-post-view-btn fa fa-video-camera expand lightbox" '. ($showCaption === 'true' ? 'title="'. esc_attr($pm_gallery_item_caption_meta) .'"' : '') .'></a>';
					} else {
						$html .= '<a href="'. esc_attr($pm_gallery_image_meta) .'" data-rel="prettyPhoto[gallery]" class="pm-gallery-post-view-btn fa fa-camera expand lightbox" '. ($showCaption === 'true' ? 'title="'. esc_attr($pm_gallery_item_caption_meta) .'"' : '') .'></a>';
					} 	
					$html .= '<ul class="pm-gallery-post-details-actions">';
						$html .= '<li>';
							$html .= '<a href="#" class="pm-gallery-post-close fa fa-chevron-left"></a>';
						$html .= '</li>';
						$html .= '<li><a href="'. get_the_permalink() .'" class="pm-gallery-post-view-more">'. esc_attr__('View Post', 'energytheme') .'</a></li>';
					$html .= '</ul>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
	
	endwhile; else:
		 
	endif;	

	$html .= '</div>';
	
	pm_ln_restore_query(); 
	
	return $html;
	
}//end of galleryPosts



//SINGLE TESTIMONIAL
function testimonialProfile($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"name" => '',
		"title" => '',
		"date" => '',
		"image" => ''
		), 
	$atts));
	
	
	$html = '';
	
	$html .= '<div class="pm-single-testimonial">';
		if($image !== '') :
			$html .= '<img width="270" height="270" src="'.$image.'">';
		endif;
		$html .= '<p class="name">'.$name.'</p>';
		$html .= '<p class="title">'.$title.'</p>';
		$html .= '<div class="pm-single-testimonial-divider"></div>';
		$html .= '<p class="quote">'.$content.'</p>';
		$html .= '<div class="pm-single-testimonial-divider"></div>';
		$html .= '<p class="date">'.$date.'</p>';
	$html .= '</div>';
	
	return $html;
	
}


//EVENT ITEMS
function eventItems($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"num_of_posts" => '3',
		"post_order" => 'DESC',
		), 
	$atts));
	
	$todaysDate = date( 'Y-m-d' ); //This date format is required by WordPress to match dates
	
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

	pm_ln_set_query($post_query);
	
	$html = '';
	
	if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
	
		$re_start_date_event = get_post_meta(get_the_ID(), 're_start_date_event', true);
		$re_end_date_event = get_post_meta(get_the_ID(), 're_end_date_event', true);
		$month = date("M", strtotime($re_start_date_event));
		$day = date("d", strtotime($re_start_date_event));
		$year = date("Y", strtotime($re_start_date_event));
		$pm_event_fan_page_meta = get_post_meta(get_the_ID(), 'pm_event_fan_page_meta', true);
		
		$pm_event_start_time_meta = get_post_meta(get_the_ID(), 're_start_time', true);
		$pm_event_end_time_meta = get_post_meta(get_the_ID(), 're_end_time', true);
		
		$pm_reoc_event = get_post_meta(get_the_ID(), 'reoc_event', true);
		
		$html .= '<div class="pm-event-item-container">';
			$html .= '<div class="pm-event-item-details">';
				$html .= '<p>'.get_the_title().'</p>';
				$html .= '<p><span>'.esc_attr__('Start:', 'energytheme').'</span> '.$pm_event_start_time_meta.' <span>'.esc_attr__('End:', 'energytheme').'</span> '.$pm_event_end_time_meta.'</p>';
				
				if($pm_reoc_event !== 'once') {
					$html .= '<a href="'.get_the_permalink().'" class="pm-primary">'.esc_attr__('View dates & details', 'energytheme').' <i class="fa fa-angle-double-right"></i></a>';
				} else {
					$html .= '<a href="'.get_the_permalink().'" class="pm-primary">'.esc_attr__('View details', 'energytheme').' <i class="fa fa-angle-double-right"></i></a>';
				}
				
				
			$html .= '</div>';
			$html .= '<div class="pm-event-item-date-bg"></div>';
			$html .= '<div class="pm-event-item-date">';
				if($pm_reoc_event !== 'once') {
					$html .= '<i class="fa fa-calendar"></i>';
				} else {
					$html .= '<p class="month">'.$month.'</p>';
					$html .= '<p class="day">'.$day.'</p>';
				}
			$html .= '</div>';
		$html .= '</div>';
	
	endwhile; else:
		 $html .= '<p>'.esc_attr__('No scheduled events were found.', 'energytheme').'</p>';
	endif;
			
	
	pm_ln_restore_query();
	
	return $html;
	
}


//CLASSES CAROUSEL
function classesCarousel($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"post_order" => 'ASC',
		), 
	$atts));
	
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

	pm_ln_set_query($post_query);
	
	$html = '';
	
	$html .= '<div class="flexslider pm-post-slider" id="pm-flexslider-classes">';
		$html .= '<ul class="slides">';
	
			if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
								 
				$pm_schedule_start_time_meta = get_post_meta(get_the_ID(), 're_start_time', true);
				$pm_schedule_end_time_meta = get_post_meta(get_the_ID(), 're_end_time', true);
				$pm_schedule_location_meta = get_post_meta(get_the_ID(), 'pm_schedule_location_meta', true);
				$pm_schedule_cancellation_meta = get_post_meta(get_the_ID(), 'pm_schedule_cancellation_meta', true);
			
				if ( has_post_thumbnail()) {
				  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
				}
				
				$html .= '<li>';
					$html .= '<img src="'.$image_url[0].'" alt="'.get_the_title().'" class="img-repsonsive" />';
					$html .= '<div class="pm-flexslider-details">';
						$html .= '<p class="title">'.get_the_title().'</p>';
						
						if($pm_schedule_cancellation_meta === 'yes') {
							$html .= '<p class="details">'.esc_attr__('Cancelled', 'energytheme').'</p>';
						} else {
							$html .= '<p class="details">'.$pm_schedule_start_time_meta.' - '.$pm_schedule_end_time_meta.' / '.$pm_schedule_location_meta.'</p>';
							$html .= '<a href="'.get_the_permalink().'" class="pm-event-item-details">View Dates &amp; Details</a>';
						}
						
						
						
					$html .= '</div>';
					
				$html .= '</li>';
			
			endwhile; else:
				 $html .= '<p>'.esc_attr__('No scheduled classes were found.', 'energytheme').'</p>';
			endif;
			
		$html .= '</ul>';
	$html .= '</div>';
	
	pm_ln_restore_query();
	
	return $html;
	
}

//COLUMN TITLE
function columnTitle($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"color" => '',
		), 
	$atts));
	
	return '<h6 class="pm-column-title">'.$content.'</h6>';
	
}

//POST ITEMS
function postItems($atts, $content = null) {
		
	extract(shortcode_atts(array(
		"num_of_posts" => '3',
		"post_order" => 'DESC',
		"class" => 'wow fadeInUp'
		), 
	$atts));
	
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

	pm_ln_set_query($post_query);

	$animationCounter = 3;
	
	$html = '';
	
	//Display Items
	$html .= '<div'. ($num_of_posts > 3 ? ' id="pm-postItems-carousel"' : '') .'>';
		
		if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
		
			$categories = get_the_category();
	 		$image_url = '';
			if ( has_post_thumbnail()) {
			  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
			}			
			
			
			if($num_of_posts == "1"){
				$html .= '<div class="col-lg-12">';
			} elseif($num_of_posts == "2") {
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12">';
			} elseif($num_of_posts == "3") {
				$html .= '<div class="col-lg-4 col-md-4 col-sm-12">';
			} else {
				$html .= '<div class="pm-postItem-carousel-item">';	
			}
				$html .= '<article class="pm-column-spacing '.$class.'" data-wow-delay="0.'.$animationCounter.'s" data-wow-offset="50" data-wow-duration="1s">';
					$html .= '<div class="pm-standalone-news-post" '. ($image_url !== '' ? 'style="background-image:url('.$image_url[0].');"' : '') .'>';
						$html .= '<div class="pm-standalone-news-post-date-shadow"></div>';
						$html .= '<div class="pm-standalone-news-post-date-bg"></div>';
						$html .= '<div class="pm-standalone-news-post-date">';
							$html .= '<p class="month">'.get_the_time( 'M' ).'</p>';
							$html .= '<p class="day">'.get_the_time( 'd' ).'</p>';
						$html .= '</div>';
						$title = get_the_title();
						$html .= '<div class="pm-standalone-news-title">';
							$html .= '<h6>'.pm_ln_set_primary_words($title).'</h6>';
							$html .= '<a href="'.get_the_permalink().'" class="pm-standalone-news-post-link fa fa-link"></a>';
						$html .= '</div>';
					$html .= '</div>';		
					$html .= '<div class="pm-standalone-news-post-tags-and-excerpt">';
						$html .= '<p>'.esc_attr__('Posted in:', 'energytheme').' ';
						
						if($categories){
							
							$catCounter = 0;
							$totalCats = count($categories);
							
							foreach($categories as $category) {
								
								$catCounter++;
								
								if($catCounter >= $totalCats){
									$html .= '<a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>';
								} else {
									$html .= '<a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>, ';	
								}
									
							}
						}
						
						$html .= '</p>';
						
						$html .= '<div class="pm-standalone-news-post-divider"></div>';
						$the_excerpt = get_the_excerpt();
					$html .= '</div>';
					$html .= '<p class="pm-standalone-news-excerpt">'.pm_ln_string_limit_words($the_excerpt, 20).' <a href="'.get_the_permalink().'">[...]</a> </p>';
				$html .= '</article>';
			$html .= '</div>';
			
			$animationCounter += 3;
		
		endwhile; else:
			$html .= '<div class="col-lg-12 pm-column-spacing">';
			 $html .= '<p>'.esc_attr__('No posts were found.', 'energytheme').'</p>';
			$html .= '</div>';
		endif;
	
	$html .= '</div>';
	
	
	
				
	pm_ln_restore_query();
	
	return $html;
	
		
}

//STAFF PROFILE
function staffProfile( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"id" => '',
		"name_color" => '#2C5E83',
		"title_color" => '#4B4B4B',
		), 
	$atts));
	
	//Method to retrieve a single post
	$queried_post = get_post($id);
	$postID = $queried_post->ID;
	$postLink = $queried_post->guid;
	$postTitle = $queried_post->post_title;
	//$postTags = get_the_tags($postID);
	$postExcerpt = $queried_post->post_excerpt;
	$shortExcerpt = pm_ln_string_limit_words($postExcerpt, 20);
	
	$pm_staff_image_meta = get_post_meta($postID, 'pm_staff_image_meta', true);
	$pm_staff_title_meta = get_post_meta($postID, 'pm_staff_title_meta', true);
	$pm_staff_twitter_meta = get_post_meta($postID, 'pm_staff_twitter_meta', true);
	$pm_staff_facebook_meta = get_post_meta($postID, 'pm_staff_facebook_meta', true);
	$pm_staff_gplus_meta = get_post_meta($postID, 'pm_staff_gplus_meta', true);
	$pm_staff_linkedin_meta = get_post_meta($postID, 'pm_staff_linkedin_meta', true);
	
	$pm_staff_instagram_meta = get_post_meta($postID, 'pm_staff_instagram_meta', true);
	
	$pm_staff_email_address_meta = get_post_meta($postID, 'pm_staff_email_address_meta', true);
	$pm_staff_quote_meta = get_post_meta($postID, 'pm_staff_quote_meta', true);
	
	$html = '';
	
	$html .= '<div class="pm-staff-profile-item-container" style="background-image:url('.$pm_staff_image_meta.');">';
		$html .= '<div class="pm-staff-profile-item-details-container">';
			$html .= '<div class="pm-staff-profile-item-details">';
				$html .= '<a href="#" class="pm-staff-profile-item-details-btn fa fa-chevron-up"></a>';
				$html .= '<p class="pm-staff-profile-item-excerpt">'.$pm_staff_quote_meta.'</p>';
				$html .= '<div class="pm-staff-profile-item-details-divider"></div>';
				$html .= '<a href="'.get_permalink($postID).'" class="pm-staff-profile-item-view-profile">'.esc_attr__('View profile', 'energytheme').'</a>';
				if($pm_staff_email_address_meta !== '') :
					$html .= '<a href="mailto:'. $pm_staff_email_address_meta .'" class="pm-staff-profile-item-email-btn fa fa-envelope"></a>';
				endif;
			$html .= '</div>';
		$html .= '</div>';
		
		$html .= '<div class="pm-staff-profile-item-social-icons-container">';
		
			$html .= '<ul class="pm-staff-profile-item-social-icons">';
			
				if($pm_staff_twitter_meta !== '') :
				
					$html .= '<li>';
						$html .= '<div class="pm-staff-item-social-icon-diamond"></div>';
						$html .= '<a href="'.$pm_staff_twitter_meta.'" class="fa fa-twitter"></a>';
					$html .= '</li>';
				
				endif;
				
				if($pm_staff_facebook_meta !== '') :
				
					$html .= '<li>';
						$html .= '<div class="pm-staff-item-social-icon-diamond"></div>';
						$html .= '<a href="'.$pm_staff_facebook_meta.'" class="fa fa-facebook"></a>';
					$html .= '</li>';
				
				endif;
				
				if($pm_staff_gplus_meta !== '') :
				
					$html .= '<li>';
						$html .= '<div class="pm-staff-item-social-icon-diamond"></div>';
						$html .= '<a href="'.$pm_staff_gplus_meta.'" class="fa fa-google-plus"></a>';
					$html .= '</li>';
				
				endif;
				
				if($pm_staff_linkedin_meta !== '') :
				
					$html .= '<li>';
						$html .= '<div class="pm-staff-item-social-icon-diamond"></div>';
						$html .= '<a href="'.$pm_staff_linkedin_meta.'" class="fa fa-linkedin"></a>';
					$html .= '</li>';
				
				endif;
								
				if($pm_staff_instagram_meta !== '') :
				
					$html .= '<li>';
						$html .= '<div class="pm-staff-item-social-icon-diamond"></div>';
						$html .= '<a href="'.$pm_staff_instagram_meta.'" class="fa fa-instagram"></a>';
					$html .= '</li>';
				
				endif;
				
			$html .= '</ul>';
		
		$html .= '</div>';
	$html .= '</div>';
	
	$html .= '<div class="pm-staff-profile-item-name">';
		$html .= '<p class="name" style="color:'.$name_color.';">'.$postTitle.'</p>';
		$html .= '<div class="pm-staff-item-divider"></div>';
		$html .= '<p class="title" style="color:'.$title_color.';">'.$pm_staff_title_meta.'</p>';
	$html .= '</div>';
		
	return $html;
	
}

//NEWSLETTER SIGNUP
function newsletterSignup( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"mailchimp_url" => '',
		"name_placeholder" => 'Your Name',
		"email_placeholder" => 'Email Address',
		"class" => ''
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-workshop-newsletter-form-container">';
		$html .= '<form action="'.esc_html($mailchimp_url).'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>  ';
			$html .= '<input name="MERGE1" type="text" id="MERGE1" placeholder="'.$name_placeholder.'">';
			$html .= '<input name="MERGE0" type="text" id="MERGE0" placeholder="'.$email_placeholder.'">';
			$html .= '<input name="subscribe" id="mc-embedded-subscribe" type="submit" value="subscribe" class="pm-trial-form-submit">';
		$html .= '</form>';
	 $html .= '</div>';
					 
	return $html;
	
}

//STAT BOX
function statBox( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"icon" => '',
		"title" => '',
		"title_color" =>'#000000',
		"text_color" =>'#ffffff',
		"class" => 'wow fadeInUp',
		"animation_delay" => "0.3"
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-value-item-container '.$class.'" data-wow-duration="1s" data-wow-offset="50" data-wow-delay="'.$animation_delay.'s">';
		$html .= '<div class="pm-value-diamond-shadow"></div>';
		$html .= '<div class="pm-value-diamond"></div>';
		
		$html .= '<div class="pm-value-title">';
			$html .= '<p class="'.$title_color.'">'.$title.'</p>';
			$html .= '<i class="'.$icon.'"></i>';
		$html .= '</div>';
		
		$html .= '<div class="pm-value-quote-container">';
			$html .= '<p style="color:'.$text_color.';">'.$content.'</p>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
	
}

//DATA TABLE GROUP
function dataTableGroup( $atts, $content = null ){
	
	$GLOBALS['pm_date_table_item_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['dataTableItems'] ) ){
	
		foreach( $GLOBALS['dataTableItems'] as $item ){
	
			$items[] = '<div class="row"><div class="col-lg-4 col-md-4 col-sm-12 pm-workshop-table-title"><p>'.$item['title'].'</p></div><div class="col-lg-8 col-md-8 col-sm-12 pm-workshop-table-content"><p>'.$item['content'].'</p></div></div>';
	
		}

		//returnwrapper plus dataTableItems
		$return = '<div class="pm-workshop-table">'.implode( "\n", $items ).'</div>';

	}

	return $return;

}

function dataTableItem( $atts, $content = null ){

	extract(shortcode_atts(array(

		'title' => 'Sample Title'

	), $atts));

	$x = $GLOBALS['pm_date_table_item_count'];

	$GLOBALS['dataTableItems'][$x] = array( 'title' => sprintf( $title, $GLOBALS['pm_date_table_item_count'] ), 'content' =>  do_shortcode($content) );

	$GLOBALS['pm_date_table_item_count']++;

}

//PRICING TABLE
function pricingTable($atts, $content = null) {

	extract(shortcode_atts(array(
		"title" => 'Silver',
		"featured" => 'no',
		"price" => '19',
		"currency_symbol" => '$',
		"subscript" => '/mo',
		"message" => '',
		"button_text" => 'Purchase Plan',
		"button_link" => '#',
		"bg_image" => '',
		), 
	$atts));
	
	$html = '';
		
	$html .= '<div class="pm-pricing-table-container">';
		$html .= '<div class="pm-pricing-table-title">';
			$html .= '<p>'.$title.'</p>';
		$html .= '</div>';
		$html .= '<div class="pm-pricing-table-price" '. ($bg_image !== '' ? 'style="background-image:url('.$bg_image.');"' : '') .'>';
			
			if($featured === 'yes') :
				$html .= '<div class="pm-pricing-table-featured-shadow"></div>';
				$html .= '<div class="pm-pricing-table-featured"></div>';
				$html .= '<i class="fa fa-thumbs-up"></i>';
			endif;
			
			$html .= '<p class="price"><sup>'.$currency_symbol.'</sup>'.$price.'<sub>'.$subscript.'</sub></p>';
			$html .= '<p class="details">'.$message.'</p>';
		$html .= '</div>';
		$html .= $content;
		$html .= '<a href="'.$button_link.'" class="pm-pricing-table-btn pm-primary">'.$button_text.' &nbsp;<i class="fa fa-angle-right"></i></a>';
		
	$html .= '</div>';
	
	return $html;
	
}

//QUOTE BOX
function quoteBox($atts, $content = null){
	
	extract(shortcode_atts(array(
		"author_name" => '',
		"author_title" => '',
		"avatar" => '',
		"text_color" => 'white',
		"name_color" => '#4D4D4D'
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-single-testimonial-container">';
		$html .= '<div class="pm-single-testimonial-box">';
			$html .= '<p style="color:'.$text_color.';">'.$content.'</p>';
		$html .= '</div>';
		$html .= '<div class="pm-single-testimonial-author-container">';
			$html .= '<div class="pm-single-testimonial-author-avatar">';
				$html .= '<img src="'.$avatar.'" width="74" height="74" alt="avatar">';
			$html .= '</div>';
			$html .= '<div class="pm-single-testimonial-author-info">';
				$html .= '<p class="name" style="color:'.$name_color.';">'.$author_name.'</p>';
				$html .= '<p class="title" style="color:'.$name_color.';">'.$author_title.'</p>';
			$html .= '</div>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
		
}

//PIE CHART
function piechart($atts, $content = null){
	
	extract(shortcode_atts(array(
			"bar_size" => 220,
			"line_width" => 12,
			"track_color" => "#dbdbdb",
			"bar_color" => "#2B5C84", 
			"text_color" => "#ffffff",
			"percentage" => 75,
			"icon" => "typcn typcn-thumbs-up",
			"caption" => "Cost Reduction",
			"font_size" => 40
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div data-barsize="'.$bar_size.'" data-linewidth="'.$line_width.'" data-trackcolor="'.$track_color.'" data-barcolor="'.$bar_color.'" data-percent="'.$percentage.'" class="pm-pie-chart">';
		$html .= '<div class="pm-pie-chart-percent" style="font-size:'.$font_size.'px; color:'.$text_color.'">';
			$html .= '<span style="color:'.$text_color.'"></span>%';
		$html .= '</div>';			
	$html .= '</div>';
	$html .= '<div class="pm-pie-chart-description" style="color:'.$text_color.'">';
		$html .= '<i class="'.$icon.'" style="color:'.$text_color.'"></i>';
		$html .= $caption;
	$html .= '</div>';
	
	return $html;
	
}

//MILESTONE
function milestone($atts, $content = null){
	
	extract(shortcode_atts(array(
			"speed" => "",
			"stop" => "",
			"caption" => "",
			"icon" => "",
			"icon_color" => '#fff',
			"bg_color" => '#333',
			"text_color" => '#333333',
			"text_size" => '24',
			"border_radius" => '99',
			"padding" => '10',
			"width" => "100",
			"height" => "100",
			"font_size" => 60,	
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="milestone">';
		if($icon !== '') :
		$html .= '<i class="'.$icon.'" style="background-color:'.$bg_color.'; color:'.$icon_color.'; border-radius:'.$border_radius.'px; padding:'.$padding.'px; font-size:'.$font_size.'px; width:'.$width.'px; height:'.$height.'px;"></i>';
		endif;
		$html .= '<div class="milestone-content" style="font-size:'.$font_size.'px;"> ';                        
			$html .= '<span data-speed="'.(int)$speed.'" data-stop="'.(int)$stop.'" class="milestone-value" style="color:'.$text_color.'; font-size:'.$text_size.'px;"></span>';
			$html .= '<div class="milestone-description" style="color:'.$text_color.'; font-size:'.$text_size.'px;">'.$caption.'</div>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
	
}

//COUNTDOWN
function countdown($atts, $content = null){
	
	extract(shortcode_atts(array(
			"date" => '2014/08/25',	
			"id" => 1,
			"text_size" => '30',
			"text_color" => "#333333"
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-countdown-container" id="pm-countdown-container-'.$id.'" style="font-size:'.$text_size.'px; color:'.$text_color.';"></div><script type="text/javascript">(function($) { $(document).ready(function(e) { $("#pm-countdown-container-'.$id.'").countdown("'.$date.'", function(event) { $(this).html(event.strftime("%w weeks %d days %H:%M:%S")); }); }); })(jQuery);</script>';
	
	return $html;
	
}


//SLIDER CONTAINER
function customSlider($atts, $content = null){
	
	extract(shortcode_atts(array(
			"id" => ''
			), 
	$atts));
	
	return '<div class="pm-slider-container">'.$content.'</div>';
}

//GOOGLE MAP
function googleMap($atts, $content = null) {
	
    extract(shortcode_atts(array(
		"id" => 'myMap', 
		"type" => 'road', 
		"latitude" => '43.656885', 
		"longitude" => '-79.383904', 
		"zoom" => '13', 
		"message" => 'This is the message...',
		"responsive" => 1, 
		"width" => '300', 
		"height" => '450'), 
	$atts));
     
    $mapType = '';
    if($type == "satellite")
        $mapType = "SATELLITE";
    else if($type == "terrain")
        $mapType = "TERRAIN"; 
    else if($type == "hybrid")
        $mapType = "HYBRID";
    else
        $mapType = "ROADMAP"; 
         
    echo '<!-- Google Map -->
        <script type="text/javascript"> 
		
		(function($) {
			
			$(document).ready(function() {
				
			  function initializeGoogleMap() {
		 
				  var myLatlng = new google.maps.LatLng('.$latitude.','.$longitude.');
				  var myOptions = {
					center: myLatlng, 
					zoom: '.$zoom.',
					mapTypeId: google.maps.MapTypeId.'.$mapType.'
				  };
				  var map = new google.maps.Map(document.getElementById("'.$id.'"), myOptions);
		 
				  var contentString = "'.$message.'";
				  var infowindow = new google.maps.InfoWindow({
					  content: contentString
				  });
				   
				  var marker = new google.maps.Marker({
					  position: myLatlng
				  });
				   
				  google.maps.event.addListener(marker, "click", function() {
					  infowindow.open(map,marker);
				  });
				   
				  marker.setMap(map);
				  
				  /*map.addListener("click", function() {
					  google.maps.event.trigger(map, "resize");
					  map.setCenter(myOptions.center); 
				  });*/
				  
				  				 
			  }
			  initializeGoogleMap();
		 
			});
			
		})(jQuery);
		
        
        </script>';
     
	if($responsive == 1){
		return '<div id="'.$id.'" data-id="'.$id.'" data-latitude="'.$latitude.'" data-longitude="'.$longitude.'" data-mapType="'.$mapType.'" data-mapZoom="'.$zoom.'" data-message="'.$message.'" style="width:100%; height:'.$height.'px;" class="googleMap"></div>';
	} else {
		return '<div id="'.$id.'" data-id="'.$id.'" data-latitude="'.$latitude.'" data-longitude="'.$longitude.'" data-mapType="'.$mapType.'" data-mapZoom="'.$zoom.'" data-message="'.$message.'" style="width:'.$width.'px; height:'.$height.'px;" class="googleMap"></div>';
	}
        
}  


//BOOTSTRAP ALERT
function alert( $atts, $content = null ) {
	
	extract(shortcode_atts(array(  
        "close" => 'true',
		"type" => 'success',
		"icon" => 'typcn typcn-tick',
    ), $atts)); 
	
	$html = '';
	
	$html .= '<div class="alert alert-'.$type.' alert-dismissible" role="alert">';
	  if($close == 'true'){
		 $html .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
	  }
	  $html .= '<i class="'.$icon.'"></i>';
	  $html .= $content;
	$html .= '</div>';
	
	return $html;

}

//DIVIDER
function divider( $atts, $content = null ) {
	
	extract(shortcode_atts(array(  
        "height" => '1',
		"width" => '80px',
		"bg_color" => '#F6D600',
		"margin_top" => 20,
		"margin_bottom" => 20,
		"divider_style" => 'standard'
    ), $atts)); 
	
	if($divider_style === 'diamond'){
		return '<div class="pm-diamond-divider" style="margin:'.$margin_top.'px auto '.$margin_bottom.'px;"><div class="pm-diamond" style="background-color:'.$bg_color.';"></div><div class="pm-diamond" style="background-color:'.$bg_color.';"></div><div class="pm-diamond" style="background-color:'.$bg_color.';"></div></div>';
	} else {
		return '<div class="pm-divider" style="height:'.$height.'px; width:'.$width.'; background-color:'.$bg_color.'; margin:'.$margin_top.'px 0px '.$margin_bottom.'px;"></div>';
	}
	
}


//STANDARD BUTTON
function standardButton($atts, $content = null) {  
    extract(shortcode_atts(array(  
		"link" => '#',
		"margin_top" => 0,
		"margin_bottom" => 0,
		"target" => '_self',
		"icon" => '',
		"text_color" => '#ffffff',
		"flip_colors" => "no",
		"animated" => 'off',
		"class" => ''
    ), $atts));  
	
	$html = '';
	
	$html .= '<a class="pm-rounded-btn '.($class !== '' ? $class : '').' '.($flip_colors === 'yes' ? 'flip_color' : '').' '. ( $animated == 'on' ? 'animated' : '' ) .'" href="'.$link.'" target="'.$target.'" style="margin-top:'.$margin_top.'px; color:'.$text_color.'; margin-bottom:'.$margin_bottom.'px;">'.$content.''. ($icon !== '' ? ' &nbsp;<i class="'.$icon.'"></i>' : '') .'</a>';
	
	return $html;
		 
}  

//BOX BTN
function iconBox($atts, $content = null) { 
 
    extract(shortcode_atts(array(  
		"margin_top" => 0,
		"margin_bottom" => 0,
		"icon" => 'typcn typcn-vendor-microsoft',
		"color" => '#7d7d7d',
		"border_radius" => '0',
		"center" => "off", 
    ), $atts));  
	
	$html = '';
	
	$html .= '<div class="pm-icon-container" style="margin:'.$margin_top.'px '. ($center === 'on' ? 'auto' : '') .' '.$margin_bottom.'px; border:6px solid '.$color.'; border-radius:'.$border_radius.'px;">';
		$html .= '<i class="'.$icon.'" style="color:'.$color.';"></i>';
	$html .= '</div>';
	
	return $html;
		 
}  

//PROGRESS BAR
function progressBar($atts) { 

	extract(shortcode_atts(array(  
        "percentage" => '50',
		"text" => '',
		"id" => 1
    ), $atts));
	
	$html = '';
	
	$html .= '<div class="pm-progress-bar-description" id="pm-progress-bar-desc-'.$id.'">';
		$html .= $text;
		$html .= '<div class="pm-progress-bar-diamond"></div>';
		$html .= '<span>'.$percentage.'%</span>';
	$html .= '</div>';
	$html .= '<div class="pm-progress-bar">'; 
		$html .= '<span data-width="'.$percentage.'" class="pm-progress-bar-outer" id="pm-progress-bar-'.$id.'">';
			$html .= '<span class="pm-progress-bar-inner"></span>'; 
		$html .= '</span>';
	$html .= '</div>';
	
	return $html;

}



//IMAGE PANEL
function imagePanel($atts, $content = null) {
			
	extract( shortcode_atts( array(
		'icon' => 'fa fa-link',
		'link' => '',
		'image' => '',
	), $atts ) );
	
	$html = '';
    
    $html .= '<div class="pm_image_panel">';
        
		$html .= '<div class="pm-hover-item-image-panel">';
		
			$html .= '<div class="pm-hover-item-icon"><a class="'.$icon.'" href="'.$link.'"></a></div>';
		
			$html .= '<div class="pm-image-panel-hover"></div>';
		
			$html .= '<div class="pm-hover-item-image-panel-img"><img src="'.$image.'" /></div>';
			
		$html .= '</div>';   
    
    $html .= '</div>';
    
	return $html;
	
}



//SINGLE POST
/*function singlePost($atts) {
			
	extract( shortcode_atts( array(
		'id' => '',
		'class' => ''
	), $atts ) );
	
	//Method to retrieve a single post
	$queried_post = get_post($id);
	$postID = $queried_post->ID;
	$postLink = $queried_post->guid;
	$postTitle = $queried_post->post_title;
	$postTitleFinal = pm_ln_string_limit_words($postTitle, 4);
	//$postTags = get_the_tags($postID);
	$postExcerpt = $queried_post->post_excerpt;
	$shortExcerpt = pm_ln_string_limit_words($postExcerpt, 5);
	$shortExcerpt2 = pm_ln_string_limit_words($postExcerpt, 15);
	$postContent = $queried_post->post_content;
	//$postImage = get_the_post_thumbnail($postID, 'thumbnail');
	$postImage = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'full' );
	$pm_featured_post_image_meta = get_post_meta($postID, 'pm_featured_post_image_meta', true);
	$count = get_comments_number($postID);
	$postDate = $queried_post->post_date;
	$month = date("M", strtotime($postDate));
	$day = date("d", strtotime($postDate));
	//$commentsLink = get_comments_link($postID);
	//$postImage = get_post_meta($postID, 'featuredPostImage', true);
	
	$html = '';
			
	  HTML code required

	return $html;
	
}  */


//CALL TO ACTION
function ctaBox($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"title" => '',
		"text_color" => '#ffffff',
		"link" => '',
		"button_text" => "Purchase Now",
		"button_text_color" => "#000000",
		"target" => "_blank"
    ), $atts));
	
	$html = '';
	
	$html .= '<div class="pm-cta-message">';
		$html .= '<p class="pm-quantum-alert-title" style="color:'.$text_color.'">'.$title.'</p>';
		$html .= '<p class="pm-quantum-alert-details" style="color:'.$text_color.'">'.$content.'</p>';
		$html .= '<p class="pm-quantum-alert-btn"><a href="'.$link.'" class="pm-rounded-btn cta-btn" style="color:'.$button_text_color.' !important;" target="'.$target.'">'.$button_text.'</a></p>';
	$html .= '</div>';
	
	return $html;
	
}

//ICON  
function iconElement($atts, $content = null) {
	extract(shortcode_atts(array( 
		"link" => '', 
        "icon" => 'fa fa-twitter',
		"icon_color" => '#ffffff',
		"font_size" => '24',
		"padding" => '14',
		"line_height" => '24'
    ), $atts));
	
    return '<a href="'.$link.'" class="pm-icon-element '.$icon.'" style="color:'.$icon_color.'; font-size:'.$font_size.'px; padding:'.$padding.'px; line-height:'.$line_height.'px;"></a>';  
	
} 

// YOUTUBE SHORTCODE
function youtubeVideo($atts) {  
    extract(shortcode_atts(array(  
        "id" => '',
		"width" => 300,
		"height" => 250,
		"responsive" => 0,
    ), $atts));  
	
	if($responsive == 1){
		$finalWidth = 100 .'%';
	} else {
		$finalWidth = $width;	
	}
	
    return '<iframe src="http://www.youtube.com/embed/'.$id.'" width="'.$finalWidth.'" height="'.$height.'"></iframe>';  
}  


// VIMEO SHORTCODE
function vimeoVideo($atts) {  
    extract(shortcode_atts(array(  
        "id" => '',
		"width" => 300,
		"height" => 250,
		"responsive" => 0,
    ), $atts));  
	
	if($responsive == 1){
		$finalWidth = 100 .'%';
	} else {
		$finalWidth = $width;	
	}
	
    return '<iframe src="//player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;color=ffffff" width="'.$finalWidth.'" height="'.$height.'" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';  
}


// TRIAL FORM
function trialForm($atts) {  

    extract(shortcode_atts(array(  
		"icon" => 'typcn typcn-document-text',
		"small_title" => 'Sign up for your',
		"large_title" => '5 day free trial',
		"recipient_email" => ''
    ), $atts));  
	
	$html = '';
		
	$html .= '<div class="pm-trial-form-container">';
		$html .= '<div class="pm-trial-form-title">	';			
			$html .= '<i class="'.$icon.'"></i>';
			$html .= '<p class="pm-trial-form-small-title">'.$small_title.'</p>';
			$html .= '<p class="pm-trial-form-large-title">'.$large_title.'</p>';
			$html .= '<div class="pm-trial-form-title-diamond"></div>';
		$html .= '</div>';
		$html .= '<div class="pm-trial-form-inputs">';
			$html .= '<form action="#" method="post" name="pm_trial_form" id="pm-trial-form">';
				$html .= '<input name="pm_trial_form_name" id="pm_trial_form_name" type="text" class="pm-trial-form-field" placeholder="'.esc_attr__('Your Name *', 'energytheme').'">';
				$html .= '<input name="pm_trial_form_email" id="pm_trial_form_email" type="email" class="pm-trial-form-field" placeholder="'.esc_attr__('Email Address *', 'energytheme').'">';
				$html .= '<input name="pm_trial_form_phone" id="pm_trial_form_phone" type="tel" class="pm-trial-form-field" placeholder="'.esc_attr__('Phone Number', 'energytheme').'">';
				$html .= '<textarea name="pm_trial_form_message" id="pm_trial_form_message" class="pm-trial-form-textarea" placeholder="'.esc_attr__('Message', 'energytheme').'"></textarea>';
				$html .= '<input type="submit" value="'.esc_attr__('Sign up', 'energytheme').'" class="pm-trial-form-submit" id="pm-trial-form-btn">';
				$html .= '<div id="pm-trial-form-response"></div>';	
				$html .= '<input name="pm_trial_form_recipient_email" id="pm_trial_form_recipient_email" type="hidden" value="'.esc_attr($recipient_email).'">';
					wp_nonce_field('pm_ln_nonce_action','pm_ln_send_trial_nonce'); 
			$html .= '</form>';
		$html .= '</div>';
	$html .= '</div>';
	
    return $html; 
}


// VIDEO BOX
function videoBox($atts) {  

    extract(shortcode_atts(array(  
		"icon" => 'typcn typcn-video',
		"video_link" => '',
		"video_image" => '',
		"gallery_link" => 'on',
		"gallery_link_text" => 'View more videos in our gallery',
		"gallery_link_url" => '',
		"gallery_link_target" => '_self'
    ), $atts));  
	
	$html = '';
		
	$html .= '<div class="pm-video-container" style="background-image:url('.$video_image.');">';
		$html .= '<div class="pm-video-overlay">';
			$html .= '<div class="pm-video-activator-border">';
				$html .= '<div class="pm-video-activator-bg"></div>';
			$html .= '</div>';
			$html .= '<a href="'.$video_link.'" data-rel="prettyPhoto" class="pm-video-activator-btn '.$icon.' expand lightbox"></a>';
		$html .= '</div>';
	$html .= '</div>';	
	if($gallery_link === 'on'):
		$html .= '<a class="pm-right-align pm-primary" href="'.$gallery_link_url.'" target="'.$gallery_link_target.'">'.$gallery_link_text.' <i class="fa fa-angle-right"></i></a>';	
	endif;
	
	
    return $html; 
}


//HTML5 VIDEO
function html5Video($atts, $content = null) {
	extract(shortcode_atts(array(  
        "webm" => '',
		"mp4" => '',
		"ogg" => '',
    ), $atts)); 
	
	return '<div class="pm-video-container"><video id="pm-video-background" autoplay loop controls="true" muted="muted" preload="auto" volume="0"><source src="'.$mp4.'" type="video/mp4"><source src="'.$webm.'" type="video/webm"><source src="'.$ogg.'" type="video/ogg">HTML5 Video Mime Type not found.</video>'.do_shortcode($content).'</div>';
	
}


//TABS
function tabGroup( $atts, $content ){
	
	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));
	
	$GLOBALS['pm_ln_tab_id'] = (int) $id;
	$GLOBALS['pm_ln_tab_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['tabs'. $GLOBALS['pm_ln_tab_id']] ) ){
	
		foreach( $GLOBALS['tabs'. $GLOBALS['pm_ln_tab_id']] as $tab ){	
			$tabs[] = '<li><a data-toggle="tab" href="#'.$GLOBALS['pm_ln_tab_id'].''.str_replace( ' ', '', $tab['title'] ).'">'.$tab['title'].'</a></li>';		
			$panes[] = '<div class="tab-pane" id="'.$GLOBALS['pm_ln_tab_id'].''.str_replace( ' ', '', $tab['title'] ).'">'.$tab['content'].'</div>';	
		}

		$return = "\n".'<ul class="nav nav-tabs pm-nav-tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="tab-content pm-tab-content shortcode">'.implode( "\n", $panes ).'</div>'."\n";

	}

	return $return;

}

function tabItem( $atts, $content ){

	extract(shortcode_atts(array(

		'title' => 'Tab %d'

	), $atts));

	$x = $GLOBALS['pm_ln_tab_count'];

	$GLOBALS['tabs' . $GLOBALS['pm_ln_tab_id']][$x] = array( 'title' => sprintf( $title, $GLOBALS['pm_ln_tab_count'] ), 'content' =>  do_shortcode($content) );

	$GLOBALS['pm_ln_tab_count']++;

}

//ACCORDION
function accordionGroup($atts, $content = null) { 

	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));

	$GLOBALS['pm_ln_accordion_id'] = (int) $id;
	$GLOBALS['pm_ln_accordion_count'] = 0;
	
	
    return '<div class="panel-group" id="accordion'.$GLOBALS['pm_ln_accordion_id'].'" role="tablist" aria-multiselectable="true">'.do_shortcode($content).'</div>';
	
}  

function accordionItem($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"title" => 'Accordion Item 1',
		"icon" => 'fa fa-plus'
    ), $atts)); 
	
	$html = '';
	
	  $html .= '<div class="panel panel-default">';
		$html .= '<div class="panel-heading" role="tab" id="heading'.$GLOBALS['pm_ln_accordion_count'].'">';
		  $html .= '<h4 class="panel-title"><i class="fa fa-plus"></i>';
			$html .= '<a data-toggle="collapse" data-parent="#accordion'.$GLOBALS['pm_ln_accordion_id'].'" href="#'.$GLOBALS['pm_ln_accordion_id'].'collapse'.$GLOBALS['pm_ln_accordion_count'].'" class="pm-accordion-link" aria-expanded="true" aria-controls="collapse'.$GLOBALS['pm_ln_accordion_count'].'">';
			  $html .= ''.$title.'';
			$html .= '</a>';
		  $html .= '</h4>';
		$html .= '</div>';
		$html .= '<div id="'.$GLOBALS['pm_ln_accordion_id'].'collapse'.$GLOBALS['pm_ln_accordion_count'].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$GLOBALS['pm_ln_accordion_count'].'">';
		  $html .= '<div class="panel-body">';
			$html .= ''.do_shortcode($content).'';
		  $html .= '</div>';
		$html .= '</div>';
	  $html .= '</div>';
	
	$GLOBALS['pm_ln_accordion_count']++;
	
    return $html;
	
} 

//FLEXSLIDER CAROUSEL
function sliderCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"animation" => 'slide',
    ), $atts)); 

	if(!isset($GLOBALS['pm_ln_flexslider_count'])){
		$GLOBALS['pm_ln_flexslider_count'] = 0;
	}
	
	$html = '';
	
	$html .= '<div class="flexslider pm-post-slider" id="pm-flexslider-carousel-'.$GLOBALS['pm_ln_flexslider_count'].'" style="width:100%;"><ul class="slides">'.do_shortcode($content).'</ul></div>';
	
	$html .= '<script>(function($) {$(document).ready(function(e) {$("#pm-flexslider-carousel-'.$GLOBALS['pm_ln_flexslider_count'].'").flexslider({animation:"'.$animation.'", controlNav: false, directionNav: true, animationLoop: true, slideshow: false, arrows: true, touch: false, prevText : "", nextText : "" }); }); })(jQuery); </script>';
	
	//increment for next possible carousel slider
	$GLOBALS['pm_ln_flexslider_count']++;
	
    return $html;
	
}  

function sliderItem($atts, $content = null) {

	extract(shortcode_atts(array(  
		"img" => '',
		"title" => ''
    ), $atts)); 
	
	$html = '<li><img src="' . $img . '" alt="' . $title . '" /></li>';
		
    return $html;
	
}  


//CLIENTS CAROUSEL
function clientCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"target" => '_blank',
    ), $atts)); 
	
	$html = '<div id="pm-brands-carousel" class="owl-carousel owl-theme">';
	
	//Redux options
	global $energy_options;
	
	if($energy_options){
		
		$clients = $energy_options['opt-client-slides'];
		
		if(count($clients) > 0){
			
			foreach($clients as $c) {
				
				$html .= '<div class="pm-brand-item">';
					$html .= '<span></span>';
					$html .= '<a href="http://'.$c['url'].'" target="'.$target.'">'.$c['url'].'</a>';
					$html .= '<img src="'.$c['image'].'" class="img-responsive" alt="'.$c['title'].'">';
				$html .= '</div>';				
				
			}//end of foreach
			
		}//end of if
		
	}//end of if
			
	$html .= '</div>';
	
	$html .= '<div class="pm-brand-carousel-btns">';
		$html .= '<a class="btn pm-owl-prev fa fa-chevron-left"></a>';
		$html .= '<a class="btn pm-owl-play fa fa-play" id="pm-owl-play"></a>';
		$html .= '<a class="btn pm-owl-next fa fa-chevron-right"></a>';
	$html .= '</div>';
	
    return $html;
	
}  


//PANELS CAROUSEL
function panelsCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"target" => '_self',
    ), $atts)); 
	
	$html = '<ul class="pm-interactive-panels-carousel" id="pm-interactive-panels-owl">';
	
	//Redux options
	global $energy_options;
	
	if($energy_options){
		
		$panels = $energy_options['opt-panel-slides'];
		
		if(count($panels) > 0){
			
			foreach($panels as $p) {
				
				$pieces = explode(" - ", $p['url']);
				
				$icon = $pieces[0];
				$url = $pieces[1];
				
				$html .= '<li>';
					$html .= '<div class="pm-icon-bundle">';
						$html .= '<i class="'.$icon.'"></i>';
						$html .= '<div class="pm-icon-bundle-content">';
							$html .= '<p><a href="'.$url.'" target="'.$target.'">'.$p['title'].' <i class="fa fa-angle-right"></i></a></p>';
						$html .= '</div>';
						$html .= '<div class="pm-icon-bundle-info">';
							$html .= '<p>'.$p['description'].'</p>';
						$html .= '</div>';
					 $html .= '</div>';
				$html .= '</li>';
				
			}//end of foreach
			
		}//end of if
		
	}//end of if
			
	$html .= '</ul>';
	
    return $html;
	
}  


//PANEL HEADER
function panelHeader($atts, $content = null) {
	extract(shortcode_atts(array(  
		"panel_style" => 1,
		"link" => '',
		"target" => '_self',
		"color" => '#00BC9D',
		"show_button" => 'true',
		"button_text" => '',
		"margin_bottom" => 10,
		"icon" => 'fa-link',
		"tip" => '',
		"bg_color" => '#F3F3F3',
    ), $atts));
		
	if($panel_style == 1){
		
		//panel header style 1
		if($show_button == 'true'){
			return '<div class="pm_span_header" style="margin-bottom:'.$margin_bottom.'px;"><h4 style="color:'.$color.';">'.$content.'</h4><div class="pm_span_header_btn"><a class="pm-custom-button pm-btn-animated pm-btn-small pm-post-btn p_header" href="'.$link.'" target="'.$target.'"><span>'.$button_text.' <i class="fa '.$icon.'"></i></span></a></div></div>';
		} else {
			return '<div class="pm_span_header" style="margin-bottom:'.$margin_bottom.'px;"><h4 style="color:'.$color.';">'.$content.'</h4></div>';
		}
		
	} elseif($panel_style == 2){
		
		//panel header style2
		if($show_button == 'true'){
			return '<div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style2"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span><a target="_self" '.($tip !== '' ? 'title="'.$tip.'"' : '').'  '. ($tip !== '' ? 'class="pm_tip"' : '') .' href="'.$link.'"><i class="fa '.$icon.'"></i></a></h4></div>';
		} else {
			return '<div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style2"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span></h4></div>';
		}
		
	} elseif($panel_style == 3){
		
		//panel header style3
		if($show_button == 'true'){
			return '<div class="pm_span_header_style3_divider"></div><div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style3"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span><a target="_self" '.($tip !== '' ? 'title="'.$tip.'"' : '').'  '. ($tip !== '' ? 'class="pm_tip"' : '') .' href="'.$link.'"><i class="fa '.$icon.'"></i></a></h4></div>';
		} else {
			return '<div class="pm_span_header_style3_divider"></div><div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style3"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span></h4></div>';
		}
		
	} else {
		return "";	
	}
	
     
}

//COLUMN HEADER
function columnHeader($atts, $content = null) {
	extract(shortcode_atts(array(  
		"color" => 'grey',
		"margin_bottom" => 0
    ), $atts));
	
	return '<div class="pm-column-header" style="margin-bottom:'.$margin_bottom.'px;"><h2 style="border-bottom:1px solid '.$color.';">'.$content.'</h2><div class="pm-column-header-block" style="background-color:'.$color.';"></div></div>';
     
}

//TESTIMONIAL CAROUSEL
function testimonials($atts) {
	
	extract(shortcode_atts(array(  
        "icon" => '',
    ), $atts));
	
	$html = '';
	
	//Redux options
	global $energy_options;
	
	if($energy_options){
		
		$testimonials = $energy_options['opt-testimonials-slides'];
		
		if(is_array($testimonials)){
			
			$counter = 0;
			
			$html .= '<div class="pm-testimonials-carousel" id="pm-testimonials-carousel">';
				$html .= '<ul class="pm-testimonial-items">';
			
					foreach($testimonials as $t) {
						
						$html .= '<li>';
							$html .= '<p class="pm-testimonial-quote">'.$t['description'].'</p>';
							$html .= '<p class="pm-testimonial-name">'.$t['title'].' / '.$t['url'].'</p>';
							$html .= '<div class="pm-testimonial-img">';
								$html .= '<img src="'.$t['image'].'" alt="'.$t['title'].'" />';
							$html .= '</div>';
						$html .= '</li>';
						
					}//end of foreach
			
				$html .= '</ul>';				
			$html .= '</div>';
			
		}
		
	}
	
	return $html;
	
}

//CONTACT FORM
function contactForm($atts) {

	extract(shortcode_atts(array(  
		"recipient_email" => '',
		"text_color" => '#FFF',
    ), $atts)); 
	

	
	$html = '';
	
		$html .= '<div class="pm-contact-form-container">';
	
			$html .= '<form action="#" method="post" id="pm-contact-form">';
							
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12">';
					$html .= '<input name="pm_s_first_name" id="pm_s_first_name" class="pm-form-textfield" type="text" placeholder="'.esc_attr__('First Name *', 'energytheme').'">';
				$html .= '</div>';
				
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12">';
					$html .= '<input name="pm_s_last_name" id="pm_s_last_name" class="pm-form-textfield" type="text" placeholder="'.esc_attr__('Last Name *', 'energytheme').'">';
				$html .= '</div>';
				
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12">';
					$html .= '<input name="pm_s_email_address" id="pm_s_email_address" class="pm-form-textfield" type="text" placeholder="'.esc_attr__('Email Address *', 'energytheme').'">';
				$html .= '</div>';
				
				$html .= '<div class="col-lg-6 col-md-6 col-sm-12">';
					$html .= '<input name="pm_s_phone_number" id="pm_s_phone_number" class="pm-form-textfield" type="tel" placeholder="'.esc_attr__('Phone Number', 'energytheme').'">';
				$html .= '</div>';
				
				$html .= '<div class="col-lg-12 pm-clear-element">';
					$html .= '<textarea name="pm_s_message" id="pm_s_message" class="pm-form-textarea" cols="50" rows="10" placeholder="'.esc_attr__('Message *', 'energytheme').'"></textarea>';
				$html .= '</div>';
				
				$html .= '<div class="col-lg-12 pm-center">';
					$html .= '<input type="button" value="'.esc_attr__('Submit Form', 'energytheme').'" name="pm-form-submit-btn" class="pm-form-submit-btn" id="pm-contact-form-btn">';
					$html .= '<div id="pm-contact-form-response"></div>';	
					$html .= '<p class="pm-required">'.esc_attr__('Fields marked with * are required', 'energytheme').'</p>';
				$html .= '</div>';
				
				$html .= '<input type="hidden" name="pm_s_email_address_contact" id="pm_s_email_address_contact" value="'.esc_attr($recipient_email).'" />';
				
				wp_nonce_field('pm_ln_nonce_action','pm_ln_send_contact_nonce'); 
			
			$html .= '</form>';
		
		$html .= '</div>';
				
	return $html;
	
}


/******** BOOTSTRAP 3 COLUMNS ***********/

//COLUMN CONTAINER
function bootstrapContainer($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"fullscreen" => 'off',
		"fullscreen_container" => 'on',
		"bg_color" => 'transparent',
		"bg_image" => '',
		"bg_position" => 'static',
		"bg_repeat" => 'repeat-x',
		"alignment" => 'left',
		"padding_top" => 20,
		"padding_bottom" => 20,
		"parallax" => 'on',
		"arrow" => 'on',
		"arrow_color" => '#182433',
		"class" => '',
		"id" => ''
    ), $atts)); 
	
	if($fullscreen == 'on'){
		
		return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container '. ($parallax === 'on' ? 'pm-parallax-panel' : '') .' '.$class.'" style="'. ($bg_image !== '' ? 'background-image:url('.$bg_image.');' : '') .' background-repeat:'.$bg_repeat.'; background-attachment:'.$bg_position.' !important; background-color:'.$bg_color.'; text-align:'.$alignment.'; padding-top:'.$padding_top.'px; padding-bottom:'.$padding_bottom.'px;" '. ( $parallax == 'on' ? 'data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0"' : '' ) .'> '. ($fullscreen_container !== 'off' ? '<div class="container">' : '') .' '.do_shortcode($content).' '. ($fullscreen_container !== 'off' ? '</div>' : '') .' '. ($arrow === 'on' ? '<div class="pm-container-arrow" style="border-top: 30px solid '.$arrow_color.';"></div>' : '') .'</div>';
		
	} else {
		
		return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container '. ($parallax === 'on' ? 'pm-parallax-panel' : '') .' '.$class.'" style="'. ($bg_image !== '' ? 'background-image:url('.$bg_image.');' : '') .' background-repeat:'.$bg_repeat.'; background-attachment:'.$bg_position.' !important; background-color:'.$bg_color.'; text-align:'.$alignment.'; padding-top:'.$padding_top.'px; padding-bottom:'.$padding_bottom.'px;" '. ( $parallax == 'on' ? 'data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0"' : '' ) .'><div class="container">'.do_shortcode($content).'</div>'. ($arrow === 'on' ? '<div class="pm-container-arrow" style="border-top: 30px solid '.$arrow_color.';"></div>' : '') .'</div>';
		
	}
	
	
    
}  

//COLUMN CONTAINER
function bootstrapRow($atts, $content = null) {	

	extract(shortcode_atts(array(  
		"class" => ''
    ), $atts)); 

	if($class !== ''){
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	} else {
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	}

	
}

//NESTED ROW
function nestedRow($atts, $content = null) {	

	extract(shortcode_atts(array(  
		"class" => ''
    ), $atts)); 

	if($class !== ''){
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	} else {
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	}

	
}

//COLUMN
function bootstrapColumn($atts, $content = null) {
	
	extract(shortcode_atts(array(  
        "col_large" => 12,
		"col_medium" => 12,
		"col_small" => 12,
		"col_extrasmall" => 12,
		"class" => 'wow fadeInUp',
		'animation_delay' => 0.3
    ), $atts)); 

	return '<div class="col-lg-'.$col_large.' col-md-'.$col_medium.' col-sm-'.$col_small.' col-xs-'.$col_extrasmall.' '.$class.'" data-wow-delay="'.$animation_delay.'s" data-wow-offset="50" data-wow-duration="1s">'.do_shortcode($content).'</div>';	
}

//NESTED COLUMN
function nestedColumn($atts, $content = null) {
	
	extract(shortcode_atts(array(  
        "col_large" => 12,
		"col_medium" => 12,
		"col_small" => 12,
		"col_extrasmall" => 12,
		"class" => ''
    ), $atts)); 

	return '<div class="col-lg-'.$col_large.' col-md-'.$col_medium.' col-sm-'.$col_small.' col-xs-'.$col_extrasmall.' '.$class.'">'.do_shortcode($content).'</div>';	
}

/******** BOOTSTRAP 3 COLUMNS END ***********/

/*-----------------------------------------------------------------------------------*/
/*	Add Shortcode Buttons to WYSIWIG
/*-----------------------------------------------------------------------------------*/
add_action('init', 'pm_ln_add_tiny_shortcodes');  
function pm_ln_add_tiny_shortcodes() { 

	if ( current_user_can('edit_posts') && current_user_can('edit_pages') ) {
		 
		 //Bootstrap 3
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapContainer');  
     	 add_filter('mce_buttons_3', 'register_bootstrapContainer'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapRow');  
     	 add_filter('mce_buttons_3', 'register_bootstrapRow'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapColumn');  
     	 add_filter('mce_buttons_3', 'register_bootstrapColumn'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_alert');  
     	 add_filter('mce_buttons_3', 'register_alert'); 
		 
		 //Add "standardButton" button
		 add_filter('mce_external_plugins', 'add_plugin_standardButton');  
		 add_filter('mce_buttons_3', 'register_standardButton');  
		 
		 //Add "iconBox" button
		 add_filter('mce_external_plugins', 'add_plugin_iconBox');  
		 add_filter('mce_buttons_3', 'register_iconBox');  
		 		 
		 //Add "Progress bar"
		 add_filter('mce_external_plugins', 'add_plugin_progressBar');  
		 add_filter('mce_buttons_3', 'register_progressBar');
		 
		 //Add "Single Post" button
		 /*add_filter('mce_external_plugins', 'add_plugin_singlepost');  
		 add_filter('mce_buttons_3', 'register_singlepost');*/
		 
		 //Add "divider" button
		 add_filter('mce_external_plugins', 'add_plugin_divider');  
		 add_filter('mce_buttons_3', 'register_divider'); 
		 
		 //Videos
		 add_filter('mce_external_plugins', 'add_plugin_youtubeVideo');  
     	 add_filter('mce_buttons_3', 'register_youtubeVideo'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_vimeoVideo');  
     	 add_filter('mce_buttons_3', 'register_vimeoVideo'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_html5Video');  
     	 add_filter('mce_buttons_3', 'register_html5Video'); 
		 
		 //eventItems
		 add_filter('mce_external_plugins', 'add_plugin_eventItems');  
     	 add_filter('mce_buttons_3', 'register_eventItems'); 
		 
		 //postItems
		 add_filter('mce_external_plugins', 'add_plugin_postItems');  
     	 add_filter('mce_buttons_3', 'register_postItems'); 
		 
		 //classesCarousel
		 add_filter('mce_external_plugins', 'add_plugin_classesCarousel');  
     	 add_filter('mce_buttons_3', 'register_classesCarousel'); 
		 
		 //Trial form
		 add_filter('mce_external_plugins', 'add_plugin_trialForm');  
     	 add_filter('mce_buttons_3', 'register_trialForm');
		 
		 //Video Box
		 add_filter('mce_external_plugins', 'add_plugin_videoBox');  
     	 add_filter('mce_buttons_3', 'register_videoBox');
		 
		 //Tab Group
		 add_filter('mce_external_plugins', 'add_plugin_tabGroup');  
     	 add_filter('mce_buttons_3', 'register_tabGroup');
		 
		 //Accordion Group
		 add_filter('mce_external_plugins', 'add_plugin_accordionGroup');  
     	 add_filter('mce_buttons_3', 'register_accordionGroup');
		 
		 //Panel Header
		 /*add_filter('mce_external_plugins', 'add_plugin_panelHeader');  
     	 add_filter('mce_buttons_3', 'register_panelHeader');*/
		 
		 //Column Header
		 /*add_filter('mce_external_plugins', 'add_plugin_columnHeader');  
     	 add_filter('mce_buttons_3', 'register_columnHeader');*/
		 
		 //Testimonials
		 add_filter('mce_external_plugins', 'add_plugin_testimonials');  
     	 add_filter('mce_buttons_3', 'register_testimonials');	
		 
		 //Contact Form
		 add_filter('mce_external_plugins', 'add_plugin_contactForm');  
     	 add_filter('mce_buttons_3', 'register_contactForm');	
		 
		 //Image panel
		 /*add_filter('mce_external_plugins', 'add_plugin_imagePanel');  
     	 add_filter('mce_buttons_3', 'register_imagePanel');*/
		 
		 //Google Map
		 add_filter('mce_external_plugins', 'add_plugin_googleMap');  
     	 add_filter('mce_buttons_3', 'register_googleMap');	
		 
		 //CTA Box
		 add_filter('mce_external_plugins', 'add_plugin_ctaBox');  
     	 add_filter('mce_buttons_3', 'register_ctaBox');
		 
		  //Icon Element
		 add_filter('mce_external_plugins', 'add_plugin_iconElement');  
     	 add_filter('mce_buttons_3', 'register_iconElement');	
		 
		 //Flexslider Carousel
		 add_filter('mce_external_plugins', 'add_plugin_sliderCarousel');  
     	 add_filter('mce_buttons_3', 'register_sliderCarousel');
		 
		 //Client Carousel
		 add_filter('mce_external_plugins', 'add_plugin_clientCarousel');  
     	 add_filter('mce_buttons_3', 'register_clientCarousel');
		 
		 //Panels Carousel
		 add_filter('mce_external_plugins', 'add_plugin_panelsCarousel');  
     	 add_filter('mce_buttons_3', 'register_panelsCarousel');
		 
		 //Pie Chart
		 add_filter('mce_external_plugins', 'add_plugin_piechart');  
     	 add_filter('mce_buttons_3', 'register_piechart');
		 
		 //Milestone
		 add_filter('mce_external_plugins', 'add_plugin_milestone');  
     	 add_filter('mce_buttons_3', 'register_milestone');
		 
		 //Countdown
		 add_filter('mce_external_plugins', 'add_plugin_countdown');  
     	 add_filter('mce_buttons_3', 'register_countdown');
		 
		 //Quote Box
		 add_filter('mce_external_plugins', 'add_plugin_quoteBox');  
     	 add_filter('mce_buttons_3', 'register_quoteBox');	
		 
		 //Pricing Table
		 add_filter('mce_external_plugins', 'add_plugin_pricingTable');  
     	 add_filter('mce_buttons_3', 'register_pricingTable');	 
		 
		 //Newsletter signup
		 add_filter('mce_external_plugins', 'add_plugin_newsletterSignup');  
     	 add_filter('mce_buttons_3', 'register_newsletterSignup');
	
		 
		 //Stat Box 1
		 add_filter('mce_external_plugins', 'add_plugin_statBox');  
     	 add_filter('mce_buttons_3', 'register_statBox');
		 
		 //Data Table
		 add_filter('mce_external_plugins', 'add_plugin_dataTableGroup');  
     	 add_filter('mce_buttons_3', 'register_dataTableGroup');
		 
		 //Staff Profile
		 add_filter('mce_external_plugins', 'add_plugin_staffProfile');  
     	 add_filter('mce_buttons_3', 'register_staffProfile');
		 
		 //Column title
		 add_filter('mce_external_plugins', 'add_plugin_columnTitle');  
     	 add_filter('mce_buttons_3', 'register_columnTitle');
		 
		 //testimonialProfile
		 add_filter('mce_external_plugins', 'add_plugin_testimonialProfile');  
     	 add_filter('mce_buttons_3', 'register_testimonialProfile'); 
		 
		 //galleryPosts
		 add_filter('mce_external_plugins', 'add_plugin_galleryPosts');  
     	 add_filter('mce_buttons_3', 'register_galleryPosts'); 
		
	}

}


//ACTIVE
function register_columnTitle($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "columnTitle");  
   return $buttons;  
} 
function add_plugin_columnTitle($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['columnTitle'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_staffProfile($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "staffProfile");  
   return $buttons;  
} 
function add_plugin_staffProfile($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['staffProfile'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_dataTableGroup($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "dataTableGroup");  
   return $buttons;  
} 
function add_plugin_dataTableGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['dataTableGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_statBox($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "statBox");  
   return $buttons;  
} 
function add_plugin_statBox($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['statBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_newsletterSignup($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "newsletterSignup");  
   return $buttons;  
} 
function add_plugin_newsletterSignup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['newsletterSignup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}  

function register_standardButton($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "standardButton");  
   return $buttons;  
} 
function add_plugin_standardButton($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['standardButton'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}  

function register_iconBox($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "iconBox");  
   return $buttons;  
} 
function add_plugin_iconBox($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['iconBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}  

/*function register_singlepost($buttons) { //Registers the TinyMCE button
   array_push($buttons, "singlepost");  
   return $buttons;  
}
function add_plugin_singlepost($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['singlepost'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}*/

function register_progressBar($buttons) { //Registers the TinyMCE button
   array_push($buttons, "progressBar");  
   return $buttons;  
}
function add_plugin_progressBar($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['progressBar'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_bootstrapContainer($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapContainer");  
   return $buttons;  
}
function add_plugin_bootstrapContainer($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapContainer'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_bootstrapRow($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapRow");  
   return $buttons;  
}
function add_plugin_bootstrapRow($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapRow'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_bootstrapColumn($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapColumn");  
   return $buttons;  
}
function add_plugin_bootstrapColumn($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapColumn'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_youtubeVideo($buttons) { //Registers the TinyMCE button
   array_push($buttons, "youtubeVideo");  
   return $buttons;  
}
function add_plugin_youtubeVideo($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['youtubeVideo'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_vimeoVideo($buttons) { //Registers the TinyMCE button
   array_push($buttons, "vimeoVideo");  
   return $buttons;  
}
function add_plugin_vimeoVideo($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['vimeoVideo'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_html5Video($buttons) { //Registers the TinyMCE button
   array_push($buttons, "html5Video");  
   return $buttons;  
}
function add_plugin_html5Video($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['html5Video'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_tabGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "tabGroup");  
   return $buttons;  
}
function add_plugin_tabGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['tabGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_accordionGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "accordionGroup");  
   return $buttons;  
}
function add_plugin_accordionGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['accordionGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_testimonials($buttons) { //Registers the TinyMCE button
   array_push($buttons, "testimonials");  
   return $buttons;  
}
function add_plugin_testimonials($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['testimonials'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_contactForm($buttons) { //Registers the TinyMCE button
   array_push($buttons, "contactForm");  
   return $buttons;  
}
function add_plugin_contactForm($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['contactForm'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_googleMap($buttons) { //Registers the TinyMCE button
   array_push($buttons, "googleMap");  
   return $buttons;  
}
function add_plugin_googleMap($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['googleMap'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_alert($buttons) { //Registers the TinyMCE button
   array_push($buttons, "alert");  
   return $buttons;  
}
function add_plugin_alert($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['alert'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_divider($buttons) {  
   array_push($buttons, "divider");  
   return $buttons;  
}
function add_plugin_divider($plugin_array) {  
   $plugin_array['divider'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_ctaBox($buttons) {  
   array_push($buttons, "ctaBox");  
   return $buttons;  
}
function add_plugin_ctaBox($plugin_array) {  
   $plugin_array['ctaBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_iconElement($buttons) {  
   array_push($buttons, "iconElement");  
   return $buttons;  
}
function add_plugin_iconElement($plugin_array) {  
   $plugin_array['iconElement'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_sliderCarousel($buttons) {  
   array_push($buttons, "sliderCarousel");  
   return $buttons;  
}
function add_plugin_sliderCarousel($plugin_array) {  
   $plugin_array['sliderCarousel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_clientCarousel($buttons) {  
   array_push($buttons, "clientCarousel");  
   return $buttons;  
}
function add_plugin_clientCarousel($plugin_array) {  
   $plugin_array['clientCarousel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_panelsCarousel($buttons) {  
   array_push($buttons, "panelsCarousel");  
   return $buttons;  
}

function add_plugin_panelsCarousel($plugin_array) {  
   $plugin_array['panelsCarousel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_piechart($buttons) {  
   array_push($buttons, "piechart");  
   return $buttons;  
}
function add_plugin_piechart($plugin_array) {  
   $plugin_array['piechart'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_milestone($buttons) {  
   array_push($buttons, "milestone");  
   return $buttons;  
}
function add_plugin_milestone($plugin_array) {  
   $plugin_array['milestone'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}

function register_countdown($buttons) {  
   array_push($buttons, "countdown");  
   return $buttons;  
}
function add_plugin_countdown($plugin_array) {  
   $plugin_array['countdown'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}

function register_quoteBox($buttons) {  
   array_push($buttons, "quoteBox");  
   return $buttons;  
}
function add_plugin_quoteBox($plugin_array) {  
   $plugin_array['quoteBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_pricingTable($buttons) {  
   array_push($buttons, "pricingTable");  
   return $buttons;  
}
function add_plugin_pricingTable($plugin_array) {  
   $plugin_array['pricingTable'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_trialForm($buttons) { //Registers the TinyMCE button
   array_push($buttons, "trialForm");  
   return $buttons;  
}
function add_plugin_trialForm($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['trialForm'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_videoBox($buttons) { //Registers the TinyMCE button
   array_push($buttons, "videoBox");  
   return $buttons;  
}
function add_plugin_videoBox($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['videoBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_postItems($buttons) { //Registers the TinyMCE button
   array_push($buttons, "postItems");  
   return $buttons;  
}
function add_plugin_postItems($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['postItems'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}

function register_classesCarousel($buttons) { //Registers the TinyMCE button
   array_push($buttons, "classesCarousel");  
   return $buttons;  
}
function add_plugin_classesCarousel($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['classesCarousel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}

function register_eventItems($buttons) { //Registers the TinyMCE button
   array_push($buttons, "eventItems");  
   return $buttons;  
}
function add_plugin_eventItems($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['eventItems'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}


function register_testimonialProfile($buttons) { //Registers the TinyMCE button
   array_push($buttons, "testimonialProfile");  
   return $buttons;  
}
function add_plugin_testimonialProfile($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['testimonialProfile'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}

function register_galleryPosts($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "galleryPosts");  
   return $buttons;  
} 
function add_plugin_galleryPosts($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['galleryPosts'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 


function parse_shortcode_content( $content ) {
    /* Parse nested shortcodes and add formatting. */
    $content = trim(  do_shortcode( $content ) );
    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );
    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );
    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    return $content;
}

?>