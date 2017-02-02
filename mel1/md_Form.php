<?php
error_reporting(E_ALL & ~E_NOTICE);
?>

<html>
<font face="Calibri">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html">
<title>Melissa Data Personator Sample</title>

</head>
<body>


<center><h1>Melissa Data Personator</h1>
<font size="3">(Hover over field names for their descriptions)</font></center>
<form method="POST" enctype="multipart/form-data" name="melissa_lookup" style="font-family: Calibri; font-size: 11" action="md_index.php">

	<table cellSpacing="0" cellPadding="3" width="900" border="0" style="font-family: calibri,sans-serif; font-size: 11pt" id="table1" align="center">
		<td>
			<table cellSpacing="0" cellPadding="3" width="450" height="450" border="0" style="font-family: calibri,sans-serif; font-size: 11pt" id="table2" align="left">
				<tr>
					<td bgColor="skyblue" align="middle" height="25" colSpan="2">1. Enter Customer Information and Options</td>
				</tr>

				<tr>
					
					<td align="right">
						<span title="If you do not have a valid ID, please call our Sales department at 1-800-800-6245 x3 to request for a demo Customer ID">
						Customer ID&nbsp;
						</span>
					</td>
					<td align="left" height="25">
					<input id="CustomerID" size="20" name="CustomerID" value="<?php echo $CustomerID ?>"></td>
				</tr>
				
				<tr>
					<td align="right">
						<span title="Simple string used to reference this web service request">
							Transmission Reference&nbsp;
						</span>
					</td>
					<td align="left" height="25">
					<input id="TransmissionReference" size="20" name="TransmissionReference" value="<?php echo $TransmissionReference ?>"></td>
				</tr>
				
				<tr>
					<td align="right">
						<span title="Used to separate elements in the FormattedAddress result">
							Line Separator&nbsp;
						</span>
					</td>
					<td align="left" height="25">
					<select name="LineSeparator">
						<option value="Semicolon">Semicolon (default)</option>
						<option value="Pipe">Pipe</option>
						<option value="Comma">Comma</option>
						<option value="Tab">Tab</option>
					</select>
				</tr>
				
				<tr>
					<td align="right">
						<span title="Choose which action to execute. The default action is 'Check'.">
							Action Type&nbsp;
						</span>
					</td>
					<td align="left" height="25">
						<span title="Determines whether the inputted fields are each valid">
						<input type="checkbox" name="Check" value="true">Check</input>
						</span>
						<span title="Determines whether the inputted fields are associated with each other">
						<input type="checkbox" name="Verify" value="true">Verify</input>
						</span>
						<span title="Return contact-data based on the centric-piece of information">
						<input type="checkbox" name="Append" value="true">Append</input>
						<span title="Updates the address to the most current address of the company/resident">
						<input type="checkbox" name="Move" value="true">Move</input>
						</span>
					</td>
				</tr>
				<tr>
					<td align="right" height="25">
						<span title="Advanced Address Correction is the ability for the service to correct a poorly entered address if found in the database using other input fields as supporting reference">
						AAC <font size="2">(Check only)</font>&nbsp;
						</span>
					</td>
					<td align="left" height="25">
						<input type="checkbox" name="AAC" value="true">Yes</input>
					</td>
				</tr>
				<tr>
					<td align="right" height="25">
						<span title="Designate a field you are most confident in and which the other input fields will determine whether they are associated with">
						Centricity <font size="2">(Verify & Append only)</font>&nbsp;
						</span>
					</td>
					<td align="left" height="25">
						<select name="Centricity">
							<option value="Auto">Auto (Default)</option>
							<option value="Address">Address</option>
							<option value="Phone">Phone</option>
							<option value="Email">Email</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" height="25">
						<span title="The Append option will determine when the service will return contact-data linked to the centric piece of information.">
						Append <font size="2">(Append only)</font>&nbsp;
						</span>
					</td>
					<td align="left" height="25">
						<select name="OptAppend">
							<option value="CheckError">Check Error (Default)</option>
							<option value="Blank">Blank</option>
							<option value="Always">Always</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">
						Columns to output&nbsp;
					</td>
					<td align="left" height="25">
						<span title="Detailed information on the inputted name">
						<input type="checkbox" name="colNameDetails" value="true">Name Details</input>
						</span>
					</td>
				</tr>
					<td />
					<td align="left" height="25">
						<span title="Detailed information on the inputted address">
						<input type="checkbox" name="colAddressDetails" value="true">Address Details</input>
						</span>
					</td>
				</tr>
				<tr>
					<td />
					<td align="left" height="25">
						<span title="Parsed out information from the inputted address">
						<input type="checkbox" name="colAddressParsed" value="true">Parsed Address</input>
						</span>
					</td>
				</tr>
				<tr>
					<td />
					<td align="left" height="25">
						<span title="Parsed out information from the inputted email">
						<input type="checkbox" name="colEmailParsed" value="true">Parsed Email</input>
						</span>
					</td>
				</tr>
				<tr>
					<td />
					<td align="left" height="25">
						<span title="Parsed out information from the inputted phone">
						<input type="checkbox" name="colPhoneParsed" value="true">Parsed Phone</input>
						</span>
					</td>
				</tr>
				<tr>
					<td />
					<td align="left" height="25">
						<span title="Latitude and longitude">
						<input type="checkbox" name="colGeocode" value="true">Lat and Long</input>
						</span>
					</td>
				</tr>
				<tr>
					<td />
					<td align="left" height="25">
						<span title="Information gathered from census data">
						<input type="checkbox" name="colCensus" value="true">Census</input>
						</span>
					</td>
				</tr>
				<tr />
			</table>
		</td>
		<td>
			<table cellSpacing="0" cellPadding="3" width="450" height="450" border="0" style="font-family: calibri,sans-serif; font-size: 11pt" align="right" id="table3">
			<tr>
				<td bgColor=#fdd017 align="middle" colSpan="2" height="25">2. Enter Contact Data in Question</td>
			</tr>
			
			<tr>
				<td align="right" >
					<span title="Business/company/organization name">
						Company&nbsp;
					</span>
				</td>
				<td align="left" height="25">
					<input id="Company" size="40" name="Company" value="<?php echo $Company ?>" >
				</td>
			</tr>
			
			<tr>
				<td align="right" >
					<span title="Contact's full name">
						Full Name&nbsp;
					</span>
				</td>
				<td align="left" height="25">
					<input id="FullName" size="40" name="FullName" value="<?php echo $FullName ?>">
				</td>
			</tr>
			
			<tr>
				<td align="right">
					<span title="First address line">
						Address Line 1&nbsp;
					</span>
				</td>
				<td align="left" height="25">
					<input id="AddressLine1" size="40" name="AddressLine1" value="<?php echo $AddressLine1 ?>">
				</td>
			</tr>
			
			<tr>
				<td align="right">
					<span title="Second address line">
						Address Line 2&nbsp;
					</span>
				</td>
				<td align="left" height="25">
					<input id="AddressLine2" size="40" name="AddressLine2" value="<?php echo $AddressLine2 ?>">
				</td>
			</tr>

			<tr>
				<td align="right" >
					<span title="City name">
						City&nbsp;
					</span>
				</td>
				<td align="left" height="25">
					<input id="City" size="40" name="City" value="<?php echo $City ?>">
				</td>
			</tr>
			<tr>
				<td align="right" >
					<span title="State/province name">
						State&nbsp;
					</span>
				</td>
				<td align="left" height="25">
					<input id="State" size="40" name="State" value="<?php echo $State ?>">
				</td>
			</tr>
			
			<tr>
				<td align="right" >
					<span title="Zip/postal code number">
						Postal Code&nbsp;
					</span>
				</td>
				<td align="left" height="25">
					<input id="PostalCode" size="40" name="PostalCode" value="<?php echo $PostalCode ?>">
				</td>
			</tr>
			
			<tr>
				<td align="right" >
					<span title="Country name">
						Country&nbsp;
					</span>
				</td>
				<td align="left" height="25">
					<input id="Country" size="40" name="Country" value="<?php echo $Country ?>">
				</td>
			</tr>

			<tr>
				<td align="right" >
					<span title="Phone number">
						Phone Number&nbsp;
					</span>
				</td>
				<td align="left" height="25">
					<input id="Phone" size="40" name="Phone" value="<?php echo $Phone ?>">
				</td>
			</tr>
			
			<tr>
				<td align="right" >
					<span title="Email">
						Email&nbsp;
					</span>
				</td>
				<td align="left" height="25">
					<input id="Email" size="40" name="Email" value="<?php echo $Email ?>">
				</td>
			</tr>
				
			<tr>
				<td align="right" >&nbsp;</td>
				<td align="left" >&nbsp;</td>
			</tr>
		</td>
		</table>
		
			<tr>
				<td align="center" bgColor=#54c571 colSpan="2">
					<input type="submit" value="Insert Sample" name="Single_Sample"/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" value="Clear" name="Single_Clear"/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" value="Process" name="Single_Process"/>
				</td>			
			</tr>
	</table>
<?php
if (isset($return_content)) {
	echo '<tr><td bgColor="#EAEAEA" colSpan="2">';
	echo '<br>------------- BEGIN SERVER RESPONSE -------------<br>'. $server_response . '<br>------------- END SERVER RESPONSE -------------<br><br>';
	echo '<br>------------- BEGIN SOAP RECORDSET -------------<br>'. $record_content . '<br>------------- END XML RECORDSET -------------<br><br>';
	echo '<br>------------- AVAILABLE VARS -------------<br>';
	printa($output_array);
	echo '------------- END AVAILABLE VARS -------------<br><br>';
	echo '</tr></td>';
	$CustomerID;
}
?>
</form>
</font>
</body>


</html>