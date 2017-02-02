<?php
session_start();

$siteid = $_SESSION['siteid'];

if(!isset($_SESSION['siteid']))
{
echo "here";
header('Location: login.php');
die();
}
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
.ui.grid {
margin-top: 0rem; 
margin-bottom: 0rem; 
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
.ui.inverted.menu{
background:#2185d0!important;
}
.cm-s-ambiance.CodeMirror{
background-color:#2185d0!important;
}
</style>

		
    <body>
<?php include 'othermenu_semantic.php'; ?>


	            
               
           
    
         <main class="ui page grid">
        <div class="row">
		<div class="ui styled accordion">
  <div class="active title">
    <i class="dropdown icon"></i>
    Code
  </div>
  <div class="active content">
    <p>Below is the tracking code to put on your website header or footer, If you have a wordpress site you can also check our wordpress plugin section</p>
	<p>
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
</textarea></p>
  </div>
  <div class="title">
    <i class="dropdown icon"></i>
    Wordpress Plugin
  </div>
  <div class="content">
    <p>
	  <img style ="width:20%" src = "/assets/pages/img/wplogo.gif"></img>
  <h4><a href = "download.php">Click here to download plugin</a></h4>
	</p>
  </div>
</div>
            	   </div>
    </main>
<script>
$('.ui.styled.accordion')
  .accordion()
;
</script>
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
</body>
<script src="../assets/pages/scripts/components-code-editors.js" type="text/javascript"></script>
          <script src="../assets/global/plugins/codemirror/lib/codemirror.js" type="text/javascript"></script>
</html>