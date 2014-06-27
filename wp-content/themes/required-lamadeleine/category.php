<?php
/**
 * The template for displaying catagory  archives.
 *
 * This is the template that displays catagory  archives by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.3.0
 */

get_header();
	
		$cat =get_cat_name($cat);


		 $mypods = pods('post')->find(array('limit' => 0, 'where'=>"category.name='".$cat."'"));
		 $stories = process_stories($mypods);

    

    foreach($stories as $story){
        echo '<pre>';
        print_r($story);
        
       
    }

?>

<?php get_footer(); ?>