<?php
/**
 * The template for displaying catagory  archives.
 *
 * This is the template that displays catagory  archives by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.3.0
 */

get_header();?>
	<!-- Row for main content area -->
	<div id="content" class="row">

		<div id="main" class="eight columns" role="main">
			<div class="post-box">

				<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

			</div>
		</div><!-- /#main -->

		<aside id="sidebar" class="four columns" role="complementary">
			<div class="sidebar-box">
				<?php 
					$sidebar = 'sidebar-story';
					dynamic_sidebar($sidebar);
				?>
			</div>
		</aside><!-- /#sidebar -->

	</div><!-- End Content row -->

<?php get_footer(); ?>