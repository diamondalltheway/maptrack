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
	   }
	 }
	 else
	 {

	  header('Location: login.php?status=false');
	  die();
	 }
}
if(isset($_POST['settingsubmit']))
{
$style = $_POST['styles'];
$view = $_POST['views'];
mysql_query("update mapkitchen.userdetails set style = '".$style."',view = '".$view."' where website_id = '".$_SESSION['siteid']."'");
}
$sqlToFetchSiteSettings = "SELECT * FROM mapkitchen.userdetails WHERE website_id = '".$_SESSION['siteid']."'";

	 $resultSetting = mysql_query($sqlToFetchSiteSettings,$conn);
 while($row = mysql_fetch_assoc($resultSetting)) {
 $userstyle = $row['style'];
 $userview = $row['view'];
 }
if($userstyle == '')
$userstyle = 123;
if($userview == '')
$userview = 123;

if(!isset($_SESSION['siteid']))
{
header('Location: login.php');
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


    <head>
        <meta charset="utf-8" />
        <title>Map Track Pro  | Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
       

        <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />

	 <script src ="../assets/pages/scripts/jquery.cookies.js"></script>
        <link href="../assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
        <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../assets/layouts/layout/css/custom.css" rel="stylesheet" type="text/css" />

		<link href="css/bootstrap-tour.min.css" rel="stylesheet">

      <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png"> 
<style>
.popover {
z-index:999999!important;
}
</style>	 
</head>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.sidr/2.2.1/stylesheets/jquery.sidr.light.min.css">
	
 <link href="../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
       <link href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	 <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css' />
		<script type="text/javascript" src="js/modernizr.custom.79639.js"></script> 
		<noscript><link rel="stylesheet" type="text/css" href="css/noJS.css" /></noscript>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=207032312654445";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-white page-sidebar-reversed">
        
        <div class="page-header navbar navbar-fixed-top">
            
            <div class="page-header-inner ">
                
					<a href="#sidr" id="mobile_menu" class="menu-toggler responsive-toggler" style  = "margin-top: 23px;margin-right: 25px;float:left;" ></a>
                <div class="page-logo">
                    <a href="dashboard.php">
                        <img src="../assets/layouts/layout/img/logo.png" style = "width:170px" alt="logo" class="logo-default" /> </a>
                </div>
	            <?php include 'daterange_header.php'; ?>
               
            </div>
            
        </div>
    
        <div class="clearfix"> </div>
     
        <div class="page-container">
		       <div class="page-content-wrapper">
               
                <div class="page-content">
                   
                    <div class="page-bar">                
                         <ul  class="page-breadcrumb">
						 
						 <li>
							<span ><b>Overall Optin's</b> : <?php echo $overalloptins; ?>&nbsp;</span>&nbsp;<span><b>Today's Optin's Count:</b> &nbsp;<?php echo $visitorOptinToday; ?></span>
							</li>
						</ul>
                    </div>
                   
                   
                    <div class="row">
                        <div class="col-md-12">
						 <div class="portlet light portlet-fit bordered">

                            
                                                 
                                    <div id='pointmap'></div>                               
                           
                           
                        </div>
					</div>
					</div>
				
                    
                   
             
                </div>
               
            </div>
             <div class="page-sidebar-wrapper">
                
                <div class="page-sidebar navbar-collapse collapse">
                   
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                       <li>
					   	                      
                                      <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>									
                                                <th> Address </th>
												<th> Frequency </th>
                                                
                                            </tr>
                                        </thead>
							</table>                             
                        
					   </li>
                    </ul>
                    
                </div>
				</div>
     
          

          
        </div>
	

        <div class="page-footer" style = "color:white">
            <div class="fb-share-button" data-href="https://web.facebook.com/mapkitchen/" data-layout="button_count" data-mobile-iframe="true"></div>
<a href="https://twitter.com/share" class="twitter-share-button" data-size="large" data-via="MapTrackPro" data-show-count="false">Tweet to @MapTrackPro</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
	<span style ="float:right">If you love our product or you have any feedback please email us <a href="mailto:help@maptrackpro.com">here</a></span>	

        </div>
       
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src ="../assets/pages/scripts/spin.js"></script>
	

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

<script src="js/bootstrap-tour.min.js"></script>
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
		 
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.16.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.16.0/mapbox-gl.css' rel='stylesheet' />

      
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
		<script src = "https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
	   <script src = "//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	   <script src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	   <script src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	   <script src = "//cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
	   <script src = "//cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please select your map settings below</h4>
      </div>
	  <form name = "settingsform" action = "" method = "post">
      <div class="modal-body">
	  
        How would you like to view your map
		<h3>Styles</h3>
		<select name = "styles">
		<option value = "-1">Please Select</option>
		<option value = "streets">Streets</option>
		<option value = "dark">Dark</option>
		<option value = "light">Light</option>
		</select>
		
		<BR/>
		<h3>Views</h3>
		<select name = "views">
		<option value = "-1">Please Select</option>
		<option value = "2D">2D</option>
		<option value = "3D">3D</option>
		</select>
 
      </div>
      <div class="modal-footer">
        <button type="submit"  id = "settingsubmit" name = "settingsubmit" style = "background-color:#e32082;color:white;" class="btn btn-default">Submit</button>
      </div>
	 </form>
    </div>

  </div>
</div>


<script>
       var addressTable = function () {
	   var loadaddress = function (start,end,page,zip,city) {
        var dataTable = $('#sample_1').DataTable( {	
        "bServerSide": true,
        "sAjaxSource": "addressdata.php?siteid=<?php echo $_SESSION['siteid'];  ?>&start="+start+"&end="+end+"&page="+encodeURIComponent(page)+"&zip="+zip+"&city="+city+"",
        "sServerMethod": "POST",
        "scrollY":        "750px",
        "scrollCollapse": "true",
		"bInfo" : false,
		"bFilter":false,
        "paging": false,
		"dom": "Bfrtipl",
		 "buttons": [
        'copy', 'excel', 'pdf' , 'print'
    ],
		"columns": [
                { "data": "addresses" },
				{ "data": "Frequency" }
              ]
            
        } );
}
		return {
        //main function to initiate the module
        init: function (start,end,page,zip,city) {
		    $('#sample_1').DataTable().destroy();
            loadaddress(start,end,page,zip,city);
        }
    };

}();
   

$(document).ready(function() { 
		
		if('<?php echo $userstyle ?>' == '123' || '<?php echo $userview ?>' == '123')
		{
		$("#myModal").modal("show");
		}
        ComponentsDateTimePickers.init();
		var tour = new Tour({
  steps: [
  {
    element: "#daterange",
	placement:"auto",
    title: "Filter address and points on map by any date range",
    content: "Here you can filter address and points on map by any date range"
  },
  {
    element: "#pagerange",
	placement:"auto",
    title: "Filter address and points on map by pages visited on your site",
    content: "Here you can filter address and points on map by pages visited on your site"
  },
  {
    element: "#ziprange",
	placement:"auto",
    title: "Filter address and points on map by zipcode range",
    content: "Here you can filter address and points on map by zipcode range"
  },
  {
    element: "#cityrange",
	placement:"auto",
    title: "Filter address and points on map by city range",
    content: "Here you can filter address and points on map by city range"
  },
  {
    element: "#clearrange",
	placement:"auto",
    title: "Here you can clear all the filters",
    content: "Here you can clear all the filters"
  }
  
]});

// Initialize the tour
tour.init();

// Start the tour
tour.start();
        		
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
		var city = '';
		if($.cookie("<?php echo $_SESSION['siteid'] ?>-page") != null)
	  {
	  page = $.cookie("<?php echo $_SESSION['siteid'] ?>-page");
	  }
	  if($.cookie("<?php echo $_SESSION['siteid'] ?>-zip") != null)
	  {
	  zip = $.cookie("<?php echo $_SESSION['siteid'] ?>-zip");
	  }
	  if($.cookie("<?php echo $_SESSION['siteid'] ?>-city") != null)
	  {
	  city = $.cookie("<?php echo $_SESSION['siteid'] ?>-city");
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
		
		mapkitchenMaps.init(sDate ,eDate,page,zip,city);
		addressTable.init(sDate,eDate,page,zip,city);
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
		var city = '';
		if($.cookie("<?php echo $_SESSION['siteid'] ?>-page") != null)
	  {
	  page = $.cookie("<?php echo $_SESSION['siteid'] ?>-page");
	  }
	  if($.cookie("<?php echo $_SESSION['siteid'] ?>-zip") != null)
	  {
	  zip = $.cookie("<?php echo $_SESSION['siteid'] ?>-zip");
	  }
	  if($.cookie("<?php echo $_SESSION['siteid'] ?>-city") != null)
	  {
	  city = $.cookie("<?php echo $_SESSION['siteid'] ?>-city");
	  }
	    $('#reportrange span').html(sDateToDisplay  + ' - ' + eDateToDisplay);
		mapkitchenMaps.init(sDate ,eDate,page,zip,city);
		addressTable.init(sDate,eDate,page,zip,city);
        
      

    }

    return {
        //main function to initiate the module
        init: function () {
            handleDateRangePickers();
        }
    };

}();

var mapkitchenMaps = function () {
 var LoadUserMaps = function (start,end,page,zip,city) {
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
var userLayer = '<?php echo $userstyle; ?>';

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
       "data": "geojsons/<?php echo $_SESSION['siteid'];  ?>.geojson"
   });
if(page == '' && zip == '' && city == '')
{
map.addLayer({
     "id": "mapgeojsonlayer",
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end]],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#e32082",
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
        "circle-color": "#e32082",
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
        "circle-color": "#e32082",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
}
if(city != '')
{
map.addLayer({
     "id": "mapgeojsonlayer",
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "city", city]],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#e32082",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
} 
if(page != '' && zip != '' && city != '')
{
map.addLayer({
     "id": "mapgeojsonlayer",
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "postcode", zip],["==", "pagetitle", page],["==","city",city]],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#e32082",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
}    
});

if('<?php echo $userview ?>' == '2D')
{
map.setPitch(0);
map.setBearing(0);
}
else
{
map.setPitch(60);
map.setBearing(-60);
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




map.addControl(new mapboxgl.Navigation());
}

    return {
        //main function to initiate the module
        init: function (start,end,page,zip,city) {
            LoadUserMaps(start,end,page,zip,city);
        }
    };

}();
</script>
<script>
$(document).ready(function() {
  $('#mobile_menu').sidr(
  {
  side: 'left'
  }
  );
  $('#sidr').css('display','block');
   if($.cookie("<?php echo $_SESSION['siteid'] ?>-page") != null)
{
  $('#dd span').html($.cookie("<?php echo $_SESSION['siteid'] ?>-page"));
}
     if($.cookie("<?php echo $_SESSION['siteid'] ?>-zip") != null)
{
  $('#dd1 span').html($.cookie("<?php echo $_SESSION['siteid'] ?>-zip"));
}
     if($.cookie("<?php echo $_SESSION['siteid'] ?>-city") != null)
{
  $('#dd3 span').html($.cookie("<?php echo $_SESSION['siteid'] ?>-city"));
}
     if($.cookie("<?php echo $_SESSION['siteid'] ?>-layer") != null)
{
  $('#dd2 span').html($.cookie("<?php echo $_SESSION['siteid'] ?>-layer"));
}
if($.cookie("<?php echo $_SESSION['siteid'] ?>-page") == '')
{
$('#dd span').html('All Pages');
}
if($.cookie("<?php echo $_SESSION['siteid'] ?>-zip") == '')
{
$('#dd1 span').html('All Zipcodes');
}
if($.cookie("<?php echo $_SESSION['siteid'] ?>-city") == '')
{
$('#dd3 span').html('All Cities');
}
});

$( "#mtpage li a" ).click(function() {
      var pageval = $( this ).html();
	  if(pageval == 'All Pages')
	  {
	  pageval = '';
	  }
	  var zipval = "";
	  var city = '';
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
	    if($.cookie("<?php echo $_SESSION['siteid'] ?>-city") != null)
	   {
	   city = $.cookie("<?php echo $_SESSION['siteid'] ?>-city");
	   }
        mapkitchenMaps.init(pagesdate ,pageedate,pageval,zipval,city);
		addressTable.init(pagesdate,pageedate,pageval,zipval,city);
		
        });

$( "#mtzip li a" ).click(function() {
      var zip = $( this ).html();
	  if(zip == 'All Zipcodes')
	  {
	  zip = '';
	  }
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
        });
$( "#mtcity li a" ).click(function() {
      var city = $( this ).html();
	  if(city == 'All Cities')
	  {
	  city = '';
	  }
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
        });
$( "#clear" ).click(function() {
  zipsdate = moment().subtract('days', 7).format('YYYY-MM-DD');
	    zipedate = moment().format('YYYY-MM-DD');
$.cookie("<?php echo $_SESSION['siteid'] ?>-sDate",zipsdate, {expires: new Date(2016, 12, 31, 00, 00, 00)});
$.cookie("<?php echo $_SESSION['siteid'] ?>-eDate",zipedate, {expires: new Date(2016, 12, 31, 00, 00, 00)});
$.cookie("<?php echo $_SESSION['siteid'] ?>-sDateToDisplay",zipsdate, {expires: new Date(2016, 12, 31, 00, 00, 00)});
		 $.cookie("<?php echo $_SESSION['siteid'] ?>-eDateToDisplay",zipedate, {expires: new Date(2016, 12, 31, 00, 00, 00)});
$.cookie("<?php echo $_SESSION['siteid'] ?>-page",'', {expires: new Date(2016, 12, 31, 00, 00, 00)});
$.cookie("<?php echo $_SESSION['siteid'] ?>-zip",'', {expires: new Date(2016, 12, 31, 00, 00, 00)});
$.cookie("<?php echo $_SESSION['siteid'] ?>-city",'', {expires: new Date(2016, 12, 31, 00, 00, 00)});

$( "#dd1 span" ).html("All Zipcodes");
$( "#dd span" ).html("All Pages");
$( "#dd3 span" ).html("All Cities");
$('#reportrange span').html(zipsdate + ' - ' + zipedate);
mapkitchenMaps.init(zipsdate ,zipedate,'','','');  
		addressTable.init(zipsdate,zipedate,'','','');
});
</script>
	<script type="text/javascript">
			
			function DropDown(el) {
				this.dd = el;
				this.placeholder = this.dd.children('span');
				this.opts = this.dd.find('ul.dropdown > li');
				this.val = '';
				this.index = -1;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						return false;
					});

					obj.opts.on('click',function(){
						var opt = $(this);
						obj.val = opt.text();
						obj.index = opt.index();
						obj.placeholder.text(obj.val);
					});
				},
				getValue : function() {
					return this.val;
				},
				getIndex : function() {
					return this.index;
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );
				var dd1 = new DropDown( $('#dd1') );
				var dd2 = new DropDown( $('#dd2') );
				var dd3 = new DropDown( $('#dd3') );
				$(document).click(function() {

					$('.wrapper-dropdown-1').removeClass('active');
				});

			});
			
		</script>

    </body>

</html>