<?php

//News posts meta options
add_action( 'add_meta_boxes', 'add_post_metaoptions' );

//Programs meta options
add_action( 'add_meta_boxes', 'add_programs_metaoptions' );

//Classes meta options
add_action( 'add_meta_boxes', 'add_classes_metaoptions' );

//Page meta options
add_action( 'add_meta_boxes', 'add_page_metaoptions' );

//Staff meta options
add_action( 'add_meta_boxes', 'add_staff_metaoptions' );

//Woocommerce meta options
add_action( 'add_meta_boxes', 'add_woocommerce_metaoptions' );

//Gallery meta options
add_action( 'add_meta_boxes', 'add_gallery_metaoptions' );

//Video meta options
add_action( 'add_meta_boxes', 'add_video_metaoptions' );

//Save custom post/page data
add_action( 'save_post', 'save_postdata' );

//Rewrite default WordPress Featured image box
add_action('do_meta_boxes', 'pm_ln_render_new_post_thumbnail_meta_box');

//Featured image box for Classes and Programs post type
add_action('do_meta_boxes', 'pm_ln_render_custom_post_thumbnail_meta_box');

/*** NEW FEATURED IMAGE FOR POSTS WITH DETAILS *****/
function pm_ln_new_post_thumbnail_meta_box() {
	
    global $post; // we know what this does
     
    echo '<p>Recommended size: 1170x500px</p>';
     
    $thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true ); // grabing the thumbnail id of the post
    echo _wp_post_thumbnail_html( $thumbnail_id ); // echoing the html markup for the thumbnail
     
    //echo '<p>Content below the image.</p>';
}

function pm_ln_render_new_post_thumbnail_meta_box() {
	
    global $post_type; // lets call the post type 
     
    // remove the old meta box
    remove_meta_box( 'postimagediv','post','side' );
             
    // adding the new meta box.
    add_meta_box('postimagediv', esc_attr__('Featured Image', 'energytheme'), 'pm_ln_new_post_thumbnail_meta_box', 'post', 'side', 'low');
}

/*** FEATURED IMAGE FOR CLASSES, PROGRAMS & SCHEDULE POST TYPES *****/
function pm_ln_custom_post_thumbnail_meta_box() {
	
    global $post; // we know what this does
     
    echo '<p>Recommended size: 900x400px</p>';
     
    $thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true ); // grabing the thumbnail id of the post
    echo _wp_post_thumbnail_html( $thumbnail_id ); // echoing the html markup for the thumbnail
     
    //echo '<p>Content below the image.</p>';
}

function pm_ln_schedules_post_thumbnail_meta_box() {
	
    global $post; // we know what this does
     
    echo '<p>Recommended size: 780x400px</p>';
     
    $thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true ); // grabing the thumbnail id of the post
    echo _wp_post_thumbnail_html( $thumbnail_id ); // echoing the html markup for the thumbnail
     
    //echo '<p>Content below the image.</p>';
}

function pm_ln_render_custom_post_thumbnail_meta_box() {
	
    global $post_type; // lets call the post type 
     
    // remove the old meta box
    remove_meta_box( 'postimagediv','post_classes','side' );
	remove_meta_box( 'postimagediv','post_programs','side' );
	remove_meta_box( 'postimagediv','post_schedules','side' );
	remove_meta_box( 'postimagediv','post_event','side' );
             
    // adding the new meta box.
    add_meta_box('postimagediv', esc_attr__('Featured Image', 'energytheme'), 'pm_ln_custom_post_thumbnail_meta_box', 'post_classes', 'side', 'low');
	add_meta_box('postimagediv', esc_attr__('Featured Image', 'energytheme'), 'pm_ln_custom_post_thumbnail_meta_box', 'post_programs', 'side', 'low');
	add_meta_box('postimagediv', esc_attr__('Featured Image', 'energytheme'), 'pm_ln_schedules_post_thumbnail_meta_box', 'post_schedules', 'side', 'low');
	add_meta_box('postimagediv', esc_attr__('Featured Image', 'energytheme'), 'pm_ln_custom_post_thumbnail_meta_box', 'post_event', 'side', 'low');
	
}

/*** GALLERY META OPTIONS & FUNCTIONS *****/
function add_gallery_metaoptions() {

	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Gallery image
	add_meta_box( 
		'pm_gallery_image_meta', //ID
		'Gallery Image',  //label
		'pm_gallery_image_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Video
	add_meta_box( 
		'pm_gallery_video_meta', //ID
		'Youtube Video',  //label
		'pm_gallery_video_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Display Video in carousel
	add_meta_box( 
		'pm_gallery_display_video_meta', //ID
		'Display Youtube Video?',  //label
		'pm_gallery_display_video_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);

	
	//Message
	add_meta_box( 
		'pm_gallery_item_caption_meta', //ID
		'Caption',  //label
		'pm_gallery_item_caption_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Disable Share options
	add_meta_box( 
		'pm_disable_share_feature', //ID
		'Disable Share feature?',  //label
		'pm_disable_share_feature_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
}

function pm_gallery_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_header_image_meta = get_post_meta( $post->ID, 'pm_gallery_header_image_meta', true );
	//echo $post->ID . $pm_gallery_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Recommended size: 1920x500px or 1920x800px for parallax mode','energytheme'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_gallery_header_image_meta); ?>" name="pm_gallery_header_image_meta" id="img-uploader-field" class="pm-admin-staff-header-upload-field" />
		<input id="upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'energytheme'); ?>" class="button-secondary" />
        <div class="pm-staff-header-image-preview"></div>
    
    <?php
	
}

function pm_gallery_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_image_meta = get_post_meta( $post->ID, 'pm_gallery_image_meta', true );
	//echo $pm_gallery_image_meta;
		

	//HTML code
	?>
		<input type="text" value="<?php echo esc_html($pm_gallery_image_meta); ?>" name="pm_gallery_image_meta" id="featured-img-uploader-field" class="pm-admin-upload-field" />
		<input id="featured_upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'energytheme'); ?>" class="button-secondary" />
        <div class="pm-admin-gallery-image-preview"></div>
        
        <?php if($pm_gallery_image_meta) : ?>
        	<input id="remove_gallery_image_button" type="button" value="<?php esc_attr_e('Remove Image', 'energytheme'); ?>" class="button-secondary" />
        <?php endif; ?>
        
    
    <?php
	
}

function pm_gallery_item_caption_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_item_caption_meta = get_post_meta( $post->ID, 'pm_gallery_item_caption_meta', true );
	//echo $pm_gallery_item_caption_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a caption for your gallery item (this will also display in the PrettyPhoto carousel unless disabled under Energy Options -> PrettyPhoto options).','energytheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_gallery_item_caption_meta); ?>" name="pm_gallery_item_caption_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_gallery_video_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_video_meta = get_post_meta( $post->ID, 'pm_gallery_video_meta', true );
	//echo $pm_gallery_video_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a Youtube video URL (ex. http://www.youtube.com/watch?v=ai9qbTKxwkc)','energytheme'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_gallery_video_meta); ?>" name="pm_gallery_video_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_gallery_display_video_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_gallery_display_video_meta = get_post_meta( $post->ID, 'pm_gallery_display_video_meta', true );
	//echo $pm_post_layout_meta;
	
	?>
        <p><?php esc_attr_e('Setting this to "YES" will override the gallery image in the PrettyPhoto carousel.', 'energytheme'); ?></p>
        <select id="pm_gallery_display_video_meta" name="pm_gallery_display_video_meta" class="pm-admin-select-list">  
        	<option value="no" <?php selected( $pm_gallery_display_video_meta, 'no' ); ?>><?php esc_attr_e('NO', 'energytheme') ?></option>
            <option value="yes" <?php selected( $pm_gallery_display_video_meta, 'yes' ); ?>><?php esc_attr_e('YES', 'energytheme') ?></option>
        </select>
    
    <?php
	
}


/*** VIDEO META OPTIONS & FUNCTIONS *****/
function add_video_metaoptions() {

	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post_videos', //Post type
		'normal', 
		'high' 
	);
	
	//Thumbnail image
	add_meta_box( 
		'pm_video_thumbnail_image_meta', //ID
		'Thumbnail Image',  //label
		'pm_video_thumbnail_image_meta_function' , //function
		'post_videos', //Post type
		'normal', 
		'high' 
	);
	
	//Video
	add_meta_box( 
		'pm_video_youtube_id_meta', //ID
		'Youtube Video',  //label
		'pm_video_youtube_id_meta_function' , //function
		'post_videos', //Post type
		'normal', 
		'high' 
	);
	
	//Display YouTube thumbnail
	add_meta_box( 
		'pm_video_display_youtube_thumbnail_meta', //ID
		'Display Youtube Thumbnail?',  //label
		'pm_video_display_youtube_thumbnail_meta_function' , //function
		'post_videos', //Post type
		'normal', 
		'high' 
	);


	
	//Disable Share options
	add_meta_box( 
		'pm_disable_share_feature', //ID
		'Disable Share feature?',  //label
		'pm_disable_share_feature_function' , //function
		'post_videos', //Post type
		'normal', 
		'high' 
	);
	
}


function pm_video_youtube_id_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_video_youtube_id_meta = get_post_meta( $post->ID, 'pm_video_youtube_id_meta', true );
	echo $pm_video_youtube_id_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a Youtube video URL (ex. http://www.youtube.com/watch?v=ai9qbTKxwkc)','energytheme'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_video_youtube_id_meta); ?>" name="pm_video_youtube_id_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_video_thumbnail_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_video_thumbnail_image_meta = get_post_meta( $post->ID, 'pm_video_thumbnail_image_meta', true );
	//echo $pm_gallery_image_meta;
		

	//HTML code
	?>
		<input type="text" value="<?php echo esc_html($pm_video_thumbnail_image_meta); ?>" name="pm_video_thumbnail_image_meta" id="featured-img-uploader-field" class="pm-admin-upload-field" />
		<input id="featured_upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'energytheme'); ?>" class="button-secondary" />
        <div class="pm-admin-gallery-image-preview"></div>
        
        <?php if($pm_video_thumbnail_image_meta) : ?>
        	<input id="remove_gallery_image_button" type="button" value="<?php esc_attr_e('Remove Image', 'energytheme'); ?>" class="button-secondary" />
        <?php endif; ?>
        
    
    <?php
	
}


function pm_video_display_youtube_thumbnail_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_video_display_youtube_thumbnail_meta = get_post_meta( $post->ID, 'pm_video_display_youtube_thumbnail_meta', true );
	//echo $pm_post_layout_meta;
	
	?>
        <p><?php esc_attr_e('Setting this to "YES" will load the default Youtube thumbnail assigned to your video and will override the Thumbnail image field.', 'energytheme'); ?></p>
        <select id="pm_video_display_youtube_thumbnail_meta" name="pm_video_display_youtube_thumbnail_meta" class="pm-admin-select-list">  
        	<option value="no" <?php selected( $pm_video_display_youtube_thumbnail_meta, 'no' ); ?>><?php esc_attr_e('NO', 'energytheme') ?></option>
            <option value="yes" <?php selected( $pm_video_display_youtube_thumbnail_meta, 'yes' ); ?>><?php esc_attr_e('YES', 'energytheme') ?></option>
        </select>
    
    <?php
	
}




/*** WOOCOMMERCE META OPTIONS & FUNCTIONS *****/
function add_woocommerce_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_woocom_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_woocom_header_image_meta_function' , //function
		'product', //Post type
		'normal', 
		'high' 
	);

	//Sidebar layout
	/*add_meta_box( 
		'pm_woocom_post_layout_meta', //ID
		'Sidebar Layout',  //label
		'pm_woocom_post_layout_meta_function' , //function
		'product', //Post type
		'normal', 
		'high' 
	);*/
	
	//Header Message
	add_meta_box( 
		'pm_woocom_header_message_meta', //ID
		'Page Header Message',  //label
		'pm_woocom_header_message_meta_function' , //function
		'product', //Post type
		'normal', 
		'high' 
	);

		
}

function pm_woocom_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_woocom_header_image_meta = get_post_meta( $post->ID, 'pm_woocom_header_image_meta', true );
	//echo $post->ID . $pm_woocom_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Recommended size: 1920x500px','energytheme'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_woocom_header_image_meta); ?>" name="pm_woocom_header_image_meta" id="img-uploader-field" class="pm-admin-upload-field" />
		<input id="upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'energytheme'); ?>" class="button-secondary" />
        <div class="pm-admin-upload-field-preview"></div>
        
        <?php if($pm_woocom_header_image_meta) : ?>
        	<input id="remove_woocom_header_image_button" type="button" value="<?php esc_attr_e('Remove Image', 'energytheme'); ?>" class="button-secondary" />
        <?php endif; ?> 
    
    <?php
	
	
	
}

function pm_woocom_post_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_woocom_post_layout_meta = get_post_meta( $post->ID, 'pm_woocom_post_layout_meta', true );
	//echo $pm_post_layout_meta;
	
	?>
        <p><?php esc_attr_e('Select your desired layout for this post.','energytheme'); ?></p>
        <select id="pm_woocom_post_layout_meta" name="pm_woocom_post_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_woocom_post_layout_meta, 'no-sidebar' ); ?>><?php esc_attr_e('No Sidebar', 'energytheme'); ?></option>
            <option value="left-sidebar" <?php selected( $pm_woocom_post_layout_meta, 'left-sidebar' ); ?>><?php esc_attr_e('Left Sidebar', 'energytheme'); ?></option>
            <option value="right-sidebar" <?php selected( $pm_woocom_post_layout_meta, 'right-sidebar' ); ?>><?php esc_attr_e('Right Sidebar', 'energytheme'); ?></option>
        </select>
            
    <?php
	
}

function pm_woocom_header_message_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_woocom_header_message_meta = get_post_meta( $post->ID, 'pm_woocom_header_message_meta', true );
	//echo $pm_woocom_header_message_meta;
		

	//HTML code
	?>
		<input type="text" value="<?php echo esc_attr($pm_woocom_header_message_meta); ?>" name="pm_woocom_header_message_meta" class="pm-admin-text-field" />
    <?php
	
}



/*** CAREERS META OPTIONS & FUNCTIONS *****/
function add_careers_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post_careers', //Post type
		'normal', 
		'high' 
	);
	
	//Position
	add_meta_box( 
		'pm_careers_position_meta', //ID
		'Position',  //label
		'pm_careers_position_meta_function' , //function
		'post_careers', //Post type
		'normal', 
		'high' 
	);
	
	//Department
	add_meta_box( 
		'pm_careers_department_meta', //ID
		'Department',  //label
		'pm_careers_department_meta_function' , //function
		'post_careers', //Post type
		'normal', 
		'high' 
	);
	
	//Opening Type
	add_meta_box( 
		'pm_careers_opening_type_meta', //ID
		'Opening Type',  //label
		'pm_careers_opening_type_meta_function' , //function
		'post_careers', //Post type
		'normal', 
		'high' 
	);
	
	//Location
	add_meta_box( 
		'pm_careers_location_meta', //ID
		'Location',  //label
		'pm_careers_location_meta_function' , //function
		'post_careers', //Post type
		'normal', 
		'high' 
	);
	
	//Icon
	add_meta_box( 
		'pm_careers_icon_meta', //ID
		'Icon',  //label
		'pm_careers_icon_meta_function' , //function
		'post_careers', //Post type
		'normal', 
		'high' 
	);
	
}

function pm_careers_position_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_careers_position_meta = get_post_meta( $post->ID, 'pm_careers_position_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('State the position for this career post.', 'energytheme'); ?> <strong><?php esc_attr_e('NOTE:', 'energytheme'); ?></strong> <?php esc_attr_e('This will appear on the Careers posts page.', 'energytheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_careers_position_meta); ?>" name="pm_careers_position_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_careers_department_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_careers_department_meta = get_post_meta( $post->ID, 'pm_careers_department_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter the department for this career post.', 'energytheme'); ?> <strong><?php esc_attr_e('NOTE:', 'energytheme'); ?></strong> <?php esc_attr_e('This will appear on the Careers posts page.', 'energytheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_careers_department_meta); ?>" name="pm_careers_department_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_careers_opening_type_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_careers_opening_type_meta = get_post_meta( $post->ID, 'pm_careers_opening_type_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('State the opening type of this career post (ex. Full-time, Part-time, Contract etc.)', 'energytheme'); ?> <strong><?php esc_attr_e('NOTE:', 'energytheme'); ?></strong> <?php esc_attr_e('This will appear on the Careers posts page.', 'energytheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_careers_opening_type_meta); ?>" name="pm_careers_opening_type_meta" class="pm-admin-text-field" />
    
    <?php
	
}


function pm_careers_location_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_careers_location_meta = get_post_meta( $post->ID, 'pm_careers_location_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('State the location of this career post.', 'energytheme'); ?> <strong><?php esc_attr_e('NOTE:', 'energytheme'); ?></strong> <?php esc_attr_e('This will appear on the Careers posts page.', 'energytheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_careers_location_meta); ?>" name="pm_careers_location_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_careers_icon_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_careers_icon_meta = get_post_meta( $post->ID, 'pm_careers_icon_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Provide an icon the best relates to this career post.', 'energytheme'); ?> <strong><?php esc_attr_e('NOTE:', 'energytheme'); ?></strong> <?php esc_attr_e('This will appear on the Careers posts page.', 'energytheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_careers_icon_meta); ?>" name="pm_careers_icon_meta" class="pm-admin-text-field" />
    
    <?php
	
}



/*** STAFF META OPTIONS & FUNCTIONS *****/
function add_staff_metaoptions() {

	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);	

	//Staff Image
	add_meta_box( 
		'pm_staff_image_meta', //ID
		'Staff Profile Image',  //label
		'pm_staff_image_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Staff Title
	add_meta_box( 
		'pm_staff_title_meta', //ID
		'Staff Title',  //label
		'pm_staff_title_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Staff Title
	add_meta_box( 
		'pm_staff_quote_meta', //ID
		'Personal Quote',  //label
		'pm_staff_quote_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Twitter Address
	add_meta_box( 
		'pm_staff_twitter_meta', //ID
		'Twitter Address',  //label
		'pm_staff_twitter_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Facebook Address
	add_meta_box( 
		'pm_staff_facebook_meta', //ID
		'Facebook Address',  //label
		'pm_staff_facebook_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Google Plus Address
	add_meta_box( 
		'pm_staff_gplus_meta', //ID
		'Google Plus Address',  //label
		'pm_staff_gplus_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Linkedin Address
	add_meta_box( 
		'pm_staff_linkedin_meta', //ID
		'Linkedin Address',  //label
		'pm_staff_linkedin_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Instagram Address
	add_meta_box( 
		'pm_staff_instagram_meta', //ID
		'Instagram Address',  //label
		'pm_staff_instagram_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Email Address
	add_meta_box( 
		'pm_staff_email_address_meta', //ID
		'Email Address',  //label
		'pm_staff_email_address_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Disable Share options
	add_meta_box( 
		'pm_disable_share_feature', //ID
		'Disable Share feature?',  //label
		'pm_disable_share_feature_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
}

function pm_staff_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_image_meta = get_post_meta( $post->ID, 'pm_staff_image_meta', true );
	//echo $pm_staff_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_html($pm_staff_image_meta); ?>" name="pm_staff_image_meta" id="img-staff-uploader-field" class="pm-admin-upload-field" />
		<input id="upload_staff_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'energytheme'); ?>" class="button-secondary" />
        <div class="pm-admin-upload-staff-preview"></div>
        
        <?php if($pm_staff_image_meta) : ?>
        	<input id="remove_staff_image_button" type="button" value="<?php esc_attr_e('Remove Image', 'energytheme'); ?>" class="button-secondary" />
        <?php endif; ?> 
    
    <?php
	
	
	
}

function pm_staff_title_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_title_meta = get_post_meta( $post->ID, 'pm_staff_title_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_attr($pm_staff_title_meta); ?>" name="pm_staff_title_meta" class="pm-admin-text-field" />
    
    <?php
	
}


function pm_staff_quote_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_quote_meta = get_post_meta( $post->ID, 'pm_staff_quote_meta', true );
	//echo $pm_staff_quote_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_attr($pm_staff_quote_meta); ?>" name="pm_staff_quote_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_twitter_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_twitter_meta = get_post_meta( $post->ID, 'pm_staff_twitter_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_html($pm_staff_twitter_meta); ?>" name="pm_staff_twitter_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_facebook_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_facebook_meta = get_post_meta( $post->ID, 'pm_staff_facebook_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_html($pm_staff_facebook_meta); ?>" name="pm_staff_facebook_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_gplus_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_gplus_meta = get_post_meta( $post->ID, 'pm_staff_gplus_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_html($pm_staff_gplus_meta); ?>" name="pm_staff_gplus_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_linkedin_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_linkedin_meta = get_post_meta( $post->ID, 'pm_staff_linkedin_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_html($pm_staff_linkedin_meta); ?>" name="pm_staff_linkedin_meta" class="pm-admin-text-field" />
    
    <?php
	
}



function pm_staff_instagram_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_instagram_meta = get_post_meta( $post->ID, 'pm_staff_instagram_meta', true );
	//echo $pm_staff_instagram_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_html($pm_staff_instagram_meta); ?>" name="pm_staff_instagram_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_email_address_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_email_address_meta = get_post_meta( $post->ID, 'pm_staff_email_address_meta', true );
	//echo $pm_staff_email_address_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_attr($pm_staff_email_address_meta); ?>" name="pm_staff_email_address_meta" class="pm-admin-text-field" />
    
    <?php
	
}



/*** POST META OPTIONS & FUNCTIONS *****/
function add_post_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Post Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);

	
	//Page layout
	/*add_meta_box( 
		'pm_post_layout_meta', //ID
		'Post Layout',  //label
		'pm_post_layout_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);*/
	
	//Featured Post
	/*add_meta_box( 
		'pm_post_featured_meta', //ID
		'Feature in Presentation carousel?',  //label
		'pm_post_featured_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);*/
	
	//Post Visibility
	/*add_meta_box(
		'pm_post_visibility', // Unique ID
		esc_htmlesc_attr__( 'Post Type Visibility', 'energytheme' ), // Title
		'pm_post_visibility_function', // Callback function
		'post', // Admin page (or post type)
		'side', // Context
		'default' // Priority
	);*/
	
	
}

function pm_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_header_image_meta = get_post_meta( $post->ID, 'pm_header_image_meta', true );
	//echo $post->ID . $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Recommended size: 1920x500px', 'energytheme') ?></p>
		<input type="text" value="<?php echo esc_html($pm_header_image_meta); ?>" name="post-header-image" id="img-uploader-field" class="pm-admin-upload-field" />
		<input id="upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'energytheme'); ?>" class="button-secondary" />
        <div class="pm-admin-upload-field-preview"></div>
        
        <?php if($pm_header_image_meta) : ?>
        	<input id="remove_page_header_button" type="button" value="<?php esc_attr_e('Remove Image', 'energytheme'); ?>" class="button-secondary" />
        <?php endif; ?>        
    
    <?php
	
}

function pm_header_message_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_header_message_meta = get_post_meta( $post->ID, 'pm_header_message_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_attr($pm_header_message_meta); ?>" name="post-header-message" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_post_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_post_layout_meta = get_post_meta( $post->ID, 'pm_post_layout_meta', true );
	//echo $pm_post_layout_meta;
	
	?>
        <p><?php esc_attr_e('Select your desired layout for this post.', 'energytheme'); ?></p>
        <select id="pm_post_layout_meta" name="pm_post_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_post_layout_meta, 'no-sidebar' ); ?>><?php esc_attr_e('No Sidebar', 'energytheme') ?></option>
            <option value="left-sidebar" <?php selected( $pm_post_layout_meta, 'left-sidebar' ); ?>><?php esc_attr_e('Left Sidebar', 'energytheme') ?></option>
            <option value="right-sidebar" <?php selected( $pm_post_layout_meta, 'right-sidebar' ); ?>><?php esc_attr_e('Right Sidebar', 'energytheme') ?></option>
        </select>
        
        
    
    <?php
	
}


/*** PROGRAMS META OPTIONS & FUNCTIONS *****/
function add_programs_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post_programs', //Post type
		'normal', 
		'high' 
	);
	
	//Disable Share options
	add_meta_box( 
		'pm_disable_share_feature', //ID
		'Disable Share feature?',  //label
		'pm_disable_share_feature_function' , //function
		'post_programs', //Post type
		'normal', 
		'high' 
	);
	
}


/*** CLASSES META OPTIONS & FUNCTIONS *****/
function add_classes_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post_classes', //Post type
		'normal', 
		'high' 
	);
	
	//Disable Share options
	add_meta_box( 
		'pm_disable_share_feature', //ID
		'Disable Share feature?',  //label
		'pm_disable_share_feature_function' , //function
		'post_classes', //Post type
		'normal', 
		'high' 
	);
	
}




/*** PAGE META OPTIONS & FUNCTIONS *****/
function add_page_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
	
	//Page layout
	add_meta_box( 
		'pm_page_layout_meta', //ID
		'Page Layout',  //label
		'pm_page_layout_meta_function' , //function
		'page', //Post type
		'side'
	);
	
	 add_meta_box(
        'custom_sidebar',
        esc_attr__( 'Custom Sidebar', 'energytheme' ),
        'pm_ln_custom_sidebar_function',
        'page',
        'side'
    );
		
	//Disable Container
	add_meta_box( 
		'pm_page_disable_container_meta', //ID
		'Disable Bootstrap container for full width content?',  //label
		'pm_page_disable_container_meta_function' , //function
		'page', //Post type
		'side'
	);
	
	//Container Padding
	add_meta_box( 
		'pm_bootstrap_container_padding', //ID
		'Bootstrap Container Padding Amount',  //label
		'pm_bootstrap_container_padding_function' , //function
		'page', //Post type
		'side'
	);
	
	//Print and Share
	add_meta_box( 
		'pm_page_print_share_meta', //ID
		'Enable Print and Share options?',  //label
		'pm_page_print_share_meta_function' , //function
		'page', //Post type
		'side' 
	);
	
	
	//Header Message
	add_meta_box( 
		'pm_header_message_meta', //ID
		'Page Header Message',  //label
		'pm_header_message_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
	
	
}

function pm_ln_custom_sidebar_function( $post ){
	
    global $wp_registered_sidebars;
     
    $custom = get_post_custom($post->ID);
     
    if(isset($custom['custom_sidebar']))
        $val = $custom['custom_sidebar'][0];
    else
        $val = "default";
 
    // Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
 
    // The actual fields for data entry
    $output = '<p><label for="myplugin_new_field">'.esc_attr__("Choose a sidebar to display.", 'energytheme' ).'</label></p>';
    $output .= "<select name='custom_sidebar'>";
 
    // Add a default option
    $output .= "<option";
    if($val == "default")
        $output .= " selected='selected'";
    $output .= " value='default'>".esc_attr__('No Sidebar', 'energytheme')."</option>";
     
    // Fill the select element with all registered sidebars
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)
    {
        $output .= "<option";
        if($sidebar['name'] == $val)
            $output .= " selected='selected'";
        $output .= " value='".$sidebar['name']."'>".$sidebar['name']."</option>";
    }
   
    $output .= "</select>";
	
	$output .= '<p><strong>'.esc_attr__("NOTE:", 'energytheme' ).'</strong> '.esc_attr__("Applies to Default Template only.", 'energytheme' ).'</p>';
     
    echo $output;
}

function pm_page_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_layout_meta = get_post_meta( $post->ID, 'pm_page_layout_meta', true );
	//echo $pm_page_layout_meta;
	
	?>
            
        <select id="pm_page_layout_meta" name="pm_page_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_page_layout_meta, 'no-sidebar' ); ?>><?php esc_attr_e('No Sidebar', 'energytheme') ?></option>
            <option value="left-sidebar" <?php selected( $pm_page_layout_meta, 'left-sidebar' ); ?>><?php esc_attr_e('Left Sidebar', 'energytheme') ?></option>
            <option value="right-sidebar" <?php selected( $pm_page_layout_meta, 'right-sidebar' ); ?>><?php esc_attr_e('Right Sidebar', 'energytheme') ?></option>
        </select>
    
    <?php
	
}

function pm_page_disable_container_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_disable_container_meta = get_post_meta( $post->ID, 'pm_page_disable_container_meta', true );
	//echo $pm_post_disable_container_meta;
	
	?>
            
        <select id="pm_page_disable_container_meta" name="pm_page_disable_container_meta" class="pm-admin-select-list"> 
        	<option value="no" <?php selected( $pm_page_disable_container_meta, 'no' ); ?>><?php esc_attr_e('No', 'energytheme') ?></option> 
            <option value="yes" <?php selected( $pm_page_disable_container_meta, 'yes' ); ?>><?php esc_attr_e('Yes', 'energytheme') ?></option>
        </select>
    
    <?php
	
}


function pm_bootstrap_container_padding_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_bootstrap_container_padding_meta = get_post_meta( $post->ID, 'pm_bootstrap_container_padding_meta', true );
	
	?>
            
        <select id="pm_bootstrap_container_padding_meta" name="pm_bootstrap_container_padding_meta" class="pm-admin-select-list"> 
        
        	<option value="120" <?php selected( $pm_bootstrap_container_padding_meta, '120' ); ?>>120</option>
            <option value="110" <?php selected( $pm_bootstrap_container_padding_meta, '110' ); ?>>110</option>
            <option value="100" <?php selected( $pm_bootstrap_container_padding_meta, '100' ); ?>>100</option>
            <option value="90" <?php selected( $pm_bootstrap_container_padding_meta, '90' ); ?>>90</option>
            <option value="80" <?php selected( $pm_bootstrap_container_padding_meta, '80' ); ?>>80</option>
            <option value="70" <?php selected( $pm_bootstrap_container_padding_meta, '70' ); ?>>70</option>
            <option value="60" <?php selected( $pm_bootstrap_container_padding_meta, '60' ); ?>>60</option>
            <option value="50" <?php selected( $pm_bootstrap_container_padding_meta, '50' ); ?>>50</option>
            <option value="40" <?php selected( $pm_bootstrap_container_padding_meta, '40' ); ?>>40</option>
            <option value="30" <?php selected( $pm_bootstrap_container_padding_meta, '30' ); ?>>30</option>
            <option value="20" <?php selected( $pm_bootstrap_container_padding_meta, '20' ); ?>>20</option>
            <option value="10" <?php selected( $pm_bootstrap_container_padding_meta, '10' ); ?>>10</option>
        	<option value="0" <?php selected( $pm_bootstrap_container_padding_meta, '0' ); ?>>0</option> 
            
        </select>
    
    <?php
	
}


function pm_page_print_share_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_print_share_meta = get_post_meta( $post->ID, 'pm_page_print_share_meta', true );
	//echo $pm_post_disable_container_meta;
	
	?>
            
        <select id="pm_page_print_share_meta" name="pm_page_print_share_meta" class="pm-admin-select-list"> 
        	<option value="on" <?php selected( $pm_page_print_share_meta, 'on' ); ?>><?php esc_attr_e('ON', 'energytheme') ?></option> 
            <option value="off" <?php selected( $pm_page_print_share_meta, 'off' ); ?>><?php esc_attr_e('OFF', 'energytheme') ?></option>
        </select>
    
    <?php
	
}

function pm_display_header_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_display_header_meta = get_post_meta( $post->ID, 'pm_display_header_meta', true );
	//echo $pm_display_header_meta;
	
	?>
            
        <select id="pm_display_header_meta" name="pm_display_header_meta" class="pm-admin-select-list"> 
        	<option value="on" <?php selected( $pm_display_header_meta, 'on' ); ?>><?php esc_attr_e('ON', 'energytheme') ?></option> 
            <option value="off" <?php selected( $pm_display_header_meta, 'off' ); ?>><?php esc_attr_e('OFF', 'energytheme') ?></option>
        </select>
    
    <?php
	
}

/*** EVENTS META OPTIONS & FUNCTIONS *****/
function add_event_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post_event', //Post type
		'normal', 
		'high' 
	);
	
	//Event date
	add_meta_box( 
		'pm_event_date_meta', //ID
		'Event Date',  //label
		'pm_event_date_meta_function' , //function
		'post_event', //Post type
		'normal', 
		'high' 
	);
	
	//Event start time
	add_meta_box( 
		'pm_event_start_time_meta', //ID
		'Event Start Time',  //label
		'pm_event_start_time_meta_function' , //function
		'post_event', //Post type
		'normal', 
		'high' 
	);
	
	//Event end time
	add_meta_box( 
		'pm_event_end_time_meta', //ID
		'Event End Time',  //label
		'pm_event_end_time_meta_function' , //function
		'post_event', //Post type
		'normal', 
		'high' 
	);
	
	//Event details
	/*add_meta_box( 
		'pm_event_details_meta', //ID
		'Event Date',  //label
		'pm_event_details_meta_function' , //function
		'post_event', //Post type
		'normal', 
		'high' 
	);*/
	
	//Event Fan Page
	add_meta_box( 
		'pm_event_fan_page_meta', //ID
		'Event Fan Page URL',  //label
		'pm_event_fan_page_meta_function' , //function
		'post_event', //Post type
		'normal', 
		'high' 
	);
	
	//Disable Share options
	add_meta_box( 
		'pm_disable_share_feature', //ID
		'Disable Share feature?',  //label
		'pm_disable_share_feature_function' , //function
		'post_event', //Post type
		'normal', 
		'high' 
	);
	
}

//Admin columns

function post_event_edit_columns($columns) {
 
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Event",
		"pm_col_ev_cat" => "Category",
		"pm_col_ev_tags" => "Tags",
		"pm_col_ev_date" => "Dates",
		"pm_col_ev_times" => "Times",
		"pm_col_ev_thumb" => "Event Image",
		
		);
	return $columns;
	
}

function post_event_custom_columns($column) {
	
	global $post;
	$custom = get_post_custom();
	switch ($column) {
		

	case "pm_col_ev_cat":
		// - show taxonomy terms -
		$eventcats = get_the_terms($post->ID, "event_categories");
		$eventcats_html = array();
		if ($eventcats) {
		foreach ($eventcats as $eventcat)
		array_push($eventcats_html, $eventcat->name);
		echo implode($eventcats_html, ", ");
		} else {
		esc_attr_e('None', 'themeforce');;
		}
	break;
	case "pm_col_ev_tags":
		// - show taxonomy terms -
		$eventtags = get_the_terms($post->ID, "eventtags");
		$eventtags_html = array();
		if ($eventtags) {
		foreach ($eventtags as $eventtag)
		array_push($eventtags_html, $eventtag->name);
		echo implode($eventtags_html, ", ");
		} else {
		esc_attr_e('None', 'themeforce');;
		}
	break;
	case "pm_col_ev_date":
		// - show dates -
		$pm_event_date_meta = $custom["pm_event_date_meta"][0];
		$month = date("M", strtotime($pm_event_date_meta));
		$day = date("d", strtotime($pm_event_date_meta));
		$year = date("Y", strtotime($pm_event_date_meta));
		echo '<em>' . $month . ' / '.$day.' / '.$year.'</em>';
	break;
	case "pm_col_ev_times":
		// - show times -
		$pm_event_start_time_meta = $custom["pm_event_start_time_meta"][0];
		$pm_event_end_time_meta = $custom["pm_event_end_time_meta"][0];
		
		echo $pm_event_start_time_meta . ' - ' .$pm_event_end_time_meta;
	break;
	case "pm_col_ev_thumb":
		// - show thumb -
		$post_image_id = get_post_thumbnail_id(get_the_ID());
		if ($post_image_id) {
			$thumbnail = wp_get_attachment_image_src( $post_image_id, 'post-thumbnail', false);
			if ($thumbnail) (string)$thumbnail = $thumbnail[0];
			
			echo '<img src="'.$thumbnail.'" alt="thumbnail" width="45%" height="45%" />';

		}
	break;
	 
	}
}

//Admin columns end

function pm_disable_share_feature_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_disable_share_feature = get_post_meta( $post->ID, 'pm_disable_share_feature', true );
	//echo $pm_post_layout_meta;
	
	?>
        <select id="pm_disable_share_feature" name="pm_disable_share_feature" class="pm-admin-select-list">  
            <option value="no" <?php selected( $pm_disable_share_feature, 'no' ); ?>><?php esc_attr_e('No', 'energytheme') ?></option>
            <option value="yes" <?php selected( $pm_disable_share_feature, 'yes' ); ?>><?php esc_attr_e('Yes', 'energytheme') ?></option>
        </select>
            
    <?php
	
}

function pm_event_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_event_header_image_meta = get_post_meta( $post->ID, 'pm_event_header_image_meta', true );
	//echo $post->ID . $pm_event_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Recommended size: 1920x500px or 1920x800px for parallax mode','energytheme'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_event_header_image_meta); ?>" name="pm_event_header_image_meta" id="img-uploader-field" class="pm-admin-staff-header-upload-field" />
		<input id="upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'energytheme'); ?>" class="button-secondary" />
        <div class="pm-staff-header-image-preview"></div>
    
    <?php
	
}

function pm_event_start_time_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_event_start_time_meta = get_post_meta( $post->ID, 'pm_event_start_time_meta', true );
	//echo $pm_event_date_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter the start time for this event.', 'energytheme'); ?></p>	
		<input name="pm_event_start_time_meta" value="<?php echo esc_attr($pm_event_start_time_meta); ?>" class="pm-admin-date-field" />
    
    <?php
	
}

function pm_event_end_time_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_event_end_time_meta = get_post_meta( $post->ID, 'pm_event_end_time_meta', true );
	//echo $pm_event_date_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter the end time for this event.', 'energytheme'); ?></p>	
		<input name="pm_event_end_time_meta" value="<?php echo esc_attr($pm_event_end_time_meta); ?>" class="pm-admin-date-field" />
    
    <?php
	
}



/*function pm_event_details_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_event_date_meta = get_post_meta( $post->ID, 'pm_event_date_meta', true );
	//echo $pm_event_date_meta;
		
	//$sche_once is used to disable date editing unless the user specifically requests it.
	//But a new event might be recurring (via filter), and we don't want to 'lock' new events.
	//See https://wordpress.org/support/topic/wrong-default-in-input-element
	$sche_once = ( $schedule == 'once' || !empty(get_current_screen()->action) );
	 
	if ( !$sche_once ){
		$notices = '<strong>'. esc_attr__( 'This is a reoccurring event', 'eventorganiser' ).'</strong>. '
					. esc_attr__( 'Check to edit this event and its reoccurrences', 'eventorganiser' )
					.' <input type="checkbox" id="HWSEvent_rec" name="eo_input[AlterRe]" value="yes">';
	}else{
		$notices = '';
	}

	//HTML code
	?>
    
    	<p><?php esc_attr_e( 'Start Date/Time', 'energytheme' ).':'; ?></p>
         
        <input class="ui-widget-content ui-corner-all" name="eo_input[StartDate]" size="10" maxlength="10" id="from_date" <?php disabled( !$sche_once );?> value="<?php echo $start->format( $phpFormat ); ?>"/>
        <?php printf(
                '<input name="eo_input[StartTime]" class="eo_time ui-widget-content ui-corner-all" size="6" maxlength="8" id="HWSEvent_time" %s value="%s"/>',
                disabled( (!$sche_once) || $all_day, true, false ),
                eo_format_datetime( $start, $time_format )
        );?>						

        
        <p><?php esc_attr_e( 'End Date/Time', 'energytheme' ).':';?></p>
         
            <input class="ui-widget-content ui-corner-all" name="eo_input[EndDate]" size="10" maxlength="10" id="to_date" <?php disabled( !$sche_once );?>  value="<?php echo $end->format( $phpFormat ); ?>"/>
        
            <?php printf(
                    '<input name="eo_input[FinishTime]" class="eo_time ui-widget-content ui-corner-all" size="6" maxlength="8" id="HWSEvent_time2" %s value="%s"/>',
                    disabled( (!$sche_once) || $all_day, true, false ),
                    eo_format_datetime( $end, $time_format )
            );?>	

        <label>
        <input type="checkbox" id="eo_allday"  <?php checked( $all_day ); ?> name="eo_input[allday]"  <?php  disabled( !$sche_once );?> value="1"/>
            <?php esc_attr_e( 'All day', 'energytheme' );?>
        </label>
        
        <p><?php esc_attr_e( 'Reoccurence:', 'eventorganiser' );?></p>
        
        <?php $reoccurrence_schedules = array( 'once' => esc_attr__( 'none', 'eventorganiser' ), 'daily' => esc_attr__( 'daily', 'eventorganiser' ), 'weekly' => esc_attr__( 'weekly', 'eventorganiser' ),
                                            'monthly' => esc_attr__( 'monthly', 'eventorganiser' ), 'yearly' => esc_attr__( 'yearly', 'eventorganiser' ) );?>

        <select id="HWSEventInput_Req" name="eo_input[schedule]">
            <?php foreach ( $reoccurrence_schedules as $index => $val ): ?>
                <option value="<?php echo $index;?>" <?php selected( $schedule, $index );?>><?php echo $val;?></option>
            <?php endforeach;  //End foreach $allowed_reoccurs?>
        </select>

    	<!-- Toggle elements with JS -->
        <p><?php esc_attr_e( 'Repeat every', 'eventorganiser' );?> 
        <input <?php  disabled( !$sche_once || $all_day );?> class="ui-widget-content ui-corner-all" name="eo_input[event_frequency]" id="HWSEvent_freq" type="number" min="1" max="365" maxlength="4" size="4" disabled="disabled" value="<?php echo $frequency;?>" /> 
        <span id="recpan" >  </span>				
        </p>

        <p id="dayofweekrepeat">
        <?php esc_attr_e( 'on', 'eventorganiser' );?>	
        <?php for ($i = 0; $i <= 6; $i++ ):
            $d = ($start_day + $i) % 7;
            $ical_d = $ical_days[$d];
            $day = $wp_locale->weekday_abbrev[$wp_locale->weekday[$d]];
            $schedule_days = ( is_array( $schedule_meta ) ? $schedule_meta : array() );
        ?>
            <input type="checkbox" id="day-<?php echo $day;?>"  <?php checked( in_array( $ical_d, $schedule_days ), true ); ?>  value="<?php echo esc_attr( $ical_d )?>" class="daysofweek" name="eo_input[days][]" disabled="disabled" />
            <label for="day-<?php echo $day;?>" > <?php echo $day;?></label>
        <?php endfor;  ?>
        </p>

        <p id="dayofmonthrepeat">
        <label for="bymonthday" >	
            <input type="radio" id="bymonthday" disabled="disabled" name="eo_input[schedule_meta]" <?php checked( $occurs_by, 'BYMONTHDAY' ); ?> value="BYMONTHDAY=" /> 
            <?php esc_attr_e( 'day of month', 'eventorganiser' );?>
        </label>
        <label for="byday" >
            <input type="radio" id="byday" disabled="disabled" name="eo_input[schedule_meta]"  <?php checked( $occurs_by != 'BYMONTHDAY', true ); ?> value="BYDAY=" /> 
            <?php esc_attr_e( 'day of week', 'eventorganiser' );?>
        </label>
        </p>

        <p class="reoccurrence_label">
        <?php esc_attr_e( 'until', 'eventorganiser' );?> 
        <input <?php  disabled( (!$sche_once) || $all_day ); ?> class="ui-widget-content ui-corner-all" name="eo_input[schedule_end]" id="recend" size="10" maxlength="10" disabled="disabled" value="<?php echo $until->format( $phpFormat ); ?>"/>
        </p>

        <p id="event_summary"> </p>
        <!-- Toggle elements with JS end -->
    
    	<p><?php esc_attr_e('Enter the date of this event.', 'energytheme'); ?></p>	
		<input type="date" id="datepicker" name="pm_event_date_meta" value="<?php echo esc_attr($pm_event_date_meta); ?>" class="pm-admin-date-field" />
    <?php
	
}*/


function pm_event_date_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_event_date_meta = get_post_meta( $post->ID, 'pm_event_date_meta', true );
	//echo $pm_event_date_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter the date of this event.', 'energytheme'); ?></p>	
		<input type="date" id="datepicker" name="pm_event_date_meta" value="<?php echo esc_attr($pm_event_date_meta); ?>" class="pm-admin-date-field" />
    <?php
	
}

function pm_event_fan_page_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_event_fan_page_meta = get_post_meta( $post->ID, 'pm_event_fan_page_meta', true );
	//echo $pm_event_fan_page_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a Facebook fan page URL','energytheme'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_event_fan_page_meta); ?>" name="pm_event_fan_page_meta" class="pm-admin-text-field" />
    <?php
	
}



/*** SCHEDULES META OPTIONS & FUNCTIONS *****/
function add_schedule_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post_schedules', //Post type
		'normal', 
		'high' 
	);
	
	//Schedule date
	add_meta_box( 
		'pm_schedule_date_meta', //ID
		'Entry Date',  //label
		'pm_schedule_date_meta_function' , //function
		'post_schedules', //Post type
		'normal', 
		'high' 
	);
	
	//Schedule start time
	add_meta_box( 
		'pm_schedule_start_time_meta', //ID
		'Entry Start Time',  //label
		'pm_schedule_start_time_meta_function' , //function
		'post_schedules', //Post type
		'normal', 
		'high' 
	);
	
	//Schedule end time
	add_meta_box( 
		'pm_schedule_end_time_meta', //ID
		'Entry End Time',  //label
		'pm_schedule_end_time_meta_function' , //function
		'post_schedules', //Post type
		'normal', 
		'high' 
	);
	
	//Location
	add_meta_box( 
		'pm_schedule_location_meta', //ID
		'Entry Location / Studio Room',  //label
		'pm_schedule_location_meta_function' , //function
		'post_schedules', //Post type
		'normal', 
		'high' 
	);
	
	//Cancellation
	add_meta_box( 
		'pm_schedule_cancellation_meta', //ID
		'Cancellation?',  //label
		'pm_schedule_cancellation_meta_function' , //function
		'post_schedules', //Post type
		'normal', 
		'high' 
	);
	
	
	//Disable Share options
	add_meta_box( 
		'pm_disable_share_feature', //ID
		'Disable Share feature?',  //label
		'pm_disable_share_feature_function' , //function
		'post_schedules', //Post type
		'normal', 
		'high' 
	);
	
}

//Admin columns

function post_schedules_edit_columns($columns) {
 
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Schedule Entry",
		"pm_col_sch_date" => "Dates",
		"pm_col_sch_times" => "Times",
		"pm_col_sch_location" => "Location / Studio Room",
		"pm_col_sch_thumb" => "Post Image",
		
		);
	return $columns;
	
}

function post_schedules_custom_columns($column) {
	
	global $post;
	$custom = get_post_custom();
	switch ($column) {


	case "pm_col_sch_date":
		// - show dates -
		$pm_schedule_date_meta = $custom["pm_schedule_date_meta"][0];
		$month = date("M", strtotime($pm_schedule_date_meta));
		$day = date("d", strtotime($pm_schedule_date_meta));
		$year = date("Y", strtotime($pm_schedule_date_meta));
		echo '<em>' . $month . ' / '.$day.' / '.$year.'</em>';
	break;
	case "pm_col_sch_times":
		// - show times -
		$pm_schedule_start_time_meta = $custom["pm_schedule_start_time_meta"][0];
		$pm_schedule_end_time_meta = $custom["pm_schedule_end_time_meta"][0];
		
		echo $pm_schedule_start_time_meta . ' - ' .$pm_schedule_end_time_meta;
	break;
	case "pm_col_sch_location":
		// - show times -
		$pm_schedule_location_meta = $custom["pm_schedule_location_meta"][0];
		
		echo $pm_schedule_location_meta;
	break;
	case "pm_col_sch_thumb":
		// - show thumb -
		$post_image_id = get_post_thumbnail_id(get_the_ID());
		if ($post_image_id) {
			$thumbnail = wp_get_attachment_image_src( $post_image_id, 'post-thumbnail', false);
			if ($thumbnail) (string)$thumbnail = $thumbnail[0];
			
			echo '<img src="'.$thumbnail.'" alt="thumbnail" width="45%" height="45%" />';

		}
	break;
	 
	}
}

//Admin columns end



/* When the post is saved, saves our custom data */
function save_postdata( $post_id ) {
	
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
 
    // verify this came from our screen and with proper authorization,
    // because save_post can be triggered at other times
 	
	if(isset($_POST['post_meta_nonce'])){
		
		if ( !wp_verify_nonce( $_POST['post_meta_nonce'], 'theme_metabox' ) )
		    return;
	 
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
			
		//Check for post values
		if(isset($_POST['post-header-image'])){
			$postHeaderImage = $_POST['post-header-image'];
			update_post_meta($post_id, "pm_header_image_meta", $postHeaderImage);
		}
		if(isset($_POST['pm_featured_post_image_meta'])){
			$pmFeaturedPostImageMeta = $_POST['pm_featured_post_image_meta'];
			update_post_meta($post_id, "pm_featured_post_image_meta", $pmFeaturedPostImageMeta);
		}		
		if(isset($_POST['post-header-message'])){
			$postHeaderImage = $_POST['post-header-message'];
			update_post_meta($post_id, "pm_header_message_meta", $postHeaderImage);
		}
	 
	 	if(isset($_POST['pm_post_layout_meta'])){
			$pmPostLayoutMeta = $_POST['pm_post_layout_meta'];
			update_post_meta($post_id, "pm_post_layout_meta", $pmPostLayoutMeta);
		}
		
		if(isset($_POST['pm_post_featured_meta'])){
			$pmPostFeaturedMeta = $_POST['pm_post_featured_meta'];
			update_post_meta($post_id, "pm_post_featured_meta", $pmPostFeaturedMeta);
		}
		
		if(isset($_POST['pm_post_visibility'])){
			$pmPostVisibility = $_POST['pm_post_visibility'];
			update_post_meta($post_id, "pm_post_visibility", $pmPostVisibility);
		}
				
		//Check for page values
		if(isset($_POST['pm_header_image_meta'])){
			$pmPageHeaderImageMeta = $_POST['pm_header_image_meta'];
			update_post_meta($post_id, "pm_header_image_meta", $pmPageHeaderImageMeta);
		}
		
		if(isset($_POST['pm_page_layout_meta'])){
			$pmPageLayoutMeta = $_POST['pm_page_layout_meta'];
			update_post_meta($post_id, "pm_page_layout_meta", $pmPageLayoutMeta);
		}
		
		if(isset($_POST['pm_page_disable_container_meta'])){
			$pmPageDisableContainerMeta = $_POST['pm_page_disable_container_meta'];
			update_post_meta($post_id, "pm_page_disable_container_meta", $pmPageDisableContainerMeta);
		}
		
		if(isset($_POST['pm_bootstrap_container_padding_meta'])){
			update_post_meta($post_id, "pm_bootstrap_container_padding_meta", $_POST['pm_bootstrap_container_padding_meta']);
		}
		
		if(isset($_POST['pm_page_print_share_meta'])){
			$pmPagePrintShareMeta = $_POST['pm_page_print_share_meta'];
			update_post_meta($post_id, "pm_page_print_share_meta", $pmPagePrintShareMeta);
		}
		
		if(isset($_POST['pm_display_header_meta'])){
			$pmDisplayHeaderMeta = $_POST['pm_display_header_meta'];
			update_post_meta($post_id, "pm_display_header_meta", $pmDisplayHeaderMeta);
		}
				
		//Check for staff values
		if(isset($_POST['post-header-image'])){
			update_post_meta($post_id, "pm_header_image_meta", $_POST['post-header-image']);
		}
		
		if(isset($_POST['pm_staff_image_meta'])){
			$pmStaffImageMeta = $_POST['pm_staff_image_meta'];
			update_post_meta($post_id, "pm_staff_image_meta", $pmStaffImageMeta);
		}
		
		if(isset($_POST['pm_staff_title_meta'])){
			$pmStaffTitleMeta = $_POST['pm_staff_title_meta'];
			update_post_meta($post_id, "pm_staff_title_meta", $pmStaffTitleMeta);
		}
		
		if(isset($_POST['pm_staff_quote_meta'])){
			$pmStaffQuoteMeta = $_POST['pm_staff_quote_meta'];
			update_post_meta($post_id, "pm_staff_quote_meta", $pmStaffQuoteMeta);
		}
		
		if(isset($_POST['pm_staff_twitter_meta'])){
			$pmStaffTwitterMeta = $_POST['pm_staff_twitter_meta'];
			update_post_meta($post_id, "pm_staff_twitter_meta", $pmStaffTwitterMeta);
		}
		
		if(isset($_POST['pm_staff_facebook_meta'])){
			$pmStaffFacebookMeta = $_POST['pm_staff_facebook_meta'];
			update_post_meta($post_id, "pm_staff_facebook_meta", $pmStaffFacebookMeta);
		}
		
		if(isset($_POST['pm_staff_gplus_meta'])){
			$pmStaffGoogleMeta = $_POST['pm_staff_gplus_meta'];
			update_post_meta($post_id, "pm_staff_gplus_meta", $pmStaffGoogleMeta);
		}
		
		if(isset($_POST['pm_staff_linkedin_meta'])){
			$pmStaffLinkedinMeta = $_POST['pm_staff_linkedin_meta'];
			update_post_meta($post_id, "pm_staff_linkedin_meta", $pmStaffLinkedinMeta);
		}
		
		if(isset($_POST['pm_staff_instagram_meta'])){
			update_post_meta($post_id, "pm_staff_instagram_meta", $_POST['pm_staff_instagram_meta']);
		}
		
		
		
		if(isset($_POST['pm_staff_email_address_meta'])){
			$pmStaffEmailAddressMeta = $_POST['pm_staff_email_address_meta'];
			update_post_meta($post_id, "pm_staff_email_address_meta", $pmStaffEmailAddressMeta);
		}
		
		//Check for Woocommerce values
		if(isset($_POST['pm_woocom_header_image_meta'])){
			$pmWoocomHeaderImageMeta = $_POST['pm_woocom_header_image_meta'];
			update_post_meta($post_id, "pm_woocom_header_image_meta", $pmWoocomHeaderImageMeta);
		}

		if(isset($_POST['pm_woocom_header_message_meta'])){
			$pmWoocomHeaderMessageMeta = $_POST['pm_woocom_header_message_meta'];
			update_post_meta($post_id, "pm_woocom_header_message_meta", $pmWoocomHeaderMessageMeta);
		}

		
		//Gallery values
		if(isset($_POST['pm_gallery_header_image_meta'])){
			$pmGalleryHeaderImageMeta = $_POST['pm_gallery_header_image_meta'];
			update_post_meta($post_id, "pm_gallery_header_image_meta", $pmGalleryHeaderImageMeta);
		}
		
		if(isset($_POST['pm_gallery_image_meta'])){
			$pmGalleryImageMeta = $_POST['pm_gallery_image_meta'];
			update_post_meta($post_id, "pm_gallery_image_meta", $pmGalleryImageMeta);
		}
		
		if(isset($_POST['pm_gallery_item_caption_meta'])){
			$pmGalleryItemCaptionMeta = $_POST['pm_gallery_item_caption_meta'];
			update_post_meta($post_id, "pm_gallery_item_caption_meta", $pmGalleryItemCaptionMeta);
		}
		
		if(isset($_POST['pm_gallery_video_meta'])){
			$pmGalleryVideoMeta = $_POST['pm_gallery_video_meta'];
			update_post_meta($post_id, "pm_gallery_video_meta", $pmGalleryVideoMeta);
		}
		
		if(isset($_POST['pm_gallery_display_video_meta'])){
			$pmGalleryDisplayVideoMeta = $_POST['pm_gallery_display_video_meta'];
			update_post_meta($post_id, "pm_gallery_display_video_meta", $pmGalleryDisplayVideoMeta);
		}
		
		
		if(isset($_POST['custom_sidebar'])){
			update_post_meta($post_id, "custom_sidebar", $_POST['custom_sidebar']);
		}
		
		
		if(isset($_POST['pm_video_display_youtube_thumbnail_meta'])){
			update_post_meta($post_id, "pm_video_display_youtube_thumbnail_meta", $_POST['pm_video_display_youtube_thumbnail_meta']);
		}
		
		if(isset($_POST['pm_video_thumbnail_image_meta'])){
			update_post_meta($post_id, "pm_video_thumbnail_image_meta", $_POST['pm_video_thumbnail_image_meta']);
		}
		
		if(isset($_POST['pm_video_youtube_id_meta'])){
			update_post_meta($post_id, "pm_video_youtube_id_meta", $_POST['pm_video_youtube_id_meta']);
		}
		
		if(isset($_POST['pm_disable_share_feature'])){
			update_post_meta($post_id, "pm_disable_share_feature", $_POST['pm_disable_share_feature']);
		}	
		
			
			
	} else {
		return;
	}	
    
}



?>