<?php
include_once 'amazon_rds.php';
include_once 'stripe/init.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
session_start();

\Stripe\Stripe::setApiKey("sk_test_Z1nopWF6anUmGYce1rH44LJN");
$subid = $_POST['subid'];
$subscription = \Stripe\Subscription::retrieve($subid);
$subscription->cancel();

$siteid = $_SESSION['siteid'];
$updaterow = mysql_query("update mapkitchen.userdetails set activeuntil = null where website_id = '".$siteid."'");
if($updaterow >= 1)
{
echo "YES";
}
?>