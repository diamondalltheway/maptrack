<?php 
    /*
    Plugin Name: Mapkitchen Plugin
    Plugin URI: http://www.map.kitchen
    Description: Plugin for displaying your user data
    Author: Vikash Bhartia
    Version: 1.0
    */
	
function enqueue_mk_scripts(){
    if( ! is_admin() )
{
wp_enqueue_script( 'mapkitchen-script', 'https://app.maptrackpro.com/lib/mapboxlib.js', array('jquery'), '1.0.1' );
wp_register_script( 'mapkitchenhandle', plugins_url( 'js/script.js', __FILE__ ) );		// Enqueued script with localized data.
wp_enqueue_script( 'mapkitchenhandle');
}
}
add_action( 'wp_enqueue_scripts', 'enqueue_mk_scripts' );
?>