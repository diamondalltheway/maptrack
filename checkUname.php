  <?php
   include_once 'amazon_rds.php';

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
} 
$status = 'true';
$usernames = array();
$emails = array();
$sqlToFetchUsername = "select username,email_id from userdetails";
 $resultData = mysql_query($sqlToFetchUsername,$conn) or die("Error in Selecting " . mysql_error($conn));
	 if(mysql_num_rows($resultData) > 0)
	 {
	  while($row = mysql_fetch_assoc($resultData)) {
	 $usernames[] = $row['username']; 
	 $emails[] = $row['email_id'];
	 }
	 }
    $requestedUsername  = $_REQUEST['username'];
    $requestedEmail  = $_REQUEST['email'];
	if($requestedUsername != '')
	{
    if( in_array($requestedUsername, $usernames) ){
        $status = 'false';
    }
	}
	if($requestedEmail != '')
	{
	if( in_array($requestedEmail, $emails) ){
        $status = 'false';
    }
	}
echo $status;
mysql_close($conn);
    ?>