<?php
include_once 'amazon_rds.php';
 $sqlToFetchSiteId = "select location from mapkitchendata where location <> -1 and country = 'United States' order by rand() limit 10";
	 $result = mysql_query($sqlToFetchSiteId,$conn) or die("Error in Selecting11 " . mysql_error($conn));
    //create an array
?>
<table border ="1">
<tr>
<th>Location</th>
<th>Address from mapbox</th>
<th>Address from mapquest</th>
</tr>
<?php
    while($row = mysql_fetch_assoc($result)) {
$split = explode(",",$row['location']);
$url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/'.$split[1].','.$split[0].'.json?types=postcode,address,country,region,place&access_token=pk.eyJ1IjoidmlrYXNodGhlY29kZXIiLCJhIjoiY2lnZzQ5cm10N3Vza3UybTU5dXY4MjVhbyJ9.ZrKrD1ZqDiGe6pPcIP95XA';
$url1 = 'https://www.mapquestapi.com/geocoding/v1/reverse?key=3hWOuIT2RWbxCCa3x3TvvyGvl0Xfm7jg&location='.$split[0].','.$split[1].'&outFormat=json&thumbMaps=false';
$ch1 = curl_init();

curl_setopt_array(
    $ch1, array( 
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false
));
$output1 = curl_exec($ch1);
 if(curl_errno($ch1)) {
        //echo 'Error: ' . curl_error($ch1) . '<br><br>';
    }
$data = json_decode($output1,true);

$ch2 = curl_init();

curl_setopt_array(
    $ch2, array( 
    CURLOPT_URL => $url1,
    CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false
));
$output2 = curl_exec($ch2);
 if(curl_errno($ch2)) {
        
    }
$data1 = json_decode($output2,true);

$addressmq = $data1['results'][0]["locations"][0]['street'] . ' '.
$data1['results'][0]["locations"][0]['adminArea5'] . ' '.
$data1['results'][0]["locations"][0]['adminArea3'] . ' '.
$data1['results'][0]["locations"][0]['postalCode'];

$address = mysql_real_escape_string($data["features"][0]['place_name']);
$exploding = explode(",",$data["features"][0]['place_name']);

if($data1['results'][0]["locations"][0]['street'] == $exploding[0])
{
echo '<tr style = "background-color:lightgreen"><td>'.$row['location'].'</td><td>'.$address.'</td><td>'.$addressmq.'</td></tr>';
}
else
{
echo '<tr style = "background-color:red"><td>'.$row['location'].'</td><td>'.$address.'</td><td>'.$addressmq.'</td></tr>';
}
}
mysql_close($conn);
?>
</table>
