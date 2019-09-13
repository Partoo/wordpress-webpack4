<?php

class Partoo_Site_Identity_Options
{
	public function __construct()
	{
		/**
		 * Filter the site identity settings display.
		 * @since 1.5.0
		 * @var bool
		 */
		if (!(bool)apply_filters('partoo_show_site_identity_settings', true)) {
			return;
		}

		// add_filter('partoo_privacy_policy_link', array($this, 'toggle_partoo_privacy_link'));

		// add_filter('partoo_author_credit', array($this, 'toggle_partoo_author_credit'));

		add_action('customize_register', array($this, 'customize_register'));

	}

	/**
	 * Toggle the visibility of the site credits in the footer.
	 *
	 * @filter partoo_author_credit
	 * @return bool Returns true when `show_author_credit` theme mod is set.
	 * @since  1.5.0
	 *
	 */
	// public function toggle_partoo_author_credit()
	// {

	//     $show_author_credit = get_theme_mod('show_author_credit', true);

	//     return !empty($show_author_credit);

	// }

	/**
	 * Toggle the visibility of the privacy policy link in the footer.
	 *
	 * @filter partoo_privacy_policy_link
	 * @return bool Returns true when `show_privacy_policy` theme mod is set.
	 * @since  1.8.3
	 *
	 */
	// public function toggle_partoo_privacy_link()
	// {

	//     $show_privacy_policy = get_theme_mod('show_privacy_policy', true);

	//     return !empty($show_privacy_policy);

	// }

	/**
	 * Register additional site identity options.
	 *
	 * @action customize_register
	 * @param WP_Customize_Manager $wp_customize Instance of the WP_Customize_Manager class.
	 * @since  1.5.0
	 *
	 * @see    WP_Customize_Manager
	 *
	 */
	public function customize_register(WP_Customize_Manager $wp_customize)
	{
		// description
//        $wp_customize->add_setting('desc', array(
//        ));
//        $wp_customize->add_control(new Wp_Customize_Control(
//            $wp_customize,
//            'desc',
//            array(
//                'label' => __('Description', 'wemesh'),
//                'section' => 'title_tagline',
//                'settings' => 'desc',
//                'type' => 'textarea',
//            )));
		// address
//		$wp_customize->add_setting('address', array());
//		$wp_customize->add_control(new Wp_Customize_Control(
//			$wp_customize,
//			'address',
//			array(
//				'label' => __('Address'),
//				'section' => 'title_tagline',
//				'settings' => 'address',
//				'type' => 'textarea',
//			)));
		// tel
//		$wp_customize->add_setting('partoo_phone', array());
//		$wp_customize->add_control(new Wp_Customize_Control(
//			$wp_customize,
//			'partoo_phone',
//			array(
//				'label' => __('Phone Number'),
//				'section' => 'title_tagline',
//				'settings' => 'partoo_phone',
//				'description' => __('Each record in a row'),
//				'type' => 'textarea',
//			)));
//		// email
//		$wp_customize->add_setting('email');
//		$wp_customize->add_control(new Wp_Customize_Control($wp_customize, 'email', array(
//			'label' => __('Input your email address'),
//			'section' => 'title_tagline',
//			'settings' => 'email',
//			'type' => 'text',
//		)));
		// wechat qrcode
		$wp_customize->add_setting('wechat');
		$wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'wechat', array(
			'label' => '上传微信公众号二维码',
			'section' => 'title_tagline',
			'settings' => 'wechat',
			'height' => 180,
			'width' => 180,
			'flex_width ' => false,
			'flex_height ' => false,
		)));
		// skype
//		$wp_customize->add_setting('skype');
//		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'skype', array(
//			'label' => __('Input your skype name'),
//			'section' => 'title_tagline',
//			'settings' => 'skype',
//			'type' => 'text',
//		)));
		// facebook
//		$wp_customize->add_setting('facebook');
//		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'facebook', array(
//			'label' => __('Input your facebook name'),
//			'section' => 'title_tagline',
//			'settings' => 'facebook',
//			'type' => 'text',
//		)));
		// twitter
//		$wp_customize->add_setting('twitter');
//		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'twitter', array(
//			'label' => __('Input your twitter name'),
//			'section' => 'title_tagline',
//			'settings' => 'twitter',
//			'type' => 'text',
//		)));
		// linkedin
//		$wp_customize->add_setting('linkedin');
//		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'linkedin', array(
//			'label' => __('Input your linkedin name'),
//			'section' => 'title_tagline',
//			'settings' => 'linkedin',
//			'type' => 'text',
//		)));

//		$wp_customize->add_setting(
//			'copyright_text',
//			array(
//				'sanitize_callback' => 'wp_kses_post',
//				'sanitize_js_callback' => 'wp_kses_post',
//				'default' => sprintf(
//				/* translators: 1. copyright symbol, 2. year, 3. site title */
//					esc_html__('Copyright %1$s %2$d %3$s', 'partoo'),
//					'&copy;',
//					date('Y'),
//					get_bloginfo('blogname')
//				),
//			)
//		);

//		$wp_customize->add_control(
//			'copyright_text',
//			array(
//				'label' => esc_html__('Footer Copyright Text', 'partoo'),
//				'section' => 'title_tagline',
//				'settings' => 'copyright_text',
//				'type' => 'text',
//				'priority' => 40,
//			)
//		);

		// $wp_customize->add_setting(
		//     'show_author_credit',
		//     array(
		//         'default' => 1,
		//         'sanitize_callback' => 'absint',
		//     )
		// );

		// $wp_customize->add_control(
		//     'show_author_credit',
		//     array(
		//         'label' => esc_html__('Display theme author credit', 'partoo'),
		//         'section' => 'title_tagline',
		//         'settings' => 'show_author_credit',
		//         'type' => 'checkbox',
		//         'priority' => 50,
		//     )
		// );

		// $wp_customize->add_setting(
		//     'show_privacy_policy',
		//     array(
		//         'default' => 1,
		//         'sanitize_callback' => 'absint',
		//     )
		// );

		// $wp_customize->add_control(
		//     'show_privacy_policy',
		//     array(
		//         'label' => esc_html__('Display privacy policy link', 'partoo'),
		//         'section' => 'title_tagline',
		//         'settings' => 'show_privacy_policy',
		//         'type' => 'checkbox',
		//         'priority' => 50,
		//     )
		// );

	}

}

$GLOBALS['partoo_site_identity_options'] = new Partoo_Site_Identity_Options;
