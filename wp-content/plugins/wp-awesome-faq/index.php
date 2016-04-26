<?php
/*
Plugin Name: WP Awesome FAQ
Plugin URI: https://jeweltheme.com/product/wordpress-faq-plugin/
Description: Accordion based Awesome WordPress FAQ Plugin
Version: 4.0.2
Author: Liton Arefin
Author URI: https://jeweltheme.com
License: GPL2
http://www.gnu.org/licenses/gpl-2.0.html
*/

//Custom FAQ Post Type 
function jeweltheme_wp_awesome_faq_post_type() {
    $labels = array(
        'name'               => _x( 'FAQ', 'post type general name' ),
        'singular_name'      => _x( 'FAQ', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'book' ),
        'add_new_item'       => __( 'Add New FAQ' ),
        'edit_item'          => __( 'Edit FAQ' ),
        'new_item'           => __( 'New FAQ Items' ),
        'all_items'          => __( 'All FAQ\'s' ),
        'view_item'          => __( 'View FAQ' ),
        'search_items'       => __( 'Search FAQ' ),
        'not_found'          => __( 'No FAQ Items found' ),
        'not_found_in_trash' => __( 'No FAQ Items found in the Trash' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'FAQ'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds FAQ specific data',
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'query_var'     => true,
        'rewrite'       => array('slug' => 'faq'),
        'capability_type'=> 'post',
        'has_archive'   => true,
        'hierarchical'  => false,
        'menu_position' => 5,
        'supports'      => array( 'title', 'editor'),
        'menu_icon' => 'dashicons-welcome-write-blog'
    );

    register_post_type( 'faq', $args ); 

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name'              => _x( 'FAQ Categories', 'taxonomy general name' ),
            'singular_name'     => _x( 'FAQ Category', 'taxonomy singular name' ),
            'search_items'      =>  __( 'Search FAQ Categories' ),
            'all_items'         => __( 'All FAQ Category' ),
            'parent_item'       => __( 'Parent FAQ Category' ),
            'parent_item_colon' => __( 'Parent FAQ Category:' ),
            'edit_item'         => __( 'Edit FAQ Category' ),
            'update_item'       => __( 'Update FAQ Category' ),
            'add_new_item'      => __( 'Add New FAQ Category' ),
            'new_item_name'     => __( 'New FAQ Category Name' ),
            'menu_name'         => __( 'FAQ Category' ),
        );
    
        register_taxonomy('faq_cat',array('faq'), array(
            'hierarchical' => true,
            'labels'       => $labels,
            'show_ui'      => true,
            'query_var'    => true,
            'rewrite'      => array( 'slug' => 'faq_cat' ),
        ));
}

add_action( 'init', 'jeweltheme_wp_awesome_faq_post_type' );

function jeweltheme_wp_awesome_faq_enqueue_scripts(){
     if(!is_admin()){
        wp_register_style('jeweltheme-jquery-ui-style',plugins_url('/jquery-ui.css', __FILE__ ));
        wp_enqueue_style('jeweltheme-jquery-ui-style');
        wp_enqueue_style('dashicons');
        wp_enqueue_script('jquery-ui-accordion');
    }   
}
add_action( 'init', 'jeweltheme_wp_awesome_faq_enqueue_scripts' );


//Option Based Script Loads FAQ
function jeweltheme_wp_awesome_faq_accordion_scripts() {
?>
<script type="text/javascript">
<?php $faq_layout = get_option('jeweltheme_faq_collapse'); 

//print_r($faq_layout['layout']);
?>
<?php if( $faq_layout['layout'] == "1st Item Open"){ ?>
    jQuery(document).ready(function($) {
        jQuery(".accordion").accordion({heightStyle: "content", collapsible: true, active: 0});
    });
<?php } ?>

<?php if( $faq_layout['layout'] == "Close All"){ ?>
    jQuery(document).ready(function($) {
            jQuery(".accordion").accordion({heightStyle: "content", collapsible: true, active: false});
    });
<?php } ?>

<?php if( $faq_layout['layout'] == "Open All"){ ?>
    jQuery(document).ready(function($) {
        jQuery('.ui-accordion-header').removeClass('ui-corner-all').addClass('ui-accordion-header-active ui-state-active ui-corner-top').attr({
            'aria-selected': 'true',
            'tabindex': '0'
        });
    });
<?php } ?>
    
</script>
<?php
}
add_action( 'wp_head', 'jeweltheme_wp_awesome_faq_accordion_scripts', 9999 );


function jeweltheme_wp_awesome_faq_shortcode($atts, $content= null) { 
    
    extract( shortcode_atts(
        array(
           'id' => '',
            'content'  => '',
            "cat_id" => '',
            "image" => '',
            ), $atts )
    );


    // WP_Query arguments
    if( $cat_id == '' ) :
        $args = array (
            'posts_per_page'        => -1,
            'post_type'             => 'faq',
            'p'                     => $id,
            'order' =>"DESC"
            );
    else:
        $args = array (
            'posts_per_page'        => -1,
            'post_type'             => 'faq',
            'p'                     => $id,
            'tax_query' => array(
                array(
                    'taxonomy' => 'faq_cat',
                    'field'    => 'id',
                    'terms'    => array( $cat_id ),
                    ),
                ),

            'order' =>"DESC"
            );
    endif;

    $query = new WP_Query( $args );

    ob_start();

    global $faq;

    $count = 0; 
    $accordion = 'accordion-' . time() . rand();

    ?>
        <div class="accordion" id="<?php echo $accordion .  $count;?>">
            <?php if( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>

                <h3><?php the_title();?></h3>
                <div>
                <?php if($image) echo "<img src='" . $image ."'>"; ?>
                    <?php the_content();?>
                </div>    

                <?php } //end while
            } ?>
        </div>
    <?php
        //Reset the query
    wp_reset_query();
    wp_reset_postdata();
        $output = ob_get_contents(); // end output buffering
        ob_end_clean(); // grab the buffer contents and empty the buffer
        return $output;
}
add_shortcode('faq', 'jeweltheme_wp_awesome_faq_shortcode');




/* Display a notice that can be dismissed */

add_action('admin_notices', 'jeweltheme_wp_awesome_faq_admin_notice');

function jeweltheme_wp_awesome_faq_admin_notice() {
    global $current_user ;
        $user_id = $current_user->ID;
    if ( ! get_user_meta($user_id, 'jeweltheme_ignore_notice') ) {
        echo '<div class="updated"><p>';         
        printf(__('<h4 style="font-size: 20px; color: #5FA52A; font-weight: normal; margin-bottom: 10px; margin-top: 5px;"><a href="http://jeweltheme.com/product/wp-awesome-faq-pro/" target="_blank">Get WP Awesome FAQ PRO Today!</a></h4>Check out Premium Features of <a href="http://jeweltheme.com/product/wp-awesome-faq-pro/" target="_blank">WP Awesome FAQ</a> Plugin. Compare Why this Plugin is really awesome !!! <br>
            Jewel Theme, always express the power of WordPress. We are one of the best Team for creating stunning WordPress Themes - Plugins and Website Templates. <br>
            Check all of our <a href="http://jeweltheme.com/product-category/wordpress-themes/" target="_blank">Free and Premium WordPress Themes</a> and <a href="http://jeweltheme.com/product-category/wordpress-plugins/" target="_blank">WordPress Plugins </a> <a style="float: right;" href="%1$s">X</a>'), '?jeweltheme_ignore=0');
        echo "</p></div>";
    }
}
add_action('admin_init', 'jeweltheme_wp_awesome_faq_ignore');


function jeweltheme_wp_awesome_faq_ignore() {
    global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['jeweltheme_ignore']) && '0' == $_GET['jeweltheme_ignore'] ) {
             add_user_meta($user_id, 'jeweltheme_ignore_notice', 'true', true);
    }
}





// Manage Category Shortcode Columns
add_filter("manage_faq_cat_custom_column", 'jeweltheme_wp_awesome_faq_cat_columns', 10, 3);
add_filter("manage_edit-faq_cat_columns", 'jeweltheme_wp_awesome_faq_cat_manage_columns'); 
 
function jeweltheme_wp_awesome_faq_cat_manage_columns($theme_columns) {
    $new_columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name'),
            'faq_category_shortcode' => __( 'Category Shortcode', 'jeweltheme' ),
            'slug' => __('Slug'),
            'posts' => __('Posts')
        );
    return $new_columns;

}


function jeweltheme_wp_awesome_faq_cat_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'faq_cat');
    switch ($column_name) {
        
        case 'title':
            echo get_the_title();
        break;

        case 'faq_category_shortcode':             
             echo '[faq cat_id="' . $theme_id. '"]';
        break;
 
        default:
            break;
    }
    return $out;    
}






add_action('admin_head', 'jeweltheme_wp_awesome_faq_tinymce_button');

function jeweltheme_wp_awesome_faq_tinymce_button() {
    global $typenow;
    
    // check user permissions
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
    return;
    }
    
    // verify the post type
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;

    // check if WYSIWYG is enabled
    if ( get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "jeweltheme_wp_awesome_faq_tinymce_plugin");
        add_filter('mce_buttons', 'jeweltheme_wp_awesome_faq_register_tinymce_button');
    }
}

function jeweltheme_wp_awesome_faq_tinymce_plugin($plugin_array) {
    $plugin_array['jeweltheme_faq_button'] = plugins_url( '/editor-button.js', __FILE__ ); 
    return $plugin_array;
}

function jeweltheme_wp_awesome_faq_register_tinymce_button($buttons) {
   array_push($buttons, "jeweltheme_faq_button");
   return $buttons;
}

function admin_inline_js(){ ?>
    <style>
        i.mce-ico.mce-i-faq-icon {
            background-image: url('<?php echo  plugins_url( 'icon.png', __FILE__ );?>');
        }
    </style>
<?php }
add_action( 'admin_print_scripts', 'admin_inline_js' );







//WP Awesome FAQ Settings Fields

add_action('admin_menu', 'jeweltheme_wp_awesome_faq_options');
add_action('admin_init', 'jeweltheme_wp_awesome_faq_settings_store');

//Add options page 
function jeweltheme_wp_awesome_faq_options() {
    add_submenu_page( 'edit.php?post_type=faq', esc_html__('WP Awesome FAQ Admin Options', 'jeweltheme'), esc_html__('FAQ Settings', 'jeweltheme'), 'edit_posts', 'faq_options', 'jeweltheme_wp_awesome_faq_setting_functions');

   register_setting( 'faq_settings', 'plugin_options' );
}

//Register Settings Page
function jeweltheme_wp_awesome_faq_settings_store() {
    register_setting('jeweltheme_faq_settings', 'jeweltheme_faq_collapse');   
}

function jeweltheme_wp_awesome_faq_setting_functions(){
    ?>
        <div class="wrap">
       <div class="icon32" id="icon-options-general"><br></div>
        <h2><?php echo esc_html__('WP Awesome FAQ Settings', 'jeweltheme');?></h2>
     <p><?php echo esc_html__('Settings sections for WP Awesome FAQ Options', 'jeweltheme');?></p>
       <form method="post" action="options.php">

            <?php settings_fields('jeweltheme_faq_settings'); ?>
                <table class="form-table">       

            <tr><th>
                <label><?php echo esc_html__('Collapse/Toggle Options', 'jeweltheme');?></label>
            </th><td>
            <?php 
                $options = get_option('jeweltheme_faq_collapse');
                $items = array("Close All", "Open All","1st Item Open");
                echo "<select id='layout' name='jeweltheme_faq_collapse[layout]'>";
                foreach($items as $item) {
                    $selected = ($options['layout']==$item) ? 'selected="selected"' : '';
                    echo "<option value='$item' $selected>$item</option>";
                }
                echo "</select>";
            ?>
            </td></tr>


        <tr><td>
            <input type="submit" class="button-primary" value="Save Changes" />
        </td></tr>

            </table>
        </form>

<?php
}
