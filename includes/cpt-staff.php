<?php
function cpt_staff(){

	register_post_type('post_staff',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Staff Members', 'energytheme' ),
				'singular_name' => esc_attr__( 'Staff', 'energytheme' ),
				'add_new' => esc_attr__( 'Add New Staff profile', 'energytheme' ),
				'add_new_item' => esc_attr__( 'Add New Staff profile', 'energytheme' ),
				'edit' => esc_attr__( 'Edit', 'energytheme' ),
				'edit_item' => esc_attr__( 'Edit Staff profile', 'energytheme' ),
				'new_item' => esc_attr__( 'New Staff profile', 'energytheme' ),
				'view' => esc_attr__( 'View', 'energytheme' ),
				'view_item' => esc_attr__( 'View Staff profile', 'energytheme' ),
				'search_items' => esc_attr__( 'Search Staff profiles', 'energytheme' ),
				'not_found' => esc_attr__( 'No Staff profiles found', 'energytheme' ),
				'not_found_in_trash' => esc_attr__( 'No Staff profiles found in Trash', 'energytheme' ),
				'parent' => esc_attr__( 'Parent Staff', 'energytheme' )
			),
			'description' => esc_attr__( 'Easily lets you add new staff profiles', 'energytheme' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => 'staff-member'),
			'supports' => array('title', 'editor', 'author', 'excerpt'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

function staff_titles() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Staff Titles', 'energytheme' ),
		'singular_name' => esc_attr__( 'Staff Titles', 'energytheme' ),
		'search_items' =>  esc_attr__( 'Search Staff Titles', 'energytheme' ),
		'popular_items' => esc_attr__( 'Popular Staff Titles', 'energytheme' ),
		'all_items' => esc_attr__( 'All Staff Titles', 'energytheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Staff Title', 'energytheme' ),
		'update_item' => esc_attr__( 'Update Staff Title', 'energytheme' ),
		'add_new_item' => esc_attr__( 'Add Staff Title', 'energytheme' ),
		'new_item_name' => esc_attr__( 'New Staff Title', 'energytheme' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Staff Titles with commas', 'energytheme' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Staff Title', 'energytheme' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Staff Titles', 'energytheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'staff_titles', 'post_staff', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'staff-title' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_staff');
add_action('init', 'staff_titles');