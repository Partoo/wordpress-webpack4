<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
get_banner();
?>
<div class="container my-5">
	<div class="row">
		<div class="col-8">
			<?php get_template_part('inc/partials/tag'); ?>
			<?php wemesh_pagination(); ?>
		</div>
		<div class="col-4">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-1')): ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
