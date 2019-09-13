<?php
defined('ABSPATH') || exit;
$container = get_theme_mod('partoo_container_type');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="MobileOptimized" content="320"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="<?php echo get_theme_mod('desc') ?>">
	<link rel="stylesheet" href="https://static.wemesh.cn/lib/fontawesome-free-5.9.0/css/all.min.css">
	<script>var isIE = !!document.documentMode;
			isIE && window.location.replace("https://static.wemesh.cn/html/fk_ie.html")</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action('wp_body_open'); ?>
<div class="site" id="page">
	<header class="site-header">
		<nav class="navbar navbar-expand-lg navbar-no-bg-navbar-light px-0">
			<div class="container px-0" style="height: 83px;">
				<button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
						data-target="#navbar" aria-controls="navbar" aria-expanded="false"
						aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
				<a class="navbar-brand" href=""><img
						src="<?php echo wp_get_attachment_url(get_theme_mod('custom_logo')); ?>"
						alt="大沽河"><span
						class="brand-name-primary ml-3 d-none d-xl-inline-block">大沽河生态旅游度假区<br/><i>DaGuHe Tourist & Holiday Resort</i></span></a>
				<?php wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container_class' => 'collapse navbar-collapse justify-content-center',
						'container_id' => 'navbar',
						'menu_class' => 'navbar-nav justify-content-md-center',
						'menu_id' => 'main-menu',
						'fallback_cb' => '',
						'depth' => 2,
						'walker' => new WP_Bootstrap_Navwalker(),
					)
				); ?>
				<?php get_search_form(); ?>
				<ul class="navbar-right flex-row d-flex align-items-center m-0">
					<li class="nav-item"><a class="toggle-search" id="toggle-search" href="#"><i
								class="fas fa-search text-black-50"></i></a></li>
					<?php if (get_theme_mod('wechat')): ?>
						<li class="nav-item">
							<button class="btn btn-success btn-circle btn-circle-sm m-1"><i class="fab fa-weixin"></i>
							</button>
							<div class="hide-element animated" id="qr">
								<img src="<?php echo wp_get_attachment_url(get_theme_mod('wechat')); ?>" alt="">
							</div>
						</li>
					<?php endif ?>
				</ul>
			</div>
		</nav>
	</header>

