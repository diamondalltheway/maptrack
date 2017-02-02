<?php
include_once 'amazon_rds.php';

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
session_start();

$siteid = $_SESSION['siteid'];

if(!isset($_SESSION['siteid']))
{
echo "here";
header('Location: login.php');
die();
}
$sqlToFetchSiteId = "select * from userdetails where website_id = '".$_SESSION['siteid']."'";
	 $result = mysql_query($sqlToFetchSiteId,$conn) or die("Error in Selecting11 " . mysql_error($conn));
    //create an array
    
?>
<html lang="en">


    <head>
        <meta charset="utf-8" />
        <title>Map Track Pro  | Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.13.0/css/semantic.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.css">
		<script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
		   <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.js"></script>
      <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png"> 
	  <link href="../assets/global/plugins/codemirror/lib/codemirror.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/codemirror/theme/neat.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/codemirror/theme/ambiance.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/codemirror/theme/material.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/codemirror/theme/neo.css" rel="stylesheet" type="text/css" />
<style>
.popover {
z-index:999999!important;
}
body {
    margin: 0;
    padding: 0;
    font-family: "Open Sans", serif;
}

.ui.menu .item {
    font-weight: 300;
    font-size: 0.9rem;
}
 a.item {
 width:235px
 }
 #reportrange span {
 font-weight:bold;
 }
.column.starter {
    padding: 40px 15px;
}
.daterangepicker .ranges li {
color:black;
}
#subscancel{
display:none;
}
</style>
<script>
$(document).ready(function(){
$("#cancelSubscription").click(function() {
var subsid = $('#subsid').text();
$.post( "cancelstripesub.php", { subid: subsid})
  .done(function( data ) {
   if(data == 'YES')
   {
   $("#subscancel").css("display", "block");
   }
  });
});
});
</script>
	</head>	
    <body>
<?php include 'othermenu_semantic.php'; ?>


	            
               
           
    
         <main class="ui grid">
        <div class="row">
		
            <div class="eight wide column">
             <div class="ui tiny header" style = "margin-top: 10px;">
			Account and Payment Settings
			 </div>
<div class="ui raised segment">
  <?php   
  while($row = mysql_fetch_assoc($result)) {
  echo "<h3 class='ui fluid divider header'><b>Website Name </b></h3>  " . "<h4>".$row["website_name"]."</h4>";
 echo "<h3 class='ui fluid divider header'><b>Website Id </b></h3>  " . "<h4>".$row["website_id"]."</h4>";
 echo "<h3 class='ui fluid divider header'><b>Email Id </b></h3>  " . "<h4 >".$row["email_id"]."</h4>";
 echo "<h3 class='ui fluid divider header'><b>Customer ID </b></h3>  " . "<h4 >".$row["stripecustomerid"]."</h4>";
  echo "<h3 class='ui fluid divider header'><b>Subscription ID </b></h3>  " . "<h4 id='subsid'>".$row["stripesubscriptionid"]."</h4>";
 $date = date('d-M-y', strtotime('+30 days', strtotime($row['DOR'])));
 echo "<h3 class='ui fluid divider header'><b>Subscription Valid Untill </b>
 </h3>  " . "<h4 >".$date."</h4>";
 }
  
  ?>
  <div class="ui buttons">
  <button class="ui button">Upgrade/Downgrade your subscription</button>
  <div class="or"></div>
  <button id = "cancelSubscription" class="ui positive button">Cancel subscription</button>
</div>
  
</div>
<div id = "subscancel" class="ui  negative message">
  <i class="close icon"></i>
  <div class="header">
    your subscription is cancelled
  </div>
  </div>
</div>
	 <div class="eight wide column">
             <div class="ui tiny header" style = "margin-top: 10px;">
			Map Settings
			 </div>
<div class="ui raised segment">
 <form class="ui form">
  <div class="field">
    <h3 class='ui fluid divider header'></h3>
    <select id = "style">
	<option value = "streets">Streets</option>
		<option value = "dark">Dark</option>
		<option value = "light">Light</option>
	</select>
  </div>
  <div class="field">
    <h3 class='ui fluid divider header'></h3>
    <select name = "views">
		<option value = "2D">2D</option>
		<option value = "3D">3D</option>
		</select>
 
  </div>

  <button class="ui button" type="submit">Submit</button>
</form>
</div>
</div>
</body>

</html>