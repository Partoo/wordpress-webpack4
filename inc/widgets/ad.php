<?php

class PartooAd extends WP_Widget
{

	/**
	 * Widget constructor.
	 */
	public function __construct()
	{
		parent::__construct(
			'partoo_ad', // id
			'Partoo::广告组件', // name
			array(
				'description' => '广告盒子',
				'classname' => 'ad',
			)
		);
	}

	// Front-end display of widget
	public function widget($args, $instance)
	{
		$id = 'widget_' . $args['widget_id'];
		?>
		<section class="parallax d-none d-xl-block"
				 style="background-image: url(<?php the_field('bg-img', $id); ?>); background-position: 50% 20%;">
			<div class="overlay overlay-dark"></div>
			<div class="container p-5 d-flex h-100">
				<div class="row justify-content-center align-self-center w-100 slogan">
					<div class="col-md-12 intro-body">
						<p class="intro-title"><?php the_field('subtitle', $id); ?></p>
						<h1 class="intro-caption mb-4"><?php the_field('title', $id); ?></h1>
						<p class="intro-subtitle"><?php the_field('excerpt', $id); ?></p>
						<?php if (!empty(get_field('link', $id))): ?>
							<a href="<?php the_field('link', $id); ?>" class="btn btn-primary mt-3 float-right">查看详情</a>
						<?php endif ?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}

	// Back-end widget form
	public function form($instance)
	{
	}

	// Sanitize widget form values as they are saved
	public function update($new_instance, $old_instance)
	{
	}
}

add_action('widgets_init', function () {
	register_widget('PartooAd');
});
