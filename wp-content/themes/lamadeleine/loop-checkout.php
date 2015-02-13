<?php while (have_posts()) { /* Start loop */
	the_post(); ?>

	<?php roots_post_before(); ?>
	<?php roots_post_inside_before(); ?>

	<?php $page_info = get_post_custom(); ?>

	<div class="page-content">
		<?php the_content(); ?>
		<?php
		if(isset($secure_token) && $secure_token == 'ERROR') {
			echo '<p>An error has occurred placing the order.</p>';
		}
		else if(isset($secure_token)) {
			echo '<iframe width="490" align="middle" height="565" frameborder="0" src="https://pilot-payflowpro.paypal.com/payflowlink.do?SECURETOKEN=' . $secure_token[0] . '&SECURETOKENID=' . $secure_token[1] . '"></iframe>';
		}
		?>
	</div>

	<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>

	<?php roots_post_inside_after(); ?>
	<?php roots_post_after(); ?>

<?php } /* End loop */ ?>