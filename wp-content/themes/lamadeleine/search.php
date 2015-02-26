<?php get_header(); ?>

	<?php roots_content_before(); ?>

	<div id="content" class="full" role="main">

		<div class="page-header">
			<h1><?php _e('Search Results for', 'roots'); ?> <?php echo get_search_query(); ?></h1>
		</div>

		<?php roots_loop_before(); ?>
		<?php get_template_part('loop', 'search'); ?>
		<?php roots_loop_after(); ?>

		<div class="clear"></div>
	</div><!-- /#content -->

	<?php roots_content_after(); ?>

<?php get_footer(); ?>