<?php while (have_posts()) { /* Start loop */
	the_post(); ?>

	<?php roots_post_before(); ?>

	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<?php roots_post_inside_before(); ?>

        <header class="entry-date">
            <time datetime="<?php echo the_date('c'); ?>"><?php printf(__('%1$s', 'roots'), get_the_date(), get_the_time()); ?></time>
        </header>

		<div class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<div class="entry-footer">
			<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
			<?php $tags = get_the_tags(); if ($tags) { ?><p><?php the_tags(); ?></p><?php } ?>
		</div>

		<?php roots_post_inside_after(); ?>
	</article>

	<div class="comments">
		<?php comments_template(); ?>
	</div>

	<?php roots_post_inside_after(); ?>
	<?php roots_post_after(); ?>

<?php } /* End loop */ ?>