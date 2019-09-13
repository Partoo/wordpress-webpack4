<div id="post-content" class="post-content mb-5">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ('' !== get_the_post_thumbnail() && !is_single()): ?>
		<?php endif; ?>

		<div class="entry-content">
			<h3 class="text-center"><?php the_title(); ?></h3>
			<div class="text-center mb-3">
				<small>发布于: <?php the_time('Y-m-d'); ?></small>
			</div>
			<hr>
			<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . '本文分页:',
					'after' => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after' => '</span>',
				)
			);
			?>
		</div><!-- .entry-content -->

	</article>
</div>
