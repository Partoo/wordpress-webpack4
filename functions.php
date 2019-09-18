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

function rnd_img()
{
	$rnd = random_int(1, 5);
	return get_theme_file_uri('/dist/images/random/') . $rnd . '.jpg';
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

// ACF
if (function_exists('acf_add_local_field_group')):

	acf_add_local_field_group(array(
		'key' => 'group_5d6f7b181da80',
		'title' => 'ad',
		'fields' => array(
			array(
				'key' => 'field_5d6f7b20a009f',
				'label' => '广告标题',
				'name' => 'title',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d6f7b41a00a0',
				'label' => '广告副标题',
				'name' => 'subtitle',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d6f7b67a00a1',
				'label' => '广告摘要',
				'name' => 'excerpt',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
			),
			array(
				'key' => 'field_5d6f7bc4a00a2',
				'label' => '背景图片',
				'name' => 'bg-img',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'large',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_5d6f7bf2a00a3',
				'label' => '广告链接',
				'name' => 'link',
				'type' => 'link',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'widget',
					'operator' => '==',
					'value' => 'partoo_ad',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5d72eeb691685',
		'title' => 'Banner',
		'fields' => array(
			array(
				'key' => 'field_5d72ef199ee0e',
				'label' => '指定图片',
				'name' => 'img',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'large',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_5d7b26d48aef1',
				'label' => '水平对齐方式',
				'name' => 'x',
				'type' => 'radio',
				'instructions' => '图片水平方向对齐方式',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'left' => '居左对齐',
					'center' => '居中对齐',
					'right' => '居右对齐',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'center',
				'layout' => 'vertical',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5d7b27728aef2',
				'label' => '垂直对齐方式',
				'name' => 'y',
				'type' => 'radio',
				'instructions' => '图片水平方向垂直方式',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'top' => '居上对齐',
					'center' => '居中对齐',
					'bottom' => '居下对齐',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'center',
				'layout' => 'vertical',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'all',
				),
			),
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5d6c6213508cd',
		'title' => 'carousel',
		'fields' => array(
			array(
				'key' => 'field_5d6c62543002d',
				'label' => 'carousel',
				'name' => 'carousel',
				'type' => 'repeater',
				'instructions' => '主页轮换图展示',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_5d6c62c23002e',
				'min' => 1,
				'max' => 5,
				'layout' => 'row',
				'button_label' => '添加轮换图',
				'hide_collapse' => 0,
				'collapse_all_repeater' => 0,
				'btn-icon-only' => 0,
				'sub_fields' => array(
					array(
						'key' => 'field_5d6c62c23002e',
						'label' => '图片',
						'name' => 'img',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'url',
						'preview_size' => 'large',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
					array(
						'key' => 'field_5d6d11f53805a',
						'label' => '标题',
						'name' => 'title',
						'type' => 'text',
						'instructions' => '标题',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '输入标题',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5d6d12253805b',
						'label' => '二级标题',
						'name' => 'subtitle',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5d6d12403805c',
						'label' => '简介',
						'name' => 'intro',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'new_lines' => '',
					),
					array(
						'key' => 'field_5d6d12583805d',
						'label' => '链接',
						'name' => 'url',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'url',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'widget',
					'operator' => '==',
					'value' => 'partoo_hero',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5d705f3ceab1a',
		'title' => 'gallery',
		'fields' => array(
			array(
				'key' => 'field_5d72104bbfb37',
				'label' => '栏目链接',
				'name' => 'link',
				'type' => 'link',
				'instructions' => '指定该字段，可以通过标题右侧的“更多”链接到指定页面',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
			),
			array(
				'key' => 'field_5d705fbd1245f',
				'label' => '列数',
				'name' => 'cols',
				'type' => 'select',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					1 => '一张一行',
					2 => '两张一行',
					3 => '三张一行',
					4 => '四张一行',
					6 => '六张一行',
				),
				'default_value' => array(
					0 => 4,
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'return_format' => 'value',
				'ajax' => 0,
				'placeholder' => '',
			),
			array(
				'key' => 'field_5d720ac9b01a6',
				'label' => '行数',
				'name' => 'rows',
				'type' => 'range',
				'instructions' => '指定行数，超过此行数的图片将不予显示',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 3,
				'min' => 1,
				'max' => 9,
				'step' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5d705fd712460',
				'label' => '图片',
				'name' => 'images',
				'type' => 'gallery',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'insert' => 'append',
				'library' => 'all',
				'min' => '',
				'max' => '',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'widget',
					'operator' => '==',
					'value' => 'partoo_gallery',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'permalink',
			1 => 'the_content',
			2 => 'excerpt',
			3 => 'discussion',
			4 => 'comments',
			5 => 'revisions',
			6 => 'slug',
			7 => 'author',
			8 => 'format',
			9 => 'page_attributes',
			10 => 'featured_image',
			11 => 'categories',
			12 => 'tags',
			13 => 'send-trackbacks',
		),
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5d78933b292b5',
		'title' => 'news',
		'fields' => array(
			array(
				'key' => 'field_5d78933b3639f',
				'label' => '显示文章数',
				'name' => 'total',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 3,
				'min' => 1,
				'max' => 12,
				'step' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5d78933b36385',
				'label' => '随机选取',
				'name' => 'is_random',
				'type' => 'true_false',
				'instructions' => '从系统中自动选取图文进行展示',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5d78933b36392',
				'label' => '只选取置顶文章',
				'name' => 'is_sticky',
				'type' => 'true_false',
				'instructions' => '是否只从置顶文章中选取',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5d78933b363aa',
				'label' => '选择要显示的文章',
				'name' => 'posts',
				'type' => 'relationship',
				'instructions' => '为了显示美观，请选择有"特色图片"的文章',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d78933b36385',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'post',
				),
				'taxonomy' => '',
				'filters' => array(
					0 => 'search',
					1 => 'post_type',
					2 => 'taxonomy',
				),
				'elements' => array(
					0 => 'featured_image',
				),
				'min' => '',
				'max' => 9,
				'return_format' => 'id',
			),
			array(
				'key' => 'field_5d78933b363b5',
				'label' => '指定分类',
				'name' => 'categories',
				'type' => 'taxonomy',
				'instructions' => '可以从指定分类中自动选取图文',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d78933b36385',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'category',
				'field_type' => 'checkbox',
				'add_term' => 1,
				'save_terms' => 0,
				'load_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
				'allow_null' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'widget',
					'operator' => '==',
					'value' => 'partoo_news',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5d7edf6d649a6',
		'title' => 'post-gallery',
		'fields' => array(
			array(
				'key' => 'field_5d7edf9575e3a',
				'label' => '是否加入图集效果',
				'name' => 'has_gallery',
				'type' => 'true_false',
				'instructions' => '如果选择“是”，可以为该文章添加图集',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5d7edf6d6b7b9',
				'label' => '栏目链接',
				'name' => 'link',
				'type' => 'link',
				'instructions' => '指定该字段，可以通过标题右侧的“更多”链接到指定页面',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d7edf9575e3a',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
			),
			array(
				'key' => 'field_5d7edf6d6b7c5',
				'label' => '列数',
				'name' => 'cols',
				'type' => 'select',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d7edf9575e3a',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					1 => '一张一行',
					2 => '两张一行',
					3 => '三张一行',
					4 => '四张一行',
					6 => '六张一行',
				),
				'default_value' => array(
					0 => 4,
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'return_format' => 'value',
				'ajax' => 0,
				'placeholder' => '',
			),
			array(
				'key' => 'field_5d7edf6d6b7cb',
				'label' => '行数',
				'name' => 'rows',
				'type' => 'range',
				'instructions' => '指定行数，超过此行数的图片将不予显示',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d7edf9575e3a',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 3,
				'min' => 1,
				'max' => 9,
				'step' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5d7edf6d6b7d2',
				'label' => '图片',
				'name' => 'images',
				'type' => 'gallery',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d7edf9575e3a',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'insert' => 'append',
				'library' => 'all',
				'min' => '',
				'max' => '',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'image',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'permalink',
			1 => 'the_content',
			2 => 'excerpt',
			3 => 'discussion',
			4 => 'comments',
			5 => 'revisions',
			6 => 'slug',
			7 => 'author',
			8 => 'format',
			9 => 'page_attributes',
			10 => 'featured_image',
			11 => 'categories',
			12 => 'tags',
			13 => 'send-trackbacks',
		),
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5d7220b6a8138',
		'title' => 'slider',
		'fields' => array(
			array(
				'key' => 'field_5d759ad3c81ae',
				'label' => '每次显示数量',
				'name' => 'per_page',
				'type' => 'radio',
				'instructions' => '指定幻灯片每次展示的文章数量',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					6 => '6',
					12 => '12',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 1,
				'layout' => 'vertical',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5d7220bc17b00',
				'label' => '随机选取',
				'name' => 'is_random',
				'type' => 'true_false',
				'instructions' => '从系统中自动选取图文进行展示',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5d77015aed83a',
				'label' => '滚动方式',
				'name' => 'direction',
				'type' => 'true_false',
				'instructions' => '如果选择会垂直滚动，否则为水平滚动',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => '垂直滚动',
				'ui_off_text' => '水平滚动',
			),
			array(
				'key' => 'field_5d72212f17b01',
				'label' => '文章总数',
				'name' => 'total',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 3,
				'min' => 3,
				'max' => 12,
				'step' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5d7d139db55b2',
				'label' => '每次滚动的幅度',
				'name' => 'step',
				'type' => 'range',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 1,
				'min' => 1,
				'max' => 4,
				'step' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5d72216017b02',
				'label' => '选择要显示的文章',
				'name' => 'posts',
				'type' => 'relationship',
				'instructions' => '为了显示美观，请选择有"特色图片"的文章',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d7220bc17b00',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => '',
				'taxonomy' => '',
				'filters' => array(
					0 => 'search',
					1 => 'post_type',
					2 => 'taxonomy',
				),
				'elements' => array(
					0 => 'featured_image',
				),
				'min' => '',
				'max' => 9,
				'return_format' => 'object',
			),
			array(
				'key' => 'field_5d749371ce0e2',
				'label' => '指定分类',
				'name' => 'categories',
				'type' => 'taxonomy',
				'instructions' => '可以从指定分类中自动选取图文',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d7220bc17b00',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'category',
				'field_type' => 'checkbox',
				'add_term' => 1,
				'save_terms' => 0,
				'load_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
				'allow_null' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'widget',
					'operator' => '==',
					'value' => 'partoo_slider',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

endif;
