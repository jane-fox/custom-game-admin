<?php


add_action( 'init', 'create_post_types' );

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
	); // item post_type


}




add_action('manage_posts_custom_column', 'custom_post_columns', 10, 2);

// SHOW THE FEATURED IMAGE
function custom_post_columns($column_name, $post_ID) {
    if ($column_name == 'url') {
            echo $post_ID;
    }
}


remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


add_action('user_register', 'set_default_admin_color');

function set_default_admin_color($user_id) {

    $args = array(
        'ID' => $user_id,
        'admin_color' => 'coffee'
    );

    wp_update_user( $args );

}




/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
//add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
	?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
	<?php }
	//add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function twentyseventeen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_uri() );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'twentyseventeen-style' ), '1.0' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'twentyseventeen-style' ), '1.0' );
		wp_style_add_data( 'twentyseventeen-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentyseventeen-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'twentyseventeen-style' ), '1.0' );
	wp_style_add_data( 'twentyseventeen-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentyseventeen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$twentyseventeen_l10n = array(
		'quote'          => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
		);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'twentyseventeen-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array(), '1.0', true );
		$twentyseventeen_l10n['expand']         = __( 'Expand child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['collapse']       = __( 'Collapse child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['icon']           = twentyseventeen_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}

	wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
//add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );



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
