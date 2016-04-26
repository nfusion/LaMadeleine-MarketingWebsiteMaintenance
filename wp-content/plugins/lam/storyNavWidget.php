<?php
/*
Plugin Name: La Madeleine Story Navigation Widget
Plugin URI: http://lamadeleine.com
Description: Nav For the Stories 
Author: Christian Serna 
Version: 1
Author URI: http://nfusion.com
*/




/**
 * LAM Location Widget Class
 */
class story_nav_widget extends WP_Widget 
{
    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        parent::__construct(
            'story_nav_widget', // Base ID
            __('La Madeleine - Story Navigation', 'lam')
        );
    }

    public function widget($args, $instance)
    {
        include( dirname(__FILE__) .'/templates/story_nav.php');        
    }



}

    // register example widget
    add_action('widgets_init', create_function('', 'return register_widget("story_nav_widget");'));




