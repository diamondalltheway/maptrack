<?php
session_start();
include 'amazon_rds.php';
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$siteid = $_REQUEST['siteid'];
/* vars for export */
// database record to be exported
$db_record = 'mapkitchendata';
// optional where query
$where = 'WHERE site_id = '.$siteid.' and location <> -1  and type = "R" and (phone != "" or email != "")';
// filename for export
$csv_filename = 'Maptrack_'.date('Y-m-d').'.csv';
// database variables


// create empty variable to be filled with export data
$csv_export = '';
// query to get data from database
if($_SESSION['plan']  == 'Leads (50 cents)')  
{ 
$query = mysql_query("SELECT distinct address,city,street,postcode,region,firstname,lastname,email,phone FROM ".$db_record." ".$where);
}
else
{
$query = mysql_query("SELECT distinct address,city,street,postcode,region FROM ".$db_record." ".$where);
}
$field = mysql_num_fields($query);
// create line with field names
for($i = 0; $i < $field; $i++) {
  $csv_export.= mysql_field_name($query,$i).",";
}
// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';
// loop through database query and fill export variable
while($row = mysql_fetch_array($query)) {
  // create line with field values
  for($i = 0; $i < $field; $i++) {
    $csv_export.= '"'.$row[mysql_field_name($query,$i)].'"'.",";
  }	
  $csv_export.= '
';	
}
// Export the data and prompt a csv file for download
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);

?>