<?php
/**
 * The default template for displaying content single/search/archive
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.3.0
 */
?>
<?php
// Get the current story pod object
$story = pods('post', get_the_id());

// Get promo relationship field
$promo = $story->field('fma_promo');

// Start the loop
while ( have_posts() ) : the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="image-wrapper">
		<?php the_post_thumbnail('featured-top'); ?>
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