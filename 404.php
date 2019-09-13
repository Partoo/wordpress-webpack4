<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
get_banner();
?>
<div class="container my-5">
	<div class="row">
		<div class="col-12">
			<h3 class="text-center">
				页面不存在, <a href="<?php home_url(); ?>">返回</a>
			</h3>
		</div>
	</div>
</div>
<?php get_footer(); ?>
