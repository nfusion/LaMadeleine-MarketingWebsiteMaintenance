<?php
/**
 * The template for displaying the homepage
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */

    /** lets loop through the page content Items ***/

    echo <<<EOT
    <div id="mobile-location"></div>
    <div id="carousel" class="swipe">
        <div class="swipe-wrap">
EOT;

    while( $mypod->fetch() ) {
        
        foreach (array('ID','title','description', 'url', 'cta', 'new_window') as $key => $value) {
             $item[$value] = $mypod->field($value);
        }
        $item['featured_img'] =  get_the_post_thumbnail( $mypod->id(), 'fma-full');
        $linkTarget = ($item['new_window'] == 1 ? '_blank' : '_self'); 
       
            echo <<<EOT
            <div class="carousel-item">
                <div>{$item['featured_img']} </div>
                <div class="carousel-text">
                    <h1>{$item['title']}</h1>
                    <p class="subhead">{$item['description']}</p>
                    <p><a class="btn" target="$linkTarget" href="{$item['url']}">{$item['cta']}</a></p>
                </div>
            </div>
EOT;
    }

        echo '</div>
        <div class="carousel-controls">
            <div class="control prev">
                <div class="icon icon-arrow-left-large"></div>
            </div>
            <div class="control next">
                <div class="icon icon-arrow-right-large"></div>
            </div>
        </div>
        <div class="carousel-paginate">';
        for($i = 0; $i < $mypod->total(); $i++){
            if($i == 0){
                $dotClasses = 'active dot dot-' . $i;
            }
            else{
                $dotClasses = 'dot dot-' . $i;
            }
            echo '<div class="' . $dotClasses . '" data-order="' . $i . '"></div>';
        };
        echo '</div></div>';
