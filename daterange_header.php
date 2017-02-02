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
<style>
#reportrange
{
position: relative;
    padding: 9px;
    margin: 0 auto;
    background: #9bc7de;
    color: #fff;
    outline: none;
    cursor: pointer;
    font-weight: bold;
}
#sidr{
display:none;
background:white;
}
.page-header.navbar .menu-toggler{
background-size:100%;
}
#dd4{
width: 75px;
    position: relative;
    padding: 10px;
    margin: 0 auto;
    background: #e32082;
    color: #fff;
    outline: none;
    cursor: pointer;
    font-weight: bold;
}

@media only screen and (max-width: 767px){
    #mobile_menu {
        display: block;
    }
	#filter_menu{
	display:none;
	}
	.sidr{
	background: #364150!important;
	}
}
</style>



	<div id="sidr">
  <!-- Your content -->
  
     <ul>
	 
                        <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                  <a href = "#" onclick="$.sidr('close', 'sidr');"><img style = "float:right" src = "/assets/layouts/layout/img/close.png"></img></a>    
						<li>
                            <a href="dashboard.php"> Dashboard</a>
                        </li>
                        <li>
                            <a href="reports.php" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true"> Reports
                               
                            </a>                         
                        </li> 
					
						<li>
                            <a href="myaccount.php" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true"> Account
                                
                            </a>                         
                        </li>
						<li>
                            <a href="logout.php" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true"> Log Out
                                
                            </a>                         
                        </li>
                        <li >

                        </li>						
                    </ul>
 
</div>
	
	<div class="hor-menu  hor-menu-light hidden-sm hidden-xs">
                    <ul class="nav navbar-nav">
                        <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                        
					

                        <li id = "daterange" style = "margin-top:6px;">
						
                         <div class="form-group ">
                                                <div class="col-md-4">
                                                    <div id="reportrange" class="btn default">
                                                        <i class="fa fa-calendar"></i> &nbsp;
                                                        <span> </span>
                                                        <b class="fa fa-angle-down"></b>
                                                    </div>
                                                </div>
												
                                            </div>
                        </li>
                        <li id = "pagerange"  style = "margin-top:6px;">
						<div id="dd" class="wrapper-dropdown-1" tabindex="1" style = "width:350px">
                        <span>All Pages</span>
						<ul class="dropdown" id = "mtpage" style = "width:350px" tabindex="1">
						<li><a href="#"><?php echo $page; ?></a></li>
                          <?php foreach($pages as $page)
{
?>
<li><a href="#"><?php echo $page; ?></a></li>
<?php
}						  ?>
<li><a href = "#">All Pages</a></li>
                                              </ul>
											
												</div>
						</li>
<li id = "ziprange" style = "margin-top:6px;">
<div id="dd1" class="wrapper-dropdown-1" tabindex="1">
						<span>All Zipcodes</span>
                       <ul class="dropdown" id = "mtzip" tabindex="1">
                          <?php foreach($postcodes as $post)
{
?>
 <li><a href="#"><?php echo $post; ?></a></li>
<?php
}						  ?>
<li><a href = "#">All Zipcodes</a></li>
                                                </ul>
											
												</div>
						</li>


<li id = "cityrange" style = "margin-top:6px">
<div id="dd3" class="wrapper-dropdown-1" tabindex="1">
<span>All Cities</span>
                         <ul class="dropdown" id = "mtcity" tabindex="1">
					        <?php foreach($cities as $city)
{
?>
 <li><a href="#"><?php echo $city; ?></a></li>
<?php
}						  ?>
<li><a href = "#">All Cities</a></li>
                                                </ul>
												
												</div>
						</li>
<li id = "clearrange" style = "margin-top:6px">
<div id="dd4"  style = "width:75px" tabindex="1">
<span id = "clear">Clear</span>
</div>
</li>
                    </ul>
                </div>