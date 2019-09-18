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
			wp_enqueue_script('lightbox', 'https://static.wemesh.cn/lib/js/lightbox.js', array(), '', true);

			$cols = intval(get_field('cols'));
			$rows = intval(get_field('rows'));
			if (empty($cols)) {
				$cols = 4;
			}
			if (empty($rows)) {
				$rows = 3;
			}
			$total = $cols * $rows;
			$cols = (string)intval(12 / intval($cols));
			$images = array_slice(get_field('images'), 0, $total);
			$link = get_field('link');
			?>
			<div class="row m-0" id="gallery">
				<?php foreach ($images as $image): ?>
					<div class="item p-1 col-<?php echo $cols ?>">
						<a href="<?php echo $image['url'] ?>"
						   data-footer="<?php echo $image['caption'] ?>"
						   data-title="<?php echo $image['title'] ?>" data-toggle="lightbox" data-gallery="gallery">

							<img src="<?php echo $image['sizes']['medium'] ?>" alt="">

							<?php if (!empty($image['title'])): ?>
								<div class="overlay-bg m-1">
									<div class="text">
										<h5 style="font-size: 14px"><?php echo $image['title'] ?></h5>
									</div>
								</div>
							<?php endif ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
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
