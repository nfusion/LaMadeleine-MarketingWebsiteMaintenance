<?php
/**
 * Template Name: Page Single
 * Description: Single page layout
 *
 */

get_header(); 

// Get the current story pod object
$page = pods('page', get_the_id());

// Get promo relationship field
$promo = $page->field('fma_promo');

?>

	<div id="content" class="page-single">

		<div id="main" role="main">
			<div class="post-box">

				<?php
					// Start the loop
					while ( have_posts() ) : the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="image-wrapper">
						<?php 
							the_post_thumbnail('featured-top'); 
						?>
					</div>

					<div class="text-wrapper shadow">

						<div class="entry-header">
							<h1><?php the_title(); ?></h1>
							<h2><?php echo get_the_excerpt(); ?></h2>
						</div>

						<div class="entry-body">
							<?php 
								the_content(); 
								echo display_promo($promo, 'mobile');
							?>
						</div>

					</div>

					<?php endwhile; ?>

				</article>

			</div>
		</div><!-- /#main -->

		<aside id="sidebar" class="four columns" role="complementary">

			<div class="sidebar-wrapper">

				<?php 
					dynamic_sidebar('sidebar-story'); 

					echo display_promo($promo, 'widget');
				?>

			</div>

		</aside><!-- /#sidebar -->

	</div><!-- End Content row -->

<?php get_footer(); ?>
