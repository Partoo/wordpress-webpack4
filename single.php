<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
get_banner();
?>
<div class="container my-5">
	<div class="row">
		<?php if (has_post_format('image')) : ?>
			<div class="col-12">
				<?php while (have_posts()):
					the_post();
					get_template_part('inc/partials/image', get_post_format());


					// If comments are open or we have at least one comment, load up the comment template.
					// if (comments_open() || get_comments_number()):
					//     comments_template();
					// endif;

					// the_post_navigation(
					//     array(
					//         'prev_text' => '<a class="btn btn-success">' . __('Previous Post', 'wemesh') . '</a><span aria-hidden="true" class="nav-subtitle">' . __('Previous', 'wemesh') . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . '</span>%title</span>',
					//         'next_text' => '<span class="screen-reader-text">' . __('Next Post', 'wemesh') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Next', 'wemesh') . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . '</span></span>',
					//     )
					// );

				endwhile; // End of the loop.
				?>
			</div>
		<?php else: ?>
			<div class="col-8">
				<?php while (have_posts()):
					the_post();
					get_template_part('inc/partials/image', get_post_format());


					// If comments are open or we have at least one comment, load up the comment template.
					// if (comments_open() || get_comments_number()):
					//     comments_template();
					// endif;

					// the_post_navigation(
					//     array(
					//         'prev_text' => '<a class="btn btn-success">' . __('Previous Post', 'wemesh') . '</a><span aria-hidden="true" class="nav-subtitle">' . __('Previous', 'wemesh') . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . '</span>%title</span>',
					//         'next_text' => '<span class="screen-reader-text">' . __('Next Post', 'wemesh') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Next', 'wemesh') . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . '</span></span>',
					//     )
					// );

				endwhile; // End of the loop.
				?>
			</div>
			<div class="col-4">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-2')): ?>
				<?php endif; ?>
			</div>
		<?php endif ?>
	</div>
</div>
<?php get_footer(); ?>
