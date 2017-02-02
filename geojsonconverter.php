<?php

include 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
  //fetch table rows from mysql db
    //$sql = "select * from mapkitchendata";
    //$result = mysql_query($sql,$conn) or die("Error in Selecting " . mysql_error($conn));
   

     $sqlToFetchSiteId = "select distinct site_id from mapkitchendata";
	 $result = mysql_query($sqlToFetchSiteId,$conn) or die("Error in Selecting11 " . mysql_error($conn));
    //create an array
    while($row = mysql_fetch_assoc($result)) {
	if($row['site_id'] != "")
	{
	 $sqlToFetchSiteData = "select location,DATE(datevisited) as datevisited , pagetitle , postcode , address , city,type from mapkitchendata where site_id = '".$row['site_id']."' and location <> -1";

	 $resultData = mysql_query($sqlToFetchSiteData,$conn) or die("Error in Selecting " . mysql_error($conn));
	 if(mysql_num_rows($resultData) > 0)
	 {
	 $geojson = array();
	$features = array();
    while($row11 = mysql_fetch_assoc($resultData)) {
	$location = explode(",", $row11['location']);
	$features[] = array(
        'type' => 'Feature', 
      'geometry' => array(
        'type' => 'Point',
        'coordinates' => array((float)$location[1],(float)$location[0])
            ),
	    'properties' => array("datevisit" => $row11['datevisited'],"pagetitle" => $row11['pagetitle'],"postcode" => $row11['postcode'],"address" => $row11['address'],"city" => $row11['city'],"type" => $row11['type']),
        );
	};
	
	$geojson[] = array(
    'type'      => 'FeatureCollection',
	'features'  => $features
	); 
	
	// // Write to json file
    header("Content-Type:application/json",true);
    $data = json_encode($geojson[0]);
	$data = str_replace("\\/", "/", $data);
    $filename = dirname(__FILE__)."/geojsons/".$row['site_id'].".geojson";
	$myfile = fopen( $filename , "w") or die("Unable to open file!");

	fwrite($myfile, $data);
	}
	}
	}
    
    
   

mysql_close($conn);

?>