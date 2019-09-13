<?php

if (have_posts()): ?>

	<h5 class="mb-5"><?php echo sprintf(__('共有 %s 条关于 ', 'wpbootstrapsass'), $wp_query->found_posts);
		echo get_search_query();
		echo(' 的结果'); ?>
	</h5>
	<?php while (have_posts()): the_post(); ?>
		<?php $category = get_the_category();
		$first_category = $category[0]; ?>
		<article class="news" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if (has_post_thumbnail()): ?>
				<div class="post-thumbnail">
					<a href=<?php the_permalink(); ?>><img
							style="width: 100%;height: 300px;object-fit: cover;object-position: center center;"
							src=<?php the_post_thumbnail_url('medium'); ?> alt="<?php the_title(); ?>"></a>
				</div>
			<?php endif; ?>
			<div class="post-entry">
				<div class="post-inner">
					<h2 class="mt-4">
						<a href=<?php the_permalink(); ?>><?php the_title(); ?></a>
					</h2>
					<div class="post-entry-meta py-3">
						<a href=<?php echo get_category_link($first_category) ?>><?php echo $first_category->name ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;
						<a href="#"><?php the_time('Y-m-d'); ?></a>
					</div>
					<?php the_excerpt(); ?>
				</div>
			</div>
		</article>
		<hr>
	<?php endwhile; ?>
<?php else: ?>
	<article>
		<h2>暂无内容</h2>
	</article>
<?php endif; ?>
