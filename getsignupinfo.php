<?php
require 'mailgun-php/vendor/autoload.php';
use Mailgun\Mailgun;

include_once 'amazon_rds.php';
include_once 'stripe/init.php';

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$request_body = file_get_contents('php://input');
$action = json_decode($request_body,true);

$url = "https://api.typeform.com/v1/form/eVjkoi?key=a204673641d703520a3fd63890c05f467b46b0bb&token=".$action['form_response']['token']."";
$ch1 = curl_init();

curl_setopt_array(
    $ch1, array( 
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false
));

$output1 = curl_exec($ch1);
 if(curl_errno($ch1)) {
        
    }
$data = json_decode($output1,true);
$allValues = array_values($data["responses"][0]["answers"]);

$selectSql = "select * from userdetails where username = '".$allValues[2]."'";
$result = mysql_query($selectSql,$conn);
$rows = mysql_num_rows($result);
$errors = array();
if($rows > 0)
{
$errors[] = "Email id Already Exists";
}
$selectSql1 = "select * from userdetails where website_name = '".$allValues[1]."'";
$result1 = mysql_query($selectSql1,$conn);
$rows1 = mysql_num_rows($result1);
if($rows1 > 0)
{
$errors[] = "Website is already Registered";
}
if(empty($errors))
{
$randomsiteid = rand(10000, 99999);

\Stripe\Stripe::setApiKey("sk_test_Z1nopWF6anUmGYce1rH44LJN");

$exdate = explode("/",$allValues[7]);
$myCard = array('number' => $allValues[4], 'cvc' => $allValues[6],'exp_month' => $exdate[0], 'exp_year' => $exdate[1],'object' => 'card');


try
{
$customer = \Stripe\Customer::create(array(
  "source" => $myCard,
  "email" => $allValues[2])
);
}
catch(Exception $e)
{
$errors[] = $e->getMessage();
}
}
if(empty($errors))
{

$sql = "INSERT INTO userdetails".
       "(username,password,website_name,website_id,email_id,DOR,ispasswordchanged,tokencode,stripecustomerid,plan,billingstartdate,billingenddate,nameoncard,cardno,cvv,expdate) ".
       "VALUES ".
       "('".$allValues[2]."','".$allValues[3]."','".$allValues[1]."','".$randomsiteid."','".$allValues[2]."',NOW(),-1,-1,'".$customer->id."','".$allValues[0]."',NOW(),NOW()+ INTERVAL 30 DAY,'". $allValues[5]."','". $allValues[4]."','". $allValues[6]."','". $allValues[7]."')";

$retval = mysql_query( $sql, $conn );
# Make the call to the client.
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
										<h3>Hello and Welcome to MapTrack</h3>
									</td>
								</tr><tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										Your account is successfully created, and you can now login to your Dashboard using the details below
										<BR/>
										<b>Username : '.$allValues[2].'</b>
										<BR/>
										<b>Password : '.$allValues[3].'</b>
									</td>
								</tr>
								<tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										If you face any problem installing the tracking code, or downloading/viewing the locations, We are just an email away
										@ <a href = "mailto:help@maptrackpro.com">help@maptrackpro.com</a>
										
									</td>
								</tr>
								<tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" itemprop="handler" itemscope itemtype="http://schema.org/HttpActionHandler" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										<a href="https://app.maptrackpro.com" class="btn-primary" itemprop="url" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Login</a>
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
# Instantiate the client.
$mgClient = new Mailgun('key-61a88fe0b8aa0e63320efcde642c9253');
$domain = "app.maptrackpro.com";
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'Vikash Bhartia <vick@maptrackpro.com>',
    'to'      => $allValues[2],
    'subject' => 'Welcome to MapTrack',
    'html'    => $html
));
}
else
{

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
										<h3>Hello </h3>
									</td>
								</tr><tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										We had some trouble creating your account , please fix the below errors and signup again
										<BR/>';
foreach($errors as $error)
{
$html .= '<b><p style = "color:red">'.$error.'</p></b>';
}							$html .= 		
									'</td>
								</tr>
								<tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										If you still face any problems, We are just an email away
										@ <a href = "mailto:help@maptrackpro.com">help@maptrackpro.com</a>
										
									</td>
								</tr>
								<tr style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" itemprop="handler" itemscope itemtype="http://schema.org/HttpActionHandler" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
										<a href="http://www.maptrackpro.com/signup.html" class="btn-primary" itemprop="url" style="font-family: \'Source Sans Pro\', sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Signup Again</a>
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

# Instantiate the client.
$mgClient = new Mailgun('key-61a88fe0b8aa0e63320efcde642c9253');
$domain = "app.maptrackpro.com";
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'Vikash Bhartia <vick@maptrackpro.com>',
    'to'      => $allValues[2],
    'subject' => 'Please fix some errors related to your account',
    'html'    => $html
));
}
?>
