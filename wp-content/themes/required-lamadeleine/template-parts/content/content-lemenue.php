<?php
/**
 * The template for displaying menues
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */
    
$menuArray  = process_menu($mypod,$pageDetails['title']);

?>

<!-- <H2><?php // echo $pageDetails['title'] ?></H2>
 -->

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
    <?php

        // Used to track odd/even category in iteration and adjust layout accordingly
        $categoryCount = 0;

        // Iterate through menu results
        foreach ($menuArray as $menu) {

            if ($categoryCount % 2 == 0) : 
                $layout = 'left'; 
            else : 
                $layout = 'right'; 
            endif;

            echo displayMenuCategory($menu,$layout);

            if(count($menu) > 0) :
                echo '<hr class="dashed">';
            endif;

            // Increment category count
            $categoryCount++;

        } // End of the $menuArray (full menu object) for each
    ?>
</div>