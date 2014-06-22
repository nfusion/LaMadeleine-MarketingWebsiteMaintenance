<?php
/**
 * The template for displaying all single posts.
 *
 * This is the template that displays all single posts by default.
 * Please note that this is the WordPress construct of posts
 * and that other 'posts' on your WordPress site will use a
 * different template.
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.3.0
 */

get_header(); ?>
	<!-- Row for main content area -->
	<div id="content" class="row">

		<div id="main" class="eight columns" role="main">

			<div class="post-box">
				
					<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'story'  ); ?>
					<?php $fma = get_post_meta( get_the_ID(), 'fma', true ); 
					
					?>

				<?php endwhile; ?>

			</div>

		</div><!-- /#main -->

		<aside id="sidebar" class="four columns" role="complementary">

			<div class="sidebar-box">

			
				<?php
				$sidebar = 'sidebar-story';
				dynamic_sidebar($sidebar);

				print_r( $fma );
			?>

			

			</div>

		</aside><!-- /#sidebar -->

	</div><!-- End Content row -->

<?php get_footer(); ?>