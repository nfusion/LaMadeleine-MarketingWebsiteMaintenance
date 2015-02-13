<?php
/*
Plugin Name: La Madeleine Location Widget
Plugin URI: http://lamadeleine.com
Description: Find Nearest Location Widget
Author: Christian Serna 
Version: 1
Author URI: http://nfusion.com
*/




/**
 * LAM Location Widget Class
 */
class location_widget extends WP_Widget 
{
    
   
    /** constructor */
    public function location_widget() 
    {
        parent::WP_Widget(false, $name = 'La Madeleine - Location Widget');
    }

    public function widget($args, $instance)
    {
         $this->callTemplate($instance);      
    }

    public function form($instance){
        $defaults = array('title'=>'', 'onLocationPage'=>'');
        $instance = wp_parse_args( (array) $instance, $defaults ); 
        ?>
        <fieldset>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?> " value="<?php echo $instance['title'] ?>" size="20"> </p>

        </fieldset>
        <fieldset>
            <label for="<?php echo $this->get_field_id('onLocationPage'); ?>">Used on Location Page?:</label>
            <input type="radio" name="<?php echo $this->get_field_name('onLocationPage') ?>" id="<?php echo $this->get_field_id('onLocationPage') ?> " value="true"  <?php echo $instance['onLocationPage'] == 'true' ? 'checked=checked': '' ?> >Yes 
            <input type="radio" name="<?php echo $this->get_field_name('onLocationPage') ?>" id="<?php echo $this->get_field_id('onLocationPage') ?> " value="false" <?php echo $instance['onLocationPage'] == 'false' ? 'checked=checked': '' ?> >No
        </fieldset>
        <?php
    }

    function update ($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = $new_instance['title'];
      $instance['onLocationPage'] = $new_instance['onLocationPage'];
      return $instance;
    }

    
    private function callTemplate(array $vars){
        foreach ($vars as $key => $value) {
            $$key = $value;
        }

        include( dirname(__FILE__) .'/templates/location.php'); 
    }



}

    // register example widget
    add_action('widgets_init', create_function('', 'return register_widget("location_widget");'));




