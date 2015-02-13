<?php get_header(); ?>
<?php include_once('js/trackingjs.html'); ?>
<?php function displaylocation($place) { ob_start(); ?>
	<span class="location_name"><?php echo $place->post_title?></span>
	<span class="location_street"><?php echo $place->address ?></span>
	<span class="location_street2"><?php echo $place->address_2 ?></span>
	<span class="location_citystatezip"><?php echo $place->city ?>, <?php echo $place->state ?> <?php echo $place->zip_code ?></span>
	<span class="location_phone"><?php echo $place->phone ?></span>
	<span class="location_menu"><a href="http://order.cateringbylamadeleine.com/" title="Click to Order" target="_blank">Click to Order</a></span>
	<?php
    return ob_get_clean();
} ?>
<div id="banners">
	<div class="container">
		<div id="banner_images">
			<div id="banner_image_wrapper">
				<a href="/menu#pastas"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banners/pesto-pasta.jpg" alt="New Chicken Pesto Pasta" class="active" /></a>
				<a href="/menu#sandwiches"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banners/bistro-sandwich.jpg" alt="Bistro Sandwich" /></a>
				<a href="/menu#sandwiches"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banners/bistro-box.jpg" alt="Bistro Box" /></a>
				<a href="/menu#sandwiches"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banners/trio.jpg" alt="Trio" /></a>
				<a href="/menu#breakfast"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banners/breakfast.jpg" alt="Breakfast" /></a>
				<a href="/menu#sandwiches"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banners/party-tray.jpg" alt="Party Tray" /></a>
			</div>
		</div>
		<div id="banner_nav">
			<div class="banner_nav_button active"></div>
			<div class="banner_nav_button"></div>
			<div class="banner_nav_button"></div>
			<div class="banner_nav_button"></div>
			<div class="banner_nav_button"></div>
			<div class="banner_nav_button"></div>
		</div>
	</div>
</div>

<div id="main" role="document">
	<div class="container">
		<div id="swirl"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/swirl.png" alt="" /></div>
	            <!--//The Loop -->
        <?php while ( have_posts() ) : the_post(); ?>
		<div id="content">
			<a href="http://order.cateringbylamadeleine.com/" id="splat"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/orderonline.png" alt="Online Ordering Now Available!" /></a>
			<div id="splat2">or call 800-96-LAMAD</div>
			<h1><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/headline.png" alt="delight your guests with catering by la madeleine for any occasion" /></h1>
				<?php the_content(); ?>
		</div>
		<?php endwhile; ?>
		<div id="location_list">
			<h2><?php echo the_title(); ?></h2>
		
			<?php $locations = getCateringLocations(); ?>
			<pre><?php //print_r($locations) ?></pre>
			<?php foreach ($locations as $loc) : ?>
				<div id="" class="state_group">
				<h3><?php echo $loc->name ?></h3>
					<div class="region_group">
						<?php $count=0; ?>
						<?php foreach ($loc->places as $place) : // is this place a region or store? ?>
						
							<?php if (!empty($place->term_id)) : // it's a region ?>
								<div class="region_group">
								<h4 class="clear"><?php echo $place->name ?></h4> 
								<?php $count=0; ?>
								<?php foreach ($place->places as $store) : ?>
									<div class="location_item <?php echo (++$count % 2) ? "item1" : "item2"; ?>">
									<?php echo displaylocation($store); ?>
									<?php echo '</div>'; ?>
								<?php endforeach; ?>
								</div>
							<?php else : // it's a store ?>
								<div class="location_item <?php echo (++$count % 2) ? "item1" : "item2"; ?>">
									<?php echo displaylocation($place); ?>
								</div>
							<?php endif; ?>
						<?php endforeach ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="clear"></div>
	</div><!-- /.container -->
</div><!-- /#main -->
<?php get_footer(); ?> ?>