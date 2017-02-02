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
   while($row = mysql_fetch_assoc($result)) {
   $cardname = $row['nameoncard'];
   $cardno = $row['cardno'];
    $cvv = $row['cvv'];
   $expdate = $row['expdate'];
   $expdates = explode("/",$expdate);
   $view = $row['style'];
   $email = $row['email_id'];
   $website_name = $row['website_name'];
   $billingstartdate =  $row['billingstartdate'];
   $billingenddate = $row['billingenddate']; 
   $customerid = $row['stripecustomerid'];
}
$sqlToFetchAddressCount = "select distinct a.address from mapkitchendata a inner join userdetails b on a.site_id = b.website_id where a.site_id = '".$_SESSION['siteid']."' and a.type = 'R' and (a.phone != '' or a.email != '') and DATE(a.datevisited) >= DATE('".$billingstartdate."') and DATE(a.datevisited) <= DATE('".$billingenddate."')";
	 
	 $result1 = mysql_query($sqlToFetchAddressCount,$conn) or die("Error in Selecting11 " . mysql_error($conn));
	
$count = mysql_num_rows($result1);
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

	</head>
<style>
.ui.grid {
margin-top: 0rem; 
margin-bottom: 0rem; 
}
.ui.inverted.menu{
background:#2185d0!important;
}
</style>	
    <body>
<?php include 'othermenu_semantic.php'; ?>


	            
               
           
    
         <main class="ui page grid">
        <div class="row">
<div class="sixteen wide column">
		<div class="ui top attached tabular menu">
  <a class="active item" data-tab="first">Account Information</a>
  <a class="item" data-tab="second">Maps</a>
  <a class="item" data-tab="third">Payment Info</a>
</div>
<div class="ui bottom attached active tab segment" data-tab="first">
  <div class="ui list">
  <div class="item">
    <i class="map marker icon"></i>
    <div class="content">
      <a class="header">Email Address</a>
      <div class="description"><?php echo $email ?></div>
    </div>
  </div>
  <div class="item">
    <i class="map marker icon"></i>
    <div class="content">
      <a class="header">Website Name</a>
      <div class="description"><?php echo $website_name ?></div>
    </div>
  </div>
  <div class="item">
    <i class="map marker icon"></i>
    <div class="content">
      <a class="header">Next Billing Date</a>
      <div class="description"><?php echo $billingdate ?></div>
    </div>
  </div>
  <div class="item">
    <i class="map marker icon"></i>
    <div class="content">
      <a class="header">Your Customer ID</a>
      <div class="description"><?php echo $customerid ?></div>
    </div>
  </div>
</div>
</div>
<div class="ui bottom attached tab segment" data-tab="second">
  <div class="ui form">

    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" id="view" name = "view" value ="streets" checked="" tabindex="0" class="hidden">
        <label>Streets</label>
      </div>
    </div>
    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" id="view" name = "view" value ="light" tabindex="0" class="hidden">
        <label>Light</label>
      </div>
    </div>
    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" id="view" name = "view" value ="dark" tabindex="0" class="hidden">
        <label>Dark</label>
      </div>
    </div>
 <button class="ui button" tabindex="0" id = "btnUpdateView">Update Your Style</button>
 <BR/>
 <BR/>
<div class="ui statistic">
  <div class="value">
    <?php echo $count ?> 
  </div>
  <div class="label">
    Verified Residential Addresses Collected in this billing cycle<BR/><BR/>
	<?php if($_SESSION['plan']  == 'Leads (50 cents)')  {  ?>
	You will be charged $<?php echo $count*0.50 ?> in next billing cycle
	<?php } else {   ?>    
	You will be charged $<?php echo $count*0.10 ?> in next billing cycle
	<?php } ?>
  </div>
</div>
  </div>

</div>
<div class="ui bottom attached tab segment" data-tab="third">
 <form class="ui form">
  <h4 class="ui dividing header">Billing Information</h4>
  <div class="field">
    <div class="seven wide field">
      <label>Name On Card</label>
      <input type="text" name="card[name]" data-validation = "required" maxlength="16" id = "cardname" placeholder="Name On Card" value = "<?php echo $cardname ?>">
    </div>
  </div>
  <div class="fields">
    <div class="seven wide field">
      <label>Card Number</label>
      <input type="text" name="card[number]" data-validation = "required" maxlength="16" id = "cardno" placeholder="Card #" value = "<?php echo $cardno ?>">
    </div>
    <div class="three wide field">
      <label>CVC</label>
      <input type="text" name="card[cvc]" data-validation = "required" maxlength="3" id = "cvc" placeholder="CVC" value = "<?php echo $cvv ?>">
    </div>
    <div class="six wide field">
      <label>Expiration</label>
      <div class="two fields">
        <div class="field">
          <select class="ui fluid search dropdown" data-validation = "required" id = "cardmonth" name="card[expire-month]">
            <option value="">Month</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
        </div>
        <div class="field">
          <input type="text" name="card[expire-year]" data-validation = "required" maxlength="4" id = "cardyear" placeholder="Year" value = "<?php echo $expdates[1] ?>">
        </div>
      </div>
    </div>
  </div>
  <button class="ui button" tabindex="0" id = "btnUpdate">Update</button>
 <p>If you want to discontinue our services , Please email us at hunter@maptrackpro.com , your account and card details will be deleted after settling any dues</p>
  </div>
 
</form>
</div>
          
</div>
</div>
</body>
<script>
$('.menu .item')
  .tab()
;
$('.ui.checkbox')
  .checkbox()
;
$(document).ready(function() { 
$("#cardmonth").val("<?php echo  $expdates[0] ?>");
$("input[name=view][value=<?php echo $view ?>]").attr('checked', 'checked');
$("#btnUpdate").click(function() {
var cardname = $("#cardname").val();
var cardno = $("#cardno").val();
var cvc = $("#cvc").val();
var cardmonth = $("#cardmonth").val();
var cardyear = $("#cardyear").val();
var siteid = '<?php echo $_SESSION['siteid']; ?>';
$.post( "updatedetails.php", { action :"update" ,cardname: cardname, cardno: cardno,cvc:cvc,cardmonth:cardmonth, cardyear:cardyear,siteid:siteid})
  .done(function( data ) {
    
    alert( "Data updated successfully" );
	location.reload();
  });
  return false;
});

$("#btnRemove").click(function() {
var cardname = ''
var cardno = ''
var cvc = ''
var cardmonth = ''
var cardyear = ''
var siteid = '<?php echo $_SESSION['siteid']; ?>';
$.post( "updatedetails.php", { action :"update" ,cardname: cardname, cardno: cardno,cvc:cvc,cardmonth:cardmonth, cardyear:cardyear,siteid:siteid})
  .done(function( data ) {
    
    alert( "Your request is accepted, your card will be removed after settling all dues if any" );
	location.reload();
  });
  return false;
});

$("#btnUpdateView").click(function() {
var view = $('input[name=view]:checked').val();
var siteid = '<?php echo $_SESSION['siteid']; ?>';
$.post( "updatedetails.php", { action :"updateview" ,view: view,siteid:siteid})
  .done(function( data ) {
    
    alert( "Your view is updated successully, Go to maps to check your views" );
	location.reload();
  });
  return false;
});

});
</script>
</html>