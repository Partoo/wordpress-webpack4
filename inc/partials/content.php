<div id="post-content" class="post-content mb-5">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ('' !== get_the_post_thumbnail() && !is_single()): ?>
		<?php endif; ?>

		<div class="entry-content">
			<h3 class="text-center"><?php the_title(); ?></h3>
			<div class="text-center mb-3">
				<small>发布于: <?php the_time('Y-m-d'); ?></small>
			</div>
			<hr class="hr-dashed-1-muted">
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
		</div>
		<hr class="hr-solid-1-muted">
		<div class="entry-footer">
			<ul>
				<li><?php previous_post_link('上篇: %link') ?></li>
				<li><?php next_post_link('下篇: %link') ?></li>
			</ul>
			<div class="tags">
				<?php
				$tags = get_the_tags();
				if ($tags) :?>
					<span><i class="fa fa-tags text-muted"></i></span>
					<?php foreach ($tags as $tag) : ?>
						<span class="badge badge-primary"><a
								href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
								title="<?php echo esc_attr($tag->name); ?>"><?php echo esc_html($tag->name); ?></a>
							</span>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</article>
</div>
