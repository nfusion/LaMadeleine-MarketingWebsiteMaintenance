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

<div class="post-box">

<?php

    $stories = process_stories($mypod);

    //print_r($stories);

    foreach($stories as $story){
        echo '<pre>';
        print_r($story);
        
       
    }

?>

</div>

