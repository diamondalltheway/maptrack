<?php
error_reporting(E_ALL & ~E_NOTICE);
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<center>
<body>
<font face="Calibri">
<form method="POST" enctype="multipart/form-data" name="melissa_lookup" style="font-family: Calibri; font-size: 11" action="md_index.php">
	<center>
	<table cellSpacing="0" cellPadding="3" width="700" border="0" style="font-family: calibri,sans-serif; font-size: 11pt" id="table1">
		
		<tr>
			<td bgColor=#66E0C2 align="center" colSpan="2">Address Parsed Results</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Street number of the building/home">
					Address House Number&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressParsed_HouseNumber" size="50" name="AddressParsed_HouseNumber" value="<?php echo $AddressParsed_HouseNumber ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Street's directional placed before the street name (i.e. 'south' in 'South Main St')">
					Address Pre-Direction&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressParsed_PreDirection" size="50" name="AddressParsed_PreDirection" value="<?php echo $AddressParsed_PreDirection ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Street name">
					Address Street Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressParsed_StreetName" size="50" name="AddressParsed_StreetName" value="<?php echo $AddressParsed_StreetName ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Descriptive component of street address such as 'St', 'Rd', 'Ave', etc.">
					Address Street Suffix&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressParsed_Suffix" size="50" name="AddressParsed_Suffix" value="<?php echo $AddressParsed_Suffix ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Street's directional placed after the street name (i.e. 'S', 'NE', 'SW', etc.)">
					Address Post-Direction&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressParsed_PostDirection" size="50" name="AddressParsed_PostDirection" value="<?php echo $AddressParsed_PostDirection ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Name of the suite/apartment">
					Address Suite Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressParsed_SuiteName" size="50" name="AddressParsed_SuiteName" value="<?php echo $AddressParsed_SuiteName ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Suite/apartment number">
					Address Suite Number&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressParsed_SuiteNumber" size="50" name="AddressParsed_SuiteNumber" value="<?php echo $AddressParsed_SuiteNumber ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Name of the detected private mailbox">
					Address Private Mailbox Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressParsed_POName" size="50" name="AddressParsed_POName" value="<?php echo $AddressParsed_POName ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The private mailbox's range/number">
					Address Private Mailbox Number&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressParsed_PONumber" size="50" name="AddressParsed_PONumber" value="<?php echo $AddressParsed_PONumber ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="(Canada Only)The US equivalent would be a rural route">
					Address Route Service&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressParsed_RouteService" size="50" name="AddressParsed_RouteService" value="<?php echo $AddressParsed_RouteService ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="(Canada Only)The US equivalent would be a PO Box">
					Address Lockbox&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressParsed_Lockbox" size="50" name="AddressParsed_Lockbox" value="<?php echo $AddressParsed_Lockbox ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="(Canada Only)The post office facility responsible for delivering to the entered/detected address. This is often used for rural addresses or when multiple post offices deliver to the same municipality">
					Address Delivery Installation&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressParsed_DeliveryInstallation" size="50" name="AddressParsed_DeliveryInstallation" value="<?php echo $AddressParsed_DeliveryInstallation ?>">
			</td>
		</tr>
		
		<tr height="25">
		</tr>
	</table>
	</center>
	
	
	
		
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
		
	</table>
	</center>

</form>
</font>
</body>
</html>