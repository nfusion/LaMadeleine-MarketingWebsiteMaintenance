<?php
/**
 * The template for displaying menues
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 */
    
$menuArray  = process_menu($mypod,$pageDetails['daypartTitle']);

?>

<div id="mobile-nav">
    <a href="/breakfast" <?php if($pageDetails['title'] === 'breakfast'){echo 'class="active"';}; ?>>
        <div class="nav-item">
            <div class="icon icon-breakfast"></div>
            Breakfast
        </div>
    </a>
    <a href="/lunch" <?php if($pageDetails['title'] === 'lunch'){echo 'class="active"';}; ?>>
        <div class="nav-item">
            <div class="icon icon-lunch"></div>
            Lunch
        </div>
    </a>
    <a href="/dinner" <?php if($pageDetails['title'] === 'dinner'){echo 'class="active"';}; ?>>
        <div class="nav-item">
            <div class="icon icon-dinner"></div>
            Dinner &amp; Wine
        </div>
    </a>
    <a href="/bakery" <?php if($pageDetails['title'] === 'bakery'){echo 'class="active"';}; ?>>
        <div class="nav-item">
            <div class="icon icon-bakery"></div>
            Bakery
        </div>
    </a>
</div>

<div class="menu-overview">
    <?php while ( have_posts() ) : the_post(); ?>

        <div class="menu-featured-image">
            <?php the_post_thumbnail('menu-featured'); ?>
        </div>
        
        <h1 class="menu-title"><span class="outer"><span class="inner"><?php the_title();?></span></span></h1>
        
        <div class="menu-text">
            <?php the_content(); ?>
        </div>
    <?php endwhile; // end of the loop. ?>
</div>

<div class="menu-details">

    <div class="row menu-links">
        <div class="four columns set-location">
            <a class="mobile-btn-link get-location" href="/locations">Choose a Location for Menu Pricing</a>
        </div>
        <div class="four columns">
            <a target="_blank" class="mobile-btn-link" href="http://www.nutritionix.com/la-madeleine/portal">Get Nutritional Information</a>
        </div>
        <div class="four columns">
            <a target="_blank" class="mobile-btn-link" href="https://online.lamadeleine.com/">Place an Order Online, S'il Vous Pla&icirc;t</a>
        </div>
    </div>

    <?php

        // Used to track odd/even category in iteration and adjust layout accordingly
        $categoryCount = 0;

        // Iterate through menu results
        foreach ($menuArray as $menu) {

            if(count($menu) > 0) :
                
            ?>
            
                <!-- <pre>
                <?php // print_r($menu) ?>
                </pre> -->

                <?php 

                // Determine if odd or even iteration to alternate menu category layout
                if ($categoryCount % 2 == 0) :
                    // Featured image appears at top of left column
                    $layout = 'left';
                else :
                    // Featured image appears at top of right column
                    $layout = 'right';
                endif;

                // Display menu category, pass menu object and layout identifier
                echo display_menu_category($menu,$layout);

                // Increment category count
                $categoryCount++;

            endif;

        } // End of the $menuArray (full menu object) for each
    ?>
</div>