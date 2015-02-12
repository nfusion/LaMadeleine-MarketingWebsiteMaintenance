<?php

$menu_categories = get_terms( 'menu_categories' );

// menu item args
$menu_items = array(
    'numberposts' => -1,
    'post_type' => 'menu_items',
);

// get menu items
$get_items = new WP_Query( $menu_items );

?>
<?php get_header(); ?>
<div id="main" role="document">
    <div class="container">
        <div id="menu_wrapper">
            <div id="menu_nav">
                <ul>
                <?php foreach ( $menu_categories as $category ) : ?>
                    <li><a href="#<?php echo $category->slug ?>"><?php echo $category->name ?></a></li>   
                <?php endforeach; ?>
                    <li class="nav_download"><a href="http://order.cateringbylamadeleine.com">Click to<br />Order Online</a></li>
                </ul>
            </div>
            <div id="menu_content">
            <!--//The Loop -->
            <?php while ( have_posts() ) : the_post(); ?>
            <?php // if this post has this term. ?>
                <?php print_r(has_term($category->term_id, 'menu_categories')); ?>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->
                <div class="entry-content">

                    <?php the_content(); ?>
                    </div><!-- .entry-content -->
                    <div id="menu">
                    <?php foreach ( $menu_categories as $category ) : ?>
                        <div class="menu_group" id="<?php echo $category->slug ?>">
                            <h2><?php echo $category->name ?></h2>
                            
                            <?php if( $get_items->have_posts() ): ?>
                                <?php while ( $get_items->have_posts() ) : $get_items->the_post(); ?>
                                <?php if ( has_term($category->term_id, 'menu_categories') ) :?>
                                <div class="menu_item">

                                    <h3><?php the_title(); //menu item title ?></h3>
									
                                    <?php if(get_field('description_header')) : ?>
                                        <h4><?php the_field('description_header'); // content description header ?></h4>
                                    <? endif; ?>
                                    
                                    <?php the_content(); //menu item content ?>

                                    <?php if(get_field('item_price')) : ?>
                                        <p><small><?php the_field('item_price'); // menu item quantity and price ?></small></p>
                                    <? endif; ?>
                                </div><!-- // end menu item -->
                                <?php endif; ?>
                                <?php endwhile; // end menu item loop ?>
                            <?php endif; //items have posts ?>
                            <?php wp_reset_query(); //reset query?>
                        </div>
                    <?php endforeach; // end category loop ?>
                    <p><small>*contains nuts | ** contains alcohol | items may vary by location</small></p>
                        </div>
                        <div class="catering_block menu-footer">
                            <p class="center"><a href="#">Back To Top</a></p>
                            <p><a target="_blank" href="<?php echo get_stylesheet_directory_uri(); ?>/LAMAD_8957_4_mch_mnu_catering_ForWeb.pdf">DOWNLOAD CATERING MENU</a></p>
                        </div>
            <?php endwhile; // end of the loop. ?>
            </div><!-- /menu-content -->
        </div>
        <div class="clear"></div>
</div><!-- /.container -->
</div><!-- /#main -->
<?php get_footer(); ?>