<?php
include 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
 
     
  
	 

    $sLimit = "";
    if ( isset( $_POST['iDisplayStart'] ) && $_POST['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".intval( $_POST['iDisplayStart'] ).", ".
            intval( $_POST['iDisplayLength'] );
    }
    
  
    /*
     * SQL queries
     * Get data to display
     */
	if($_GET['start'] != '' && $_GET['end'] != '')
{	
    $sQuery = "select REPLACE(address,', United States','') as addresses, count(*) as Frequency from mapkitchendata where site_id = '".$_GET['siteid']."' and address <> '' and country = 'United States' and location <> -1 and DATE(datevisited) >= '".$_GET['start']."' and DATE(datevisited) <= '".$_GET['end']."' group by address order by frequency desc ".$sLimit."";
}   
if($_GET['page'] != '')
{	
    $sQuery = "select REPLACE(address,', United States','') as addresses, count(*) as Frequency from mapkitchendata where site_id = '".$_GET['siteid']."' and address <> '' and country = 'United States' and location <> -1 and DATE(datevisited) >= '".$_GET['start']."' and DATE(datevisited) <= '".$_GET['end']."' and pagetitle = '".mysql_real_escape_string(urldecode($_GET['page']))."' group by address order by frequency desc ".$sLimit."";
}
if($_GET['zip'] != '')
{	
    $sQuery = "select REPLACE(address,', United States','')  as addresses, count(*) as Frequency from mapkitchendata where site_id = '".$_GET['siteid']."' and address <> '' and country = 'United States' and location <> -1 and DATE(datevisited) >= '".$_GET['start']."' and DATE(datevisited) <= '".$_GET['end']."' and postcode = '".$_GET['zip']."' group by address order by frequency desc ".$sLimit."";
}
if($_GET['city'] != '')
{	
    $sQuery = "select REPLACE(address,', United States','')  as addresses, count(*) as Frequency from mapkitchendata where site_id = '".$_GET['siteid']."' and address <> '' and country = 'United States' and location <> -1 and DATE(datevisited) >= '".$_GET['start']."' and DATE(datevisited) <= '".$_GET['end']."' and city = '".$_GET['city']."' group by address order by frequency desc ".$sLimit."";
}

if($_GET['page'] != '' &&  $_GET['zip'] != '' && $_GET['city'] != '')
{
$sQuery = "select  REPLACE(address,', United States','')  as addresses, count(*) as Frequency from mapkitchendata where site_id = '".$_GET['siteid']."' and address <> '' and country = 'United States' and location <> -1 and DATE(datevisited) >= '".$_GET['start']."' and DATE(datevisited) <= '".$_GET['end']."' and postcode = '".$_GET['zip']."' and pagetitle = '".urldecode($_GET['page'])."' and city = '".$_GET['city']."' group by address order by frequency desc ".$sLimit."";
}   

   $rResult = mysql_query( $sQuery, $conn ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
     
    /* Data set length after filtering */
    $sQuery = "
        SELECT FOUND_ROWS()
    ";
    $rResultFilterTotal = mysql_query( $sQuery, $conn ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
    $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
    $iFilteredTotal = $aResultFilterTotal[0];
     
    /* Total data set length */
    $sQuery = "
        SELECT COUNT(*)
        FROM   mapkitchendata where site_id = '".$_GET['siteid']."' AND address <> '' and location <> -1 AND postcode <> '' AND country = 'United States' 
    ";
    $rResultTotal = mysql_query( $sQuery, $conn ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
    $aResultTotal = mysql_fetch_array($rResultTotal);
    $iTotal = $aResultTotal[0];
     
     
    /*
     * Output
     */
    
     $data = array();
    while ( $aRow = mysql_fetch_assoc( $rResult ) )
    {
                /* General output */
                $data[] = $aRow;       
    }
  $output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iTotal,
        "aaData" => $data
    );   
    echo json_encode( $output );	 

?>