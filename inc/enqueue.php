<?php
/**
 * partoo enqueue scripts
 *
 * @package partoo
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('partoo_scripts')) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function partoo_scripts()
	{
		// Get the theme data.
		$the_theme = wp_get_theme();
		$theme_version = $the_theme->get('Version');

		$css_version = $theme_version . '.' . filemtime(get_template_directory() . '/dist/css/main.min.css');
		wp_enqueue_style('partoo-styles', get_template_directory_uri() . '/dist/css/main.min.css', array(), $css_version);

//		wp_enqueue_script( 'jquery' );

		$js_version = $theme_version . '.' . filemtime(get_template_directory() . '/dist/js/bundle.min.js');
		wp_enqueue_script('jq', 'https://static.wemesh.cn/lib/js/jquery.min.js', array(), $js_version, true);
		wp_enqueue_script('bs4', 'https://static.wemesh.cn/lib/js/bootstrap.min.js', array(), $js_version, true);
		wp_enqueue_script('partoo-scripts', get_template_directory_uri() . '/dist/js/bundle.min.js', array(), $js_version, true);
		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
} // endif function_exists( 'partoo_scripts' ).

add_action('wp_enqueue_scripts', 'partoo_scripts');
