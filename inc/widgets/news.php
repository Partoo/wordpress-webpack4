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
		echo get_field('title', $id);
		$total = intval(get_field('total', $id));
		$is_sticky = get_field('is_sticky', $id);
		if ($is_sticky) {
			$sticky = get_option('sticky_posts');
			if (get_field("is_random", $id)) {
				if (empty(get_field("categories", $id))) {
					$posts = get_posts([
						'posts_per_page' => $total,
						'post__in' => $sticky,
						'post_status' => 'publish',
						'orderby' => 'rand',
						'meta_query' => array(
							array(
								'key' => '_thumbnail_id',
								'compare' => 'EXISTS'
							),
						)
					]);
				} else {
					$posts = get_posts([
						'cat' => get_field('categories', $id),
						'posts_per_page' => $total,
						'post__in' => $sticky,
						'post_status' => 'publish',
						'orderby' => 'rand',
						'meta_query' => array(
							array(
								'key' => '_thumbnail_id',
								'compare' => 'EXISTS'
							),
						)
					]);
				}
			} else {
				$posts = get_field('posts', $id);
			}
		} else {
			if (get_field("is_random", $id)) {
				if (empty(get_field("categories", $id))) {
					$posts = get_posts([
						'posts_per_page' => $total,
						'post_status' => 'publish',
						'orderby' => 'rand',
						'meta_query' => array(
							array(
								'key' => '_thumbnail_id',
								'compare' => 'EXISTS'
							),
						)
					]);
				} else {
					$posts = get_posts([
						'cat' => get_field('categories', $id),
						'posts_per_page' => $total,
						'post_status' => 'publish',
						'orderby' => 'rand',
						'meta_query' => array(
							array(
								'key' => '_thumbnail_id',
								'compare' => 'EXISTS'
							),
						)
					]);
				}
			} else {
				$posts = get_field('posts', $id);
			}
		}
		if (count($posts) == 0) {
			echo '暂无内容';
		} else
			?>

		<?php foreach ($posts as $post) : ?>
		<div class="card mb-3 post-card">
			<div class="row no-gutters">
				<div class="col-md-4">
					<a href="<?php echo get_permalink($post) ?>"><img
							src="<?php if (empty(get_the_post_thumbnail_url($post))) {
								echo('https://static.wemesh.cn/img/demo/demo1.jpg');
							} else {
								echo get_the_post_thumbnail_url($post, 'medium');
							} ?>"
							alt="<?php get_the_title($post) ?>" style="height: 120px"></a>
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<h5 class="card-title"><a
								href="<?php echo get_permalink($post) ?>"><?php echo get_the_title($post) ?></a></h5>
						<p class="card-text excerpt"><?php echo wp_strip_all_tags($post->post_content) ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
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
