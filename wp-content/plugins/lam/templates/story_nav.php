<div class="widget widget-story-nav">


    <?php

    foreach(array('food','culture','community') as $cat){
         //$cat = 'food';//strtolower(get_cat_name($cat));
        $mypods = pods('post')->find(array('limit' => 3, 'orderby' => 'date desc', 'where'=>"category.name='".$cat."'"));
        $stories = process_stories($mypods);

        foreach($stories as $story){
          
            $stories_by_cat[$cat][]= array('title'=>$story['title'], 'permalink'=>$story['permalink']);
        }

    }

    // echo"<pre>";
     // print_r($stories_by_cat);
     // die();
?>

	<h2>La Madeleine Stories</h2>
  
  	<div class="cat-wrapper">
        <a href='/stories/food' class="story-nav-link category-food">
	  	<div class="icon icon-food"></div>
	  	<div class="text-wrapper">
	  		<div class="cat-name">Food</div>
	  		<div class="cat-desc">Behind the scenes of delicious dishes.</div>
	  	</div>
        </a>
        <ul class='categories'> 
        <?php 
            foreach($stories_by_cat['food'] as $story){
                ?>
                    <li><a href="<?php echo $story['permalink'] ?>"><?php echo   $story['title'] ?></a> </li>
                <?php
            }
        ?>
        </ul>
	  </div>
  
  
  	<div class="cat-wrapper">
        <a href='/stories/culture' class="story-nav-link category-culture">
	  	<div class="icon icon-culture"></div>
	  	<div class="text-wrapper">
	  		<div class="cat-name">Culture</div>
	  		<div class="cat-desc">Our philosophy, heritage and future.</div>
	  	</div>
        </a>
        <ul>
            <?php 
                foreach($stories_by_cat['culture'] as $story){
                    ?>
                        <li><a href="<?php echo $story['permalink'] ?>"><?php echo   $story['title'] ?></a> </li>
                    <?php
                }
            ?>
            </ul>
	  </div>
  
  
  	<div class="cat-wrapper">
        <a href='/stories/community' class="story-nav-link category-community">
	  	<div class="icon icon-community"></div>
	  	<div class="text-wrapper">
	    	<div class="cat-name">Community</div>
	    	<div class="cat-desc">Working together to make a difference.</div>
	    </div>
        </a>
        <ul>
            <?php 
                foreach($stories_by_cat['community'] as $story){
                    ?>
                        <li><a href="<?php echo $story['permalink'] ?>"><?php echo   $story['title'] ?></a> </li>
                    <?php
                }
            ?>
            </ul>
	  </div>

  <a href='/stories' class="story-nav-link stories">
  	<div class="cat-wrapper">
	  	<div class="icon icon-stories"></div>
	  	<div class="text-wrapper">
	    	<div class="cat-name">Stories</div>
	    	<div class="cat-desc">Un m&eacute;lange de la Madeleine.</div>
	    </div>
	  </div>
  </a>
</div>