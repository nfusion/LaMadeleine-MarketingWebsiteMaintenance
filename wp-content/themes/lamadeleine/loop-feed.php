<?php while (have_posts()) { /* Start loop */
    the_post(); ?>

    <?php roots_post_before(); ?>

    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
        <?php roots_post_inside_before(); ?>

        <div class="entry-header">
            <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
        </div>

        <div class="entry-content">
            <?php the_excerpt(); ?>
            <p class="read_more"><a href="<?php the_permalink() ?>">Read More</a></p>
        </div>

        <footer class="author-info">
            <time datetime="<?php echo the_date('c'); ?>"><?php printf(__('%1$s', 'roots'), get_the_date(), get_the_time()); ?></time>
            <?php printf(__('<cite class="fn">By %s</cite>', 'roots'), get_the_author()); ?>
            <?php edit_comment_link(__('(Edit)', 'roots'), '', ''); ?>
        </footer>

        <?php roots_post_inside_after(); ?>
    </article>

    <?php roots_post_inside_after(); ?>
    <?php roots_post_after(); ?>

<?php } /* End loop */ ?>