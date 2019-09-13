<?php /* Template Name: Contact Page Template */
defined('ABSPATH') || exit;
define('WPCF7_AUTOP', false);
get_header();
get_banner();
?>
<div class="container my-5">
	<div class="row">
		<div class="col-8">
			<div class="contact-title">
				<h3 class="text-center">我们用心聆听您的声音</h3>
				<p class="text-muted">如果您对我们的工作有任何的意见或者建议,欢迎您通过填写下面的表单来通我们取得联系,您的反馈对我们非常重要,我们会在第一时间与您取得联系.</p>
			</div>
			<div class="form">
				<?php if (have_posts()) : while (have_posts()) : the_post();
					the_content();
				endwhile;
				else: ?>
					<p>Sorry, no posts matched your criteria.</p>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-4">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-contact')): ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
