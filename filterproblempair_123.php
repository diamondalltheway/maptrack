<?php

include 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
 
   
   $Initiallocation = '';
   $initialLoc = '';
     $sqlsettimezone = "SET time_zone = 'US/Central'";
$retval = mysql_query( $sqlsettimezone, $conn );
     $sqlToFetchStreets = "select street,count(*) as count from mapkitchendata where datevisited > CURRENT_TIMESTAMP - interval 40 minute group by street";
	 $result = mysql_query($sqlToFetchStreets,$conn) or die("Error in Selecting11 " . mysql_error($conn));
   
  while($row = mysql_fetch_assoc($result)) {
	if($row['count'] > 1)
	{
	
	 $sqlToFetchPoints = "select address,location from mapkitchendata where street =  '".$row['street']."' group by street";
	 $resultData = mysql_query($sqlToFetchPoints,$conn) or die("Error in Selecting " . mysql_error($conn));   
   
   $row11 = mysql_fetch_array($resultData, MYSQL_NUM);
  
   for($i = 0 ;$i  < count($row11) ;$i++)
   {
    $Initiallocation = $row11[$i][1];
	$initialLoc = explode(",",$Initiallocation);
	for($j = 1 ; $j <  count($row11) ; $j++)
	{
	$comparingLocation = explode(",",$row11[$j][1]);
	$distance = distance($initialLoc[1],$initialLoc[0],$comparingLocation[1],$comparingLocation[0],"K");
	if($distance < 0.05)
	{
	 mysql_query("delete from mapkitchendata where location = '".$row11['location']."'");
	}	
	}
   }
  
$Initiallocation = '';
$initialLoc = '';
}
}
	
mysql_close($conn);
  function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}  

?>