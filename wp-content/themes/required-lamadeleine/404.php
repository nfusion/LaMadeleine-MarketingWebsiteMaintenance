<?php
/**
 * Template Name: Page Single
 * Description: Single page layout
 *
 */

get_header(); 

?>

	<div id="content" class="page-single">

		<div id="main" role="main">
			<div class="post-box has-padding">

				<h2>D&eacute;sol&eacute;, the page you requested was not found.</h2>

				<p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>

				<p>Please try the following:</p>
				<ul class="has-margin">
					<li><p>Check your spelling</p></li>
					<li><p>Return to the <a href="/">home page</a></p></li>
					<li><p>Click your browser's back button</p>
				</li>
			</div>
		</div><!-- /#main -->

		<aside id="sidebar" class="four columns" role="complementary">

			<div class="sidebar-wrapper">

				<?php 
					dynamic_sidebar('sidebar-home'); 

					echo display_promo($promo, 'widget');
				?>

			</div>

		</aside><!-- /#sidebar -->

	</div><!-- End Content row -->

<?php get_footer(); ?>
