<?php
/**
 * Viable Lite theme functions.
 *
 * Functions file for child theme, enqueues parent and child stylesheets by default.
 *
 * @since	1.0.0
 * @package Viable Lite
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'viable_lite_enqueue_styles' ) ) {
	/**
	 * Enqueue Styles.
	 *
	 * Enqueue parent style and child styles where parent are the dependency
	 * for child styles so that parent styles always get enqueued first.
	 *
	 * @since 1.0.0
	 */
	function viable_lite_enqueue_styles() {

		// Enqueue Parent theme's stylesheet.
		wp_enqueue_style( 'viable-lite-parent-style', get_template_directory_uri() . '/style.css' );

		wp_enqueue_style( 'viable-lite-parent-main', get_template_directory_uri() . '/assets/dist/css/main.css' );

		
		
	}
}

// Add enqueue function to the desired action.
add_action( 'wp_enqueue_scripts', 'viable_lite_enqueue_styles', 20 );