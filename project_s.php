<?php 
/* Short and sweet */
define('WP_USE_THEMES', false);
require('../wp-blog-header.php');
$start = microtime(true);
global $wpdb;
$values = $wpdb->get_results( 'SELECT location FROM location_data limit 200', OBJECT );
$zipcodes = array();
$zip = array();
$zips = array();
$data = array();

foreach($values as $value)
{

$split = explode(",",$value->location);
$url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/'.$split[1].','.$split[0].'.json?types=postcode&access_token=pk.eyJ1IjoidmlrYXNodGhlY29kZXIiLCJhIjoiY2lnZzQ5cm10N3Vza3UybTU5dXY4MjVhbyJ9.ZrKrD1ZqDiGe6pPcIP95XA';
$data[] = $url;

}

$r = multiRequest($data);
 


foreach($r  as $rs)
{

$datas = json_decode($rs);


if($datas->features != null)
{
$loc = $datas->query[1].",".$datas->query[0];
$zipcodes[$loc][] = $datas->features[0]->text;
$zips[] = $datas->features[0]->text;
}
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
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-heat/v0.1.3/leaflet-heat.js'></script>
    <!-- Mapbox GL -->
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v0.11.2/mapbox-gl.css" rel='stylesheet' />
    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v0.11.2/mapbox-gl.js"></script>
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

  <a href='#' onclick = showcenter(<?php echo array_search($x,$zipcodes) ?>)><?php echo $x."---".$y ?></a>
  
  <?php $i++ ?>

<?php endforeach; ?>
</nav>
</div>
<script src="mapboxgl/leaflet-mapbox-gl.js"></script>
<script>
<?php $k = 0; ?>
<?php foreach($zipcodes as $x => $y):
if($k == 1)
{
continue;
}
?>
var map = L.map('map').setView([<?php echo $x ?>], 15);

<?php $k++; ?>
<?php endforeach; ?>

<?php $j = 0; ?>
<?php foreach($result as $x => $y): ?>


var locations<?php echo $j?> = [];
heat<?php echo $j ?> = L.heatLayer([], { radius: 20,
            blur: 15, 
            maxZoom: 21,}).addTo(map);
<?php foreach($zipcodes as $loc => $zip): ?>
<?php foreach($zip as $y => $z) : ?>

<?php if($z == $x):?>
locations<?php echo $j?>.push(<?php echo $loc ?>);
<?php endif; ?>

<?php endforeach;?>
<?php endforeach;?>

heat<?php echo $j ?>.addLatLng(locations<?php echo $j?>);
<?php $j++; endforeach; ?>

var gl = L.mapboxGL({
    accessToken: 'pk.eyJ1IjoidmlrYXNodGhlY29kZXIiLCJhIjoiY2lnZzQ5cm10N3Vza3UybTU5dXY4MjVhbyJ9.ZrKrD1ZqDiGe6pPcIP95XA',
    style: 'mapbox://styles/mapbox/streets-v8'
}).addTo(map);
</script>
</body>
</html>
<?php
function multiRequest($data, $options = array()) {
 
  // array of curl handles
  $curly = array();
  // data to be returned
  $result = array();
 
  // multi handle
  $mh = curl_multi_init();
 
  // loop through $data and create curl handles
  // then add them to the multi-handle
  foreach ($data as $id => $d) {
 
    $curly[$id] = curl_init();
 
    $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
    curl_setopt($curly[$id], CURLOPT_URL,            $url);
    curl_setopt($curly[$id], CURLOPT_HEADER,         0);
    curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
 
    // post?
    if (is_array($d)) {
      if (!empty($d['post'])) {
        curl_setopt($curly[$id], CURLOPT_POST,       1);
        curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
      }
    }
 
    // extra options?
    if (!empty($options)) {
      curl_setopt_array($curly[$id], $options);
    }
 
    curl_multi_add_handle($mh, $curly[$id]);
  }
 
  // execute the handles
  $running = null;
  do {
    curl_multi_exec($mh, $running);
  } while($running > 0);
 
 
  // get content and remove handles
  foreach($curly as $id => $c) {
    $result[$id] = curl_multi_getcontent($c);
	
    curl_multi_remove_handle($mh, $c);
  }
 
  // all done
  curl_multi_close($mh);
 
  return $result;
}
 $time = microtime(true) - $start;
 echo $time;
?>