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
						$mypods = pods('home_fma')->find();
						$sidebar = 'sidebar-home';
						$pagename = 'home';
					break;
					
					case 'breakfast':
					case 'bakery':
					case 'lunch':
					case 'dinner':

					$params = array(
					    //'where' => "daypart_relationship = 'Lunch'",
					    'orderby' => 'order_weight ASC',
					    'limit' => '0'
					);

					$pageDetails['title']=$pagename;
					$mypods = pods('menu_item')->find($params);
					$sidebar = 'sidebar-menu';
					$pagename = 'lemenue';


					break;

					case 'locations':
						$pageDetails['title']=$pagename;
						$mypods = pods('locations')->find();
						$sidebar = 'sidebar-location';
					break;

					case 'store':
						$pageDetails['title']=$pagename;
						$mypods = array();
						$sidebar = 'sidebar-store';
					break;
					
					case 'stories':
						$mypods = get_posts();
						$sidebar = 'sidebar-story';
						break;
					default:

				}



				// if ( is_front_page() ) {
				// 	$mypods = pods('home_fma')->find();
				// 	$pagename = 'home';
				// } elseif( $pagename == 'stories') {
				// 	$mypods = get_posts();
					
				// } else {
				// 	$mypods = pods( $pagename )->find(); 
				// 	if( ! $mypods->total_found() ) {
				// 		echo "No Content Found";
				// 		$pagename = false;
				// 	}
				// }

				$mypods = isset($mypods) ? $mypods : array();
				if($pagename){
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
					else :
						dynamic_sidebar($sidebar);
					endif;
				?>
			</div>
		</aside><!-- /#sidebar -->

	</div><!-- End Content row -->

<?php get_footer(); ?>