<?php

/**
 * Customizer bootstrap.
 *
 * @class    Partoo_Customizer
 * @package  Classes/Customizer
 * @category Class
 */
class Partoo_Customizer
{

	/**
	 * Stylesheet slug.
	 *
	 * @var string
	 */
	public static $stylesheet;

	/**
	 * Class constructor.
	 */
	public function __construct()
	{

		self::$stylesheet = get_stylesheet();

		/**
		 * Load Customizer Colors functionality.
		 *
		 * @since 1.0.0
		 */
		// require_once get_template_directory() . '/inc/customizer/colors.php';

		/**
		 * Load Customizer Fonts functionality.
		 *
		 * @since 1.0.0
		 */
		// require_once get_template_directory() . '/inc/customizer/fonts.php';

		/**
		 * Load Customizer Layouts functionality.
		 *
		 * @since 1.0.0
		 */
		// require_once get_template_directory() . '/inc/customizer/layouts.php';

		/**
		 * Load additional site identity options
		 *
		 * @since 1.5.0
		 */
		require_once get_template_directory() . '/inc/customizer/site-identity.php';

		add_action('after_setup_theme', array($this, 'logo'));
		add_action('customize_register', array($this, 'selective_refresh'), 11);
		add_action('customize_register', array($this, 'use_featured_hero_image'));
		// add_action('customize_preview_init', array($this, 'customize_preview_js'));
		add_action('wp_head', array($this, 'customizer_css'));

	}

	/**
	 * Add custom logo support.
	 *
	 * @action after_setup_theme
	 * @uses   [add_theme_support](https://developer.wordpress.org/reference/functions/add_theme_support/)
	 *
	 * @since  1.0.0
	 */
	public function logo()
	{
		$args = (array)apply_filters('Partoo_custom_logo_args',
			array(
				'width' => 290,
				'height' => 110,
				'flex-height' => true,
				'flex-width' => true,
				'header-text' => array('site-title', 'site-description'),
			)
		);
		add_theme_support('custom-logo', $args);
	}

	/**
	 * Adds postMessage support for site title and description for the Customizer.
	 *
	 * @action customize_register
	 * @param WP_Customize_Manager $wp_customize Instance of the WP_Customize_Manager class.
	 * @uses   $this->blogname()
	 * @uses   $this->blogdescription()
	 *
	 * @see    WP_Customize_Manager
	 *
	 * @since  1.0.0
	 *
	 */
	public function selective_refresh(WP_Customize_Manager $wp_customize)
	{

		$wp_customize->get_setting('blogname')->transport = 'postMessage';
		$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
		$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

		if (!isset($wp_customize->selective_refresh)) {
			return;
		}

		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector' => '.site-title a',
				'container_inclusive' => false,
				'render_callback' => array($this, 'blogname'),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector' => '.site-description',
				'container_inclusive' => false,
				'render_callback' => array($this, 'blogdescription'),
			)
		);

	}

	/**
	 * Display the blog name.
	 *
	 * @since 1.0.0
	 *
	 * @see   $this->selective_refresh()
	 */
	public function blogname()
	{

		bloginfo('name');

	}

	/**
	 * Display the blog description.
	 *
	 * @since 1.0.0
	 * @see   $this->selective_refresh()
	 */
	public function blogdescription()
	{

		bloginfo('description');

	}

	/**
	 * Add control to use featured images as the hero image.
	 *
	 * @action customize_register
	 * @param WP_Customize_Manager $wp_customize Instance of the WP_Customize_Manager class.
	 * @since  1.0.0
	 *
	 * @see    WP_Customize_Manager
	 *
	 */
	public function use_featured_hero_image(WP_Customize_Manager $wp_customize)
	{

		$wp_customize->add_setting(
			'use_featured_hero_image',
			array(
				'default' => 1,
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			'use_featured_hero_image',
			array(
				'label' => esc_html__('Use featured image', 'Partoo'),
				'description' => esc_html__('Allow the featured image on the current post to override the hero image.', 'Partoo'),
				'section' => 'header_image',
				'priority' => 5,
				'type' => 'checkbox',
			)
		);

	}

	/**
	 * Enqueue preview JS.
	 *
	 * @action customize_preview_init
	 *
	 * @since 1.0.0
	 */
	// public function customize_preview_js() {

	// 	$suffix = SCRIPT_DEBUG ? '' : '.min';

	// 	wp_enqueue_script('Partoo-customize-preview', get_template_directory_uri() . "/assets/js/admin/customizer{$suffix}.js", array('customize-preview'), PARTOO_VERSION, true);

	// 	wp_localize_script('Partoo-customize-preview', 'colorsSettings', array('hero_background_selector' => Partoo_get_hero_image_selector()));

	// }
	public function customizer_css()
	{
		if (get_theme_mod('hero_img')) {
			?>
			<style type="text/css">
				#hero-img {
					background: url("<?php echo get_theme_mod('hero_img') ?>") no-repeat;
					background-size: cover;
					background-position: center center;
				}
			</style>
			<?php
		}
	}

	/**
	 * Return an array of CSS rules as compacted CSS.
	 *
	 * Note: When `SCRIPT_DEBUG` is enabled, the returned CSS
	 * will be expanded instead of compacted.
	 *
	 * @param array $rules Array of CSS rules to parse.
	 *
	 * @return string Returns parsed rules ready to be printed as inline CSS.
	 * @since 1.0.0
	 *
	 */
	public static function parse_css_rules(array $rules)
	{

		$open_format = SCRIPT_DEBUG ? "%s {\n" : '%s{';
		$rule_format = SCRIPT_DEBUG ? "\t%s: %s;\n" : '%s:%s;';
		$close_format = SCRIPT_DEBUG ? "}\n" : '}';

		ob_start();

		foreach ($rules as $rule => $properties) {

			// @codingStandardsIgnoreStart
			printf(
				$open_format,
				implode(
					SCRIPT_DEBUG ? ",\n" : ',',
					array_map('trim', explode(',', $rule))
				)
			);
			// @codingStandardsIgnoreEnd

			foreach ($properties as $property => $value) {

				// @codingStandardsIgnoreStart
				printf($rule_format, $property, $value);
				// @codingStandardsIgnoreEnd

			}

			echo $close_format; // xss ok.

		}

		return ob_get_clean();

	}

}

new Partoo_Customizer;
