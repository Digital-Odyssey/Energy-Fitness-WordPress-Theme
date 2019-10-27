<?php
function cpt_gallery(){

	register_post_type('post_galleries',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Gallery', 'energytheme' ),
				'singular_name' => esc_attr__( 'Gallery', 'energytheme' ),
				'add_new' => esc_attr__( 'Add New Gallery item', 'energytheme' ),
				'add_new_item' => esc_attr__( 'Add New Gallery item', 'energytheme' ),
				'edit' => esc_attr__( 'Edit', 'energytheme' ),
				'edit_item' => esc_attr__( 'Edit Gallery item', 'energytheme' ),
				'new_item' => esc_attr__( 'New Gallery item', 'energytheme' ),
				'view' => esc_attr__( 'View', 'energytheme' ),
				'view_item' => esc_attr__( 'View Gallery item', 'energytheme' ),
				'search_items' => esc_attr__( 'Search Gallery items', 'energytheme' ),
				'not_found' => esc_attr__( 'No Gallery items found', 'energytheme' ),
				'not_found_in_trash' => esc_attr__( 'No Gallery items found in Trash', 'energytheme' ),
				'parent' => esc_attr__( 'Parent Staff', 'energytheme' )
			),
			'description' => esc_attr__( 'Easily lets you add new gallery posts', 'energytheme' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => 'gallery'),
			'supports' => array('title', 'editor', 'author', 'excerpt'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

function gallery_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Gallery Categories', 'energytheme' ),
		'singular_name' => esc_attr__( 'Gallery Categories', 'energytheme' ),
		'search_items' =>  esc_attr__( 'Search Gallery Categories', 'energytheme' ),
		'popular_items' => esc_attr__( 'Popular Gallery Categories', 'energytheme' ),
		'all_items' => esc_attr__( 'All Gallery Categories', 'energytheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Gallery Category', 'energytheme' ),
		'update_item' => esc_attr__( 'Update Gallery Category', 'energytheme' ),
		'add_new_item' => esc_attr__( 'Add Gallery Category', 'energytheme' ),
		'new_item_name' => esc_attr__( 'New Gallery Category Name', 'energytheme' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Gallery Categories with commas', 'energytheme' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Gallery Categories', 'energytheme' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Gallery Categories', 'energytheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'gallerycats', 'post_galleries', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'gallery-category' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

function gallery_tags() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Gallery Tags', 'energytheme' ),
		'singular_name' => esc_attr__( 'Gallery Tags', 'energytheme' ),
		'search_items' =>  esc_attr__( 'Search Gallery Tags', 'energytheme' ),
		'popular_items' => esc_attr__( 'Popular Gallery Tags', 'energytheme' ),
		'all_items' => esc_attr__( 'All Gallery Tags', 'energytheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Gallery Category', 'energytheme' ),
		'update_item' => esc_attr__( 'Update Gallery Category', 'energytheme' ),
		'add_new_item' => esc_attr__( 'Add Gallery Category', 'energytheme' ),
		'new_item_name' => esc_attr__( 'New Gallery Category Name', 'energytheme' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Gallery Tags with commas', 'energytheme' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Gallery Tags', 'energytheme' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Gallery Tags', 'energytheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'gallerytags', 'post_galleries', array(
		'hierarchical' => false, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'gallery-tag' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_gallery');
add_action('init', 'gallery_categories');
//add_action('init', 'gallery_tags');