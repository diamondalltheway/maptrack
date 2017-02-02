<?php
session_start();
include 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
 
     
if($_POST['page'] == '' && $_POST['zip'] == '' && $_POST['city'] == '')
{	
    $sQuery = "select REPLACE(address,', United States','') as addresses,city,region,postcode,firstname,lastname,email,phone, count(*) as Frequency from mapkitchendata where site_id = '".$_POST['siteid']."' and address <> '' and country = 'United States' and type = 'R' and (phone != '' or email != '') and location <> -1 and DATE(datevisited) >= '".$_POST['start']."' and DATE(datevisited) <= '".$_POST['end']."' group by address order by frequency desc";
}
else if($_POST['page'] != '' &&  $_POST['zip'] != '' && $_POST['city'] != '')
{
$sQuery = "select REPLACE(address,', United States','')  as addresses,city,region,postcode,firstname,lastname,email,phone, count(*) as Frequency from mapkitchendata where site_id = '".$_POST['siteid']."' and address <> '' and country = 'United States' and (phone != '' or email != '') and type = 'R' and  location <> -1 and DATE(datevisited) >= '".$_POST['start']."' and DATE(datevisited) <= '".$_POST['end']."' and postcode IN (";

$zips = explode(',',$_POST['zip']);


	$count = 1;
	foreach($zips as $zip)
	{
	$comma = ",";
	$sQuery .=  "'".$zip."'";
	if(count($zips) != $count)
	{
	$sQuery .= $comma;
	}
	$count++;
	}
	
$pages = explode(',',$_POST['page']);

    $sQuery .= ") OR pagetitle IN (";
	$count = 1;
	foreach($pages as $page)
	{
	$comma = ",";
	$sQuery .=  "'".mysql_real_escape_string(urldecode($page))."'";
	if(count($pages) != $count)
	{
	$sQuery .= $comma;
	}
	$count++;
	}

$cities = explode(',',$_POST['city']);

$sQuery .= ") OR city IN (";
	$count = 1;
	foreach($cities as $city)
	{
	$comma = ",";
	$sQuery .=  "'".$city."'";
	if(count($cities) != $count)
	{
	$sQuery .= $comma;
	}
	$count++;
	}
$sQuery .= ") group by address order by frequency desc";
}    
else if($_POST['page'] != '' &&  $_POST['zip'] != '')
{	
  $sQuery = "select REPLACE(address,', United States','')  as addresses,city,region,postcode,firstname,lastname,email,phone, count(*) as Frequency from mapkitchendata where site_id = '".$_POST['siteid']."' and address <> '' and country = 'United States' and type = 'R' and (phone != '' or email != '') and location <> -1   and DATE(datevisited) >= '".$_POST['start']."' and DATE(datevisited) <= '".$_POST['end']."' and postcode IN (";
  $zips = explode(',',$_POST['zip']);
	
	$count = 1;
	foreach($zips as $zip)
	{
	$comma = ",";
	$sQuery .=  "'".$zip."'";
	if(count($zips) != $count)
	{
	$sQuery .= $comma;
	}
	$count++;
	}
	
$pages = explode(',',$_POST['page']);

    $sQuery .= ") OR pagetitle IN (";
	$count = 1;
	foreach($pages as $page)
	{
	$comma = ",";
	$sQuery .=  "'".mysql_real_escape_string(urldecode($page))."'";
	if(count($pages) != $count)
	{
	$sQuery .= $comma;
	}
	$count++;
	}

$sQuery .= ") group by address order by frequency desc";
}
else if($_POST['zip'] != '' &&  $_POST['city'] != '')
{	
$sQuery = "select REPLACE(address,', United States','')  as addresses,city,region,postcode,firstname,lastname,email,phone, count(*) as Frequency from mapkitchendata where site_id = '".$_POST['siteid']."' and address <> '' and country = 'United States' and type = 'R' and (phone != '' or email != '') and location <> -1 and DATE(datevisited) >= '".$_POST['start']."' and DATE(datevisited) <= '".$_POST['end']."' and postcode IN (";
$zips = explode(',',$_POST['zip']);


	$count = 1;
	foreach($zips as $zip)
	{
	$comma = ",";
	$sQuery .=  "'".$zip."'";
	if(count($zips) != $count)
	{
	$sQuery .= $comma;
	}
	$count++;
	}
$cities = explode(',',$_POST['city']);
$sQuery .= ") OR city IN (";
	$count = 1;
	foreach($cities as $city)
	{
	$comma = ",";
	$sQuery .=  "'".$city."'";
	if(count($cities) != $count)
	{
	$sQuery .= $comma;
	}
	$count++;
	}
$sQuery .= ") group by address order by frequency desc";

}
else if($_POST['city'] != '' && $_POST['page'] != '')
{	
$sQuery = "select REPLACE(address,', United States','')  as addresses,city,region,postcode,firstname,lastname,email,phone, count(*) as Frequency from mapkitchendata where site_id = '".$_POST['siteid']."' and address <> '' and country = 'United States' and type = 'R' and (phone != '' or email != '') and location <> -1 and DATE(datevisited) >= '".$_POST['start']."' and DATE(datevisited) <= '".$_POST['end']."' and pagetitle IN (";

$pages = explode(',',$_POST['page']);

	$count = 1;
	foreach($pages as $page)
	{
	$comma = ",";
	$sQuery .=  "'".mysql_real_escape_string(urldecode($page))."'";
	if(count($pages) != $count)
	{
	$sQuery .= $comma;
	}
	$count++;
	}
$cities = explode(',',$_POST['city']);
$sQuery .= ") OR city IN (";
	$count = 1;
	foreach($cities as $city)
	{
	$comma = ",";
	$sQuery .=  "'".$city."'";
	if(count($cities) != $count)
	{
	$sQuery .= $comma;
	}
	$count++;
	}
$sQuery .= ") group by address order by frequency desc";

}
else if($_POST['page'] != '')
{	
$sQuery = "select REPLACE(address,', United States','')  as addresses,city,region,postcode,firstname,lastname,email,phone, count(*) as Frequency from mapkitchendata where site_id = '".$_POST['siteid']."' and address <> '' and country = 'United States' and type = 'R' and (phone != '' or email != '') and location <> -1 and DATE(datevisited) >= '".$_POST['start']."' and DATE(datevisited) <= '".$_POST['end']."' and pagetitle IN (";

$pages = explode(',',$_POST['page']);
	$count = 1;
	foreach($pages as $page)
	{
	$comma = ",";
	$sQuery .=  "'".mysql_real_escape_string(urldecode($page))."'";
	if(count($pages) != $count)
	{
	$sQuery .= $comma;
	}
	$count++;
	}
$sQuery .= ") group by address order by frequency desc";
}
else if($_POST['city'] != '')
{	
$sQuery = "select REPLACE(address,', United States','')  as addresses,city,region,postcode,firstname,lastname,email,phone, count(*) as Frequency from mapkitchendata where site_id = '".$_POST['siteid']."' and address <> '' and country = 'United States' and type = 'R' and (phone != '' or email != '') and location <> -1 and DATE(datevisited) >= '".$_POST['start']."' and DATE(datevisited) <= '".$_POST['end']."' and city IN (";

$cities = explode(',',$_POST['city']);


	$count = 1;
	foreach($cities as $city)
	{
	$comma = ",";
	$sQuery .=  "'".mysql_real_escape_string(urldecode($city))."'";
	if(count($cities) != $count)
	{
	$sQuery .= $comma;
	}
	$count++;
	}
$sQuery .= ") group by address order by frequency desc";
}
else if($_POST['zip'] != '')
{	
$sQuery = "select REPLACE(address,', United States','')  as addresses,city,region,postcode,firstname,lastname,email,phone, count(*) as Frequency from mapkitchendata where site_id = '".$_POST['siteid']."' and address <> '' and country = 'United States' and type = 'R' and (phone != '' or email != '') and location <> -1 and DATE(datevisited) >= '".$_POST['start']."' and DATE(datevisited) <= '".$_POST['end']."' and postcode IN (";

$zips = explode(',',$_POST['zip']);


	$count = 1;
	foreach($zips as $zip)
	{
	$comma = ",";
	$sQuery .=  "'".mysql_real_escape_string(urldecode($zip))."'";
	if(count($zips) != $count)
	{
	$sQuery .= $comma;
	}
	$count++;
	}
$sQuery .= ") group by address order by frequency desc";
}

$rResult = mysql_query( $sQuery, $conn ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
     
  $activeQuery = "select * from userdetails where website_id =  '".$_POST['siteid']."'"; 
  $aResult = mysql_query( $activeQuery, $conn ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	$active = true;
	while ( $acRow = mysql_fetch_assoc( $aResult ) )
    {
		if($acRow['activeuntil'] == null)
		{
			$active = false;
		}
	}
	$data = '';		
    while ( $aRow = mysql_fetch_assoc( $rResult ) )
    {
	$data .= '<div class="title">
    <i class="dropdown icon"></i>
    '.$aRow['addresses'].'
  </div>';
  if($_SESSION['plan']  == 'Leads (50 cents)')  { 
  $data .= '<div class="content">
    <p class="transition hidden">
	<i class="user icon"></i> : '.$aRow['firstname']. ' ' .$aRow['lastname'].'<BR/>
    <i class="Phone icon"></i> : '.$aRow['phone'].'<BR/>
	<i class="Mail icon"></i> : '.$aRow['email'].' <BR/>
	</p>
  </div>';
  }
    }
 
    echo $data;	 

?>