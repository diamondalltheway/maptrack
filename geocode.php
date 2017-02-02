<?php   
$url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/-73.989,40.733.json?types=postcode,address,country,region&access_token=pk.eyJ1IjoidmlrYXNodGhlY29kZXIiLCJhIjoiY2lnZzQ5cm10N3Vza3UybTU5dXY4MjVhbyJ9.ZrKrD1ZqDiGe6pPcIP95XA';

$ch1 = curl_init();

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
$data = json_decode($output1,true);


var_dump($data["features"][0]['place_name']);
echo "---------------------------------";
var_dump($data["features"][1]["text"]);
echo "---------------------------------";
var_dump($data["features"][2]["text"]);
echo "---------------------------------";
var_dump($data["features"][3]["text"]);
?>