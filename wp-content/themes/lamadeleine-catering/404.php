<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.2.0
 */

get_header(); ?>

	<!-- Row for main content area -->
	<div id="content" class="row">

		<div id="main" class="twelve columns" role="main">
			<div class="post-box">

				<article id="post-0" class="post error404 not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( '404 &mdash; Quel dommage!', 'requiredfoundation' ); ?></h1>
					</header>

					<div class="entry-content">
						<div class="row">
							<div class="twelve columns">
								<div class="panel">
									<p class="lead"><?php _e( 'The page you are looking for is <em>perdu</em>. Perhaps one of the links below will get you back on track.', 'requiredfoundation' ); ?></p>
									<?php //get_search_form(); ?>
									<div style="font-size:130%;">
										<?php wp_nav_menu( array('theme_location' => 'left-menu', 'depth'=>1) ); ?>
										<?php wp_nav_menu( array('theme_location' => 'right-menu') ); ?>
									</div>
								</div>
							</div>
						</div>
		
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
			</div>
		</div>
	</div>
<?php get_footer(); ?>