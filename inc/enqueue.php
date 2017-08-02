<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

if ( ! function_exists( 'enqueue_stuff' ) ) {

	// Enqueue scripts and styles.
	function enqueue_stuff() {

		// Theme stylesheet.
		wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), CONTENT_VERSION );
		wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), CONTENT_VERSION );
		wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/theme.css', array(), CONTENT_VERSION );

		wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/scripts.min.js', array(), CONTENT_VERSION, true );

	}

}

add_action( 'wp_enqueue_scripts', 'enqueue_stuff' );
