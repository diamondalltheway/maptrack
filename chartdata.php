<?php
include 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$sqlToFetchChartData = "select count(*) as Frequency , DATE(datevisited) as visitdate from mapkitchendata where site_id = '".$_GET['siteid']."' group by DATE(datevisited)";
	
	 $result = mysql_query($sqlToFetchChartData,$conn) or die("Error in Selecting11 " . mysql_error($conn));
    
	
	 $data = array();
	 if(mysql_num_rows($result) > 0)
	 {
	  while($row = mysql_fetch_assoc($result)) {
	   $data[] = $row;
	 }
	 echo json_encode( $data );
}
?>