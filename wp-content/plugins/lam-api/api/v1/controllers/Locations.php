<?php
	namespace Voce\Thermal\v1\Controllers;
	class Locations {
		public static function find( $app ) {
			$location = new \Voce\Thermal\v1\Models\Locations;
			$return = $location->findbyCord($app->request()->get('lat'), $app->request()->get('lng'));
			
			/* get the imaages */
			foreach ($return as  $loc) {

				$featuredImg = wp_get_attachment_image_src( get_post_thumbnail_id($loc->id), 'location-featured');
				$thumbImg = wp_get_attachment_image_src( get_post_thumbnail_id($loc->id), 'thumbnail');
				$loc->images['featured'] = $featuredImg[0];
				$loc->images['thumbnail'] = $thumbImg[0];

			}
			
			
			if(count($return)){
				header("Content-Type: application/json");
				echo  json_encode($return );
				die();
			} else{
				//http_response_code(400);
				header("Content-Type: application/json",true,400);
				echo  json_encode(array('error' =>'Failed to find locations in API') );
				die();
			}
			return;
		}


		public static function findImage( $app, $postID, $sized = 'location-featured' ) {

			
			$return = wp_get_attachment_image_src( get_post_thumbnail_id($postID), $sized);
			if($return){
				header("Content-Type: application/json");
				echo  json_encode($return[0] );
			}  else{
				header("Content-Type: application/json",true,400);
				echo  json_encode(array('error' =>'Failed to find locations image in API') );
			}
			die(0);
			return;
			

		}


}

?>
