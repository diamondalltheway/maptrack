<?php
include_once 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$request_body = file_get_contents('php://input');
$action = json_decode($request_body,true);
$token = $request_body['stripeToken'];
$sql = "INSERT INTO userdetails".
       "(username) ".
       "VALUES ".
       "('".$token."')";

$retval = mysql_query( $sql, $conn );
?>