<?php
function cpt_classes(){

	register_post_type('post_classes',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Classes', 'energytheme' ),
				'singular_name' => esc_attr__( 'Classes', 'energytheme' ),
				'add_new' => esc_attr__( 'Add New Class', 'energytheme' ),
				'add_new_item' => esc_attr__( 'Add New Class', 'energytheme' ),
				'edit' => esc_attr__( 'Edit', 'energytheme' ),
				'edit_item' => esc_attr__( 'Edit Class', 'energytheme' ),
				'new_item' => esc_attr__( 'New Class', 'energytheme' ),
				'view' => esc_attr__( 'View', 'energytheme' ),
				'view_item' => esc_attr__( 'View Class', 'energytheme' ),
				'search_items' => esc_attr__( 'Search Classes', 'energytheme' ),
				'not_found' => esc_attr__( 'No Classes found', 'energytheme' ),
				'not_found_in_trash' => esc_attr__( 'No Classes found in Trash', 'energytheme' ),
				'parent' => esc_attr__( 'Parent Class', 'energytheme' )
			),
			'description' => esc_attr__( 'Easily lets you add new classes', 'energytheme' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => 'class'),
			'supports' => array('title', 'editor', 'author', 'excerpt', 'thumbnail'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

/*function classes_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Class Categories', 'energytheme' ),
		'singular_name' => esc_attr__( 'Class Categories', 'energytheme' ),
		'search_items' =>  esc_attr__( 'Search Class Categories', 'energytheme' ),
		'popular_items' => esc_attr__( 'Popular Class Categories', 'energytheme' ),
		'all_items' => esc_attr__( 'All Class Categories', 'energytheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Class Category', 'energytheme' ),
		'update_item' => esc_attr__( 'Update Class Category', 'energytheme' ),
		'add_new_item' => esc_attr__( 'Add Class Category', 'energytheme' ),
		'new_item_name' => esc_attr__( 'New Class Category', 'energytheme' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Class Categories with commas', 'energytheme' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Class Categories', 'energytheme' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Class Categories', 'energytheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'class_categories', 'post_classes', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'class-category' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

function class_tags() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Class Tags', 'energytheme' ),
		'singular_name' => esc_attr__( 'Class Tags', 'energytheme' ),
		'search_items' =>  esc_attr__( 'Search Class Tags', 'energytheme' ),
		'popular_items' => esc_attr__( 'Popular Class Tags', 'energytheme' ),
		'all_items' => esc_attr__( 'All Class Tags', 'energytheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Class Tag', 'energytheme' ),
		'update_item' => esc_attr__( 'Update Class Tag', 'energytheme' ),
		'add_new_item' => esc_attr__( 'Add Class Tag', 'energytheme' ),
		'new_item_name' => esc_attr__( 'New Class Tag', 'energytheme' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Class Tags with commas', 'energytheme' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Class Tags', 'energytheme' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Class Tags', 'energytheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'classtags', 'post_classes', array(
		'hierarchical' => false, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'class-tag' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}*/

add_action('init', 'cpt_classes');
//add_action('init', 'class_categories');
//add_action('init', 'class_tags');