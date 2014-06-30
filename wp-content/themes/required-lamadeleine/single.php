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

			<?php

				// Get the current story pod object
				$story = pods('post', get_the_id());

				// Get promo relationship field
				$promo = $story->field('fma_promo');

				// Get top image field
				$topImage = $story->field('top_image');

				// echo "<pre>";
				// print_r($topImage);
				// echo "</pre>";

				// Start the loop
				while ( have_posts() ) : the_post();

				// Get the post category object
				$cat = get_the_category();

				// Get category name from first category result
				$cat = strtolower($cat[0]->name);
			?>

				<div id="mobile-nav">
			    <a href="/stories/food" <?php if($cat === 'food'){echo 'class="active"';}; ?>>
			        <div class="nav-item">
			            <div class="icon icon-food"></div>
			            Food
			        </div>
			    </a>
			    <a href="/stories/culture" <?php if($cat === 'culture'){echo 'class="active"';}; ?>>
			        <div class="nav-item">
			            <div class="icon icon-culture"></div>
			            Culture
			        </div>
			    </a>
			    <a href="/stories/community" <?php if($cat === 'community'){echo 'class="active"';}; ?>>
			        <div class="nav-item">
			            <div class="icon icon-community"></div>
			            Community
			        </div>
			    </a>
			    <a href="/stories">
			        <div class="nav-item">
			            <div class="icon icon-stories"></div>
			            All Stories
			        </div>
			    </a>
				</div>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="image-wrapper">
							<?php
								// Get attachment image with featured-top image style
								echo wp_get_attachment_image($topImage['ID'], 'featured-top');
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

		<aside id="sidebar" class="four columns <?php echo 'category-' . $cat; ?>" role="complementary">

			<div class="sidebar-wrapper">

				<?php 
					dynamic_sidebar('sidebar-story'); 

					echo display_promo($promo, 'widget');
				?>

			</div>

		</aside><!-- /#sidebar -->

	</div><!-- End Content row -->

<?php get_footer(); ?>