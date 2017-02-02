<?php
require 'mailgun-php/vendor/autoload.php';
use Mailgun\Mailgun;
include_once 'amazon_rds.php';
include_once 'stripe/init.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

\Stripe\Stripe::setApiKey("sk_test_Z1nopWF6anUmGYce1rH44LJN");

// Retrieve the request's body and parse it as JSON
$input = @file_get_contents("php://input");
$event_json = json_decode($input);
// Check against Stripe to confirm that the ID is valid
$event = \Stripe\Event::retrieve($event_json->id);
if (isset($event) && $event->type == "invoice.payment_failed") {
  $customer = \Stripe\Customer::retrieve($event->data->object->customer);
  $email = $customer->email;
  // Sending your customers the amount in pennies is weird, so convert to dollars
  $amount = sprintf('$%0.2f', $event->data->object->amount_due / 100.0);
 $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Actionable emails e.g. reset password</title>


<style type="text/css">
img {
max-width: 100%;
}
body {
-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
}
body {
background-color: #f6f6f6;
}
@media only screen and (max-width: 640px) {
  body {
    padding: 0 !important;
  }
  h1 {
    font-weight: 800 !important; margin: 20px 0 5px !important;
  }
  h2 {
    font-weight: 800 !important; margin: 20px 0 5px !important;
  }
  h3 {
    font-weight: 800 !important; margin: 20px 0 5px !important;
  }
  h4 {
    font-weight: 800 !important; margin: 20px 0 5px !important;
  }
  h1 {
    font-size: 22px !important;
  }
  h2 {
    font-size: 18px !important;
  }
  h3 {
    font-size: 16px !important;
  }
  .container {
    padding: 0 !important; width: 100% !important;
  }
  .content {
    padding: 0 !important;
  }
  .content-wrap {
    padding: 10px !important;
  }
  .invoice {
    width: 100% !important;
  }
}
</style>
</head>

<body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

<table class="body-wrap" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
		<td class="container" width="600" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
			<div class="content" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
				<table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
							<meta itemprop="name" content="Confirm Email" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" />
							<table width="100%" cellpadding="0" cellspacing="0" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							
							<tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td class="content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
							<img style = "width:40%" src = "https://app.maptrackpro.com/assets/pages/img/logo.png"></img>
							</td></tr>
							<tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td class="content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										<h3>Hello</h3>
									</td>
								</tr><tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										
  Unfortunately your most recent invoice payment for ' . $amount . ' was declined.
  This could be due to a change in your card number or your card expiring, cancelation of your credit card,
  or the bank not recognizing the payment and taking action to prevent it.
  
  Please update your payment information as soon as possible by logging in to dashboard on account setting page


									
									</td>
								</tr>
							
								<tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" itemprop="handler" itemscope itemtype="http://schema.org/HttpActionHandler" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										<a href="http://www.mailgun.com" class="btn-primary" itemprop="url" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Login</a>
									</td>
								</tr><tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										MapTrack
										<BR/>
										Vick
									</td>
								</tr></table></td>
					</tr></table><div class="footer" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
					<table width="100%" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="aligncenter content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">Follow <a href="http://twitter.com/mail_gun" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">@MapTrack</a> on Twitter.</td>
						</tr></table></div></div>
		</td>
		<td style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
	</tr></table></body>
</html>
';
  $mgClient = new Mailgun('key-61a88fe0b8aa0e63320efcde642c9253');
$domain = "app.maptrackpro.com";
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'Vikash Bhartia <vick@maptrackpro.com>',
    'to'      => $email,
    'subject' => 'your subscription payment failed',
    'html'    => $html
));
mysql_query("update userdetails set activeuntil = null where username= '".$email."'");
}
if (isset($event) && $event->type == " invoice.payment_succeeded") {
  $customer = \Stripe\Customer::retrieve($event->data->object->customer);
  $email = $customer->email;
  // Sending your customers the amount in pennies is weird, so convert to dollars
  $amount = sprintf('$%0.2f', $event->data->object->amount_due / 100.0);
 $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Actionable emails e.g. reset password</title>


<style type="text/css">
img {
max-width: 100%;
}
body {
-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
}
body {
background-color: #f6f6f6;
}
@media only screen and (max-width: 640px) {
  body {
    padding: 0 !important;
  }
  h1 {
    font-weight: 800 !important; margin: 20px 0 5px !important;
  }
  h2 {
    font-weight: 800 !important; margin: 20px 0 5px !important;
  }
  h3 {
    font-weight: 800 !important; margin: 20px 0 5px !important;
  }
  h4 {
    font-weight: 800 !important; margin: 20px 0 5px !important;
  }
  h1 {
    font-size: 22px !important;
  }
  h2 {
    font-size: 18px !important;
  }
  h3 {
    font-size: 16px !important;
  }
  .container {
    padding: 0 !important; width: 100% !important;
  }
  .content {
    padding: 0 !important;
  }
  .content-wrap {
    padding: 10px !important;
  }
  .invoice {
    width: 100% !important;
  }
}
</style>
</head>

<body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

<table class="body-wrap" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
		<td class="container" width="600" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
			<div class="content" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
				<table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
							<meta itemprop="name" content="Confirm Email" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" />
							<table width="100%" cellpadding="0" cellspacing="0" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							
							<tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td class="content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
							<img style = "width:40%" src = "https://app.maptrackpro.com/assets/pages/img/logo.png"></img>
							</td></tr>
							<tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
							<td class="content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										<h3>Hello</h3>
									</td>
								</tr><tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										
  Congratulations, your most recent invoice payment for ' . $amount . ' was Paid.
 


									
									</td>
								</tr>
							
								<tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" itemprop="handler" itemscope itemtype="http://schema.org/HttpActionHandler" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										<a href="http://www.mailgun.com" class="btn-primary" itemprop="url" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Login</a>
									</td>
								</tr><tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										MapTrack
										<BR/>
										Vick
									</td>
								</tr></table></td>
					</tr></table><div class="footer" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
					<table width="100%" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="aligncenter content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">Follow <a href="http://twitter.com/mail_gun" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">@MapTrack</a> on Twitter.</td>
						</tr></table></div></div>
		</td>
		<td style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
	</tr></table></body>
</html>
';
  $mgClient = new Mailgun('key-61a88fe0b8aa0e63320efcde642c9253');
$domain = "app.maptrackpro.com";
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'Vikash Bhartia <vick@maptrackpro.com>',
    'to'      => $email,
    'subject' => 'Your Invoice is paid',
    'html'    => $html
));
mysql_query("update userdetails set activeuntil = NOW + 30 days where username= '".$email."'");
}
?>