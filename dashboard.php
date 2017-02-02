<?php

session_start();


include 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect123: ' . mysql_error());
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
		$_SESSION['plan'] = $row['plan'];
		
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

mysql_query("update mapkitchen.userdetails set style = '".$style."' where website_id = '".$_SESSION['siteid']."'");
}
$sqlToFetchSiteSettings = "SELECT * FROM mapkitchen.userdetails WHERE website_id = '".$_SESSION['siteid']."'";

	 $resultSetting = mysql_query($sqlToFetchSiteSettings,$conn);
 while($row = mysql_fetch_assoc($resultSetting)) {
 $userstyle = $row['style'];
 
 }
if($userstyle == '')
$userstyle = 123;


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
$initialLocation = mysql_result(mysql_query("select location from mapkitchendata where site_id = '".$_SESSION['siteid']."' and country = 'United States' and location <> -1 order by RAND() limit 1"),0);

$initialLocation = explode(",", $initialLocation);
if($initialLocation[0] == "")
{
$initialLocation = explode(",", "34.21000538397041,-118.34408073697084");
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

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.css">
		<script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
		   <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.js"></script>
	   <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        
        <link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
       

		<link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />

        <link href="../assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
        
        <link href="../assets/layouts/layout/css/custom.css" rel="stylesheet" type="text/css" />

		<link href="css/bootstrap-tour.min.css" rel="stylesheet">

      <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png"> 
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
.ui.grid {
    margin-top: -1rem;
    margin-bottom: -1rem;
    margin-left: 0rem;
    margin-right: 0rem;
}
#menu {
        background: #fff;
        position: absolute;
        z-index: 1;
        top: 50px;
		right: 75px;
        border-radius: 3px;
        width: 120px;
        border: 1px solid rgba(0,0,0,0.4);
        font-family: 'Open Sans', sans-serif;
    }

    #menu a {
        font-size: 13px;
        color: #404040;
        display: block;
        margin: 0;
        padding: 0;
        padding: 10px;
        text-decoration: none;
        border-bottom: 1px solid rgba(0,0,0,0.25);
        text-align: center;
    }

    #menu a:last-child {
        border: none;
    }

    #menu a:hover {
        background-color: #f8f8f8;
        color: #404040;
    }

    #menu a.active {
        background-color: #3887be;
        color: #ffffff;
    }

    #menu a.active:hover {
        background: #3074a4;
    }
.ui.inverted.menu{
background:#2185d0!important;
}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.semanticui.min.css"/>
 <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.semanticui.min.css"" rel="stylesheet" type="text/css" />
</head>
	 <script src ="../assets/pages/scripts/jquery.cookies.js"></script>
	 <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>	
    <body>


<?php include 'daterange_header_semantic.php'; ?>
	            
               
           
    
         <main class="ui grid">
        <div class="row">
		
            <div class="twelve wide column">
                
				<div class="ui tiny header" style = "margin-top: 10px;">Overall Optin's : <?php echo $overalloptins; ?>&nbsp;&nbsp;Today's Optin's Count: &nbsp;<?php echo $visitorOptinToday; ?>
				<div class="ui toggle checkbox" style = "display:none">
  <input type="checkbox" name="public">
  <label>Show Commercial</label>
</div>
<script>
$('.ui.checkbox')
  .checkbox()
;
</script>
				</div>
                 <div id = "dimmerMap" class="ui active dimmer">
    <div class="ui indeterminate text loader">Preparing Maps...Hold on tight!!</div>
  </div>
  <nav id="menu">
<a href="#" style = "background-color:#00cc00;color:white" class="active">Residential</a>
<a href="#" style = "background-color:#FFA500;color:white" class="active">Commercial</a>
  </nav>
   <div id='pointmap'></div>
   
            </div>
			 <div class="four wide column">
				<div class="ui  tiny header" style = "margin-top: 10px;">

<button id = "exportCSV" class="ui fluid blue button">Export</button>
<p>The List only shows the verified residential addresses</p>
				</div>
				 
				  <div id = "dimmerAddress" class="ui active dimmer">
    <div class="ui indeterminate text loader">Getting Addresses</div>
  </div>
				<div class="ui styled accordion" id = "addresslist">
  
</div>
			 </div>
       
	   </div>
    </main>
     

	

       
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
       
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
<div class="ui small modal" style = "margin-top: -100px;">
  <div class="header">Welcome, we need some information to get you going</div>
  <div class="content">
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
      </div>
	  <BR/>
	  <BR/>
      <div class="modal-footer">
        <button type="submit"  id = "settingsubmit" name = "settingsubmit" class="ui blue button">Submit</button>
      </div>
	 </form>
  </div>
</div>


<script>


       var addressTable = function () {
	   var loadaddress = function (start,end,page,zip,city) {
		$.post( "addressdata_semantic.php", { siteid:<?php echo $_SESSION['siteid'];  ?>, start: start,end:end,page:encodeURIComponent(page),zip:zip,city:city })
  .done(function( data ) {
	$('#dimmerAddress').removeClass('active');
    if(data != '')
	{
	$("#addresslist").html(data);
	}
	else 
	{
	$("#addresslist").html('<p>No Addresss Generated Yet</p><p>Please check to see if tracking code is installed</p>');
	}
  });
  $('.ui.styled.accordion')
  .accordion()
;
}
		return {
        //main function to initiate the module
        init: function (start,end,page,zip,city) {
            loadaddress(start,end,page.toString(),zip.toString(),city.toString());
        }
    };

}();
   
$(document).ready(function() { 
if('<?php echo $userstyle ?>' == '123')
		{
		$('.ui.small.modal') .modal({
    blurring: true
  })
  .modal('show')
;
		}
ComponentsDateTimePickers.init();
 

$("#exportCSV").click(function() {

location.href = "exportcsv.php?siteid=<?php echo $_SESSION['siteid'] ?>";
});

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
                    'Today': [moment(), moment()],
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
		$('#dimmerMap').addClass('active');
		$('#dimmerAddress').addClass('active');
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
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
}
else if(page != '' && zip != '' && city != '')
{

var pages = page.toString().split(",");
for (var i = 0; i < pages.length; i++) { 
map.addLayer({
     "id": "mapgeojsonlayer"+pages[i],
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "pagetitle", pages[i]],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
 }
var zips = zip.toString().split(",");
for (var i = 0; i < zips.length; i++) { 
map.addLayer({
     "id": "mapgeojsonlayer"+zips[i],
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "postcode", zips[i]],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
 }
 var cities = city.toString().split(",");
for (var i = 0; i < cities.length; i++) { 
map.addLayer({
     "id": "mapgeojsonlayer"+cities[i],
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "city", cities[i]],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
 }
} 
else if(page != '' &&  zip != '')
{
var pages = page.toString().split(",");
for (var i = 0; i < pages.length; i++) { 
map.addLayer({
     "id": "mapgeojsonlayer"+pages[i],
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "pagetitle", pages[i]],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
 }
var zips = zip.toString().split(",");
for (var i = 0; i < zips.length; i++) { 
map.addLayer({
     "id": "mapgeojsonlayer"+zips[i],
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "postcode", zips[i]],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
 }
}
else if(zip != '' && city != '')
{
var cities = city.toString().split(",");
for (var i = 0; i < cities.length; i++) { 
map.addLayer({
     "id": "mapgeojsonlayer"+cities[i],
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "city", cities[i]],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
 }
var zips = zip.toString().split(",");
for (var i = 0; i < zips.length; i++) { 
map.addLayer({
     "id": "mapgeojsonlayer"+zips[i],
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "postcode", zips[i]],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
 }
}
else if(city != '' && page != '')
{
var cities = city.toString().split(",");
for (var i = 0; i < cities.length; i++) { 
map.addLayer({
     "id": "mapgeojsonlayer"+cities[i],
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "city", cities[i]],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
 }
var pages = page.toString().split(",");
for (var i = 0; i < pages.length; i++) { 
map.addLayer({
     "id": "mapgeojsonlayer"+pages[i],
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "pagetitle", pages[i]],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
 }
}
else if(page != '')
{
var pages = page.toString().split(",");
for (var i = 0; i < pages.length; i++) { 
map.addLayer({
     "id": "mapgeojsonlayer"+pages[i],
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "pagetitle", pages[i]],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
 }
}  
else if(zip != '')
{
var zips = zip.toString().split(",");
for (var i = 0; i < zips.length; i++) { 
map.addLayer({
     "id": "mapgeojsonlayer"+zips[i],
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "postcode", zips[i]],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
   
}
}
else if(city != '')
{

var cities = city.toString().split(",");
for (var i = 0; i < cities.length; i++) { 
map.addLayer({
     "id": "mapgeojsonlayer-"+cities[i],
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "city", cities[i]],["==", "type", 'R']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#00cc00",
        "circle-opacity": 0.5
      },
   },'road-label-sm');
}
} 
  map.addLayer({
     "id": "mapgeojsonlayer-C",
     "interactive":true,	 // An id for this layer
     "type": "circle", // As a point layer, we need style a symbol for each point.
     "source": "mapgeojsondata",	 // The source layer we defined above
     "filter": ["all",[">=", "datevisit", start],["<=", "datevisit", end],["==", "type", 'C']],
	 "paint": {
        "circle-radius": 5,
        "circle-color": "#FFA500",
        "circle-opacity": 0.5
      },
   },'road-label-sm'); 
});



map.on('load', function (e) {
       $('#dimmerMap').removeClass('active');
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


$( "#clear" ).click(function() {
	 $('#dimmerMap').addClass('active');
	 $('#dimmerAddress').addClass('active');
  zipsdate = moment().subtract('days', 7).format('YYYY-MM-DD');
	    zipedate = moment().format('YYYY-MM-DD');
$.cookie("<?php echo $_SESSION['siteid'] ?>-sDate",zipsdate, {expires: new Date(2016, 12, 31, 00, 00, 00)});
$.cookie("<?php echo $_SESSION['siteid'] ?>-eDate",zipedate, {expires: new Date(2016, 12, 31, 00, 00, 00)});
$.cookie("<?php echo $_SESSION['siteid'] ?>-sDateToDisplay",zipsdate, {expires: new Date(2016, 12, 31, 00, 00, 00)});
		 $.cookie("<?php echo $_SESSION['siteid'] ?>-eDateToDisplay",zipedate, {expires: new Date(2016, 12, 31, 00, 00, 00)});
$.cookie("<?php echo $_SESSION['siteid'] ?>-page",'', {expires: new Date(2016, 12, 31, 00, 00, 00)});
$.cookie("<?php echo $_SESSION['siteid'] ?>-zip",'', {expires: new Date(2016, 12, 31, 00, 00, 00)});
$.cookie("<?php echo $_SESSION['siteid'] ?>-city",'', {expires: new Date(2016, 12, 31, 00, 00, 00)});

$('#reportrange span').html(zipsdate + ' - ' + zipedate);
mapkitchenMaps.init(zipsdate ,zipedate,'','','');  
		addressTable.init(zipsdate,zipedate,'','','');
});
</script>
	

    </body>

</html>