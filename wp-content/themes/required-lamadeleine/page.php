<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.3.0
 */

get_header(); ?>

	<div id="content" class="<?php echo $pagename; ?>">

		<div id="main" role="main">
			<div class="post-box">

				<?php
				$pageDetails = array();

				switch ($pagename){
					case'':

						$params = array(
					    'orderby' => 'order.meta_value ASC',
					    'limit' => '0'
						);

						$mypods = pods('home_fma')->find($params);
						$sidebar = 'sidebar-home';
						$pagename = 'home';
					break;
					
					case 'breakfast':
					case 'bakery':
					case 'lunch':
					case 'dinner':

						switch ($pagename){

							case 'breakfast':
								$daypartTitle = 'Breakfast';
								break;
							case 'bakery':
								$daypartTitle = 'Bakery';
								break;
							case 'lunch':
								$daypartTitle = 'Lunch';
								break;
							case 'dinner':
								$daypartTitle = 'Dinner & Wine';
								break;

						}

						//pods_cache_clear();
					$pageDetails['title']=$pagename;
					
					$key = 'menu_'.$pagename;
					$mypods = pods_cache_get( $key, '', function($key){
						$params = array(
						    //'where' => "daypart_relationship = 'Lunch'",
						    'orderby' => 'order_weight ASC',
						    'limit' => '0'
						);
						$mypods = pods('menu_item')->find($params);
						pods_cache_set ( $key, $mypods, '', $expires = 300);
						return $mypods;
					});

					
					
					$pageDetails['daypartTitle'] = $daypartTitle;
					$key2 = 'daypart_'.$daypartTitle;

					
					$daypart = pods_cache_get( $key2, '', function($key2){
						$params2 = array(
					    'where' => "t.post_title = '".$daypartTitle."'",
					    //'orderby' => 'order_weight ASC',
					    'limit' => '0'
						);

						$daypart = pods('daypart')->find($params2 );

						pods_cache_set ( $key2, $daypart, '', $expires = 300);
						
						return $daypart;
					});

					

					while( $daypart->fetch() ) {
						$pageDetails['foodCats'] = $daypart->field('menu_categories');
					}

					
					$sidebar = 'sidebar-menu';
					$pagename = 'lemenue';


					break;

					case 'locations':
						$pageDetails['title']=$pagename;
						$mypods = pods('locations')->find(array('limit' => '0'));
						$sidebar = 'sidebar-location';
					break;

					case 'store':
						$pageDetails['title']=$pagename;
						$mypods = array();
						$sidebar = 'sidebar-story';
					break;

					case 'thank-you':
						$pageDetails['title']=$pagename;
						$mypods = array();
						$sidebar = 'sidebar-story';
					break;
					
					case 'stories':
						$mypods = pods('post')->find(array('limit' => 0, 'where'=>'is_featured="1"', 'orderby'=>'date DESC'));
						$sidebar = 'sidebar-story';
						break;
					default:
						
				}

				$mypods = isset($mypods) ? $mypods : array();
				if($defaultTemplate && $pagename){
					get_template_part( 'content', 'page' );
				}
				else if($pagename){
					pods_view( '/template-parts/content/content-'.$pagename.'.php' , array('mypod' => $mypods, 'pageDetails'=>$pageDetails));
				}

				?>

			</div>
		</div><!-- /#main -->

		<aside id="sidebar" role="complementary">
			<div class="sidebar-wrapper">
				<?php 
					if($sidebar == 'sidebar-menu') :
						get_sidebar('menu');
					elseif($sidebar == 'sidebar-location') :
						get_sidebar('locations');
					else :
						dynamic_sidebar($sidebar);
					endif;

					// If this is stories index page, get associated promo
					if($pagename == 'stories'){
						// Get the current story pod object
						$podPage = pods('page', get_the_id());

						// Get promo relationship field
						$promo = $podPage->field('fma_promo');

						// Display promo markup
						echo display_promo($promo, 'widget');
					}

				?>
			</div>
		</aside><!-- /#sidebar -->

	</div><!-- End Content row -->

<?php get_footer(); ?>