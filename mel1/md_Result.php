<?php
error_reporting(E_ALL & ~E_NOTICE);
?>

<html>
<font face="Calibri">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html">
</head>

<center>
<body>
<form method="POST" enctype="multipart/form-data" name="melissa_lookup" style="font-family: Calibri; font-size: 11" action="md_index.php">
	<center>
	<table cellSpacing="0" cellPadding="3" width="700" border="0" style="font-family: calibri,sans-serif; font-size: 11pt">
		
		<tr>
			<td bgColor=#F9966B align="center" colSpan="2">Basic Results</td>
		</tr>
		<tr height="25">
		</tr>
		<tr>
			<td align="right" >
				<span title="Version number of the Web Service">
					Version&nbsp;
				</span>
			</td>
			<td align="left" >
				<input id="Results_Version" size="40" name="Results_Version" value="<?php echo $Results_Version ?>" >
			</td>
		</tr>
		
		<tr>
			<td align="right" >
				<span title="Transmission reference passed in from input">
					Transmission Reference&nbsp;
				</span>
			</td>
			<td align="left" >
				<input id="Results_TransReference" size="40" name="Results_TransReference" value="<?php echo $Results_TransReference ?>" >
			</td>
		</tr>
		
		<tr>
			<td align="right" >
				<span title="Transmission results">
					Transmission Results&nbsp;
				</span>
			</td>
			<td align="left" >
				<input id="Results_TransResults" size="40" name="Results_TransResults" value="<?php echo $Results_TransResults ?>" >
			</td>
		</tr>
				
		<tr>
			<td align="right" >
				<span title="List of codes detailing address verification">
					Results Codes&nbsp;
				</span>
			</td>
			<td align="left" >
				<input id="Results_Results" size="40" name="Results_Results" value="<?php echo $Results_Results ?>">
			</td>
		</tr>
						
		<tr>
			<td align="right" >
				<span title="Organization / company name">
					Company&nbsp;
				</span>
			</td>
			<td align="left" >
				<input id="Results_Company" size="40" name="Results_Company" value="<?php echo $Results_Company ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Full Name">
					Full Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Results_FullName" size="40" name="Results_FullName" value="<?php echo $Results_FullName ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right" >
				<span title="First address line">
					Address Line 1&nbsp;
				</span>
			</td>
			<td align="left" >
				<input id="Results_AddressLine1" size="40" name="Results_AddressLine1" value="<?php echo $Results_AddressLine1 ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right" >
				<span title="Second address line">
					Address Line 2&nbsp;
				</span>
			</td>
			<td align="left" >
				<input id="Results_AddressLine2" size="40" name="Results_AddressLine2" value="<?php echo $Results_AddressLine2 ?>">
			</td>
		</tr>

		<tr>
			<td align="right">
				<span title="City name">
					City&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Results_City" size="40" name="Results_City" value="<?php echo $Results_City ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="State">
					State&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Results_State" size="40" name="Results_State" value="<?php echo $Results_State ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="ZIP code">
					ZIP&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Results_ZIP" size="40" name="Results_ZIP" value="<?php echo $Results_ZIP ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Country">
					Country&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Results_Country" size="40" name="Results_Country" value="<?php echo $Results_Country ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Phone">
					Phone Number&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Results_Phone" size="40" name="Results_Phone" value="<?php echo $Results_Phone ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Email">
					Email&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Results_Email" size="40" name="Results_Email" value="<?php echo $Results_Email ?>">
			</td>
		</tr>
			
		<tr height="25">
		</tr>
	</table>
	
	</center>
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