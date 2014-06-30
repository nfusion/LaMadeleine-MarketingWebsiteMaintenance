<?php
/**
 * The template for displaying all single posts.
 *
 * This is the template that displays all single posts by default.
 * Please note that this is the WordPress construct of posts
 * and that other 'posts' on your WordPress site will use a
 * different template.
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.3.0
 */

get_header(); 


 		 $id = $wp_query->post->ID;
		 $mypods = pods('post')->find(array('limit' => 0, 'where'=>"d.id=".$id));
		 $stories = process_stories($mypods);

    

    foreach($stories as $story){
        echo '<pre>';
        print_r($story);
        
       
    }

?>
	

<?php get_footer(); ?>