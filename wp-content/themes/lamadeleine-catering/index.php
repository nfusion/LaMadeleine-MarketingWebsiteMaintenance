<?php require_once('header.php'); ?>
<?php include_once('js/trackingjs.html'); ?>

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
		<div id="content">
			<a href="http://order.cateringbylamadeleine.com/" id="splat"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/orderonline.png" alt="Online Ordering Now Available!" /></a>
			<div id="splat2">or call 800-96-LAMAD</div>
			<h1><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/headline.png" alt="delight your guests with catering by la madeleine for any occasion" /></h1>
			<img id="tarts" src="<?php echo get_stylesheet_directory_uri(); ?>/img/tarts.png" alt="Delicious Tarts" />
			<div id="content_left">
				<p>Serving la Madeleine® instantly makes your event something special. It’s fast, it’s easy, and the only thing that will look better than our signature sandwiches, soupes and salades, or our fresh, handcrafted pastries and desserts, is you. Whether you’re hosting an office lunch or a party, serving la Madeleine® will delight your guests with country French charm and flavor.</p>
				<div class="catering_block">
					<p>Catering Menu - <a href="/menu">View</a> / <a target="_blank" href="/assets/LAMAD_8957_4_mch_mnu_catering_ForWeb.pdf">Download</a><br />
						<a href="http://order.cateringbylamadeleine.com/">Click Here to Order for Your Event</a><br />
						<span style="font-weight:normal;">OR CALL 800-96-LAMAD (800-965-2623)</span></p>
				</div>
				<h5>Questions?</h5>
				<p><a href="/faqs">Get answers here</a>, or call the number above and we’ll be glad to help.</p>
				<p class="social_links"><a class="facebook" href="http://www.facebook.com/laMadeleineCafe">&nbsp;</a><a class="twitter" href="http://twitter.com/lamadeleine">&nbsp;</a><a class="pinterest" href="http://pinterest.com/lamadeleinecafe/">&nbsp;</a></p>
			</div>
		</div>
		<div id="location_list">
			<h2><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/locations-headline.png" alt="Find your la Madeleine café" /></h2>
			<?php echo $locations; ?>
		</div>
		<div class="clear"></div>
	</div><!-- /.container -->
</div><!-- /#main -->
<?php require_once('footer.php'); ?>