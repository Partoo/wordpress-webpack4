<?php

class PartooCarousel extends WP_Widget
{

	/**
	 * Widget constructor.
	 */
	public function __construct()
	{
		parent::__construct(
			'partoo_hero', // id
			'Partoo::轮换图', // name
			array(
				'description' => '通常用在首页的横幅轮换图',
				'classname' => 'carousel',
			)
		);
	}

	// Front-end display of widget
	public function widget($args, $instance)
	{
		$id = 'widget_' . $args['widget_id'];
		$rows = get_field('carousel', $id);
		?>
		<div id="hero" class="carousel slide carousel-wemesh carousel-fade margin-nav" data-ride="carousel">
			<ol class="carousel-indicators mb-3">
				<?php foreach ($rows as $key => $row): ?>
					<li data-target="#hero" data-slide-to="<?php echo $key ?>"
						class="<?php if ($key == 0) echo 'active' ?>"></li>
				<?php endforeach; ?>
			</ol>
			<div class="carousel-inner">
				<?php foreach ($rows as $key => $row): ?>
					<div class="carousel-item carousel-cover <?php if ($key == 0) echo 'active' ?>"
						 style="height: 600px;background-image: url(<?php echo $row['img'] ?>);background-position: center center;background-size:cover;">
						<div class="overlay overlay-purple"></div>
						<div class="container d-flex h-100">
							<div class="row justify-content-center align-items-center slogan w-100">
								<div class="col-md-9 intro-body">
									<p class="intro-title animated fadeInUp"><?php echo $row['subtitle'] ?></p>
									<h1 class="d-inline-block intro-caption mb-4 animated zoomIn"><?php echo $row['title'] ?></h1>
									<p class="intro-subtitle animated slideInUp"><?php echo $row['intro'] ?></p>
									<?php if (!empty($row['url'])): ?>
										<a href="<?php echo $row['url'] ?>"
										   class="btn btn-primary mt-3 animated slow slideInUp">查看详情</a>
									<?php endif ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}

	// Back-end widget form
	public function form($instance)
	{
		if (isset($instance['title'])) {
			$title = $instance['title'];
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
				   name="<?php echo $this->get_field_name('title'); ?>" type="text"
				   value="<?php echo esc_attr($title); ?>">
		</p>
		<?php
	}

	// Sanitize widget form values as they are saved
	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		return $instance;
	}
}

add_action('widgets_init', function () {
	register_widget('PartooCarousel');
});
