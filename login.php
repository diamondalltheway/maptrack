<?php
include_once 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
session_start();

if(isset($_POST['submit']))
{

$sqlToFetchEmail = "select * from userdetails";
$result = mysql_query($sqlToFetchEmail,$conn) or die("Error in Selecting11 " . mysql_error($conn));
 $emailArray = array();   
    while($row = mysql_fetch_assoc($result)) {
     $emailArray[] = $row['email_id'];
}

if(!in_array($_POST['email'],$emailArray))
{
$status = 1;
}
else
{
$sqlToFetchUserId = "select user_id from userdetails where email_id = '".$_POST['email']."'";
$resultUserId = mysql_query($sqlToFetchUserId,$conn) or die("Error in Selecting11 " . mysql_error($conn));
 while($row = mysql_fetch_assoc($resultUserId)) {
     $userid = $row['user_id'];
}



$token = getGUID();

$sqltoupdate = "update  userdetails set tokencode = '".$token."' where user_id = '".$userid."'";

$updatesql = mysql_query($sqltoupdate);
$to = $_POST['email'];
$subject = "Map Kitchen | Reset your password";
$message = '<html><head><title>Forgot Password</title></head>
<body>
<p>You requested to change the password for your account</p>
<p>Please click on the link below to reset passsword</p>
<p>https://app.map.kitchen/resetpassword?link='.$token.'&user='.$userid.'</p>
</body>
</html>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to,$subject,$message,$headers);
$status = 2;
}
}
function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>MapTrack - Login</title>
  		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.13.0/css/semantic.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.css">
		<script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
		   <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.js"></script>
	<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.23.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.23.0/mapbox-gl.css' rel='stylesheet' />
  <style type="text/css">
     body { margin:0; padding:0; }
     #map { position:absolute; top:0; bottom:0; width:100%; height:100%}
	
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
	  margin-top:5px;
    }
	.content{
	color:#2185d0
	}
	.ui.teal.buttons .button, .ui.teal.button
	{
	background-color: #e32082!important
	}
	 #fly {
        display: block;
        position: relative;
        margin: 0px auto;;
        padding: 10px;
        border: none;
        border-radius: 3px;
        font-size: 12px;
        text-align: center;
        color: #fff;
    }
  </style>
</head>
<body>
<div id ="map"></div>
<div id ="fly" class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      <img src="../assets/pages/img/logo.png" style = "width:300px" class="image">
      <div class="content">
        Log-in to your account
      </div>
    </h2>
    <form class="ui large form" action="dashboard.php" method="post">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="login" placeholder="E-mail address">
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password" placeholder="Password">
          </div>
        </div>
        <input class="ui fluid large teal submit button" type = "submit" value = "Login"></input>
      </div>
		<?php if($status == 1) {  ?>
      <div class="ui negative message">
 
  <div class="header">
    This email id does not exist in our record
  </div>
  </div>
		<?php } ?>
	   <?php if($status == 2) {  ?>
      <div class="ui negative message">
 
  <div class="header">
    Check your email for password reset link
  </div>
  </div>
		<?php } ?>
	  <?php if($_GET['status'] == 4) {  ?>
      <div class="ui negative message">
 
  <div class="header">
    Password link expired or not valid
  </div>
  </div>
		<?php } ?>
	   <?php if($_GET['status'] == 6) {  ?>
      <div class="ui success  message">
 
  <div class="header">
    Password Changed Successfully!
  </div>
  </div>
		<?php } ?>
	  <?php if($_GET['status'] == 'false') {  ?>	
	<div class="ui negative message">
 
  <div class="header">
    That seems incorrect !! Please try with valid login details
  </div>
  </div>
  <?php } ?>
    </form>
	<div class="ui message">
      <form class="ui small form" action="" method="post">
                <h3>Forget Password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                 <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="email" placeholder="E-mail address">
          </div>
        </div>
				            
                    <input type="submit" name = "submit" value="submit" class="ui fluid large teal submit button"></input>     
				
       
  </div>
  </form>
</div>
</div>
</div>
</body>
<script>

mapboxgl.accessToken = 'pk.eyJ1IjoidmlrYXNodGhlY29kZXIiLCJhIjoiY2lnZzQ5cm10N3Vza3UybTU5dXY4MjVhbyJ9.ZrKrD1ZqDiGe6pPcIP95XA';
var start = [-95.467055, 30.167395];
var end = [-104.985486, 39.751366];
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v9',
    center: start,
    zoom: 9
});
$(document).ready(function() { 
var isAtStart = true;


    // depending on whether we're currently at point a or b, aim for
    // point a or b
    var target = isAtStart ? end : start;

    // and now we're at the opposite point
    isAtStart = !isAtStart;

    map.flyTo({
        // These options control the ending camera position: centered at
        // the target, at zoom level 9, and north up.
        center: target,
        zoom: 9,
        bearing: 0,

        // These options control the flight curve, making it move
        // slowly and zoom out almost completely before starting
        // to pan.
        speed: 0.2, // make the flying slow
        curve: 1, // change the speed at which it zooms out

        // This can be any easing function: it takes a number between
        // 0 and 1 and returns another number between 0 and 1.
        easing: function (t) {
            return t;
        }
    });

});
</script>
</html>
