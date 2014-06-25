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

    foreach(array('community','culture', 'food') as $catName){

        ?>
        <h2> <?php echo $catName ?> </h2>
        <?php


        $args = array(  'category' => get_cat_ID( $catName )  );

        $myposts = get_posts( $args );
        foreach ( $myposts as $post ) { 
             echo"<pre>";
             print_r($post); 
             echo"</pre>";
        }
        
        wp_reset_postdata();
    }

?>

</div>

