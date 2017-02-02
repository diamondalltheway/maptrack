<?php
include 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_close($conn);
?> 	

	

       <div class="ui stackable menu">
  <div class="ui small image item">
    <img class = "ui fluid image" src="/assets/layouts/layout/img/logo.png"></img>
  </div>
  

<a class="item" style = "width:100px">
<button class=" ui button" id = "more" style = "background: #e32082!important;color: white!important;" id = "clear">Menu</button>
</a>
	<div class="ui left  demo vertical inverted  sidebar labeled icon menu">
  <a href = "/dashboard" class="item">
    <i class="home icon"></i>
    Dashboard
  </a>
  <a href = "/myaccount" class="item">
    <i class="code icon"></i>
    Tracking Code
  </a>
  <a href = "/account_settings" class="item">
    <i class="smile icon"></i>
    Account Settings
  </a>
 
   <a href = "/logout" class="item">
    <i class="Sign Out icon"></i>
    Log Out
  </a>
</div>
<script>
$('#more').click(function() {
$('.ui.labeled.icon.sidebar')
  .sidebar('toggle')
;
});
</script>
</div>