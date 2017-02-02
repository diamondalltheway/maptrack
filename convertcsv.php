<?php 
/* Short and sweet */
define('WP_USE_THEMES', false);
require('../wp-blog-header.php');
$start = microtime(true);
global $wpdb;
$values = $wpdb->get_results( 'SELECT location FROM location_data limit 200', OBJECT );
foreach($values as $value)
{

$split = explode(",",$value->location);


}