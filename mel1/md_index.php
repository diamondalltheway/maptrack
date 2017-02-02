<?php

	//Create the global MD Personator object
	$MDPersonator;
	
	//Create the global results variable
	$MD_Results;
		
//If the 'Clear' button is pr4essed, return a blank form
if ( isset($_REQUEST['Single_Clear']) )
{
	include('md_Form.php');
}

//If the 'Sample' button is pressed, enter a sample input record
if ( isset($_REQUEST['Single_Sample']) )
{
	$CustomerID 			= $_POST['CustomerID'];
	$TransmissionReference 	= "Testing Melissa Data Personator sample";
	$Company 				= "Melissa Data";
	$AddressLine1 			= "22382 Avenida Empresa";
	$AddressLine2 			= "";
	$City 					= "Rancho Santa Margarita";
	$State 					= "CA";
	$PostalCode 			= "92688";
	$Country 				= "USA";
	$Phone 					= "949-586-5200";
	$Email 					= "";
	include ('md_Form.php');
}

if ( isset($_REQUEST['Single_Process']) )
{
	global $MDPersonator, $MD_Results;
	
	//Set the path to the WSDL location
	//Choose from using the https or http url and comment out the other
	$wsdl = "http://personator.melissadata.net/v3/SOAP/ContactVerify?wsdl";
	
	try{
		if(!@file_get_contents($wsdl)){
			throw new SoapFault('Server', 'No WSDL found at ' . $wsdl);
		}
		
		//Retrieve the fields inputted and store them to their corresponding variable
		
		$CustomerID 			= $_POST['CustomerID'];
		$TransmissionReference 	= $_POST['TransmissionReference'];
		$LineSeparator 			= $_POST['LineSeparator'];
		$ActionCheck 			= $_POST['Check'];
		$ActionVerify 			= $_POST['Verify'];
		$ActionAppend			= $_POST['Append'];
		$ActionMove				= $_POST['Move'];
		$Action					= "";
		$Columns				= "";
		$AAC 					= $_POST['AAC'];
		$Centricity 			= $_POST['Centricity'];
		$OptAppend				= $_POST['OptAppend'];
		$Options				= "";
		
		//Check to see if the Check action, Verify action, or both were selected and concatenate
		//	the choices to a single string
		if($ActionCheck)
		{
			$Action .= "Check";
			if($AAC)
			{
				$Options .= "AdvancedAddressCorrection:on";
			}
			$ActionCheck = false;
		}
		if($ActionVerify)
		{
			if($ActionCheck){
				$Action .= ", ";
				$Options .= ";";
			}
			$Action .= "Verify";
			$Options .= "CentricHint:" . $Centricity;
			$ActionVerify = false;
		}
		if($ActionAppend)
		{
			if($ActionCheck || $ActionVerify){
				$Action .= ", ";
				if(!$ActionVerify){
					$Options .= ";CentricHint:" . $Centricity . ";";
				}
				else{
					$Options .= ";";
				}
			}
			$Action .= "Append";
			$Option .= "Append:" . $OptAppend;
			$ActionAppend = false;
		}
		if($ActionMove)
		{
			if($ActionCheck || $ActionVerify || $ActionAppend){
				$Action .= ", ";
			}
			$Action .= "Move";
			$ActionAppend = false;
		}
		
		//Check to see which columns were selected (if any) and concatenate the choices
		//	to a single string
		if( isset($_POST['colNameDetails']))
		{
			$Columns .= "GrpNameDetails";
		}
		if( isset($_POST['colAddressDetails']))
		{
			if($Columns != "")
			{
				$Columns .= ",";
			}
			$Columns .= "GrpAddressDetails";
		}
		if( isset($_POST['colAddressParsed']))
		{
			if($Columns != "")
			{
				$Columns .= ",";
			}
			$Columns .= "GrpParsedAddress";
		}
		if( isset($_POST['colEmailParsed']))
		{
			if($Columns != "")
			{
				$Columns .= ",";
			}
			$Columns .= "GrpParsedEmail";
		}
		if( isset($_POST['colPhoneParsed']))
		{
			if($Columns != "")
			{
				$Columns .= ",";
			}
			$Columns .= "GrpParsedPhone";
		}
		if( isset($_POST['colGeocode']))
		{
			if($Columns != "")
			{
				$Columns .= ",";
			}
			$Columns .= "GrpGeocode";
		}
		if( isset($_POST['colCensus']))
		{
			if($Columns != "")
			{
				$Columns .= ",";
			}
			$Columns .= "GrpCensus";
		}	
		
		$soap = new soapclient($wsdl); //Create the SOAP client
		
		$MDPersonator->Request->TransmissionReference 	= $TransmissionReference;
		$MDPersonator->Request->CustomerID 			= $CustomerID;
		$MDPersonator->Request->Actions 				= $Action;
		$MDPersonator->Request->Columns 				= $Columns;
		$MDPersonator->Request->Options 				= $Options;
		
		$inputRecord = array(
			'RecordID'=>"1",
			'FullName'=>$_POST['FullName'],
			'CompanyName'=>$_POST['Company'],
			'AddressLine1'=>$_POST['AddressLine1'],
			'AddressLine2'=>$_POST['AddressLine2'],
			'City'=>$_POST['City'],
			'State'=>$_POST['State'],
			'PostalCode'=>$_POST['PostalCode'],
			'Country'=>$_POST['Country'],
			'PhoneNumber'=>$_POST['Phone'],
			'EmailAddress'=>$_POST['Email']
		);
		
		$MDPersonator->Request->Records[0]=$inputRecord;
		
		$MD_Results = $soap->doContactVerify($MDPersonator);
		
		if($MD_Results->Fault->Desc !=""){
			print("Web Service General Error");
			return;
		}
		
		$Results_Version 			= $MD_Results->doContactVerifyResult->Version;
		$Results_TransReference 	= $MD_Results->doContactVerifyResult->TransmissionReference;
		$Results_TransResults 		= $MD_Results->doContactVerifyResult->TransmissionResults;
		
		$Response = $MD_Results->doContactVerifyResult->Records->ResponseRecord;
		var_dump($Response);
		
		//Retrieve and return the default columns
		$Results_Results 		= $Response->Results;
		$Results_Company 		= $Response->CompanyName;
		$Results_FullName 		= $Response->NameFull;
		$Results_AddressLine1 	= $Response->AddressLine1;
		$Results_AddresSLine2 	= $Response->AddressLine2;
		$Results_City 			= $Response->City;
		$Results_State 			= $Response->State;
		$Results_ZIP 			= $Response->PostalCode;
		$Results_Country 		= $Response->CountryName;
		$Results_Phone 			= $Response->PhoneNumber;
		$Results_Email 			= $Response->EmailAddress;
		
		include('md_Form.php');
		include('md_Result.php');
		
		//Depending on the group columns selected, retrieve the corresponding data and return the columns
		
		if(isset($_POST['colNameDetails']))
		{
			//Name Details columns
			$NameDetails_Gender 		= $Response->Gender;
			$NameDetails_Gender2 		= $Response->Gender2;
			$NameDetails_Salutation 	= $Response->Salutation;
			$NameDetails_NamePrefix 	= $Response->NamePrefix;
			$NameDetails_NameFirst 		= $Response->NameFirst;
			$NameDetails_NameMiddle 	= $Response->NameMiddle;
			$NameDetails_NameLast 		= $Response->NameLast;
			$NameDetails_NameSuffix 	= $Response->NameSuffix;
			$NameDetails_NamePrefix2 	= $Response->NameSuffix2;
			$NameDetails_NameFirst2 	= $Response->NameFirst2;
			$NameDetails_NameMiddle2 	= $Response->NameMiddle2;
			$NameDetails_NameLast2 		= $Response->NameLast2;
			$NameDetails_NameSuffix2 	= $Response->NameSuffix2;
			
			include('md_grpNameDetails.php');
		}
		if(isset($_POST['colAddressDetails']))
		{
			//Address Details columns
			$AddressDetails_CityAbbrev 		= $Response->CityAbbreviation;
			$AddressDetails_StateName 		= $Response->StateName;
			$AddressDetails_Urbanization 	= $Response->UrbanizationName;
			$AddressDetails_CarrierRoute 	= $Response->CarrierRoute;
			$AddressDetails_DPCCode 		= $Response->DeliveryPointCode;
			$AddressDetails_DPCDigit 		= $Response->DeliveryPointCheckDigit;
		
			include('md_grpAddressDetails.php');
		}
		if(isset($_POST['colAddressParsed']))
		{
			//Address Parsed columns
			$AddressParsed_HouseNumber 				= $Response->AddressHouseNumber;
			$AddressParsed_PreDirection 			= $Response->AddressPreDirection;
			$AddressParsed_StreetName 				= $Response->AddressStreetName;
			$AddressParsed_Suffix 					= $Response->AddressStreetSuffix;
			$AddressParsed_PostDirection 			= $Response->AddressPreDirection;
			$AddressParsed_SuiteName 				= $Response->AddressSuiteName;
			$AddressParsed_SuiteNumber 				= $Response->AddressSuiteNumber;
			$AddressParsed_POName 					= $Response->AddressPrivateMailboxName;
			$AddressParsed_PONumber 				= $Response->AddressPrivateMailboxRange;
			$AddressParsed_RouteService 			= $Response->AddressRouteService;
			$AddressParsed_Lockbox 					= $Response->AddressLockBox;
			$AddressParsed_DeliveryInstallation 	= $Response->AddressDeliveryInstallation;
			
			include('md_grpAddressParsed.php');
		}
		if(isset($_POST['colEmailParsed']))
		{
			//Parsed Email columns
			$ParsedEmail_Domain 	= $Response->DomainName;
			$ParsedEmail_Mailbox	= $Response->MailboxName;
			$ParsedEmail_TLDName 	= $Response->TopLevelDomain;
			
			include('md_grpParsedEmail.php');
		}
		if(isset($_POST['colPhoneParsed']))
		{
			//Parsed Phone columns
			$ParsedPhone_AreaCode 		= $Response->AreaCode;
			$ParsedPhone_NewAreaCode 	= $Response->NewAreaCode;
			$ParsedPhone_Prefix 		= $Response->PhonePrefix;
			$ParsedPhone_Suffix 		= $Response->PhoneSuffix;
			$ParsedPhone_Extension 		= $Response->PhoneExtension;
		
			include('md_grpParsedPhone.php');
		}
		if(isset($_POST['colGeocode']))
		{
			//Geocode columns
			$Geocode_Latitude 	= $Response->Latitude;
			$Geocode_Longitude 	= $Response->Longitude;
			
			include('md_grpGeocode.php');
		}
		if(isset($_POST['colCensus']))
		{
			//Census columns
			$Census_CountyName 		= $Response->CountyName;
			$Census_CountyFIPS 		= $Response->CountyFIPS;
			$Census_CensusTract 	= $Response->CensusTract;
			$Census_CensusBlock 	= $Response->CensusBlock;
			$Census_PlaceCode 		= $Response->PlaceCode;
			$Census_PlaceName 		= $Response->PlaceName;
			$Census_CBSACode 		= $Response->CBSACode;
			$Census_CBSATitle 		= $Response->CBSATitle;
			$Census_CBSALevel 		= $Response->CBSALevel;
			$Census_CBSADivCode 	= $Response->CBSADivisionCode;
			$Census_CBSADivTitle 	= $Response->CBSADivisionTitle;
			$Census_CBSADivLevel 	= $Response->CBSADivisionLevel;
			$Census_CongrDist 		= $Response->CongressionalDistrict;
			
			include('md_grpCensus.php');
		}
	}
	catch(SoapFault $fault){
		print_r("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})");
	};
}

//If the 'Insert New Record' button of the Results page is pressed, return to the form page
if ( isset($_REQUEST['Results_Return']))
{
	include('md_Form.php');
}
?>