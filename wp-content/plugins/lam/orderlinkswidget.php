<?php
/*
Plugin Name: La Madeleine Order Links Widget
Plugin URI: http://lamadeleine.com
Description: Dynamically determines To Go and Catering links by location.
Author: Katherine White 
Version: 1.1
Author URI: http://nfusion.com
*/


// Creating the widget 
class lam_orderlinks_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'lam_orderlinks', 

        // Widget name will appear in UI
        __('Order Links Widget', 'lam_widget_domain'), 

        // Widget description
        array( 'description' => __( 'Dynamically determines To Go and Catering links by location.', 'lam_widget_domain' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $toGoUrl = 'https://order.lamadeleine.com/index.cfm?fuseaction=order&action=preorder&isToGo=1';
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output
        echo '<div class="textwidget">';
        echo '<div class="btn-wrapper">';
        echo '<a class="btn order-online" target="_blank" href="'. $toGoUrl .'">To Go</a>';
        echo '<a class="btn" target="_blank" href="http://cateringbylamadeleine.com">Catering</a>';
        echo '</div></div>';

        echo $args['after_widget'];
    }
            
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = '';
        }
        // Widget admin form
    ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here

// Register and load the widget
function lam_orderlinks_load_widget() {
    register_widget( 'lam_orderlinks_widget' );
}
add_action( 'widgets_init', 'lam_orderlinks_load_widget' );

add_filter('dynamic_sidebar_params', 'lam_orderlinks_styling'); 

function lam_orderlinks_styling($params){
    //print_r($params);
    if ($params[0]['widget_name'] == "Order Links Widget"){ //make sure its your widget id here
        // its your widget so you add  your classes
        $addtl_classes = 'widget_text '; // make sure you leave a space at the end
        $addtl_classes = 'class=" '.$addtl_classes;
        $params[0]['before_widget'] = str_replace('class="',$addtl_classes,$params[0]['before_widget']);
    }
    return $params;
} 