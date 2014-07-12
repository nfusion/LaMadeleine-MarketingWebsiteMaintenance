<?php
namespace Voce\Thermal\v1\Controllers;

class Dayparts {


    public static  function find( $app, $time, $offset ) {
        header("Content-Type: application/json");
        $data = Dayparts::daypartToJson($time, $offset);
        header("Content-Type: application/json");
        echo json_encode($data);
        return;
    }


    /**
    *
    */
    public static  function daypartToJson($clientTime, $offset){

        $dayPartPods = pods('daypart')->find(); 
        $return = array();
            while( $dayPartPods->fetch() ) {
                    foreach (array('title','descriptor', 'daypart', 'start_display_time', 'end_display_time','link', 'slug') as $key => $value) {
                        $item[$value] = $dayPartPods->field($value);
                    }
                    $imgSrc =  wp_get_attachment_image_src( get_post_thumbnail_id($dayPartPods->id()), 'daypart');
                    $imgSrcThumb =  wp_get_attachment_image_src( get_post_thumbnail_id($dayPartPods->id()), 'thumbnail');
                    $item['featured_img'] = $imgSrc[0];
                    $item['thumb_img'] = $imgSrcThumb[0];
                    $item['menu_cat'] = Dayparts::getDayPartMenuCategories($item['daypart']);
                    $return[$item['title']]= $item;
            }
            switch ($offset) {
                    default:
                   $tsString =  "America/Chicago";
                    break;
            }

            $breakfastEnd = new \DateTime($return['Breakfast']['end_display_time'], new \DateTimeZone($tsString)); 
            $breakfastStart = new \DateTime($return['Breakfast']['start_display_time'], new \DateTimeZone($tsString)); 
            $lunchEnd = new \DateTime($return['Lunch']['end_display_time'], new \DateTimeZone($tsString)); 
            $lunchStart = new \DateTime($return['Lunch']['start_display_time'], new \DateTimeZone($tsString)); 
            $bakeryEnd = new \DateTime($return['Bakery']['end_display_time'], new \DateTimeZone($tsString)); 
            $bakeryStart = new \DateTime($return['Bakery']['start_display_time'], new \DateTimeZone($tsString)); 
            $dinnerEnd = new \DateTime($return['Dinner & Wine']['end_display_time'], new \DateTimeZone($tsString)); 
            $dinnerStart = new \DateTime($return['Dinner & Wine']['end_display_time'], new \DateTimeZone($tsString)); 
            
		     
            switch($clientTime){

                case (( $clientTime < $breakfastEnd->getTimestamp()) && ($clientTime < $breakfastStart->getTimestamp())):
                    $order =  array('Bakery','Breakfast', 'Lunch', 'Dinner & Wine');
                break;

                case ( $clientTime < $breakfastEnd->getTimestamp()):
                    $order =  array('Breakfast','Lunch','Bakery','Dinner & Wine');
                break;
                case ( $clientTime < $lunchEnd->getTimestamp()) :
                    $order =  array('Lunch','Bakery','Dinner & Wine','Breakfast');
                break;
               case ( $clientTime < $bakeryEnd->getTimestamp() ):
                    $order =  array('Bakery','Dinner & Wine','Breakfast', 'Lunch');
                break;
                case ($clientTime < $dinnerEnd->getTimestamp()):
                    $order =  array('Dinner & Wine','Breakfast', 'Lunch','Bakery');
                break;
                default:
                   $order =  array('Bakery','Breakfast', 'Lunch', 'Dinner & Wine');
            }

            foreach ($order as  $value) {
                $returnOrdered[] = $return[$value];
            }


            return $returnOrdered;
        }

    private function getDayPartMenuCategories($daypart){

       
        $params = array(
                        'where' => "t.post_title = '".ucfirst($daypart)."'",
                        'orderby' => "date ASC",
                        'limit' => '1'
                    );
            $daypart_pod = pods('daypart')->find($params);


            /** Due to accent Mark issues we need a caticory translation dictionary **/

            $params = array(
                        'limit' => '0'
                    );


            $cat_pod =  pods('menu_categories')->find($params);
             while( $cat_pod->fetch() ) {

               $catDict[$cat_pod->field('slug')] = $cat_pod->field('title');
               
            }

            $menu_categories='';
            while( $daypart_pod->fetch() ) {
                $menu_categories_arr = explode(', ',$daypart_pod->field('menu_categories'));
                $i = 0;
                foreach( $menu_categories_arr  as $slug){
                    $i++;
                    $comma = $i< count($menu_categories_arr )? ',':'';
                    $menu_categories .= $catDict[$slug] .$comma;
                }
            }
            
            //$menu_categories = ucwords(str_replace('-', ' ', $menu_categories));

        return json_encode( explode(",", $menu_categories));

    }
   

}

?>
