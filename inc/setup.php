<?php
/**
 * Theme basic setup.
 *
 * @packagepartoo
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// Set the content width based on the theme's design and stylesheet.
//if (!isset($content_width)) {
//	$content_width = 640; /* pixels */
//}

add_action('after_setup_theme', 'partoo_setup');

if (!function_exists('partoo_setup')) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function partoo_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on partoo, use a find and replace
		 * to change 'partoo' to the name of your theme in all the template files
		 */
		load_theme_textdomain('partoo', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
//		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'primary' => __('Primary Menu', 'partoo'),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support('post-thumbnails');

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support('customize-selective-refresh-widgets');

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support('post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		));

		// Set up the WordPress core custom background feature.
//		add_theme_support('custom-background', apply_filters('partoo_custom_background_args', array(
//			'default-color' => 'ffffff',
//			'default-image' => '',
//		)));

		// Set up the WordPress Theme logo feature.
		add_theme_support('custom-logo');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Check and setup theme default settings.
		partoo_setup_theme_default_settings();

	}
}


add_filter('excerpt_more', 'partoo_custom_excerpt_more');

if (!function_exists('partoo_custom_excerpt_more')) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function partoo_custom_excerpt_more($more)
	{
		if (!is_admin()) {
			$more = '';
		}
		return $more;
	}
}

add_filter('wp_trim_excerpt', 'partoo_all_excerpts_get_more_link');

if (!function_exists('partoo_all_excerpts_get_more_link')) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function partoo_all_excerpts_get_more_link($post_excerpt)
	{
		if (!is_admin()) {
			$post_excerpt = $post_excerpt . ' ... <p class="mb-0"><a class="btn btn-primary view-article text-white" href="' . esc_url(get_permalink(get_the_ID())) . '">' . '阅读详情' . '</a></p>';
		}
		return $post_excerpt;
	}
}

function wpdocs_custom_excerpt_length($length)
{
	return 100;
}

add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);


//Limit number of tags inside widget
function tag_widget_limit($args)
{
	if (isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag') {
		$args['number'] = 10; //Limit number of tags
	}
	return $args;
}

add_filter('widget_tag_cloud_args', 'tag_widget_limit');
/**
 * Change the Tag Cloud's Font Sizes.
 *
 * @param array $args
 *
 * @return array
 * @since 1.0.0
 *
 */
function change_tag_cloud_font_sizes(array $args)
{
	$args['smallest'] = '12';
	$args['largest'] = '12';

	return $args;
}

add_filter('widget_tag_cloud_args', 'change_tag_cloud_font_sizes');

add_filter('the_posts', function ($posts, \WP_Query $query) {
	if ($pick = $query->get('shuffle_and_pick')) {
		shuffle($posts);
		$posts = array_slice($posts, 0, (int)$pick);
	}
	return $posts;
}, 10, 2);

