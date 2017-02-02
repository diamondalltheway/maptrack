<?php
include_once 'amazon_rds.php';

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$action = $_POST['action'];
$cardname = $_POST['cardname'];
$cardno =  $_POST['cardno'];
$cvc = $_POST['cvc'];
$cardmonth =  $_POST['cardmonth'];
$cardyear = $_POST['cardyear'];
$expdate = $cardmonth."/".$cardyear;
$siteid = $_POST['siteid'];
$view = $_POST['view'];
if($action == 'update')
{
$query = "update mapkitchen.userdetails set nameoncard = '".$cardname."',cardno = '".$cardno."',cvv = '".$cvc."',expdate='".$expdate."' where website_id = '".$siteid."'";
}
else
{
$query = "update mapkitchen.userdetails set `style` = '".$view."' where website_id = '".$siteid."'";
}
echo $query;
mysql_query($query);
?>