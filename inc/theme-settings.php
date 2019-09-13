<?php
/**
 * Check and setup theme's default settings
 *
 * @packagepartoo
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('partoo_setup_theme_default_settings')) {
	function partoo_setup_theme_default_settings()
	{

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$partoo_posts_index_style = get_theme_mod('partoo_posts_index_style');
		if ('' == $partoo_posts_index_style) {
			set_theme_mod('partoo_posts_index_style', 'default');
		}

		// Sidebar position.
		$partoo_sidebar_position = get_theme_mod('partoo_sidebar_position');
		if ('' == $partoo_sidebar_position) {
			set_theme_mod('partoo_sidebar_position', 'right');
		}

		// Container width.
		$partoo_container_type = get_theme_mod('partoo_container_type');
		if ('' == $partoo_container_type) {
			set_theme_mod('partoo_container_type', 'container');
		}
	}
}
