<?php
include 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$pages = array();
$sqlToFetchPageDetails = "select  pagetitle  , count(pagetitle) as count from mapkitchendata where pagetitle != '' and site_id = '".$_SESSION['siteid']."' group by pagetitle order by count desc limit 10";

$result = mysql_query($sqlToFetchPageDetails,$conn) or die("Error in Selecting11 " . mysql_error($conn));

	  if(mysql_num_rows($result) > 0)
	 {
	  while($row = mysql_fetch_assoc($result)) {
	   
       $pages[] = $row['pagetitle'];

	  
	   }
	 }
$postcodes = array();
$sqlToFetchZipcodes = " (SELECT postcode,count(location) as loc FROM   mapkitchendata where address <> '' and location <> -1 and country = 'United States' and site_id ='".$_SESSION['siteid']."' group by postcode order by loc desc limit 5)";

$result11 = mysql_query($sqlToFetchZipcodes,$conn) or die("Error in Selecting11 " . mysql_error($conn));

	  if(mysql_num_rows($result11) > 0)
	 {
	  while($row = mysql_fetch_assoc($result11)) {
	   
       $postcodes[] = $row['postcode'];

	  
	   }
	 }
$cities = array();
$sqlToFetchCities = "SELECT city,count(location) as loc FROM   mapkitchendata where address <> '' and city <> '' and location <> -1 and country = 'United States' and site_id ='".$_SESSION['siteid']."' group by city order by loc desc limit 5";
$result111 = mysql_query($sqlToFetchCities,$conn) or die("Error in Selecting11 " . mysql_error($conn));

	  if(mysql_num_rows($result111) > 0)
	 {
	  while($row = mysql_fetch_assoc($result111)) {
	   
       $cities[] = $row['city'];

	  
	   }
	 }


mysql_close($conn);
?> 	

	

       <div class="ui stackable menu">
  <div class="ui small image item">
    <img class = "ui fluid image" src="/assets/layouts/layout/img/logo.png"></img>
  </div>
  <a class = "item">
   <div id="reportrange" class="ui fluid">
                                                        <i class="fa fa-calendar"></i> &nbsp;
                                                        <span> </span>
                                                        <b class="fa fa-angle-down"></b>
                                                    </div>
  </a>
  <a   class="item">

<select id = "zips" class="ui fluid search selection dropdown" multiple="">
  <option value="">Zips</option>
  <?php foreach($postcodes as $post)
  { ?>
  <option value = "<?php echo $post ?>"><?php echo $post ?></option>
 <?php }
?>
</select>
<script>
$('#zips')
  .dropdown({
  onChange: function(value, text, $selectedItem) { 
	 $('#dimmerMap').addClass('active');
	 $('#dimmerAddress').addClass('active');
  var zip = value;
	  var page = '';
	  var city = '';
	  $.cookie("<?php echo $_SESSION['siteid'] ?>-zip",zip, {expires: new Date(2016, 12, 31, 00, 00, 00)});
      if($.cookie("<?php echo $_SESSION['siteid'] ?>-sDate") == null && $.cookie("<?php echo $_SESSION['siteid'] ?>-eDate") == null)
	  {
	    zipsdate = moment().subtract('days', 29).format('YYYY-MM-DD');
	    zipedate = moment().format('YYYY-MM-DD');
	  }
	  else
	  {
	     zipsdate = $.cookie("<?php echo $_SESSION['siteid'] ?>-sDate") 
	    zipedate = $.cookie("<?php echo $_SESSION['siteid'] ?>-eDate")
	  }
	  if($.cookie("<?php echo $_SESSION['siteid'] ?>-page") != null)
	  {
	  page = $.cookie("<?php echo $_SESSION['siteid'] ?>-page");
	  }
	   if($.cookie("<?php echo $_SESSION['siteid'] ?>-city") != null)
	  {
	  city = $.cookie("<?php echo $_SESSION['siteid'] ?>-city");
	  }
        mapkitchenMaps.init(zipsdate ,zipedate,page,zip,city);  
		addressTable.init(zipsdate,zipedate,page,zip,city);
  }
  })
;
if($.cookie("<?php echo $_SESSION['siteid'] ?>-zip") != '')
	  {
		var zip_array = $.cookie("<?php echo $_SESSION['siteid'] ?>-zip").toString().split(',');
		
		$('#zips').dropdown("set selected",zip_array);
	  }

</script>
  </a>
  <a class="item"><select id = "cities" class="ui fluid search selection dropdown" multiple="">
  <option value="">Cities</option>
  <?php foreach($cities as $city)
  { ?>
  <option value = "<?php echo $city ?>"><?php echo $city ?></option>
 <?php }
?>
</select>
<script>
$('#cities')
  .dropdown({
  onChange: function(value, text, $selectedItem) {  
  $('#dimmerMap').addClass('active');
  $('#dimmerAddress').addClass('active');
  var city = value;
	  var page = '';
	  var zip = '';
	  $.cookie("<?php echo $_SESSION['siteid'] ?>-city",city, {expires: new Date(2016, 12, 31, 00, 00, 00)});
      if($.cookie("<?php echo $_SESSION['siteid'] ?>-sDate") == null && $.cookie("<?php echo $_SESSION['siteid'] ?>-eDate") == null)
	  {
	    zipsdate = moment().subtract('days', 29).format('YYYY-MM-DD');
	    zipedate = moment().format('YYYY-MM-DD');
	  }
	  else
	  {
	     zipsdate = $.cookie("<?php echo $_SESSION['siteid'] ?>-sDate") 
	    zipedate = $.cookie("<?php echo $_SESSION['siteid'] ?>-eDate")
	  }
	  if($.cookie("<?php echo $_SESSION['siteid'] ?>-page") != null)
	  {
	  page = $.cookie("<?php echo $_SESSION['siteid'] ?>-page");
	  }
	   if($.cookie("<?php echo $_SESSION['siteid'] ?>-zip") != null)
	  {
	  zip = $.cookie("<?php echo $_SESSION['siteid'] ?>-zip");
	  }
        mapkitchenMaps.init(zipsdate ,zipedate,page,zip,city);  
		addressTable.init(zipsdate,zipedate,page,zip,city);
  }
  })
;
if($.cookie("<?php echo $_SESSION['siteid'] ?>-city") != '')
	  {
		var city_array = $.cookie("<?php echo $_SESSION['siteid'] ?>-city").toString().split(',');
		
		$('#cities').dropdown("set selected",city_array);
	  }
</script></a>
   <a class="item"><select id = "pages" class="ui fluid search selection dropdown" multiple="">
  <option value="">Pages</option>
  <?php foreach($pages as $page)
  { ?>
  <option value = "<?php echo $page ?>"><?php echo $page ?></option>
 <?php }
?>
</select>
<script>
$('#pages')
  .dropdown({
  onChange: function(value, text, $selectedItem) { 
	 $('#dimmerMap').addClass('active');
	 $('#dimmerAddress').addClass('active');
  var page = value;
	  var zip = '';
	  var city = '';
	  $.cookie("<?php echo $_SESSION['siteid'] ?>-page",page, {expires: new Date(2016, 12, 31, 00, 00, 00)});
      if($.cookie("<?php echo $_SESSION['siteid'] ?>-sDate") == null && $.cookie("<?php echo $_SESSION['siteid'] ?>-eDate") == null)
	  {
	    zipsdate = moment().subtract('days', 29).format('YYYY-MM-DD');
	    zipedate = moment().format('YYYY-MM-DD');
	  }
	  else
	  {
	     zipsdate = $.cookie("<?php echo $_SESSION['siteid'] ?>-sDate") 
	    zipedate = $.cookie("<?php echo $_SESSION['siteid'] ?>-eDate")
	  }
	  if($.cookie("<?php echo $_SESSION['siteid'] ?>-zip") != null)
	  {
	  zip = $.cookie("<?php echo $_SESSION['siteid'] ?>-zip");
	  }
	   if($.cookie("<?php echo $_SESSION['siteid'] ?>-city") != null)
	  {
	  city = $.cookie("<?php echo $_SESSION['siteid'] ?>-city");
	  }
        mapkitchenMaps.init(zipsdate ,zipedate,page,zip,city);  
		addressTable.init(zipsdate,zipedate,page,zip,city);
  }
  })
;
if($.cookie("<?php echo $_SESSION['siteid'] ?>-page") != '')
	  {
		var page_array = $.cookie("<?php echo $_SESSION['siteid'] ?>-page").toString().split(',');
		
		$('#pages').dropdown("set selected",page_array);
	  }
</script></a>
<a class="item" style = "width:100px">
<button class=" ui button" style = "background: #e32082!important;color: white!important;" id = "clear">Clear</button>
</a>
<a class="item" style = "width:100px">
<button class=" ui button" id = "more" style = "background: #e32082!important;color: white!important;" id = "clear">More</button>
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