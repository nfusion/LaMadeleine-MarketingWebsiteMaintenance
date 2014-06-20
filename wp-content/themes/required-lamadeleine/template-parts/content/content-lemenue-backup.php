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
        $categoryCount = 1;

        // Iterate through menu results
        foreach ($menuArray as $menu) {    

            // This category's name
            $categoryName = $menu['items'][0]['menu_category']['name'];

            // This category's total number of menu items
            $totalMenuItems = count($menu['items']);

            // Start new menu category row
            echo '<div clas="row">';

            // Alternate between left/right menu category layout
            // If category count is odd number use layout 1, else use layout 2
            if ($categoryCount % 2 == 1) : ?>
                <div class="six columns">
                    <?php
                        // Iterate through first half of total menu items
                        for($i = 0; $i < ($totalMenuItems / 2); $i++){ 
                            // This menu item
                            $item = $menu['items'][$i];

                            // Count menu item keys
                            $keyLength = count($item['menu_key_relationship']);

                            // Echo menu item wrapper
                            echo '<div class="menu-item">';
                       
                            // Echo menu item title
                            echo '<div class="title-wrapper"><p class="title">' . $item['title'] . '</p>';

                            // If there are menu keys assigned with this item display associated icons
                            if($keyLength > 0){
                                echo '<div class="menu-keys">';
                                // Iterate through menu item keys
                                foreach($item['menu_key_relationship'] as $menuKey){
                                    // Echo this menu item key
                                    echo '<span class="icon icon-legend-' . $menuKey['slug'] . '"></span>';
                                }
                                echo '</div>';
                            };

                            // Closing .title-wrapper
                            echo '</div>';

                            // Echo menu item description
                            echo '<p class="desc">' . $item['description'] . '</p>';

                            // Closing .menu-item
                            echo '</div>';
                        };
                    ?>
                </div>
                <div class="six columns">
                    <div class="menu-item">
                        <?php
                            // Iterate through second half of total menu items
                            for($i = ($totalMenuItems / 2); $i < $totalMenuItems; $i++){
                                // This menu item
                                $item = $menu['items'][$i];

                                // Count menu item keys
                                $keyLength = count($item['menu_key_relationship']);

                                // Echo menu item wrapper
                                echo '<div class="menu-item">';
                           
                                // Echo menu item title
                                echo '<div class="title-wrapper"><p class="title">' . $item['title'] . '</p>';

                                // If there are menu keys assigned with this item display associated icons
                                if($keyLength > 0){
                                    echo '<div class="menu-keys">';
                                    // Iterate through menu item keys
                                    foreach($item['menu_key_relationship'] as $menuKey){
                                        // Echo this menu item key
                                        echo '<span class="icon icon-legend-' . $menuKey['slug'] . '"></span>';
                                    }
                                    echo '</div>';
                                };

                                // Closing .title-wrapper
                                echo '</div>';

                                // Echo menu item description
                                echo '<p class="desc">' . $item['description'] . '</p>';

                                // Closing .menu-item
                                echo '</div>';

                            };
                        ?>
                    </div>
                </div>
            <?php else : ?>
                <h3>EVEN!</h3>
            <?php
            endif;

            // End menu category row
            echo '</div>';
        ?>

        <h3><?php echo $categoryName; ?></h3>

        <!-- <h5>The Featured Item:</h5>
        
        <pre>
        <?php // print_r($menu['featured']) ?>
        </pre> -->

        <!-- <h5>The Items:</h5> -->
        
        <pre>
        <?php //print_r($menu['items']) ?>
        </pre>

        <hr class="dashed">

    <?php 

        // Increment category count
        $categoryCount++;
        } // End of the $menuArray (full menu object) for each
    ?>
</div>
