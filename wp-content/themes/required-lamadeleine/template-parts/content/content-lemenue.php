<?php
/**
 * The template for displaying menues
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */

    
    $menuArray  = process_menu($mypod,$pageDetails['title']);
?>

<H2><?php echo $pageDetails['title'] ?></H2>

<?php

   // echo "<pre>";
   // print_r($menuArray);

   //  die();


    foreach ($menuArray as $category => $menu) {
    ?>

         <h3><?php echo $category ?></h3>

        The Feature Item : <br>
        <pre>
        <?php print_r($menu['featured']) ?>
        </pre>
        <hr>
        The Items for <?php echo $category ?>: <br>
        <pre>
        <?php print_r($menu['items']) ?>
        </pre>
    



    <?php 
    } // End of the $menuArray (full menu object) for each
