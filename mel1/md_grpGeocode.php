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
			<td bgColor=#66E0C2 align="center" colSpan="2">Geocode Results</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Latitude">
					Latitude&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Geocode_Latitude" size="50" name="Geocode_Latitude" value="<?php echo $Geocode_Latitude ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Longitude">
					Longitude&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Geocode_Longitude" size="50" name="Geocode_Longitude" value="<?php echo $Geocode_Longitude ?>">
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