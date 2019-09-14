<?php

class PartooGallery extends WP_Widget
{

	/**
	 * Widget constructor.
	 */
	public function __construct()
	{
		parent::__construct(
			'partoo_gallery', // id
			'Partoo::图集', // name
			array(
				'description' => '放置图集的盒子',
				'classname' => 'gallery',
			)
		);
	}

	// Front-end display of widget
	public function widget($args, $instance)
	{
		wp_enqueue_script('lightbox', 'https://static.wemesh.cn/lib/js/lightbox.js', array(), '', true);
		$id = 'widget_' . $args['widget_id'];
		$cols = intval(get_field('cols', $id));
		$rows = intval(get_field('rows', $id));
		$total = $cols * $rows;
		$cols = (string)intval(12 / intval($cols));
		$images = array_slice(get_field('images', $id), 0, $total);
		$link = get_field('link', $id);
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
		<?php echo $args['after_widget'];
	}

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
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['icon'] = (!empty($new_instance['icon'])) ? strip_tags($new_instance['icon']) : null;
		$instance['position'] = (!empty($new_instance['position'])) ? sanitize_text_field($new_instance['position']) : null;
		return $instance;
	}
}

add_action('widgets_init', function () {
	register_widget('PartooGallery');
});
