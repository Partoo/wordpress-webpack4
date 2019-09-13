<?php
/**
 * Custom hooks.
 *
 * @package partoo
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'partoo_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function partoo_site_info() {
		do_action( 'partoo_site_info' );
	}
}

if ( ! function_exists( 'partoo_add_site_info' ) ) {
	add_action( 'partoo_site_info', 'partoo_add_site_info' );

	/**
	 * Add site info content.
	 */
	function partoo_add_site_info() {
		$the_theme = wp_get_theme();

		$site_info = sprintf(
			'<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s(%4$s)',
			esc_url( __( 'http://wordpress.org/', 'partoo' ) ),
			sprintf(
				/* translators:*/
				esc_html__( 'Proudly powered by %s', 'partoo' ),
				'WordPress'
			),
			sprintf( // WPCS: XSS ok.
				/* translators:*/
				esc_html__( 'Theme: %1$s by %2$s.', 'partoo' ),
				$the_theme->get( 'Name' ),
				'<a href="' . esc_url( __( 'http://partoo.com', 'partoo' ) ) . '">partoo.com</a>'
			),
			sprintf( // WPCS: XSS ok.
				/* translators:*/
				esc_html__( 'Version: %1$s', 'partoo' ),
				$the_theme->get( 'Version' )
			)
		);

		echo apply_filters( 'partoo_site_info_content', $site_info ); // WPCS: XSS ok.
	}
}
