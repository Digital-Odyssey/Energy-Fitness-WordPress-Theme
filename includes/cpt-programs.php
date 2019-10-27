<?php
function cpt_programs(){

	register_post_type('post_programs',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Programs', 'energytheme' ),
				'singular_name' => esc_attr__( 'Programs', 'energytheme' ),
				'add_new' => esc_attr__( 'Add New Program', 'energytheme' ),
				'add_new_item' => esc_attr__( 'Add New Program', 'energytheme' ),
				'edit' => esc_attr__( 'Edit', 'energytheme' ),
				'edit_item' => esc_attr__( 'Edit Program', 'energytheme' ),
				'new_item' => esc_attr__( 'New Program', 'energytheme' ),
				'view' => esc_attr__( 'View', 'energytheme' ),
				'view_item' => esc_attr__( 'View Program', 'energytheme' ),
				'search_items' => esc_attr__( 'Search Programs', 'energytheme' ),
				'not_found' => esc_attr__( 'No Programs found', 'energytheme' ),
				'not_found_in_trash' => esc_attr__( 'No Programs found in Trash', 'energytheme' ),
				'parent' => esc_attr__( 'Parent Program', 'energytheme' )
			),
			'description' => esc_attr__( 'Easily lets you add new programs', 'energytheme' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => 'program'),
			'supports' => array('title', 'editor', 'author', 'excerpt', 'thumbnail'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

/*function programs_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Program Categories', 'energytheme' ),
		'singular_name' => esc_attr__( 'Program Categories', 'energytheme' ),
		'search_items' =>  esc_attr__( 'Search Program Categories', 'energytheme' ),
		'popular_items' => esc_attr__( 'Popular Program Categories', 'energytheme' ),
		'all_items' => esc_attr__( 'All Program Categories', 'energytheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Program Category', 'energytheme' ),
		'update_item' => esc_attr__( 'Update Program Category', 'energytheme' ),
		'add_new_item' => esc_attr__( 'Add Program Category', 'energytheme' ),
		'new_item_name' => esc_attr__( 'New Program Category', 'energytheme' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Program Categories with commas', 'energytheme' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Program Categories', 'energytheme' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Program Categories', 'energytheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'program_categories', 'post_programs', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'program-category' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

function program_tags() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Program Tags', 'energytheme' ),
		'singular_name' => esc_attr__( 'Program Tags', 'energytheme' ),
		'search_items' =>  esc_attr__( 'Search Program Tags', 'energytheme' ),
		'popular_items' => esc_attr__( 'Popular Program Tags', 'energytheme' ),
		'all_items' => esc_attr__( 'All Program Tags', 'energytheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Program Tag', 'energytheme' ),
		'update_item' => esc_attr__( 'Update Program Tag', 'energytheme' ),
		'add_new_item' => esc_attr__( 'Add Program Tag', 'energytheme' ),
		'new_item_name' => esc_attr__( 'New Program Tag', 'energytheme' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Program Tags with commas', 'energytheme' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Program Tags', 'energytheme' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Program Tags', 'energytheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'programtags', 'post_programs', array(
		'hierarchical' => false, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'program-tag' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}*/

add_action('init', 'cpt_programs');
//add_action('init', 'program_categories');
//add_action('init', 'program_tags');