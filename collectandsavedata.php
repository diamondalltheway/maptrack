<?php
global $MDPersonator, $MD_Results;
$wsdl = "http://personator.melissadata.net/v3/SOAP/ContactVerify?wsdl";
if(!@file_get_contents($wsdl)){
			throw new SoapFault('Server', 'No WSDL found at ' . $wsdl);
		}
$soap = new soapclient($wsdl); //Create the SOAP client
include_once 'amazon_rds.php';

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
if($_POST['location'] != '')
{
$location = $_POST['location'];
}
else
{
$location = $_GET['location'];
}
$split = explode(",",$location);
$url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/'.$split[1].','.$split[0].'.json?types=postcode,address,country,region,place&access_token=pk.eyJ1IjoidmlrYXNodGhlY29kZXIiLCJhIjoiY2lnZzQ5cm10N3Vza3UybTU5dXY4MjVhbyJ9.ZrKrD1ZqDiGe6pPcIP95XA';

$ch1 = curl_init();

curl_setopt_array(
    $ch1, array( 
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false
));

$output1 = curl_exec($ch1);
 if(curl_errno($ch1)) {
        //echo 'Error: ' . curl_error($ch1) . '<br><br>';
    }
$data = json_decode($output1,true);


$sqlsettimezone = "SET time_zone = 'US/Central'";
$retval = mysql_query( $sqlsettimezone, $conn );
if($_POST['siteid'] != '')
{
$siteid  = $_POST['siteid'];
}
else
{
$siteid  = $_GET['siteid'];
}
if($_POST['pagevisited'] != '')
{
$pagevisited  = $_POST['pagevisited'];
}
else
{
$pagevisited  = $_GET['pagevisited'];
}
if($_POST['pagetitle'] != '')
{
$pagetitle  = $_POST['pagetitle'];
}
else
{
$pagetitle  = $_GET['pagetitle'];
}
$location = mysql_real_escape_string($location);
$siteid = mysql_real_escape_string($siteid);
$country = mysql_real_escape_string($data["features"][4]['text']);
$region = mysql_real_escape_string($data["features"][3]['text']);
$postcode = mysql_real_escape_string($data["features"][2]['text']);
$city = mysql_real_escape_string($data["features"][1]['text']);
$street = mysql_real_escape_string($data["features"][0]['text']);
$address = mysql_real_escape_string($data["features"][0]['place_name']);
$pagevisited = mysql_real_escape_string($pagevisited);
$pagetitle = mysql_real_escape_string($pagetitle);

//DO GOOGLE API ROOF TOP STUFF HERE
$newaddress = explode(",",$address);
$addressforsmarty  = urlencode($newaddress[0]);



$url11 = "https://us-street.api.smartystreets.com/street-address?auth-id=cfe91e6f-6297-50aa-8c84-730ce51a7604&auth-token=AetBRCpD0BUVqJuzphsd&street=".$addressforsmarty."&city=".$city."&state=".$region."&zipcode=".$postcode."&candidates=10";


$ch123 = curl_init();

curl_setopt_array(
    $ch123, array( 
    CURLOPT_URL => $url11,
    CURLOPT_RETURNTRANSFER => true
));

$output2 = curl_exec($ch123);
 if(curl_errno($ch123)) {
        
    }
$data11 = json_decode($output2,true);
if($data11[0]["metadata"]["rdi"] == "Residential" && $data11[0]["metadata"]["record_type"] == "S")
{
$MDPersonator->Request->CustomerID 	= '117481792';
		$addressArray = explode(",",$address);
		$inputRecord = array(
			'RecordID'=>"1",
			'AddressLine1'=>$addressArray[0],
			'City'=>$city,
			'State'=>$region,
			'PostalCode'=> $postcode
		);
		
		$MDPersonator->Request->Records[0]=$inputRecord;
		$MD_Results = $soap->doContactVerify($MDPersonator);
		if($MD_Results->Fault->Desc !=""){
			print("Web Service General Error");
			return;
		}
		
		$Response = $MD_Results->doContactVerifyResult->Records->ResponseRecord;
		
		$add_key = $Response->AddressKey;
		
		$xmlpayload = '<?xml version="1.0" ?>'. 		 
		'<RequestArray>'.
		'<TransmissionReference>Maptrack</TransmissionReference>'.
		'<CustomerId>117481792</CustomerId> '.
		'<OptPropertyDetail>TRUE</OptPropertyDetail>'.
		'<TotalRecords>1</TotalRecords>'. 
		'<Record>'.
		'<RequestRecord>'.
		'<RecordID>1</RecordID>'.
		'<AddressKey>'.$add_key.'</AddressKey>'. 
		'<FIPS></FIPS>'. 
		'<APN></APN> '.
		'</RequestRecord>'.
		'</Record>'.
		'</RequestArray>';

		define('XML_POST_URL', 'https://property.melissadata.net/v3/xml/service.svc/DoLookup');		
		/**
		* Initialize handle and set options
		*/

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_URL, XML_POST_URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlpayload);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		/**
		* Execute the request and also time the transaction
		*/
		$start = array_sum(explode(' ', microtime()));
		$result = curl_exec($ch);
		$stop = array_sum(explode(' ', microtime()));
		$totalTime = $stop - $start;
		
		/**
		* Check for errors
		*/
		if ( curl_errno($ch) ) {
			$result = 'ERROR -> ' . curl_errno($ch) . ': ' . curl_error($ch);
			
		} else {
			$returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
			switch($returnCode){
				case 404:
					$result = 'ERROR -> 404 Not Found';
					break;
				default:
					break;
					
			}
		}
		
		/**
		* Close the handle
		*/
		
		curl_close($ch);


     //now we can loop through the xml structure
				   
		
		$objDOM = new DOMDocument();
		$objDOM->loadXML($result);
		$name = $objDOM->getElementsByTagName("Name")->item(0)->nodeValue;
		$nameArray = explode(" ",$name);
		if(count($nameArray) == 2)
		{
			$name = $nameArray[1] . " " . $nameArray[0];
		}
		if(count($nameArray) == 3)
		{
			$name = $nameArray[1] . " " . $nameArray[2] . " " . $nameArray[0];
		}

//DATAFINDER API HERE
	$datafinderurl = "http://api.datafinder.com/qdf.php?service=phone&k2=mbfd2z0znfzamz44qulalpg5&d_first=".$nameArray[1]."&d_last=".$nameArray[0]."&d_fulladdr=".urlencode($address)."&d_city=".$city."&d_state=".$region."&d_zip=".$postcode."";
	

$datafinderch1 = curl_init();

curl_setopt_array(
    $datafinderch1, array( 
    CURLOPT_URL => $datafinderurl,
    CURLOPT_RETURNTRANSFER => true
));

$datafinderoutput = curl_exec($datafinderch1);

 if(curl_errno($datafinderch1)) {
        
    }
$datafinder = json_decode($datafinderoutput,true);

$phone = $datafinder['datafinder']['results'][0]['Phone'];

$datafinderurl1 = "http://api.datafinder.com/qdf.php?service=email&k2=mbfd2z0znfzamz44qulalpg5&d_first=".$nameArray[1]."&d_last=".$nameArray[0]."&d_fulladdr=".urlencode($address)."&d_city=".$city."&d_state=".$region."&d_zip=".$postcode."";
	

$datafinderch11 = curl_init();

curl_setopt_array(
    $datafinderch11, array( 
    CURLOPT_URL => $datafinderurl1,
    CURLOPT_RETURNTRANSFER => true
));

$datafinderoutput11 = curl_exec($datafinderch11);

 if(curl_errno($datafinderch11)) {
        
    }
$datafinder11 = json_decode($datafinderoutput11,true);

$email = $datafinder11['datafinder']['results'][0]['EmailAddr'];

$sql = "INSERT INTO mapkitchendata".
       "(type,location,site_id,datevisited,country,region,street,city,postcode,address,pagevisited,pagetitle,firstname,lastname,phone,email) ".
       "VALUES ".
       "('R','".$location."', '".$siteid."',".CURRENT_TIMESTAMP.",'".$country."','".$region."','".$street."','".$city."','".$postcode."','".$address."','".$pagevisited."','".$pagetitle."','".$nameArray[1]."','".$nameArray[0]."','".$phone."','".$email."')";
$result = null;
$addressArray = null;
$inputRecord = null;
$name = null;
$Response = null;
$add_key = null;
$xmlpayload = null;
}
else
{
$sql = "INSERT INTO mapkitchendata".
       "(type,location,site_id,datevisited,country,region,street,city,postcode,address,pagevisited,pagetitle) ".
       "VALUES ".
       "('C','".$location."', '".$siteid."',".CURRENT_TIMESTAMP.",'".$country."','".$region."','".$street."','".$city."','".$postcode."','".$address."','".$pagevisited."','".$pagetitle."')";
}
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  //die('Could not enter data: ' . mysql_error());
}
//echo "Entered data successfully\n";
mysql_close($conn);


?>