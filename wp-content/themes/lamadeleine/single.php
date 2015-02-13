<?php get_header(); ?>

	<?php roots_content_before(); ?>

	<div id="content" class="blog_content" role="main">

		<?php roots_loop_before(); ?>
		<?php get_template_part('loop', 'single'); ?>
		<?php roots_loop_after(); ?>

		<div class="clear"></div>
	</div><!-- /#content -->

	<?php roots_content_after(); ?>

<?php get_footer(); ?>