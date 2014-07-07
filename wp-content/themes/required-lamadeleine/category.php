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

get_header();
	
$cat = strtolower(get_cat_name($cat));
$mypods = pods('post')->find(array('limit' => 0, 'where'=>"category.name='".$cat."'"));
$stories = process_stories($mypods);

?>

<div id="content" class="<?php echo $pagename; ?>">
	<div id="main" role="main">
		<div class="post-box">

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

<?php

		echo display_story_carousel($stories);

		// foreach($stories as $key => $story){
		    
		// }

?>

			</div>
		</div><!-- /#main -->

		<aside id="sidebar" role="complementary">
			<div class="sidebar-wrapper">
				<?php 
					dynamic_sidebar('sidebar-story');

					// Get the pods content for page ID 201 (stories index)
					$podPage = pods('page', 201);

					// Get promo relationship field
					$promo = $podPage->field('fma_promo');

					// Display promo markup
					echo display_promo($promo, 'widget');
				?>
			</div>
		</aside><!-- /#sidebar -->

	</div><!-- End Content row -->

<?php get_footer(); ?>