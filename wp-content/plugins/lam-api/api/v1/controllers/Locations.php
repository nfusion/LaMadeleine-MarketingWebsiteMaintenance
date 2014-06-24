<?php
	namespace Voce\Thermal\v1\Controllers;
	class Locations {
		public static function find( $app ) {
			$location = new \Voce\Thermal\v1\Models\Locations;
			$return = $location->findbyCord($app->request()->get('lat'), $app->request()->get('lng'));

			/** We have decided to do this on client to avoid timezone issues **/

			// $currentCloseProp= strtolower(date('l')).'_close';
			// $currentOpenProp= strtolower(date('l')).'_open';

			// foreach ($return as  $loc) {
			// 	$loc->current_open=$loc->$currentOpenProp;
			// 	$loc->current_close=$loc->$currentCloseProp;
			// }
			//$return['current_open'] = $location->tuesday_close;

			
			if(count($return)){
				header("Content-Type: application/json");
				echo  json_encode($return );
			} 
			return;
		}


		public static function findImage( $app, $postID ) {

			
			header("Content-Type: application/json");
			$return = wp_get_attachment_url( get_post_thumbnail_id( $postID ) );
			if($return){
				
				echo  json_encode($return );
			} 
			return;
			

		}


}

?>
