<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>

	<?php roots_content_before(); ?>

    <div id="content" class="full" role="main">

        <?php roots_loop_before(); ?>
        <?php get_template_part('loop', 'page'); ?>
        <?php roots_loop_after(); ?>

    </div><!-- /#content -->

	<?php roots_content_after(); ?>

<?php get_footer(); ?>