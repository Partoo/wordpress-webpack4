<?php

class PartooVideo extends WP_Widget
{

	/**
	 * Widget constructor.
	 */
	public function __construct()
	{
		parent::__construct(
			'partoo_video', // id
			'Partoo::视频播放组件', // name
			array(
				'description' => '放置视频外链的盒子',
				'classname' => 'video',
			)
		);
	}

	// Front-end display of widget
	public function widget($args, $instance)
	{
		$id = 'widget_' . $args['widget_id'];
		$link = $instance['link'];
		preg_match('/id_(.+?)\.html/', $link, $matches);
		$params = $matches[1];
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
		$aspect_radio = $instance['aspect_radio'];
		if (empty($aspect_radio)) {
			$aspect_radio = '4by3';
		}
		echo get_field('title', $id);
		?>
		<div class="embed-responsive embed-responsive-<?php echo $aspect_radio ?>">
			<iframe src='http://player.youku.com/embed/<?php echo $params ?>' allowfullscreen="true"></iframe>
		</div>
		<?php echo $args['after_widget'];
	}

	// Back-end widget form
	public function form($instance)
	{
		if ($instance) {
			$title = esc_attr($instance['title']);
			$icon = esc_attr($instance['icon']);
			$position = esc_attr($instance['position']);
			$aspect_radio = esc_attr($instance['aspect_radio']);
			$link = esc_attr($instance['link']);
		} else {
			$title = '';
			$icon = '';
			$position = '';
			$link = '';
			$aspect_radio = '';
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
			<label for="<?php echo $this->get_field_id('link'); ?>">
				<?php echo '视频链接地址' ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>"
				   name="<?php echo $this->get_field_name('link'); ?>" type="text"
				   value="<?php echo esc_attr($link); ?>">
		</p>
		<p>
			<label>
				<input type="radio" value="4by3"
					<?php checked($aspect_radio, '4by3'); ?>
					   name="<?php echo $this->get_field_name('aspect_radio'); ?>"
					   id="<?php echo $this->get_field_id('aspect_radio'); ?>"/>
				<?php echo '4:3' ?>
			</label>
			<label>
				<input type="radio" value="16by9"
					<?php checked($aspect_radio, '16by9'); ?>
					   name="<?php echo $this->get_field_name('aspect_radio'); ?>"
					   id="<?php echo $this->get_field_id('aspect_radio'); ?>"/>
				<?php echo '16:9' ?>
			</label>
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
		$instance['link'] = (!empty($new_instance['link'])) ? strip_tags($new_instance['link']) : null;
		$instance['position'] = (!empty($new_instance['position'])) ? sanitize_text_field($new_instance['position']) : null;
		$instance['aspect_radio'] = (!empty($new_instance['aspect_radio'])) ? sanitize_text_field($new_instance['aspect_radio']) : null;
		return $instance;
	}
}

add_action('widgets_init', function () {
	register_widget('PartooVideo');
});
