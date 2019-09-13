<?php
defined('ABSPATH') || exit;
get_header();
?>
<?php if (is_front_page() && is_home()) : ?>
	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-area-1')): ?>
	<?php endif; ?>
	<?php
	$response = wp_remote_get('http://www.wemesh.cn/api/weather');
	if (wp_remote_retrieve_response_code($response)) {
		$weather = json_decode($response['body'], true);
	} else {
		$weather = [['icon' => '', 'date' => '数据获取失败', 'temperature' => '0', 'wind' => '', 'period' => '请刷新页面重试']];
	}
endif; ?>
<!--	Weather start-->
<section id="weather">
	<div class="container my-3 py-4">
		<div class="row align-items-center grid-divider">
			<?php foreach ($weather as $item): ?>
				<div class="col-md-4 p-0">
					<div class="col-padding">
						<div class="row">
							<div class="col-4 weather">
								<i class="iconfont <?php echo $item['icon'] ?>"></i>
								<span><?php echo $item['weather'] ?></span>
							</div>
							<div class="col-8 mt-2 info p-0">
								<h3><span
										class="mr-1 text-dark-primary"><?php echo $item['date'] ?></span> <?php echo $item['period'] ?>
								</h3>
								<p><span><?php echo $item['temperature'] ?>&#8451;</span> <?php echo($item['wind']) ?>
								</p>
								<!--									<span class="badge badge-pill badge-info">-->
								<?php //echo $item['sunset'] ?><!--</span>-->
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!--Weather end-->
<!--	bg-light-->
<section class="bg-light">
	<div class="container py-5">
		<div class="row large-title">
			<div class="col-lg-6 col-sm-12">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('half-area-left')): ?>
				<?php endif; ?>
			</div>
			<div class="col-md-6">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('half-area-right')): ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-fluid-area-grey')): ?>
<?php endif; ?>
<section class="container my-5" id="travels">
	<div class="row large-title">
		<div class="col-lg-7 col-sm-12">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-container-left')): ?>
			<?php endif; ?>
		</div>
		<div class="col-md-5 d-none d-lg-block">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-container-right')): ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-fluid-area')): ?>
<?php endif; ?>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-primary-color-area')): ?>
<?php endif; ?>

<?php get_footer(); ?>
