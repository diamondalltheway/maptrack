



<?php
	
	//**************************************************************
	// PropertyWS Main Function
	//**************************************************************
	if ( isset($_REQUEST['PropertyWS']) )
	{

		//*********************************************************************
		// A valid Customer ID is required to access Melissa Datas
		// WebSmart Services. Please call our Sales department
		// at 1-800-635-4772 x3 to request for a valid Customer ID.
		//*********************************************************************

		//** Initialize the Variables
		$CustomerID = $_POST['CustomerID'];
		$AddressKey = $_POST['AddressKey'];
		$FIPS = $_POST['FIPS'];
		$APN = $_POST['APN'];
		$OptDetailOnly = $_POST['OptPropertyDetail'];
		$responseXML=$_POST['responseXML'];
		
		if ($OptDetailOnly == "true")
		{
			$DetailOnly = "checked";
		}
		else 
		{
			$DetailOnly = "";
		}
		
		/*
		* Define POST URL and also payload
		*/
				
		define ('XML_PAYLOAD','<?xml version="1.0" ?>'. 
		 
		'<RequestArray>'.
		'<TransmissionReference>Testing: Property XML Web Service</TransmissionReference>'.
		'<CustomerId>'.$CustomerID.'</CustomerId> '.
		'<OptPropertyDetail>'.$OptDetailOnly.'</OptPropertyDetail>'.
		'<TotalRecords>1</TotalRecords>'. 
		'<Record>'.
		'<RequestRecord>'.
		'<RecordID>1</RecordID>'.
		'<AddressKey>'.$AddressKey.'</AddressKey>'. 
		'<FIPS>'.$FIPS.'</FIPS>'. 
		'<APN>'.$APN.'</APN> '.
		'</RequestRecord>'.
		'</Record>'.
		'</RequestArray>');

		define('XML_POST_URL', 'https://property.melissadata.net/v3/xml/service.svc/DoLookup');
		
				
		
		/**
		* Initialize handle and set options
		*/
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_URL, XML_POST_URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, XML_PAYLOAD);
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
		$objDOM->save("response.xml");
		$responseXML = file_get_contents("response.xml");
		include('MainForm.php');
		
		/**
		* Output the results and time
		*/
		echo '<BR><b><font face="verdana" size="2">Total time for request: </b>' . $totalTime . "\n";
		
		//** Otuput Results
		echo '<BR><BR><b>RESULTS:- </b>';
		$UniversalCode = $objDOM->getElementsByTagName("Code")->item(0)->nodeValue;
		echo '<BR><b><left>Universal Code: </b>'.$UniversalCode;
		PrintResults($UniversalCode);
		$Code = $objDOM->getElementsByTagName("Code")->item(1)->nodeValue;
		$Description = $objDOM->getElementsByTagName("Description")->item(1)->nodeValue;
		$FIPSCode = $objDOM->getElementsByTagName("FIPSCode")->item(1)->nodeValue;
		$FormattedAPN = $objDOM->getElementsByTagName("FormattedAPN")->item(0)->nodeValue;
		$Name = $objDOM->getElementsByTagName("Name")->item(0)->nodeValue;
		$Name2 = $objDOM->getElementsByTagName("Name2")->item(0)->nodeValue;
		$Address = $objDOM->getElementsByTagName("Address")->item(0)->nodeValue;
		$City = $objDOM->getElementsByTagName("City")->item(0)->nodeValue;
		$Zip = $objDOM->getElementsByTagName("Zip")->item(0)->nodeValue;
		$CalculatedTotalValue = $objDOM->getElementsByTagName("CalculatedTotalValue")->item(0)->nodeValue;
		$YearBuilt = $objDOM->getElementsByTagName("YearBuilt")->item(0)->nodeValue;
		$SaleDate = $objDOM->getElementsByTagName("SaleDate")->item(0)->nodeValue;
		$BuildingSize = $objDOM->getElementsByTagName("BuilddingArea")->item(1)->nodeValue;
		echo '<BR><b>Code: </b>'.$Code;
		echo '<BR><b>Description: </b>' . $Description;
		echo '<BR><b>Formatted APN: </b>'. $FormattedAPN;
		echo '<BR><b>Name Of Owner: </b>'. $Name;
		echo '<BR><b>Name Of second Owner: </b>'. $Name2;
		echo '<BR><b>Address: </b>' . $Address;
		echo '<BR><b>City: </b>'. $City;
		echo '<BR><b>Zip and Plus4: </b>' . $Zip;
		echo '<BR><b>Calculated total value: </b>'.'$'. $CalculatedTotalValue;
		echo '<BR><b>Year Built: </b>' . $YearBuilt;
		echo '<BR><b>Sale Date: </b>' . $SaleDate;
		echo '<BR><b>Building Zise: </b>' . $BuildingSize;
	
		/**
		* Exit the script
		*/
		exit(0);

	}

	//**************************************************************
	// Clear Button Functions
	//**************************************************************

	if ( isset($_REQUEST['Clear']) )
	{
		$CustomerID = "";
		$AddressKey = "";
		$FIPS = "";
		$APN = "";
		$OptDetailOnly ="";
		include('MainForm.php');
	}

	//**************************************************************
	// Insert Sample Address to the Form
	//**************************************************************

	if ( isset($_REQUEST['Insert']) )
	{
		$CustomerID = $_POST['CustomerID'];

		$AddressKey = "92688211282";
		$FIPS = "";
		$APN = "";
		include('MainForm.php');
	}

	//**************************************************************
	// Function to print out the Result Definitions
	//**************************************************************
	Function PrintResults($UniversalCode)
	{

		if($UniversalCode == "SE01")
		{
			print_r(" :Web Service Internal Error");
		}
		elseif($UniversalCode == "GE01")
		{
			print_r(" :Empty XML Request Structure");
		}
		elseif($UniversalCode == "GE02")
		{
			print_r(" :Empty XML Request Record Structure");
		}
		elseif($UniversalCode == "GE03")
		{
			print_r(" :Requested Records Exceed the Maximum Amount");
		}
		elseif($UniversalCode == "GE04")
		{
			print_r(" :Customer ID Empty");
		}
		elseif($UniversalCode == "GE05")
		{
			print_r(" :Customer ID Invalid");
		}
		elseif($UniversalCode == "GE06")
		{
			print_r(" :Customer ID Disabled");
		}
		elseif($UniversalCode == "GE07")
		{
			print_r(" :XML request Invalid");
		}
	}	

?>








