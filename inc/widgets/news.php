<?php

class PartooNews extends WP_Widget
{

	/**
	 * Widget constructor.
	 */
	public function __construct()
	{
		parent::__construct(
			'partoo_news', // id
			'Partoo::图文新闻盒子', // name
			array(
				'description' => '放置新闻的盒子',
				'classname' => 'news',
			)
		);
	}

	// Front-end display of widget
	public function widget($args, $instance)
	{
		$id = 'widget_' . $args['widget_id'];
		echo $args['before_widget'];
		if (!empty($instance['title'])) {
			if (!empty($instance['icon'])) {
				if (!empty($instance['position'])) {
					if ($instance['position'] == 'before') {
						echo $args['before_title'] . "<i class='fa fa-" . $instance['icon'] . "'></i> " . apply_filters('widget_title', $instance['title']) . $args['after_title'];
					} else {
						echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . " <i class='fa fa-" . $instance['icon'] . "'></i>" . $args['after_title'];
					}
				}
			}
		}
		$total = intval(get_field('total', $id));
		$is_sticky = get_field('is_sticky', $id);
		// 如果从置顶文件中选取
		$post_args = [];
		if ($is_sticky) {
			$sticky = get_option('sticky_posts');
			// 如果指定随机选取
			if (get_field("is_random", $id)) {
				// 如果没有指定分类
				if (empty(get_field("categories", $id))) {
					$post_args = [
						'post__in' => $sticky,
						'posts_per_page' => 12,
						'orderby' => 'date',
						'order' => 'DESC',
						'no_found_rows' => 'true',
						'shuffle_and_pick' => $total // <-- our custom argument
					];
//					如果指定了分类
				} else {
					$post_args = [
						'cat' => get_field('categories', $id),
						'post__in' => $sticky,
						'posts_per_page' => 12,
						'orderby' => 'date',
						'order' => 'DESC',
						'no_found_rows' => 'true',
						'shuffle_and_pick' => $total // <-- our custom argument
					];
				}
				// 如果不是随机选取
			} else {
				var_dump('如果不是随机选取,这里需要设置');
//				$posts = get_field('posts', $id);
			}
			// 如果不是从置顶中选取
		} else {
//		如果是随机选取
			if (get_field("is_random", $id)) {
//			如果未指定分类
				if (empty(get_field("categories", $id))) {
					$post_args = [
						'post_type' => 'post',
						'posts_per_page' => 12,
						'orderby' => 'date',
						'order' => 'DESC',
						'no_found_rows' => 'true',
						'shuffle_and_pick' => $total // <-- our custom argument
					];
					// 如果指定了分类
				} else {
					$post_args = [
						'cat' => get_field('categories', $id),
						'posts_per_page' => 12,
						'orderby' => 'date',
						'order' => 'DESC',
						'no_found_rows' => 'true',
						'shuffle_and_pick' => $total // <-- our custom argument
					];
				}
			} else {
				$ids = get_field('posts', $id);
				$post_args = [
					'post__in' => $ids
				];
			}
		}
		query_posts($post_args);
		if (have_posts()) :
			while (have_posts()) : the_post(); ?>
				<div class="card mb-3 post-card">
					<div class="row no-gutters equal-height">
						<div class="col-md-4">
							<a href="<?php the_permalink(); ?>"><img
									src="<?php if (empty(get_the_post_thumbnail_url())) {
										echo rnd_img();
									} else {
										the_post_thumbnail_url('medium');
									} ?>"
									alt="<?php the_title() ?>"></a>
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title"><a
										href="<?php the_title() ?>"><?php the_title() ?></a>
								</h5>
								<p class="card-text excerpt"><?php echo mb_substr(strip_tags(get_the_content()), 0, 46) ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php else: ?>
			<h5><?php echo '暂无内容' ?></h5>
		<?php endif; ?>
		<?php echo $args['after_widget'];
	}

	// Back-end widget form
	public function form($instance)
	{
		if ($instance) {
			$title = esc_attr($instance['title']);
			$icon = esc_attr($instance['icon']);
			$position = esc_attr($instance['position']);
		} else {
			$title = '';
			$icon = '';
			$position = '';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Title'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
				   name="<?php echo $this->get_field_name('title'); ?>" type="text"
				   value="<?php echo esc_attr($title); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('icon'); ?>">
				<?php echo '图标' ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('icon'); ?>"
				   name="<?php echo $this->get_field_name('icon'); ?>" type="text"
				   value="<?php echo esc_attr($icon); ?>">
			<label>
				<input type="radio" value="before"
					<?php checked($position, 'before'); ?>
					   name="<?php echo $this->get_field_name('position'); ?>"
					   id="<?php echo $this->get_field_id('position'); ?>"/>
				<?php echo '图标在文字之前' ?>
			</label>
			<label>
				<input type="radio" value="after"
					<?php checked($position, 'after'); ?>
					   name="<?php echo $this->get_field_name('position'); ?>"
					   id="<?php echo $this->get_field_id('position'); ?>"/>
				<?php echo '图标在文字之后' ?>
			</label>
		</p>
		<?php
	}

	// Sanitize widget form values as they are saved
	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : null;
		$instance['icon'] = (!empty($new_instance['icon'])) ? strip_tags($new_instance['icon']) : null;
		$instance['position'] = (!empty($new_instance['position'])) ? sanitize_text_field($new_instance['position']) : null;
		return $instance;
	}
}

add_action('widgets_init', function () {
	register_widget('PartooNews');
});
