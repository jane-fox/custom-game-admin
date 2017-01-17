<?php


add_action( 'init', 'create_post_types' );

function create_post_types() {

	register_post_type( 'scene',
		array(
			'menu_icon' => 'dashicons-format-video',
			'labels' => array(
				'name' => __( 'Scenes' ),
				'singular_name' => __( 'Scene' )
				),
			'public' => true,
			'has_archive' => true,
			)
		);

	register_post_type( 'place',
		array(
			'menu_icon' => 'dashicons-admin-site',
			'labels' => array(
				'name' => __( 'Places' ),
				'singular_name' => __( 'Place' )
				),
			'public' => true,
			'has_archive' => true,
			)
		);

	register_post_type( 'character',
		array(
			'menu_icon' => 'dashicons-universal-access',
			'labels' => array(
				'name' => __( 'Characters' ),
				'singular_name' => __( 'Character' )
				),
			'public' => true,
			'has_archive' => true,
			)
		);

	register_post_type( 'item',
		array(
			'menu_icon' => 'dashicons-carrot',
			'labels' => array(
				'name' => __( 'Items' ),
				'singular_name' => __( 'Item' ),
				'all_items' => __('Item functionality currently does not exist. But you can still pre-empitively create some if youd like.')
				),
			'public' => true,
			'has_archive' => true,
			//'show_ui' =>
			)
		);

}





add_action('user_register', 'set_default_admin_color');

function set_default_admin_color($user_id) {

    $args = array(
        'ID' => $user_id,
        'admin_color' => 'coffee'
    );

    wp_update_user( $args );

}



