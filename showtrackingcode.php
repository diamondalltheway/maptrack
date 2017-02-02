<?php
include_once 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
if($_POST['email'] == '')
{
header('Location: login.php');
die();
}

$sqlToFetchSiteName = "select website_name from userdetails";
$result = mysql_query($sqlToFetchSiteName,$conn) or die("Error in Selecting11 " . mysql_error($conn));
 $siteidArray = array();   
    while($row = mysql_fetch_assoc($result)) {
	$siteidArray[] = $row['website_name'];
}

if(in_array($_POST['websitename'],$siteidArray))
{
header('Location: login.php');
die();
}
$randomsiteid = rand(10000, 99999);
if($_POST['googlelogin'] != "")
{
$sql = "INSERT INTO userdetails".
       "(username,password,website_name,website_id,email_id,DOR,twitter,snapchat,social_login) ".
       "VALUES ".
       "('".$_POST['email']."', 'google','".$_POST['websitename']."','".$randomsiteid."','".$_POST['email']."',".CURRENT_TIMESTAMP.",' ',' ','google')";
}
else
{
$sql = "INSERT INTO userdetails".
       "(username,password,website_name,website_id,email_id,DOR,twitter,snapchat) ".
       "VALUES ".
       "('".$_POST['username']."', '".$_POST['password1']."','".$_POST['websitename']."','".$randomsiteid."','".$_POST['email']."',".CURRENT_TIMESTAMP.",'".$_POST['twitter']."','".$_POST['snapchat']."')";
}
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  //die('Could not enter data: ' . mysql_error());
}
//echo "Entered data successfully\n";
mysql_close($conn);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>MapKitchen | Tracking Code</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
            <link href="../assets/global/plugins/codemirror/lib/codemirror.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/codemirror/theme/neat.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/codemirror/theme/ambiance.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/codemirror/theme/material.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/codemirror/theme/neo.css" rel="stylesheet" type="text/css" />
		<!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../assets/layouts/layout/css/custom.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="">
                        <img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
                   
                </div>
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                       
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                               
                                <span class="username username-hide-on-mobile"><?php echo $_SESSION['sitename'] ?></span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                
								<li>
                                    <a href="myaccount.php">
                                        <i class="icon-key"></i> My Account </a>
                                </li>
								
                                <li>
                                    <a href="logout.php">
                                        <i class="icon-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>

        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
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
           
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                   
                    <!-- END THEME PANEL -->
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title">Congratulations for signing up!! Here is Your Track Code
                       
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- BEGIN PAGE BAR -->
 
                    <!-- END PAGE BAR -->
                    <!-- END PAGE HEADER-->
				<div class="portlet light bordered">
                                
                                <div class="portlet-body">
                                    <textarea id="mkcode1">

&lt;script&gt;
if (!window.jQuery) {
  var jq = document.createElement('script'); jq.type = 'text/javascript';
  jq.src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js';
  document.getElementsByTagName('head')[0].appendChild(jq);
}
&lt;/script&gt;
&lt;script  src="http://app.map.kitchen/lib/mapboxlib.js">&lt;/script&gt;
&lt;/script&gt;
jQuery(document).ready(function(){
        jQuery.ajax({url: "http://app.map.kitchen/mapkitchentrackcode.php",type: "POST", data : { siteid: <?php echo $randomsiteid ?> }, success:          function(result){
         eval(result);
}});
});
&lt;/script&gt;
									</textarea>
                                </div>
                            </div>
			<div class="note note-info">
                        <p>Alternatively, If you don't know how to include the code, you can download 
this wordpress plugin and install(Please note that the plugin is only for your site-Do not install the plugin
On another site</p>
                    </div>
				<h4><img style ="width:20%" src = "/assets/pages/img/wplogo.gif"><img><a href = "download.php">Download WordPress Plugin</a></h4>
				
				<?php
				
$data = 'jQuery(document).ready(function(){
        jQuery.ajax({url: "http://app.map.kitchen/mapkitchentrackcode.php",type: "POST", data : { siteid: '.$randomsiteid.' }, success:          function(result){
         eval(result);
}});
});';
chown(dirname(__FILE__)."/mapkitchen/", "root");
chmod(dirname(__FILE__)."/mapkitchen/", 0777);
$filename = dirname(__FILE__)."/mapkitchen/js/script.js";
$myfile = fopen( $filename , "w") or die("Unable to open file!");
fwrite($myfile, $data);
chmod(dirname(__FILE__)."/mapkitchen/", 0755);
//file name:compress.php
//Title:How to compress a Folder containing Sub-Folders and Files with PHP
//Date:6-12-2012
$folder="mapkitchen/";
if (file_exists('mapkitchen.zip')) {
unlink('mapkitchen.zip');
}
$output="mapkitchen.zip";
$zip = new ZipArchive();

if ($zip->open($output, ZIPARCHIVE::CREATE) !== TRUE) {
    die ("Unable to open Archirve");
}

$all= new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder));

foreach ($all as $f=>$value) {
    if($f == "mapkitchen/.." || $f == "mapkitchen/." || $f == "mapkitchen/js/.." || $f == "mapkitchen/js/.")
	{
	continue;
	}

	$zip->addFile(realpath($f), $f) or die ("ERROR: Unable to add file: $f");
}
$zip->close();

?>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <a href="javascript:;" class="page-quick-sidebar-toggler">
                <i class="icon-login"></i>
            </a>
      
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2016 &copy; MapKitchen.
               
            </div>
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
          <script src="../assets/global/plugins/codemirror/lib/codemirror.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/codemirror/mode/javascript/javascript.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/codemirror/mode/htmlmixed/htmlmixed.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/codemirror/mode/css/css.js" type="text/javascript"></script>       
	   <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
		 <script src="../assets/pages/scripts/components-code-editors.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>