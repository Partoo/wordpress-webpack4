<?php
/**
 * partoo functions and definitions
 *
 * @package partoo
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
//@ini_set('upload_max_size', '64M');
//@ini_set('post_max_size', '64M');
//@ini_set('max_execution_time', '300');
register_nav_menus(array( // Using array to specify more menus if needed
	'secondary' => '页脚菜单', // Footer Navigation
));

$includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/sidebar.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
//	'/hooks.php',                           // Custom hooks.
//	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
//	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
//	'/woocommerce.php',                     // Load WooCommerce functions.
//	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
	'/breadcrumb.php',

);


foreach ($includes as $file) {
	$filepath = locate_template('inc' . $file);
	if (!$filepath) {
		trigger_error(sprintf('Error locating /inc%s for inclusion', $file), E_USER_ERROR);
	}
	require_once $filepath;
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function wemesh_pagination()
{
	global $wp_query;
	$big = 999999;
	$links = paginate_links(array(
		'base' => str_replace($big, '%#%', get_pagenum_link($big)),
		'format' => 'paged/%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages,
		'type' => 'array',
		'show_all' => false,
		'end_size' => 3,
		'mid_size' => 1,
		'prev_next' => true,
		'prev_text' => '上页',
		'next_text' => '下页',
		'add_args' => false,
		'add_fragment' => '',
	));
	if ($links) {
		$pagination = '<nav class="mb-5"><ul class="pagination justify-content-center">';
		foreach ($links as $page) {
			$pagination .= '<li class="page-item ' . (strpos($page, 'current') !== false ? 'active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
		}
		$pagination .= '</ul></nav>';
		echo $pagination;
	}
	return null;
}


// include widgets
include_once get_stylesheet_directory() . '/inc/widgets/hero.php';
include_once get_stylesheet_directory() . '/inc/widgets/ad.php';
include_once get_stylesheet_directory() . '/inc/widgets/gallery.php';
include_once get_stylesheet_directory() . '/inc/widgets/slider.php';
include_once get_stylesheet_directory() . '/inc/widgets/video.php';
include_once get_stylesheet_directory() . '/inc/widgets/news.php';

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'wp_resource_hints', 2);
// Disable REST API link tag
remove_action('wp_head', 'rest_output_link_wp_head', 10);
// Disable oEmbed Discovery Links
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
// Disable REST API link in HTTP headers
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
add_filter('show_admin_bar', function () {
	return false;
});

//Remove JQuery migrate
function remove_jquery_migrate($scripts)
{
	if (!is_admin() && isset($scripts->registered['jquery'])) {
		$script = $scripts->registered['jquery'];

		if ($script->deps) { // Check whether the script has any dependencies
			$script->deps = array_diff($script->deps, array('jquery-migrate'));
		}
	}
}

add_action('wp_default_scripts', 'remove_jquery_migrate');
