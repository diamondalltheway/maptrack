<?php
$url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/8369+Kuykendahl+Rd+Spring+Texas+77382+United+States.json?access_token=pk.eyJ1IjoidmlrYXNodGhlY29kZXIiLCJhIjoiY2lnZzQ5cm10N3Vza3UybTU5dXY4MjVhbyJ9.ZrKrD1ZqDiGe6pPcIP95XA';

$ch1 = curl_init();

curl_setopt_array(
    $ch1, array( 
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false
));

$output1 = curl_exec($ch1);
var_dump($output1);
?>