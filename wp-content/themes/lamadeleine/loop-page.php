<?php while (have_posts()) { /* Start loop */
	the_post(); ?>

	<?php roots_post_before(); ?>
	<?php roots_post_inside_before(); ?>

	<?php $page_info = get_post_custom(); ?>

	<div class="page-content">
		<?php the_content(); ?>
	</div>

	<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>

	<?php roots_post_inside_after(); ?>
	<?php roots_post_after(); ?>

<?php } /* End loop */ ?>