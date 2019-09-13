<?php
defined('ABSPATH') || exit;
?>
<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="nav-footer">
					<?php wp_nav_menu(array('theme_location' => 'secondary', 'depth' => 1)); ?>
				</nav>
				<div class="copyright-footer">
					<p class="copyright">
						©<?php echo date('Y') ?> 大沽河生态旅游度假区 版权所有
					</p>
				</div>
				<div class="credits">
					基于 <a href="https://www.wemesh.cn" target="_blank">WeMesh&reg; 技术驱动</a>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>

</html>

