<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;


add_action('widgets_init', 'partoo_register_sidebars');

if (!function_exists('partoo_register_sidebars')) {
	/**
	 * Initializes themes widgets.
	 */
	// SIDEBAR
	function partoo_register_sidebars()
	{

		$sidebars = (array)apply_filters(
			'partoo_sidebars',
			array(
				'sidebar-1' => array(
					'name' => '栏目页边栏',
					'description' => esc_html__('The primary sidebar appears alongside the content of every page, post, archive, and search template.', 'partoo'),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h4 class="widget-title">',
					'after_title' => '</h4>',
				),
				'sidebar-2' => array(
					'name' => '内容页边栏',
					'description' => esc_html__('The secondary sidebar will only appear when you have selected a three-column layout.', 'partoo'),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h4 class="widget-title">',
					'after_title' => '</h4>',
				),
				'sidebar-contact' => array(
					'name' => '联系页面边栏',
					'description' => '联系页面的边栏',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h4 class="widget-title">',
					'after_title' => '</h4>',
				),
				'footer-1' => array(
					'name' => '页脚',
					'description' => esc_html__('This sidebar is the first column of the footer widget area.', 'partoo'),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h4 class="widget-title">',
					'after_title' => '</h4>',
				),
//				'footer-2' => array(
//					'name' => esc_html__('Footer 2', 'partoo'),
//					'description' => esc_html__('This sidebar is the second column of the footer widget area.', 'partoo'),
//					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//					'after_widget' => '</aside>',
//					'before_title' => '<h4 class="widget-title">',
//					'after_title' => '</h4>',
//				),
				'home-area-1' => array(
					'name' => '首页焦点位置',
					'description' => '首页导航下方焦点位置',
					'before_widget' => '<div id="%1$s" class="widget %2$s container py-5">',
					'after_widget' => '</div>',
					'before_title' => '<div class="title mb-5"><h2>',
					'after_title' => '</div></h2>',
				),
				'home-fluid-area-grey' => array(
					'name' => '首页横幅位置',
					'description' => '首页中心横幅位置',
//					'before_widget' => '<section id="%1$s" class="widget %2$s bg-world py-5">',
//					'after_widget' => '</section>',
//					'before_title' => '<div class="title mb-5"><h2>',
//					'after_title' => '</div></h2>',
				),
				'half-area-left' => array(
					'name' => '半块左侧',
					'description' => '用在两栏同时等高时',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h5 class="title">',
					'after_title' => '</h5>',
				),
				'half-area-right' => array(
					'name' => '半块右侧',
					'description' => '用在两栏同时等高时',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h5 class="title">',
					'after_title' => '</h5>',
				),
				'home-primary-color-area' => array(
					'name' => '首页横幅-2',
					'description' => '首页下方横幅位置',
//					'before_widget' => '<div id="%1$s" class="widget %2$s bg-success text-white p-5 text-center">',
//					'after_widget' => '</div>',
//					'before_title' => '<div class="title mb-5"><h2>',
//					'after_title' => '</div></h2>',
				),
				'home-container-left' => array(
					'name' => '首页下方固定宽度左侧',
					'description' => '首页下方固定宽度左侧',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h5 class="title">',
					'after_title' => '</h5>',
				),
				'home-container-right' => array(
					'name' => '首页下方固定宽度右侧',
					'description' => '首页下方固定宽度右侧',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h5 class="title">',
					'after_title' => '</h5>',
				),
			)
		);

		foreach ($sidebars as $id => $args) {
			register_sidebar(array_merge(array('id' => $id), $args));
		}
	}

} // endif function_exists( 'partoo_widgets_init' ).
