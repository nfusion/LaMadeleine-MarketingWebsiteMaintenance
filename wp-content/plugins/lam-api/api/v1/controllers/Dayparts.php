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
        $return = [];
            while( $dayPartPods->fetch() ) {
                    foreach (['title','descriptor', 'daypart', 'start_display_time', 'end_display_time','link'] as $key => $value) {
                        $item[$value] = $dayPartPods->field($value);
                    }
                    $imgSrc =  wp_get_attachment_image_src( get_post_thumbnail_id($dayPartPods->id()), 'daypart'); 
                    $item['featured_img'] = $imgSrc[0];
                    $return[$item['title']]= $item;
            }
            switch ($offset) {
                    default:
                   $tsString =  "America/Denver";
                    break;
            }

            $breakfastEnd = new \DateTime($return['Breakfast']['end_display_time'], new \DateTimeZone($tsString)); 
            $breakfastStart = new \DateTime($return['Breakfast']['start_display_time'], new \DateTimeZone($tsString)); 
            $lunchEnd = new \DateTime($return['Lunch']['end_display_time'], new \DateTimeZone($tsString)); 
            $lunchStart = new \DateTime($return['Lunch']['start_display_time'], new \DateTimeZone($tsString)); 
            $bakeryEnd = new \DateTime($return['Bakery']['end_display_time'], new \DateTimeZone($tsString)); 
            $bakeryStart = new \DateTime($return['Bakery']['start_display_time'], new \DateTimeZone($tsString)); 
            $dinnerEnd = new \DateTime($return['Dinner/Wine']['end_display_time'], new \DateTimeZone($tsString)); 
            $dinnerStart = new \DateTime($return['Dinner/Wine']['end_display_time'], new \DateTimeZone($tsString)); 
            
            
            switch($clientTime){
                case ( $clientTime < $breakfastEnd->getTimestamp()):
                    $order =  ['Breakfast','Lunch','Bakery','Dinner/Wine'];
                break;
                case ( $clientTime < $lunchEnd->getTimestamp()) :
                    $order =  ['Lunch','Bakery','Dinner/Wine','Breakfast',];
                break;
               case ( $clientTime < $bakeryEnd->getTimestamp() ):
                    $order =  ['Bakery','Dinner/Wine','Breakfast', 'Lunch'];
                break;
                case ($clientTime < $dinnerEnd->getTimestamp()):
                    $order =  ['Dinner/Wine','Breakfast', 'Lunch','Bakery'];
                break;
                default:
                   $order =  ['Bakery','Breakfast', 'Lunch', 'Dinner/Wine'];
            }

            foreach ($order as  $value) {
                $returnOrdered[] = $return[$value];
            }


            return $returnOrdered;
        }

   

}

?>
