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
        <div class="menu-title">
            <h1><?php the_title();?></h1>
        </div>
        <div class="menu-text">
            <?php the_content(); ?>
        </div>
    <?php endwhile; // end of the loop. ?>
</div>

<div class="menu-details">
    <?php
        foreach ($menuArray as $category => $menu) {
    ?>

        <h3><?php echo $category ?></h3>

        The Feature Item : <br>
        
        <?php print_r($menu['featured']) ?>
        
        <hr>
        The Items for <?php echo $category ?>: <br>
        
        <?php print_r($menu['items']) ?>

    <?php 
        } // End of the $menuArray (full menu object) for each
    ?>
</div>
