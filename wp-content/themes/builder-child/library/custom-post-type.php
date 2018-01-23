<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

add_action( 'init', 'collection_category_taxonomy');
function collection_category_taxonomy() {
  register_taxonomy(
  'collection_categories',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
  'collections',   		 //post type name
  array(
    'hierarchical' 		=> true,
    'show_admin_column' => true,
    'label' 			=> 'Collection Categories',  //Display name
    'query_var' 		=> true,
    'rewrite'			=> array(
      'slug' 			=> '/collections', // This controls the base slug that will display before each term
      'with_front' 	=> false // Don't display the category base before
      )
    )
  );
}


// let's create the function for the custom type
add_action( 'init', 'register_collection_post', 20 );
function register_collection_post() {
    $labels = array(
  		'name'               => _x( 'Collections', 'post type general name' ),
  		'singular_name'      => _x( 'Collection', 'post type singular name' ),
  		'add_new'            => _x( 'Add New', 'Collection' ),
  		'add_new_item'       => __( 'Add New Collection' ),
  		'edit_item'          => __( 'Edit Collection' ),
  		'new_item'           => __( 'New Collection' ),
  		'all_items'          => __( 'All Collections' ),
  		'view_item'          => __( 'View Collections' ),
  		'search_items'       => __( 'Search Collections' ),
  		'show_in_nav_menus'  => true,
  		'not_found'          => __( 'No Collections found' ),
  		'not_found_in_trash' => __( 'No Collections found in the Trash' ), 
  		'parent_item_colon'  => '',
  		'menu_name'          => 'Collections'
  		);

    $args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'description' => 'Custom Collections',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
		'taxonomies' => array('collection_categories'),
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'query_var' => true,
		'can_export' => true,
		'public' => true,
		'rewrite'	=> array(
		'slug'    => '/collection',
		'with_front' 	=> false // Don't display the category base before
		)
	);
	register_post_type( 'collections', $args );
}

    
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */
	

?>
