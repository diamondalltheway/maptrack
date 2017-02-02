<?php 
session_start();


include 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$sqlToFetchDetails = "SELECT * FROM mapkitchen.userdetails";


	 $result = mysql_query($sqlToFetchDetails,$conn);
	 while($row = mysql_fetch_assoc($result)) {
	 
	 echo $row['username'].'<BR/>';
	 }
?>