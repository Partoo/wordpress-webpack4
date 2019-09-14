<?php

class PartooSlider extends WP_Widget
{

	public static $params;

	public function __construct()
	{
		parent::__construct(
			'partoo_slider', // id
			'Partoo::幻灯滚动盒子', // name
			array(
				'description' => '一个迷人的滚动容器',
				'classname' => 'slider',
			)
		);
	}

	// Front-end display of widget
	public function widget($args, $instance)
	{
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
		$id = 'widget_' . $args['widget_id'];
		$per_page = intval(get_field('per_page', $id));
		$step = intval(get_field('step', $id));
		$col = 12 / $per_page;
		$direction = get_field('direction', $id);
		$params = ['per_page' => $per_page, 'step' => $step, 'vertical' => $direction];
//		$is_vertical
		PartooSlider::$params = json_encode($params);
		wp_enqueue_script('partoo_slider', 'https://static.wemesh.cn/lib/js/slick.min.js', array(), '', true);
		$total = intval(get_field('total', $id));
		if (get_field('is_random', $id)) {
			if (empty(get_field('categories', $id))) {
				$posts = get_posts([
					'post_type' => 'post',
					'posts_per_page' => $total,
					'orderby' => 'date',
					'order' => 'DESC',
					'no_found_rows' => 'true',
				]);
			} else {
				$posts = get_posts([
					'cat' => get_field('categories', $id),
					'post_type' => 'post',
					'posts_per_page' => 12,
					'orderby' => 'date',
					'order' => 'DESC',
					'no_found_rows' => 'true',
					'shuffle_and_pick' => $total // <-- our custom argument
				]);
			}
		} else {
			$posts = get_field('posts', $id);
		}
		if ($instance['style'] == '1'):
			?>

			<div id="v-slider">
				<?php foreach ($posts as $post): ?>
					<div class="card">
						<div class="row ">
							<div class="col-md-4 pr-0">
								<img src="<?php if (empty(get_the_post_thumbnail_url($post))) {
									echo rnd_img();
								} else {
									echo get_the_post_thumbnail_url($post, 'medium');
								} ?>" class="w-100">
								<ul>
									<li>
										<i class="fa fa-clock"></i> <?php echo date('Y-m-d', strtotime($post->post_date)) ?>
									</li>
								</ul>
							</div>
							<div class="col-md-8 pr-0">
								<div class="card-block p-3">
									<h5 class="card-title"><a
											href="<?php echo get_permalink($post) ?>"><?php echo get_the_title($post) ?></a>
									</h5>
									<p class="card-text text-secondary"><?php echo mb_substr(wp_strip_all_tags($post->post_content), 0, 32) ?></p>
									<p class="text-right mt-2"><a href="<?php echo get_permalink($post) ?>" class="btn
											btn-sm btn-primary">详情</a></p>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php else: ?>
			<div id="v-slider">
				<?php foreach ($posts as $post): ?>
					<li>asdf</li>
				<?php endforeach; ?>
			</div>
		<?php endif ?>
		<?php echo $args['after_widget'];
	}

	public function form($instance)
	{
		if ($instance) {
			$title = esc_attr($instance['title']);
			$icon = esc_attr($instance['icon']);
			$position = esc_attr($instance['position']);
			$style = esc_attr($instance['style']);
		} else {
			$title = '';
			$icon = '';
			$position = '';
			$style = '';
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
		<p>
			<label>
				<input type="radio" value="1" checked
					<?php checked($style, '1'); ?>
					   name="<?php echo $this->get_field_name('style'); ?>"
					   id="<?php echo $this->get_field_id('style'); ?>"/>
				<?php echo '卡片中图片在文字上方' ?>
				<input type="radio" value="2"
					<?php checked($style, '2'); ?>
					   name="<?php echo $this->get_field_name('style'); ?>"
					   id="<?php echo $this->get_field_id('style'); ?>"/>
				<?php echo '卡片中图片在文字左方' ?>
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
		$instance['style'] = (!empty($new_instance['style'])) ? sanitize_text_field($new_instance['style']) : null;
		return $instance;
	}
}


add_action('wp_footer', function () {
	$params = PartooSlider::$params;
	wp_add_inline_script('partoo_slider', "window.slickParams = $params");
});
add_action('widgets_init', function () {
	register_widget('PartooSlider');
});


