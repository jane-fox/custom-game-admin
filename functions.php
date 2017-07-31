<?php

include "understrap_functions.php";

define("CONTENT_VERSION", "0.2");

add_action( 'init', 'create_post_types' );
add_action( 'init', 'custom_options' );


// Custom options for the game
function custom_options() {

	// group, option name
	add_option("content_version", CONTENT_VERSION);


}

// Register custom post types for our data
function create_post_types() {

	register_post_type( 'scene',
		array(
			'menu_icon' => 'dashicons-format-video',
			'public' => true,
			'has_archive' => true,
			'supports' => ['page-attributes', 'title', 'editor'],
			'hierarchical' => true,

			'labels' => array(
				'name' => __( 'Scenes' ),
				'singular_name' => __( 'Scene' ),
			    'add_new' => __('Add New Scene'),
			    'add_new_item' => __('Add New Scene'),
			    'edit_item' => __('Edit Scene'),
			    'new_item' => __('New Scene'),
			    'view_item' => __('View Scene'),
			    'search_items' => __('Search Scenes'),
			    'not_found' =>  __('No Scenes found'),
			    'not_found_in_trash' => __('No Scenes found in Trash'),
   				'parent_item_colon' => ''
			), // labels
		)
	); // scene post type


	register_post_type( 'place',
		array(
			'menu_icon' => 'dashicons-admin-site',
			'public' => true,
			'has_archive' => true,
			'supports' => ['page-attributes', 'title', 'editor'],
			'hierarchical' => true,

			'labels' => array(
				'name' => __( 'Places' ),
				'singular_name' => __( 'Place' ),
			    'add_new' => __('Add New Place'),
			    'add_new_item' => __('Add New Place'),
			    'edit_item' => __('Edit Place'),
			    'new_item' => __('New Place'),
			    'view_item' => __('View Place'),
			    'search_items' => __('Search Places'),
			    'not_found' =>  __('No Places found'),
			    'not_found_in_trash' => __('No Places found in Trash'),
   				'parent_item_colon' => ''
			), // labels

		)
	); // place post type


	register_post_type( 'character',
		array(
			'menu_icon' => 'dashicons-universal-access',
			'public' => true,
			'has_archive' => true,

			'labels' => array(
				'name' => __( 'Characters' ),
				'singular_name' => __( 'Character' ),
			    'add_new' => __('Add New Character'),
			    'add_new_item' => __('Add New Character'),
			    'edit_item' => __('Edit Character'),
			    'new_item' => __('New Character'),
			    'view_item' => __('View Character'),
			    'search_items' => __('Search Characters'),
			    'not_found' =>  __('No Characters found'),
			    'not_found_in_trash' => __('No Characters found in Trash'),
   				'parent_item_colon' => ''
			), // labels

		)
	); // character post_type


	register_post_type( 'item',
		array(
			'menu_icon' => 'dashicons-carrot',
			'public' => true,
			'has_archive' => true,

			'labels' => array(
				'name' => __( 'Items' ),
				'singular_name' => __( 'Item' ),
				'all_items' => __('Item functionality currently does not exist. But you can still pre-empitively create some if youd like.')
			),

			//'show_ui' =>
		)
	); // item post_type


	register_post_type( 'map',
		array(
			'menu_icon' => 'dashicons-location-alt',
			'public' => true,
			'has_archive' => true,

			'labels' => array(
				'name' => __( 'Map' ),
				'singular_name' => __( 'Map' ),
				//'all_items' => __('Item functionality currently does not exist. But you can still pre-empitively create some if youd like.')
			),

			//'show_ui' =>
		)
	); // map post_type


	register_post_type( 'conversation',
		array(
			'menu_icon' => 'dashicons-format-chat',
			'public' => true,
			'has_archive' => true,

			'labels' => array(
				'name' => __( 'Conversation' ),
				'singular_name' => __( 'Conversation' ),
				//'all_items' => __('Item functionality currently does not exist. But you can still pre-empitively create some if youd like.')
			),

			//'show_ui' =>
		)
	); // item post_type


}




// TODO: custom data columns
add_action('manage_posts_custom_column', 'custom_post_columns', 10, 2);
function custom_post_columns($column_name, $post_ID) {
    if ($column_name == 'post_name') {
            echo $post_ID;
    }
}


//Remove emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


// Give a default color to new users
add_action('user_register', 'set_default_admin_color');
function set_default_admin_color($user_id) {

    $args = array(
        'ID' => $user_id,
        'admin_color' => 'coffee'
    );

    wp_update_user( $args );

}



// Enqueue scripts and styles.
function enqueue_stuff() {

	// Theme stylesheet.
	wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), CONTENT_VERSION );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), CONTENT_VERSION );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/theme.css', array(), CONTENT_VERSION );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/scripts.min.js', array(), CONTENT_VERSION, true );


}
add_action( 'wp_enqueue_scripts', 'enqueue_stuff' );



/**
 * Implement the Custom Header feature.
 */
//require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
//require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
//require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
//require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
//require get_parent_theme_file_path( '/inc/icon-functions.php' );
