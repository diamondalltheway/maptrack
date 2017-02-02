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
			<td bgColor=#66E0C2 align="center" colSpan="2">Address Details Results</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Abbreviation of the city">
					City Abbreviation&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressDetails_CityAbbrev" size="50" name="AddressDetails_CityAbbrev" value="<?php echo $AddressDetails_CityAbbrev ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Full name of the state">
					State Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressDetails_StateName" size="50" name="AddressDetails_StateName" value="<?php echo $AddressDetails_StateName ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Primarily used for Puerto Rican addresses, an urbanization is a subset of a city, like a town">
					Urbanization Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressDetails_Urbanization" size="50" name="AddressDetails_Urbanization" value="<?php echo $AddressDetails_Urbanization ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Group of addresses which the USPS assigns the same code to aid in mail delivery">
					Carrier Route&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressDetails_CarrierRoute" size="50" name="AddressDetails_CarrierRoute" value="<?php echo $AddressDetails_CarrierRoute ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Group of addresses which the USPS assigns the same code to aid in mail delivery">
					Delivery Point Code&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressDetails_DPCCode" size="50" name="AddressDetails_DPCCode" value="<?php echo $AddressDetails_DPCCode ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Digit associated to the Delivery Point Code">
					Delivery Point Check Digit&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="AddressDetails_DPCDigit" size="50" name="AddressDetails_DPCDigit" value="<?php echo $AddressDetails_DPCDigit ?>">
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