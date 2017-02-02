<?php


$url = "https://us-street.api.smartystreets.com/street-address?auth-id=cfe91e6f-6297-50aa-8c84-730ce51a7604&auth-token=AetBRCpD0BUVqJuzphsd&street=4507+Breckenridge+Dr&city=Houston&state=Texas&zipcode=77066&candidates=10";
$ch1 = curl_init();

curl_setopt_array(
    $ch1, array( 
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true
));

$output1 = curl_exec($ch1);
 if(curl_errno($ch1)) {
        
    }
$data = json_decode($output1,true);

var_dump($data);
?>
