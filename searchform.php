<?php
/**
 * The template for displaying search forms
 *
 * @package partoo
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<!--				SEARCH FORM-->
<form id="navbar-search" class="navbar-search py-4" action="<?php echo esc_url(home_url('/')); ?>" method="post">
	<div class="container">
		<div class="input-group">
			<input type="text" class="form-control" id="s" name="s" placeholder="输入要搜索的内容..."
				   aria-label="Search" value="<?php the_search_query(); ?>">
			<div class="input-group-append">
				<button class="btn btn-outline-primary" id="searchsubmit" name="submit" type="submit">搜索</button>
			</div>
		</div>
	</div>
</form><!-- end .navbar-search -->
