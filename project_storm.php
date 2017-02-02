<?php 
/* Short and sweet */
define('WP_USE_THEMES', false);
require('../wp-blog-header.php');
$start = microtime(true);
global $wpdb;
$values = $wpdb->get_results( 'SELECT location FROM location_data limit 200', OBJECT );


$ch1 = curl_init();
$zipcodes = array();
$zip = array();
$zips = array();
foreach($values as $value)
{
ob_start();
$split = explode(",",$value->location);
$url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/'.$split[1].','.$split[0].'.json?types=postcode&access_token=pk.eyJ1IjoidmlrYXNodGhlY29kZXIiLCJhIjoiY2lnZzQ5cm10N3Vza3UybTU5dXY4MjVhbyJ9.ZrKrD1ZqDiGe6pPcIP95XA';

curl_setopt_array(
    $ch1, array( 
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false
));

$output1 = curl_exec($ch1);
 if(curl_errno($ch1)) {
        echo 'Error: ' . curl_error($ch1) . '<br><br>';
    }
$data = json_decode($output1);
if($data->features != null)
{

$zipcodes[$value->location][] = $data->features[0]->text;
$zips[] = $data->features[0]->text;
}
echo ob_get_contents();
ob_end_flush();
}




$result = array_count_values($zips);
arsort($result);


?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>A simple map</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.mapbox.com/mapbox.js/v2.2.3/mapbox.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-heat/v0.1.3/leaflet-heat.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.2.3/mapbox.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
  #map { position:absolute; top:0; bottom:0; width:100%; }
  .menu-ui {
  background:#fff;
  position:absolute;
  top:10px;right:10px;
  z-index:1;
  border-radius:3px;
  width:120px;
  border:1px solid rgba(0,0,0,0.4);
  }
  .menu-ui a {
    font-size:13px;
    color:#404040;
    display:block;
    margin:0;padding:0;
    padding:5px 10px;
    text-decoration:none;
    border-bottom:1px solid rgba(0,0,0,0.25);
    text-align:center;
    }
    .menu-ui a:first-child {
      border-radius:3px 3px 0 0;
      }
    .menu-ui a:last-child {
      border:none;
      border-radius:0 0 3px 3px;
      }
    .menu-ui a:hover {
      background:#f8f8f8;
      color:#404040;
      }
    .menu-ui a.active {
      background:#3887BE;
      color:#FFF;
      }
      .menu-ui a.active:hover {
        background:#3074a4;
        }
</style>
</head>
<body>
<div id='map'>
<nav class='menu-ui'>
<?php $i = 0; ?>
<?php foreach($result as $x => $y): ?>
<?php ob_start();?>
  <a href='#' onclick = showcenter(<?php echo array_search($x,$zipcodes) ?>)><?php echo $x."---".$y ?></a>
  
  <?php $i++ ?>
 <?php  
 echo ob_get_contents();
ob_end_flush();
 ?>
<?php endforeach; ?>
</nav>
</div>
<script>
L.mapbox.accessToken = 'pk.eyJ1IjoidmlrYXNodGhlY29kZXIiLCJhIjoiY2lnZzQ5cm10N3Vza3UybTU5dXY4MjVhbyJ9.ZrKrD1ZqDiGe6pPcIP95XA';
var map = L.mapbox.map('map', 'mapbox.dark');
<?php $j = 0; ?>
<?php foreach($result as $x => $y): ?>


var locations<?php echo $j?> = [];
heat<?php echo $j ?> = L.heatLayer([], { radius: 20,
            blur: 15, 
            maxZoom: 18,}).addTo(map);
<?php foreach($zipcodes as $loc => $zip): ?>
<?php foreach($zip as $y => $z) : ?>
<?php ob_start();?>
<?php if($z == $x):?>
locations<?php echo $j?>.push(<?php echo $loc ?>);
<?php endif; ?>
<?php
echo ob_get_contents();
ob_end_flush();?>
<?php endforeach;?>
<?php endforeach;?>

heat<?php echo $j ?>.addLatLng(locations<?php echo $j?>);
<?php $j++; endforeach; ?>
<?php $k = 0; ?>
<?php foreach($zipcodes as $x => $y):
if($k == 1)
{
continue;
}
?>
map.setView([<?php echo $x ?>], 9);
<?php $k++; ?>
<?php endforeach; ?>

</script>
</body>
</html>
<?php  $time = microtime(true) - $start;
 echo $time;  
 ?>