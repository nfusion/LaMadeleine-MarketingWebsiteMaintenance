<?php
/**
 * The template for displaying all single posts.
 *
 * This is the template that displays all single posts by default.
 * Please note that this is the WordPress construct of posts
 * and that other 'posts' on your WordPress site will use a
 * different template.
 *
 * 
 */

get_header(); ?>

	<!-- Row for main content area -->
	<div id="content">

		<div id="main" role="main">

			<div class="post-box">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; ?>

			</div>

		</div><!-- /#main -->

		<aside id="sidebar" role="complementary">

			<div class="sidebar-box">

				<?php get_sidebar(); ?>

			</div>

		</aside><!-- /#sidebar -->

	</div><!-- End Content row -->

<?php get_footer(); ?>