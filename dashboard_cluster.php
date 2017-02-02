<?php
session_start();


include 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}


if(isset($_POST['login']) && isset($_POST['password']))
{

$sqlToFetchLoginDetails = "SELECT * FROM mapkitchen.userdetails WHERE (USERNAME = '".$_POST['login']."' OR email_id = '".$_POST['login']."') AND password = '".$_POST['password']."'";


	 $result = mysql_query($sqlToFetchLoginDetails,$conn) or die("Error in Selecting11 " . mysql_error($conn));
    
	
	 
	 if(mysql_num_rows($result) > 0)
	 {
	  while($row = mysql_fetch_assoc($result)) {
	   
       $siteid = $row['website_id'];
	   $sitename = $row['website_name'];
	    $_SESSION['siteid'] = $siteid;
		$_SESSION['sitename'] = $sitename;
		$_SESSION['ispasswordchanged'] = $row['ispasswordchanged'];
	    if($row['ispasswordchanged'] == '-1')
		{
		 header('Location: askwebsite.php?siteid='.$siteid);
	     die();
		}
	   }
	 }
	 else
	 {

	  header('Location: login.php?status=false');
	  die();
	 }
}
/*
if($_GET['login'] == 'google')
{
$sqlToFetchLoginDetails = "SELECT * FROM mapkitchen.userdetails WHERE (USERNAME = '".$_SESSION["user_email"]."' OR email_id = '".$_SESSION["user_email"]."') AND password = 'google'";

$result = mysql_query($sqlToFetchLoginDetails,$conn) or die("Error in Selecting11 " . mysql_error($conn));
    
	
	 
	 if(mysql_num_rows($result) > 0)
	 {
	  while($row = mysql_fetch_assoc($result)) {
	   
       $siteid = $row['website_id'];
	   $sitename = $row['website_name'];
	    $_SESSION['siteid'] = $siteid;
		$_SESSION['sitename'] = $sitename;
	  
	   }
	 }

}*/
if(!isset($_SESSION['siteid']))
{
header('Location: login.php');
die();
}
if($_SESSION['ispasswordchanged'] == '-1')
{
header('Location: askwebsite.php?siteid='.$_SESSION['siteid']);
die();
}
$sqlsettimezone = "SET time_zone = 'US/Central'";
$retval = mysql_query( $sqlsettimezone, $conn );
$visitorToday = mysql_result(mysql_query("SELECT COUNT(*) FROM mapkitchendata where DATE(datevisited) = DATE(NOW()) AND site_id = '".$_SESSION['siteid']."'"),0);
$visitorOptinToday = mysql_result(mysql_query("SELECT COUNT(*) FROM mapkitchendata where DATE(datevisited) = DATE(NOW()) AND site_id = '".$_SESSION['siteid']."' AND location <> -1"),0);
$overallvisitor = mysql_result(mysql_query("SELECT COUNT(*) FROM mapkitchendata where site_id = '".$_SESSION['siteid']."'"),0);
$overalloptins = mysql_result(mysql_query("SELECT COUNT(*) FROM mapkitchendata where site_id = '".$_SESSION['siteid']."' and location <> -1"),0);
$initialLocation = mysql_result(mysql_query("select max(location) from mapkitchendata where postcode = ((SELECT postcode FROM (SELECT postcode,count(location) as loc FROM   mapkitchendata where address <> '' and country <> '' and location <> -1 and site_id = '".$_SESSION['siteid']."'  group by postcode order by loc desc) as results limit 1))"),0);
if($initialLocation == null)
{
$initialLocation = explode(",", "30.154355300000002,-95.38463089999999");
}
else
{
$initialLocation = explode(",", $initialLocation);
}
mysql_close($conn);
?>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Map Kitchen | Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
       
		<!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
        <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../assets/layouts/layout/css/custom.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="icon" href="favicon.ico" /> </head>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.sidr/2.2.1/stylesheets/jquery.sidr.dark.min.css">
		       <!-- BEGIN PAGE LEVEL PLUGINS -->
 <link href="../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
       <link href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-white page-sidebar-reversed">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="dashboard.php">
                        <img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
                </div>
	            <?php include 'daterange_header.php'; ?>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a id ="filter_menu" href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                       
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                               
                                <span class="username username-hide-on-mobile"><?php echo $_SESSION['sitename'] ?></span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                						<li>
                            <a href="dashboard.php"> Dashboard</a>
                        </li>
                        <li>
                            <a href="reports.php"> Reports
                               
                            </a>                         
                        </li> 
								
								<li>
                                    <a href="myaccount.php">
                                         Tracking Code </a>
                                </li>
								
                                <li>
                                    <a href="logout.php">
                                         Log Out </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
		       <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                    
             
                    <!-- END THEME PANEL -->
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">                
                         <ul  class="page-breadcrumb">
						 
						 <li>
							<span ><b>Overall Optin's</b> : <?php echo $overalloptins; ?>&nbsp;</span>&nbsp;<span><b>Today's Optin's Count:</b> &nbsp;<?php echo $visitorOptinToday; ?></span>
							</li>
						</ul>
                    </div>
                   
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
   
                    <div class="row">
                        <div class="col-md-12">
						 <div class="portlet light portlet-fit bordered">

                            
                                                 
                                    <div id='pointmap'></div>                               
                           
                           
                        </div>
					</div>
					</div>
				
                    
                   
             
                </div>
                <!-- END CONTENT BODY -->
            </div>
             <div class="page-sidebar-wrapper">
                <!-- END SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                       <li>
					   	                      
                                      <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>									
                                                <th> Address </th>
                                                
                                            </tr>
                                        </thead>
							</table>                             
                        
					   </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
				</div>
     
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->

          
        </div>
		</div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src ="https://fgnass.github.io/spin.js/spin.min.js"></script>
		 <script src ="../assets/pages/scripts/jquery.cookies.js"></script>
		<!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
  <script src="../assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script> 
        <script src="//cdn.jsdelivr.net/jquery.sidr/2.2.1/jquery.sidr.min.js"></script>	
		<!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
	   <script src = "https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
	   <script src = "//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	   <script src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	   <script src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	   <script src = "//cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
	   <script src = "//cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
		<!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="//cdn.jsdelivr.net/jquery.sidr/2.2.1/jquery.sidr.min.js"></script>			 
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.16.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.16.0/mapbox-gl.css' rel='stylesheet' />

        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src = "https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
	   <script src = "//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	   <script src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	   <script src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	   <script src = "//cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
	   <script src = "//cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
<?php

?>
<script>
       var addressTable = function () {
	   var loadaddress = function (start,end,page,zip) {
        var dataTable = $('#sample_1').DataTable( {
        "bServerSide": true,
        "sAjaxSource": "addressdata.php?siteid=<?php echo $_SESSION['siteid'];  ?>&start="+start+"&end="+end+"&page="+encodeURIComponent(page)+"&zip="+zip+"",
        "sServerMethod": "POST",
        "scrollY":        "750px",
        "scrollCollapse": "true",
		"bInfo" : false,
		"bFilter":false,
        "paging":         false,
		"dom": "Bfrtipl",
		 "buttons": [
        'copy', 'excel', 'pdf' , 'print'
    ],
		"columns": [
                { "data": "address" },
              ]
            
        } );
}
		return {
        //main function to initiate the module
        init: function (start,end,page,zip) {
		    $('#sample_1').DataTable().destroy();
            loadaddress(start,end,page,zip);
        }
    };

}();
   

$(document).ready(function() {    
        ComponentsDateTimePickers.init();
		
        		
    });
var ComponentsDateTimePickers = function () {

    var handleDateRangePickers = function () {
        if (!jQuery().daterangepicker) {
            return;
        }
 
        $('#reportrange').daterangepicker({
                opens: (App.isRTL() ? 'left' : 'right'),
                startDate: moment().subtract('days', 29),
                endDate: moment(),
                minDate: '01/01/2016',
                maxDate: '12/31/2020',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Now': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                buttonClasses: ['btn'],
                applyClass: 'green',
                cancelClass: 'default',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Apply',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            },
             function (start, end) {
			 var page = '';
		var zip = '';
		if($.cookie("<?php echo $_SESSION['siteid'] ?>-page") != null)
	  {
	  page = $.cookie("<?php echo $_SESSION['siteid'] ?>-page");
	  }
	  if($.cookie("<?php echo $_SESSION['siteid'] ?>-zip") != null)
	  {
	  zip = $.cookie("<?php echo $_SESSION['siteid'] ?>-zip");
	  }
			 var sDate = start.format('YYYY-MM-DD'); 
	         var eDate = end.format('YYYY-MM-DD'); 
             var sDateToDisplay = start.format("MMM Do YYYY");
             var eDateToDisplay  = end.format("MMM Do YYYY");			 
		 $.cookie("<?php echo $_SESSION['siteid'] ?>-sDate",sDate, {expires: new Date(2016, 12, 31, 00, 00, 00)});
		 $.cookie("<?php echo $_SESSION['siteid'] ?>-eDate",eDate, {expires: new Date(2016, 12, 31, 00, 00, 00)});
		 $.cookie("<?php echo $_SESSION['siteid'] ?>-sDateToDisplay",sDateToDisplay, {expires: new Date(2016, 12, 31, 00, 00, 00)});
		 $.cookie("<?php echo $_SESSION['siteid'] ?>-eDateToDisplay",eDateToDisplay, {expires: new Date(2016, 12, 31, 00, 00, 00)});
	    $('#reportrange span').html(sDateToDisplay + ' - ' + eDateToDisplay);
		
		mapkitchenMaps.init(sDate ,eDate,page,zip);
		addressTable.init(sDate,eDate,page,zip);
         }
        );
	  var sDate = '';
      var eDate = '';
      var sDateToDisplay = '';
      var eDateToDisplay  = '';	  
	  if($.cookie("<?php echo $_SESSION['siteid'] ?>-sDate") == null || $.cookie("<?php echo $_SESSION['siteid'] ?>-eDate") == null )
	  {
	    sDate = moment().subtract('days', 29).format('YYYY-MM-DD');
	    eDate = moment().format('YYYY-MM-DD');
		sDateToDisplay = moment().subtract('days', 29).format("MMM Do YYYY");
		eDateToDisplay = moment().format("MMM Do YYYY");
	  }
	  else
	  {
	     sDate = $.cookie("<?php echo $_SESSION['siteid'] ?>-sDate")
	    eDate = $.cookie("<?php echo $_SESSION['siteid'] ?>-eDate")
        sDateToDisplay = $.cookie("<?php echo $_SESSION['siteid'] ?>-sDateToDisplay")
		eDateToDisplay = $.cookie("<?php echo $_SESSION['siteid'] ?>-eDateToDisplay")
	  }
       
        var page = '';
		var zip = '';
		if($.cookie("<?php echo $_SESSION['siteid'] ?>-page") != null)
	  {
	  page = $.cookie("<?php echo $_SESSION['siteid'] ?>-page");
	  }
	  if($.cookie("<?php echo $_SESSION['siteid'] ?>-zip") != null)
	  {
	  zip = $.cookie("<?php echo $_SESSION['siteid'] ?>-zip");
	  }
	    $('#reportrange span').html(sDateToDisplay  + ' - ' + eDateToDisplay);
		mapkitchenMaps.init(sDate ,eDate,page,zip);
		addressTable.init(sDate,eDate,page,zip);
        
      

    }

    return {
        //main function to initiate the module
        init: function () {
            handleDateRangePickers();
        }
    };

}();

var mapkitchenMaps = function () {
 var LoadUserMaps = function (start,end,page,zip) {
var opts = {
  lines: 13, // The number of lines to draw
  length: 20, // The length of each line
  width: 10, // The line thickness
  radius: 30, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 0, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#000', // #rgb or #rrggbb or array of colors
  speed: 1, // Rounds per second
  trail: 60, // Afterglow percentage
  shadow: false, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: '50%', // Top position relative to parent
  left: '50%' // Left position relative to parent
};

var target = document.getElementById('pointmap'); //put your target here!
var spinner = new Spinner(opts).spin(target); 
mapboxgl.accessToken = 'pk.eyJ1IjoidmlrYXNodGhlY29kZXIiLCJhIjoiY2lnZzQ5cm10N3Vza3UybTU5dXY4MjVhbyJ9.ZrKrD1ZqDiGe6pPcIP95XA';
var userLayer = '';
if($.cookie("<?php echo $_SESSION['siteid'] ?>-layer") != null)
{
userLayer = $.cookie("<?php echo $_SESSION['siteid'] ?>-layer");
} 
else
{
userLayer = 'streets';
}
var zoom = '';
  if($.cookie("<?php echo $_SESSION['siteid'] ?>-zoom") != null)
  {
  zoom = $.cookie("<?php echo $_SESSION['siteid'] ?>-zoom");
  }
  else
  {
  zoom = 11;
  }
var map = new mapboxgl.Map({
    container: 'pointmap', // container id
    style: 'mapbox://styles/mapbox/'+userLayer+'-v8', //stylesheet location
    center: [<?php echo $initialLocation[1] ?>,<?php echo $initialLocation[0] ?>],
    zoom : zoom
});

map.on('style.load', function() {
 map.addSource("mapgeojsondata", {
       "type": "geojson",
       "data": "geojsons/<?php echo $_SESSION['siteid'];  ?>.geojson",
	   "cluster": true,
        "clusterMaxZoom": 14, // Max zoom to cluster points on
        "clusterRadius": 50 // Radius of each cluster when clustering points (defaults to 50)
   });
if(page == '' && zip == '')
{
map.addLayer({
     "id": "mapgeojsonlayer",
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end]],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#1DC5B3",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
}
if(page != '')
{
map.addLayer({
     "id": "mapgeojsonlayer",
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "pagetitle", page]],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#1DC5B3",
        "circle-opacity": 0.5
      },
   },'road-label-sm');

}  
if(zip != '')
{
map.addLayer({
     "id": "mapgeojsonlayer",
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "postcode", zip]],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#1DC5B3",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
} 
if(page != '' && zip != '')
{
map.addLayer({
     "id": "mapgeojsonlayer",
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "postcode", zip],["==", "pagetitle", page]],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#1DC5B3",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
}    
var layers = [
        [150, '#f28cb1'],
        [20, '#f1f075'],
        [0, '#51bbd6']
    ];
layers.forEach(function (layer, i) {

        map.addLayer({
            "id": "cluster-" + i,
            "type": "circle",
            "source": "mapgeojsondata",
            "paint": {
                "circle-color": layer[1],
                "circle-radius": 18
            },
            "filter": i == 0 ?
                [">=", "point_count", layer[0]] :
                ["all",
                    [">=", "point_count", layer[0]],
                    ["<", "point_count", layers[i - 1][0]]]					
        });


});

   
    map.addLayer({
        "id": "cluster-count",
        "type": "symbol",
        "source": "mapgeojsondata",
        "layout": {
            "text-field": "{point_count}",
            "text-font": [
                    "DIN Offc Pro Medium",
                    "Arial Unicode MS Bold"
                ],
            "text-size": 12
        }
    });
});

if($.cookie("<?php echo $_SESSION['siteid'] ?>-view") != null)
{
if($.cookie("<?php echo $_SESSION['siteid'] ?>-view") == 'a1')
{
map.setPitch(60);
map.setBearing(-60);
}
else
{
map.setPitch(0);
map.setBearing(0);
}
}
else
{
map.setPitch(0);
map.setBearing(0);
}
map.on('load', function (e) {
       spinner.stop();
    });
map.on('zoom', function (e) {
       var zoom = map.getZoom();
       $.cookie("<?php echo $_SESSION['siteid'] ?>-zoom",zoom, {expires: new Date(2016, 12, 31, 00, 00, 00)});
    });
map.on('click', function (e) {
    var features = map.queryRenderedFeatures(e.point, { layers: ['mapgeojsonlayer'] });

    if (!features.length) {
        return;
    }

    var feature = features[0];

    // Populate the popup and set its coordinates
    // based on the feature found.
    var popup = new mapboxgl.Popup()
        .setLngLat(feature.geometry.coordinates)
        .setHTML(feature.properties.address)
        .addTo(map);
});
map.on('mousemove', function (e) {
    var features = map.queryRenderedFeatures(e.point, { layers: ['mapgeojsonlayer'] });
    map.getCanvas().style.cursor = (features.length) ? 'pointer' : '';
});	
$( "#mbstyle" ).change(function() {	
spinner.spin();
var layerId = $( this ).val();
map.setStyle('mapbox://styles/mapbox/' + layerId + '-v8');
$.cookie("<?php echo $_SESSION['siteid'] ?>-layer",layerId, {expires: new Date(2016, 12, 31, 00, 00, 00)});
});

$( "#mapviews" ).change(function() {	
spinner.spin();
var layerId = $( this ).val();
if(layerId == 'a1')
{
map.setPitch(60);
map.setBearing(-60);
$.cookie("<?php echo $_SESSION['siteid'] ?>-view",layerId, {expires: new Date(2016, 12, 31, 00, 00, 00)});
}
else
{
map.setPitch(0);
map.setBearing(0);
$.cookie("<?php echo $_SESSION['siteid'] ?>-view",layerId, {expires: new Date(2016, 12, 31, 00, 00, 00)});
}

});
function switchView(layer)
{
spinner.spin();
var layerId = layer.target.id;


}
map.addControl(new mapboxgl.Navigation());
}

    return {
        //main function to initiate the module
        init: function (start,end,page,zip) {
            LoadUserMaps(start,end,page,zip);
        }
    };

}();
</script>
<script>
$(document).ready(function() {
  $('#mobile_menu').sidr();
  $('#sidr').css('display','block');
   if($.cookie("<?php echo $_SESSION['siteid'] ?>-page") != null)
{
  $('#pageid').val($.cookie("<?php echo $_SESSION['siteid'] ?>-page"));
}
     if($.cookie("<?php echo $_SESSION['siteid'] ?>-zip") != null)
{
  $('#zipcode').val($.cookie("<?php echo $_SESSION['siteid'] ?>-zip"));
}
     if($.cookie("<?php echo $_SESSION['siteid'] ?>-view") != null)
{
  $('#mapviews').val($.cookie("<?php echo $_SESSION['siteid'] ?>-view"));
}
     if($.cookie("<?php echo $_SESSION['siteid'] ?>-layer") != null)
{
  $('#mbstyle').val($.cookie("<?php echo $_SESSION['siteid'] ?>-layer"));
}
});

$( "#pageid" ).change(function() {
      var pageval = $( this ).val();
	  var zipval = "";
	  $.cookie("<?php echo $_SESSION['siteid'] ?>-page",pageval, {expires: new Date(2016, 12, 31, 00, 00, 00)});
      if($.cookie("<?php echo $_SESSION['siteid'] ?>-sDate") == null && $.cookie("<?php echo $_SESSION['siteid'] ?>-eDate") == null)
	  {
	    pagesdate = moment().subtract('days', 29).format('YYYY-MM-DD');
	    pageedate = moment().format('YYYY-MM-DD');
	  }
	  else
	  {
	     pagesdate = $.cookie("<?php echo $_SESSION['siteid'] ?>-sDate"); 
	    pageedate = $.cookie("<?php echo $_SESSION['siteid'] ?>-eDate")
	  }
	  if($.cookie("<?php echo $_SESSION['siteid'] ?>-zip") != null)
	   {
	   zipval = $.cookie("<?php echo $_SESSION['siteid'] ?>-zip");
	   }
        mapkitchenMaps.init(pagesdate ,pageedate,pageval,zipval);
		addressTable.init(pagesdate,pageedate,pageval,zipval);
		
        });

$( "#zipcode" ).change(function() {
      var zip = $( this ).val();
	  var page = '';
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
        mapkitchenMaps.init(zipsdate ,zipedate,page,zip);  
		addressTable.init(zipsdate,zipedate,page,zip);
        });
</script>
     <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>