<?php
query_posts(
	array(
		'cat' => get_query_var('cat'),
		'orderby' => 'modified',
		'order' => 'DESC',
	)
);
if (have_posts()): while (have_posts()): the_post(); ?>
	<?php $category = get_the_category();
	$first_category = $category[0]; ?>
	<div class="post-entry">
		<div class="post-inner">
			<h5 class="mt-4">
				<a href=<?php the_permalink(); ?>><?php the_title(); ?></a>
			</h5>
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
	<!-- article -->
	<article>
		<h2><?php _e('Sorry, nothing to display.', 'wemesh'); ?></h2>
	</article>
<?php endif; ?>
