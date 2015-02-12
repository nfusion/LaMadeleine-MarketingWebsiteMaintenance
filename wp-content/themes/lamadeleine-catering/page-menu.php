<?php
// args
$args = array(
'numberposts' => -1,
'post_type' => 'menu_items'
);
// get results
$the_query = new WP_Query( $args );
?>
<?php get_header(); ?>
<div id="main" role="document">
    <div class="container">
        <div id="menu_wrapper">
            <div id="menu_nav">
                <ul>
                    <li><a href="#breakfast">Breakfast</a></li>
                    <li><a href="#sandwiches">Sandwiches</a></li>
                    <li><a href="#boxes">bistro box lunches</a></li>
                    <li><a href="#salades">salades</a></li>
                    <li><a href="#entrees">entrées</a></li>
                    <li><a href="#pastas">pastas</a></li>
                    <li><a href="#soupes">soupes</a></li>
                    <li><a href="#a-la-carte">à la carte</a></li>
                    <li><a href="#beverages">beverages</a></li>
                    <li><a href="#pastries-desserts">pastries & desserts</a></li>
                    <li class="nav_download"><a href="http://order.cateringbylamadeleine.com">Click to<br />Order Online</a></li>
                </ul>
            </div>
            <!--//The Loop -->
            <?php while ( have_posts() ) : the_post(); ?>
            <div id="menu_content">
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header><!-- .entry-header -->
                    <div class="entry-content">

                        <?php the_content(); ?>
                        </div><!-- .entry-content -->
                        <div id="menu">
                            <div class="menu_group" id="breakfast">
                                <h2>bakery collections</h2>
                                <?php if( $the_query->have_posts() ): ?>
                                
	                                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	                                
	                                <div class="menu_item">

	                                	<!-- menu item title -->
	                                    <h3><?php the_title(); ?></h3>
										
										<!-- menu item content -->
	                                    <?php the_content(); ?>

	                                    <p><small>SMALL VAR HERE&nbsp;<span>$<?php the_field('small_size_price'); ?></span>&nbsp;MEDIUM VAR HERE <span>&nbsp;$<?php the_field('medium_size_price'); ?></small></p>
	                                </div>
	                                
	                                <?php endwhile; ?>

                                <?php endif; ?>
                                <?php wp_reset_query(); //reset query?>
                            </div>
                            <p><small>*contains nuts | ** contains alcohol | items may vary by location</small></p>
                        </div>
                        <div class="catering_block">
                            <p class="center"><a href="#">Back To Top</a>
                            <a target="_blank" href="/assets/LAMAD_8957_4_mch_mnu_catering_ForWeb.pdf">DOWNLOAD CATERING MENU</a></p>
                        </div>
                    </div>
                    <?php endwhile; // end of the loop. ?>
                </div>
                <div class="clear"></div>
</div><!-- /.container -->
</div><!-- /#main -->
<?php get_footer(); ?>