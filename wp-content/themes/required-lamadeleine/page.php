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
					$pageDetails['daypartTitle'] = $daypartTitle;
					$params = array(
					    //'where' => "daypart_relationship = 'Lunch'",
					    'orderby' => 'order_weight ASC',
					    'limit' => '0'
					);

					$pageDetails['title']=$pagename;
					$mypods = pods('menu_item')->find($params);

					$params2 = array(
					    'where' => "t.post_title = '".$daypartTitle."'",
					    //'orderby' => 'order_weight ASC',
					    'limit' => '0'
					);

					$daypart = pods('daypart')->find($params2 );

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
						$sidebar = 'sidebar-store';
					break;

					case 'thank-you':
						$pageDetails['title']=$pagename;
						$mypods = array();
						$sidebar = 'sidebar-store';
					break;
					
					case 'stories':
						$mypods = pods('post')->find(array('limit' => 0, 'where'=>'is_featured="1"', 'orderby'=>'date DESC'));
						$sidebar = 'sidebar-story';
						break;
					default:
						$pageDetails['title']=$pagename;
						$sidebar = 'sidebar-story';
						$defaultTemplate = true;
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
				?>
			</div>
		</aside><!-- /#sidebar -->

	</div><!-- End Content row -->

<?php get_footer(); ?>