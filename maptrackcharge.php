<?php
include_once 'amazon_rds.php';
include_once 'stripe/init.php';
\Stripe\Stripe::setApiKey("sk_test_Z1nopWF6anUmGYce1rH44LJN");

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$query1 = "SELECT * FROM userdetails";
$result = mysql_query($query1,$conn) or die("Error in Selecting11 " . mysql_error($conn));
if(mysql_num_rows($result) > 0)
{
	while($row = mysql_fetch_assoc($result)) {
	
	$today_date=date();

	if(strtotime($today_date) > strtotime($row['billingenddate']))
	{
		
		if($row['stripecustomerid'] != '')
		{
			
			$sqlToFetchAddressCount = "select distinct a.address from mapkitchendata a inner join userdetails b on a.site_id = b.website_id where a.site_id = '".$row['website_id']."' and a.type = 'R' and DATE(a.datevisited) >= DATE('".$row['billingstartdate']."') and DATE(a.datevisited) <= DATE('".$row['billingenddate']."')";	 
			
			$result1 = mysql_query($sqlToFetchAddressCount,$conn) or die("Error in Selecting11 " . mysql_error($conn));	
			$count = mysql_num_rows($result1);
			$amount = $count*0.10;
			// Charge the Customer instead of the card
			$charge = \Stripe\Charge::create(array(
			"amount" => $amount*100, // Amount in cents
			"currency" => "usd",
			"customer" => $row['stripecustomerid'])
			);
			if($charge->status == 'succeeded')
			{
			$query3 = "update mapkitchen.userdetails set `billingstartdate` = NOW(),`billingenddate` = NOW() + INTERVAL 30 day where website_id = '".$row['website_id']."'";
			
			mysql_query($query3);
			}
		}
	}
	$charge = null;
 }
}
?>