<?php get_header(); ?>

	<?php roots_content_before(); ?>

	<div id="content" role="main">

		<div class="page-header">
			<h1><?php _e('File Not Found', 'roots'); ?></h1>
		</div>
		<div class="alert alert-block fade in">
			<a class="close" data-dismiss="alert">&times;</a>
			<p><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'roots'); ?></p>
		</div>
		<p><?php _e('Please try the following:', 'roots'); ?></p>
		<ul>
			<li><?php _e('Check your spelling', 'roots'); ?></li>
			<li><?php printf(__('Return to the <a href="%s">home page</a>', 'roots'), home_url()); ?></li>
			<li><?php _e('Click the <a href="javascript:history.back()">Back</a> button', 'roots'); ?></li>
		</ul>

		<div class="clear"></div>
	</div><!-- /#content -->

	<?php roots_content_after(); ?>

<?php get_footer(); ?>