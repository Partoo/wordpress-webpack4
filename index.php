<?php
defined('ABSPATH') || exit;
get_header();
?>
<?php if (is_front_page() && is_home()) : ?>
	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-area-1')): ?>
	<?php endif; endif; ?>

<!--	bg-light-->
<section class="bg-light">
	<div class="container py-5">
		<div class="row large-title">
			<div class="col-lg-6 col-sm-12">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('half-area-left')): ?>
				<?php endif; ?>
			</div>
			<div class="col-md-6">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('half-area-right')): ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-fluid-area-grey')): ?>
<?php endif; ?>
<section class="container my-5" id="travels">
	<div class="row large-title">
		<div class="col-lg-7 col-sm-12">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-container-left')): ?>
			<?php endif; ?>
		</div>
		<div class="col-md-5 d-none d-lg-block">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-container-right')): ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-fluid-area')): ?>
<?php endif; ?>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-primary-color-area')): ?>
<?php endif; ?>

<?php get_footer(); ?>
