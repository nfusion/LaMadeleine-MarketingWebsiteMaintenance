<?php
/**
 * The template for displaying posts in the Image Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */
?>

<?php
$pageTitle = strtolower(get_the_title());
?>

<div id="mobile-nav">
    <a href="/stories/food" <?php if($pageTitle === 'food'){echo 'class="active"';}; ?>>
        <div class="nav-item">
            <div class="icon icon-food"></div>
            Food
        </div>
    </a>
    <a href="/stories/culture" <?php if($pageTitle === 'culture'){echo 'class="active"';}; ?>>
        <div class="nav-item">
            <div class="icon icon-culture"></div>
            Culture
        </div>
    </a>
    <a href="/stories/community" <?php if($pageTitle === 'community'){echo 'class="active"';}; ?>>
        <div class="nav-item">
            <div class="icon icon-community"></div>
            Community
        </div>
    </a>
    <a href="/stories" <?php if($pageTitle === 'stories'){echo 'class="active"';}; ?>>
        <div class="nav-item">
            <div class="icon icon-stories"></div>
            All Stories
        </div>
    </a>
</div>

<div class="post-box">

<?php

    $stories = process_stories($mypod);

    echo display_story_carousel($stories);

    // echo '<pre>';
    // print_r($stories);
    // echo '</pre>';

    foreach($stories as $story){

    		// echo '<pre>';
      //   print_r($story);
      //  	echo '</pre>';   
    }

?>

</div>

