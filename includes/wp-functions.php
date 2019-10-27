<?php 

if( !function_exists('pm_ln_is_plugin_active') ){
	
	function pm_ln_is_plugin_active($plugin) {

		include_once (ABSPATH . 'wp-admin/includes/plugin.php');
	
		return is_plugin_active($plugin);
	
	}
	
}

function pm_ln_has_shortcode($shortcode = '') {
     
    $post_to_check = get_post(get_the_ID());
     
    // false because we have to search through the post content first
    $found = false;
     
    // if no short code was provided, return false
    if (!$shortcode) {
        return $found;
    }
    // check the post content for the short code
    if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {
        // we have found the short code
        $found = true;
    }
     
    // return our final results
    return $found;
}

//WPML custom language selector
function pm_ln_icl_post_languages(){
	
  if( function_exists('icl_get_languages') ){
	  
	  $languages = icl_get_languages('skip_missing=1');
  
	  if(1 < count($languages)){
		  
		  
		  echo '<li>';
			echo '<div class="pm-dropdown pm-language-selector-menu">';
				echo '<div class="pm-dropmenu">';
					echo '<p class="pm-menu-title">'.esc_attr__('Language','energytheme').'</p>';
					echo '<i class="fa fa-angle-down"></i>';
				echo '</div>';
				echo '<div class="pm-dropmenu-active">';
					echo '<ul>';
					   foreach($languages as $l){
						if(!$l['active']) echo '<li><img src="'.$l['country_flag_url'].'" /><a href="'.$l['url'].'">'.$l['translated_name'].'</a></li>';
					   }
					echo '</ul>';
				echo '</div>';
			echo '</div>';
		 echo '</li>';
		
		//echo join(', ', $langs);
		
	  }
	  
  }//end of check function
  
}

//Custom WordPress functions
function pm_ln_set_query($custom_query=null) { 
	global $wp_query, $wp_query_old, $post, $orig_post;
	$wp_query_old = $wp_query;
	$wp_query = $custom_query;
	$orig_post = $post;
}

function pm_ln_restore_query() {  
	global $wp_query, $wp_query_old, $post, $orig_post;
	$wp_query = $wp_query_old;
	$post = $orig_post;
	setup_postdata($post);
}

//Limit words in paragraphs
function pm_ln_string_limit_words($string, $word_limit){
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

//Apply primary color to the first two words in a news post title
function pm_ln_set_primary_words($title = ''){
	
    $ARR_title = explode(" ", $title);

    if(sizeof($ARR_title) > 2 ){
        $ARR_title[0] = "<span>".$ARR_title[0];
		$ARR_title[1] = $ARR_title[1]."</span>";
        return implode(" ", $ARR_title);
    } else {
        return $title;
    }
  
}

//Count all posts related to current tag
function pm_ln_get_posts_count_by_tag($tag_name){
    $tags = get_tags(array ('search' => $tag_name) );
    foreach ($tags as $tag) {
      //if ($tag->name == $tag_name) {}
	  return $tag->count;
    }
    return 0;
}

//Count all posts related to current category
function pm_ln_get_posts_count_by_category($category_name){
    $categories = get_categories(array ('search' => $category_name) );
    foreach ($categories as $category) {
		//if ($category->name == $category_name) {}
		return $category->count;
    }
    return 0;
}

//Convert HEX to RGB
function pm_ln_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
	  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
	  $r = hexdec(substr($hex,0,2));
	  $g = hexdec(substr($hex,2,2));
	  $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

//YOUTUBE Thumbnail Extract
function pm_ln_parse_yturl($url) {
	$pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
	preg_match($pattern, $url, $matches);
	return (isset($matches[1])) ? $matches[1] : false;
}

function pm_ln_parse_youtube_id($url) {
  $url_string = parse_url($url, PHP_URL_QUERY);
  parse_str($url_string, $args);
  return isset($args['v']) ? $args['v'] : false;
}


//New breadcrumb nav as of Feb. 23 2014
function pm_ln_breadcrumbs() {
	
	global $post;
	
	echo '<div class="pm-sub-header-breadcrumbs-ul">';	
    
    if (!is_home()) {
        echo '<p><a href="'.home_url().'"> Home</a></p>';
        echo '<p><i class="fa fa-angle-right"></i></p>';
		
		if (is_single() && get_post_type() == 'post_staff' ) { //Wordpress doesnt support custom post types for breadcrumbs
		
			echo '<p>';
			the_title();
			echo '</p>';
		
		} else if (is_single()) {
			
            echo '<p>';
			the_title();
            echo '</p>';
			
		} else if (is_404()) {
			
            echo '<p> '.esc_attr__('404 Error', 'energytheme').'</p>';
		
		} else if (is_category()) {	
		
			echo '<p>';
			
            //the_category('</li><li class="separator"> / </li><li>', 'single');
			
			$cat = get_category( get_query_var( 'cat' ) ); 
			echo $cat->name;
			echo '</p>';
				
        } elseif (is_page()) {
			
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<p><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></p> <p><i class="fa fa-angle-right"></i></p>';
                }
                echo $output;
                echo '<p title="'.$title.'"> '.$title.'</p>';
            } else {
                echo '<p> ';
                echo the_title();
                echo '</p>';
            }
        } 
		elseif (is_tag()) {
			echo '<p>'; 
			single_tag_title();
			echo '</p>';
		}
		elseif (is_day()) {
			echo"<p>Archive for "; the_time('F jS, Y'); echo'</p>';
		}
		elseif (is_month()) {
			echo"<p>Archive for "; the_time('F, Y'); echo'</p>';
		}
		elseif (is_year()) {
			echo"<p>Archive for "; the_time('Y'); echo'</p>';
		}
		elseif (is_author()) {
			echo"<p>Author Archive"; echo'</p>';
		}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {exit;
			echo "<p>Blog Archives"; echo'</p>';
		}
		elseif (is_search()) {
			echo"<p>Search Results"; echo'</p>';
		}
    }
    
	
	
    echo '</div>';
	
}

//COMMENTS CONTROL
function pm_ln_mytheme_comment($comment, $args, $depth) {
	
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('pm-comment-box-container'); ?> id="li-comment-<?php comment_ID() ?>">
    
	<div class="pm-comment-box-container" id="comment-<?php comment_ID(); ?>">
	
		<div class="comment-author vcard pm-comment-box-avatar-container">
    
    		<div class="pm-comment-avatar">
				<?php echo get_avatar($comment,$size='70'); ?>
            </div>
            
            <ul class="pm-comment-author-list">
                <li><p class="pm-comment-name"><?php comment_author(); ?></p></li>
                <li><p class="pm-comment-date">
                <?php printf(esc_attr__('<cite class="fn">%s</cite>', 'energytheme'), get_comment_author_link()) ?> <a href="<?php echo htmlspecialchars(get_comment_link( $comment->comment_ID )) ?>"> <?php printf(esc_attr__('%1$s at %2$s', 'energytheme'), get_comment_date(),get_comment_time()) ?></a><?php edit_comment_link(esc_attr__('(Edit)', 'energytheme'),' ','') ?>
                </p></li>
            </ul>
                   
		<!-- Leave this space empty (no closing div tag here) -->
    
	</div>
	
	<?php if ($comment->comment_approved == '0') : ?>
		<em style="margin-top:20px; display:block;"><?php esc_attr_e('Your comment is awaiting moderation.', 'energytheme') ?></em>
	<?php endif; ?>
	 
	 
	<div class="pm-comment"><?php comment_text() ?></div>
    
		<?php if($args['max_depth']!=$depth) { ?>
            <div class="pm-comment-reply-btn">
                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
        <?php } ?>
    
	</div>
	<?php
	
	//echo '<div class="pm-comment-reply-form">';
	
		//Required for Themeforest regulations.
		$comments_args = array(
		  'title_reply'       => esc_attr__( 'Leave a Reply', 'energytheme' ),
		  'title_reply_to'    => esc_attr__( 'Leave a Reply to %s', 'energytheme' ),
		  'cancel_reply_link' => esc_attr__( 'Cancel Reply', 'energytheme' ),
		  'label_submit'      => esc_attr__( 'Post Comment', 'energytheme' ),
		);
	
		//comment_form($comments_args);
	
	//echo '</div>';
		
}//end of comments control

//Menu functions
function pm_ln_main_menu() {
	echo '<ul class="sf-menu" id="pm-nav">';
		  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
	echo '</ul>';
}


function pm_ln_footer_menu() {
	echo '<ul class="pm-footer-navigation" id="pm-footer-nav">';
		  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
	echo '</ul>';
}

/* Quick login validation */
function pm_ln_validate_quick_login() {
	
	// Verify nonce
    if( isset( $_POST['pm_ln_quick_login_nonce'] ) ) {
	
	  if ( !wp_verify_nonce( $_POST['pm_ln_quick_login_nonce'], 'pm_ln_nonce_action' ) ) {
		  die( 'A system error has occurred, please try again later.' );
	  }	   
	  
    }
	
	//global $wp, $wp_rewrite, $wp_the_query, $wp_query;
	//require_once('/home/pulsarme/dev/wp-blog-header.php');
	
	 //Post values
  	$username = $_POST['quickuser'];
    $password = $_POST['quickpass'];
	
	if( empty($username) || $password === 'Username' ){
		
		echo 'username_error';
		die();
		
	} elseif( empty($password) || $password === 'Password' ){
		
		echo 'password_error';
		die();
		
	} else {
		//all good, continue
	}
	
	//Verify credentials
	$user = get_user_by( 'login', $username );
	if ( $user && wp_check_password( $password, $user->data->user_pass, $user->ID) ) {
	   
	   $creds = array();
	   $creds['user_login'] = $username;
	   $creds['user_password'] = $password;
	   $creds['remember'] = false;
	   
	   //Authenticate user
	   $auth = wp_signon($creds, false );
	   if( is_wp_error($auth) ) {      
			echo "login_failed";
			die();
	   } else {
			echo "login_success";
			die();
	   }
	   
	} else {
		
	   echo "credentials_failed";
	   exit;
	   
	}
	die();
	
}


//Quick login form
function pm_ln_quick_login_form() { ?>

    <div class="pm-ln-quick-login-form">
    
    	<form class="form-horizontal registraion-form" role="form">
        
        	<ul class="pm-ln-quick-login-list">
        
                <li>
                    <input type="text" name="pm_quick_username" id="pm_quick_username" value="" placeholder="<?php esc_attr_e('Username','energytheme'); ?>" maxlength="70" class="pm-ln-quick-login-textfield" />
                </li>
                <li>
                    <input type="password" name="pm_quick_password" id="pm_quick_password" value="" placeholder="<?php esc_attr_e('Password','energytheme'); ?>" maxlength="70" class="pm-ln-quick-login-textfield" />
                </li>
                <li>
                    <input type="submit" value="<?php esc_attr_e('Sign in','energytheme'); ?>" id="btn-quick-login" class="pm-base-btn pm-header-btn pm-register-btn">
                </li>
            
            </ul>
            
            <?php 
            wp_nonce_field('pm_ln_nonce_action','pm_ln_quick_login_nonce'); 
            //wp_nonce_field( plugin_basename( __FILE__ ), 'pm_ln_new_user_nonce' );
            ?>
        
        </form>
        
    </div>

<?php
}

function pm_ln_registration_form() { ?>

	<h6><?php esc_attr_e('Register Account','energytheme'); ?></h6>

    <div class="vb-registration-form">
      <form class="form-horizontal registration-form" role="form">
    
        <div class="form-group">
          <label for="pm_name" class="sr-only"><?php esc_attr_e('Full Name','energytheme'); ?></label>
          <input type="text" name="pm_name" id="pm_name" value="" placeholder="Full Name" maxlength="70" />
        </div>
    
        <div class="form-group">
          <label for="pm_email" class="sr-only"><?php esc_attr_e('Email Address','energytheme'); ?></label>
          <input type="email" name="pm_email" id="pm_email" value="" placeholder="Email Address" maxlength="70" />
        </div>
    
        <div class="form-group">
          <label for="pm_username" class="sr-only"><?php esc_attr_e('Username','energytheme'); ?></label>
          <input type="text" name="pm_username" id="pm_username" value="" placeholder="<?php esc_attr_e('Username','energytheme'); ?>" maxlength="70" />
        </div>
        
        <div class="form-group">
          <label for="pm_pass" class="sr-only"><?php esc_attr_e('Password','energytheme'); ?></label>
          <input type="password" name="pm_pass" id="pm_pass" value="" placeholder="Password" maxlength="70" />
          <p><?php esc_attr_e('Minimum 8 characters','energytheme'); ?></p>
        </div>
    
        <?php 
		wp_nonce_field('pm_ln_nonce_action','pm_ln_new_user_nonce'); 
		//wp_nonce_field( plugin_basename( __FILE__ ), 'pm_ln_new_user_nonce' );
		?>

            
        <input type="submit" value="<?php esc_attr_e('Register Account','energytheme'); ?>" class="button-primary btn-register-user clearfix" id="wp-submit" name="wp-submit">
      </form>
    
        <div class="indicator"></div>
        <div class="alert result-message"></div>
    </div>

<?php
}

/* New User registration - retrieves data from Ajax request */
function pm_ln_register_new_user() {
 
    // Verify nonce
    if( isset( $_POST['pm_ln_new_user_nonce'] ) ) {
	
	  if ( !wp_verify_nonce( $_POST['pm_ln_new_user_nonce'], 'pm_ln_nonce_action' ) ) {
		  die( 'A system error has occurred, please try again later.' );
	  }	   
	  
    }

    //Post values
  	$username = $_POST['user'];
    $password = $_POST['pass'];
    $email    = $_POST['mail'];
    $name     = $_POST['name'];
	$code     = $_POST['code'];
 	
 	// IMPORTANT: You should make server side validation here!
	
	if( empty($name) || $name === 'Full Name' ){
		
		echo 'name_error';
		exit;
		
	} elseif( !pm_ln_validate_email($email_address) ){
		
		echo 'email_error';
		exit;
		
	} elseif( empty($username) || $username === 'Username' ){
		
		echo 'username_error';
		exit;
		
	} elseif( empty($password) || $password === 'Password' ){
		
		echo 'pass_error';
		exit;
		
	} else {
		
	}
	
	//Get the default role from Members area plug-in
	$default_role = get_option('pm_default_registration_role');
	
	if(!$default_role){
		$default_role = 'standard_member';	
	}
	
	$userdata = array(
		'user_login' => $username,
		'user_pass'  => $password,
		'user_email' => $email,
		'first_name' => $name,
		'role' => $default_role
	);

	$user_id = wp_insert_user( $userdata ) ;
	
	//$u = new WP_User( $user_id );
	//add_role( $role, $display_name, $capabilities ); // I assume $role, $display_name, $caps are already set before
	//$u->set_role( $role );

	//On success
	if( !is_wp_error($user_id) ) {
		echo 'success';
		exit;
	} else {
		//echo $user_id->get_error_message();
		echo 'form_error';
		exit;
	} 
  die();
	
}

/* Load More AJAX Call */
function pm_ln_load_more(){
	
	if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
	if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');
	
	$section = '';
			
	
	$args = '';
	if(isset($_POST['section']) && $_POST['section']){
		$section = $_POST['section'];
		$args = 'post_type=post_'.$_POST['section'].'&'; //match the post type name
	}
	
	
	if($section == 'schedules') {
		
		$schedules_posts_per_page = get_theme_mod('schedules_posts_per_page', '3');
			
		$args = array(
			'post_type' => 'post_schedules',
			'post_status' => 'publish',
			'posts_per_page' => $schedules_posts_per_page,
			'paged' => $_POST['page'],
			'order' => 'DESC',
			/*'orderby' => 'meta_value',
			'meta_key' => 're_start_date_event',*/
			'meta_query' => array(
				array(
					'key' => 'is_expired',
					'value' => 'true',
					'compare' => '!=',
				)
			),
		);
		
	} else {
		
		$args .= 'post_status=publish&posts_per_page=4&paged='. $_POST['page'];
			
	}
	
	
		
	ob_start();
	$query = new WP_Query($args);
	while( $query->have_posts() ){ $query->the_post();
		
		if($section == 'galleries'){//match the post type name
			get_template_part( 'content', 'gallerypost' );
		} else {
			get_template_part( 'content', $section.'post' );	
		}	
		
	}
	
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	
	echo json_encode(
		array(
			'pages' => $query->max_num_pages,
			'content' => $content
		)
	);
	
	exit;

}


function pm_ln_load_more_posts(){
	
	if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
	if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');

	$posts_per_load = get_theme_mod('posts_per_load', '3');
	
	$args = '';

	$args .= 'post_status=publish&posts_per_page='.$posts_per_load.'&paged='. $_POST['page'];
		
	ob_start();
	$query = new WP_Query($args);
	while( $query->have_posts() ){ $query->the_post();
				
		get_template_part( 'content', 'post' );	
		
	}
	
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	
	echo json_encode(
		array(
			'pages' => $query->max_num_pages,
			'content' => $content
		)
	);
	
	exit;

}

function pm_ln_retrieve_likes() {
	//verify nonce (set in functions.php - line 636)
	if(!wp_verify_nonce($_POST['like_nonce'], 'like_nonce_ajax')) die('Invalid retrieve like nonce');
	if( !is_numeric($_POST['postID']) || $_POST['postID'] < 0 ) die('Invalid request');
	
	$postID = $_POST['postID'];
	
	$currentLikes = get_post_meta($postID, 'pm_total_likes', true);
	
	echo json_encode(
		array(
			'currentLikes' => $currentLikes,
		)
	);
	
	exit;
	
}

function pm_ln_like_feature() {
	
	//verify nonce (set in functions.php - line 636)
	if(!wp_verify_nonce($_POST['nonce'], 'like_nonce_ajax')) die('Invalid save like nonce');
	if( !is_numeric($_POST['postID']) || $_POST['postID'] < 0 ) die('Invalid request');
	
	$postID = $_POST['postID'];
	$likes = (int) $_POST['likes'];
	
	//$newLikes = $likes + 1;
	
	update_post_meta($postID, 'pm_total_likes', $likes);
	
	exit;
	
}


//FUNCTIONS

function pm_ln_create_dates($weeksToDisplay = 1){

	$dOffsets = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
	$prevMonday = mktime(0,0,0, date("m"), date("d")-array_search(date("l"),$dOffsets), date("Y"));
	$oneWeek = 3600*24*7;
	$toSunday = 3600*24*6;
	//$weeksToDisplay = 4;
	$weeks = array();
	
	for ($i = 0; $i < $weeksToDisplay; $i++){
		//$weeks = "Week " . ($i + 1) . " (mon-sun) " . date("Y/m/d",$prevMonday + $oneWeek*$i) . " to " . date("Y/m/d",$prevMonday + $oneWeek*$i + $toSunday) . "<br>";
		//$weeks =  date("Y/m/d", $prevMonday + $oneWeek*$i ) . " to " . date("Y/m/d",$prevMonday + $oneWeek*$i + $toSunday) . "<br>";
		array_push($weeks, date("Y/m/d", $prevMonday + $oneWeek*$i ) . " - " . date("Y/m/d",$prevMonday + $oneWeek*$i + $toSunday));
	}
	
	return $weeks;
	
}

function pm_ln_formatInternalDate($date){
			
	$date = date_create($date);
	return date_format($date,"d M Y");
	
}

function pm_ln_formatInternalDateTime($date_time){
	
	$date_time = date_create($date_time);
	return date_format($date_time,"d M Y h:i A");
	
}

function pm_ln_validate_email($email){
			
	return filter_var($email, FILTER_VALIDATE_EMAIL);
	
}//end of validate_email()

function pm_ln_send_contact_form() {
			
	 // Verify nonce
     if( isset( $_POST['pm_ln_send_contact_nonce'] ) ) {
	
	   if ( !wp_verify_nonce( $_POST['pm_ln_send_contact_nonce'], 'pm_ln_nonce_action' ) ) {
		   die( 'A system error has occurred, please try again later.' );
	   }	   
	  
     }

	 //Post values
	 $first_name = sanitize_text_field($_POST['first_name']);
	 $last_name = sanitize_text_field($_POST['last_name']);
	 $email_address = sanitize_text_field($_POST['email_address']);
	 $message = sanitize_text_field($_POST['message']);
	 $phone = sanitize_text_field($_POST['phone']);
	 $recipient = sanitize_text_field($_POST['recipient']);
	 $consent = sanitize_text_field($_POST['consent']);
	 
	
	 if ( empty($first_name) ){
		
		echo 'first_name_error';
		die();


	 } elseif( empty($last_name) ){
		
		echo 'last_name_error';
		die();
		
	 } elseif( !pm_ln_validate_email($email_address) ){
		
		echo 'email_error';
		die();

		
	 } elseif( empty($message) ){
		
		echo 'message_error';
		die();
		
	 }
	 
	 if($consent === 'unchecked') {
		echo 'consent_error';
		die();
	 }
	 

	
	//All good, send email
	$multiple_recipients = array(
		$recipient
	);
	
	$subj = esc_html__('Contact Form Inquiry', 'energytheme');
	
	$body = ' 
	
	  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'energytheme') .' ****
	  
	  '. esc_html__('First Name', 'energytheme') .': '.$first_name.'
	  '. esc_html__('Last Name', 'energytheme') .': '.$last_name.'
	  '. esc_html__('Email Address', 'energytheme') .': '.$email_address.'
	  '. esc_html__('Phone Number', 'energytheme') .': '.$phone.'
	  '. esc_html__('Message', 'energytheme') .': '.$message.'
	  
	';
	
	$send_mail = wp_mail( $multiple_recipients, $subj, $body );
	
	if($send_mail) {
		
		echo 'success';
		die();
		
	} else {
		
		echo 'failed';
		die();
			
	}
		
}


function pm_ln_send_quick_contact_form() {
			
	 // Verify nonce
     if( isset( $_POST['pm_ln_send_quick_contact_nonce'] ) ) {
	
	   if ( !wp_verify_nonce( $_POST['pm_ln_send_quick_contact_nonce'], 'pm_ln_nonce_action' ) ) {
		   die( 'A system error has occurred, please try again later.' );
	   }	   
	  
     }

	 //Post values
	 $full_name = sanitize_text_field($_POST['full_name']);
	 $email_address = sanitize_text_field($_POST['email_address']);
	 $message = sanitize_text_field($_POST['message']);
	 $recipient = sanitize_text_field($_POST['recipient']);
	 
	
	 if ( empty($full_name) ){
		
		echo 'full_name_error';
		die();

		
	} elseif( !pm_ln_validate_email($email_address) ){
		
		echo 'email_error';
		die();
		
	} elseif( empty($message) ){
		
		echo 'message_error';
		die();
		
	} 
	
	//All good, send email
	$multiple_recipients = array(
		$recipient
	);
	
	$subj = esc_html__('Quick Contact Form Inquiry', 'energytheme');
	
	$body = ' 
	
	  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'energytheme') .' ****
	  
	  '. esc_html__('Full Name', 'energytheme') .': '.$full_name.'
	  '. esc_html__('Email Address', 'energytheme') .': '.$email_address.'
	  '. esc_html__('Message', 'energytheme') .': '.$message.'
	  
	';
	
	$send_mail = wp_mail( $multiple_recipients, $subj, $body );
	
	if($send_mail) {
		
		echo 'success';
		die();
		
	} else {
		
		echo 'failed';
		die();
			
	}
		
}



function pm_ln_send_trial_form() {
			
	 // Verify nonce
     if( isset( $_POST['pm_ln_send_trial_nonce'] ) ) {
	
	   if ( !wp_verify_nonce( $_POST['pm_ln_send_trial_nonce'], 'pm_ln_nonce_action' ) ) {
		   die( 'A system error has occurred, please try again later.' );
	   }	   
	  
     }

	 //Post values
	 $full_name = sanitize_text_field($_POST['full_name']);
	 $email_address = sanitize_text_field($_POST['email_address']);
	 $phone = sanitize_text_field($_POST['phone']);
	 $message = sanitize_text_field($_POST['message']);
	 $recipient = sanitize_text_field($_POST['recipient']);
	 $consent = sanitize_text_field($_POST['consent']);
	 
	
	 if ( empty($full_name) ){
		
		echo 'full_name_error';
		die();

		
	} elseif( !pm_ln_validate_email($email_address) ){
		
		echo 'email_error';
		die();
		
	} 
	
	if($consent === 'unchecked') {
		echo 'consent_error';
		die();
	}
	
	//All good, send email
	$multiple_recipients = array(
		$recipient
	);
	
	$subj = esc_html__('Trial Form Inquiry', 'energytheme');
	
	$body = ' 
	
	  **** '. esc_html__('THIS IS AN AUTOMATED MESSAGE. PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL', 'energytheme') .' ****
	  
	  '. esc_html__('Full Name', 'energytheme') .': '.$full_name.'
	  '. esc_html__('Email Address', 'energytheme') .': '.$email_address.'
	  '. esc_html__('Phone Number', 'energytheme') .': '.$phone.'
	  '. esc_html__('Message', 'energytheme') .': '.$message.'
	  
	';
	
	$send_mail = wp_mail( $multiple_recipients, $subj, $body );
	
	if($send_mail) {
		
		echo 'success';
		die();
		
	} else {
		
		echo 'failed';
		die();
			
	}
		
}

?>