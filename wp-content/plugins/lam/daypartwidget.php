<?php
/*
Plugin Name: La Madeleine Dayparts Widget
Plugin URI: http://lamadeleine.com
Description: Daypart Ordering Widget
Author: Christian Serna 
Version: 1
Author URI: http://nfusion.com
*/




/**
 * La Mdeleine Daypart Widget Class
 */
class dayparts_widget extends WP_Widget 
{
    
    protected $dayPartPods;


    /** constructor */
    public function dayparts_widget() 
    {
        parent::WP_Widget(false, $name = 'La Madeleine - Daypart Widget');
    }

    public function widget($args, $instance)
    {   
        $this->callTemplate($instance);
        
    }


    public function form($instance){
        $defaults = array('title'=>'');
        $instance = wp_parse_args( (array) $instance, $defaults ); 

        ?>
        <fieldset>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?> " value="<?php echo $instance['title'] ?>" size="20"> </p>

        </fieldset>
        <?php
    }

    function update ($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = $new_instance['title'];
      return $instance;
    }

    
    private function callTemplate(array $vars){
        foreach ($vars as $key => $value) {
            $$key = $value;
        }

        include( dirname(__FILE__) .'/templates/daypart.php'); 
    }

}

    // register example widget
    add_action('widgets_init', create_function('', 'return register_widget("dayparts_widget");'));