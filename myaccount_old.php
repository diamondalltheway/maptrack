<?php
session_start();
if($_GET['ipc'] == '-1')
		{
		 header('Location: askwebsite.php?from=myaccount&siteid='.$_GET['sid']);
	     die();
		}
$siteid = $_SESSION['siteid'];

if(!isset($_SESSION['siteid']))
{
header('Location: login.php');
die();
}
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
        <title>Map Track Pro  | My Account</title>
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
     <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
                <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="dashboard.php">
                        <img src="../assets/layouts/layout/img/logo.png" style = "width:170px" alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler"> </div>
                </div>
				<div class="hor-menu  hor-menu-light hidden-sm hidden-xs">
                    <ul class="nav navbar-nav">
                        <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                        <li class="classic-menu-dropdown">
                            <a href="dashboard.php"> Dashboard</a>
                        </li>
                        <li class="mega-menu-dropdown">
                            <a href="reports.php" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true"> Reports
                            </a>                         
                        </li>
								
                    </ul>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
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
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler"> </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                       
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
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
                    <h3 class="page-title">
                    Tracking Code
                    </h3>
				

<div class="note note-info">
                        <p>If you have a wordpress site..Please install the below plugin to activate the code</p>
                    </div>
				<h4><img style ="width:20%" src = "/assets/pages/img/wplogo.gif"><img><a href = "download.php">Download WordPress Plugin</a></h4>
                    <div class="note note-info">
                        <p> if your website is a custom one ..Please follow the below approach </p>
                    </div>


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
&lt;script  src="https://app.maptrackpro.com/lib/mapboxlib.js">&lt;/script&gt;
&lt;script&gt;
jQuery(document).ready(function(){
        jQuery.ajax({url: "https://app.maptrackpro.com/mapkitchentrackcode.php",type: "POST", data : { siteid: <?php echo $_SESSION['siteid'] ?> }, success:          function(result){
         eval(result);
}});
});
&lt;/script&gt;
									</textarea>
                                </div>
                            </div>
			
				<?php
$data = 'jQuery(document).ready(function(){
        jQuery.ajax({url: "https://app.maptrackpro.com/mapkitchentrackcode.php",type: "POST", data : { siteid: '.$siteid.'  }, success:          function(result){
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
$output="zip/mapkitchen.zip";
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