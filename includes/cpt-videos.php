<?php
function cpt_video(){

	register_post_type('post_videos',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Videos', 'energytheme' ),
				'singular_name' => esc_attr__( 'Videos', 'energytheme' ),
				'add_new' => esc_attr__( 'Add New Video item', 'energytheme' ),
				'add_new_item' => esc_attr__( 'Add New Video item', 'energytheme' ),
				'edit' => esc_attr__( 'Edit', 'energytheme' ),
				'edit_item' => esc_attr__( 'Edit Video item', 'energytheme' ),
				'new_item' => esc_attr__( 'New Video item', 'energytheme' ),
				'view' => esc_attr__( 'View', 'energytheme' ),
				'view_item' => esc_attr__( 'View Video item', 'energytheme' ),
				'search_items' => esc_attr__( 'Search Video items', 'energytheme' ),
				'not_found' => esc_attr__( 'No Video items found', 'energytheme' ),
				'not_found_in_trash' => esc_attr__( 'No Video items found in Trash', 'energytheme' ),
				'parent' => esc_attr__( 'Parent Staff', 'energytheme' )
			),
			'description' => esc_attr__( 'Easily lets you add new video posts', 'energytheme' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => 'video-post'),
			'supports' => array('title', 'editor', 'author', 'excerpt'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

function video_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Video Categories', 'energytheme' ),
		'singular_name' => esc_attr__( 'Video Categories', 'energytheme' ),
		'search_items' =>  esc_attr__( 'Search Video Categories', 'energytheme' ),
		'popular_items' => esc_attr__( 'Popular Video Categories', 'energytheme' ),
		'all_items' => esc_attr__( 'All Video Categories', 'energytheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Video Category', 'energytheme' ),
		'update_item' => esc_attr__( 'Update Video Category', 'energytheme' ),
		'add_new_item' => esc_attr__( 'Add Video Category', 'energytheme' ),
		'new_item_name' => esc_attr__( 'New Video Category Name', 'energytheme' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Video Categories with commas', 'energytheme' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Video Categories', 'energytheme' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Video Categories', 'energytheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'videocats', 'post_videos', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'video-category' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

function video_tags() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Video Tags', 'energytheme' ),
		'singular_name' => esc_attr__( 'Video Tags', 'energytheme' ),
		'search_items' =>  esc_attr__( 'Search Video Tags', 'energytheme' ),
		'popular_items' => esc_attr__( 'Popular Video Tags', 'energytheme' ),
		'all_items' => esc_attr__( 'All Video Tags', 'energytheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Video Category', 'energytheme' ),
		'update_item' => esc_attr__( 'Update Video Category', 'energytheme' ),
		'add_new_item' => esc_attr__( 'Add Video Category', 'energytheme' ),
		'new_item_name' => esc_attr__( 'New Video Category Name', 'energytheme' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Video Tags with commas', 'energytheme' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Video Tags', 'energytheme' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Video Tags', 'energytheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'videotags', 'post_videos', array(
		'hierarchical' => false, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'video-tag' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_video');
add_action('init', 'video_categories');
//add_action('init', 'video_tags');