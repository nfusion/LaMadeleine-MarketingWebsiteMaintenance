<?php
/*
Template Name: Checkout Complete
*/
?>
<?php get_header(); ?>

	<?php roots_content_before(); ?>

	<div id="content" role="main">

		<?php roots_loop_before(); ?>

		<?php while (have_posts()) { /* Start loop */
			the_post(); ?>

			<?php roots_post_before(); ?>
			<?php roots_post_inside_before(); ?>

			<?php $page_info = get_post_custom(); ?>

			<div class="page-content">
				<?php the_content(); ?>
				<?php
				if(isset($_POST['AMT'])) {
					echo '<p>' . $_POST['USER1'] . ' Tomato Basil Soupe Trio<br />' . 
						$_POST['USER2'] . ' Salade Dressing Duet - ' . $_POST['USER3'] . ', ' . $_POST['USER4'] . '</p>' . 
						'<p><strong>Total:</strong> ' . $_POST['AMT'] . '</p>';
				}
				?>
			</div>

			<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>

			<?php roots_post_inside_after(); ?>
			<?php roots_post_after(); ?>

		<?php } /* End loop */ ?>

		<?php roots_loop_after(); ?>

		<div class="clear"></div>
	</div><!-- /#content -->
	
	<?php roots_content_after(); ?>

<?php get_footer(); ?>