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
			<td bgColor=#66E0C2 align="center" colSpan="2">Census Results</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Name of the detected county">
					County Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_CountyName" size="50" name="Census_CountyName" value="<?php echo $Census_CountyName ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Five-digit code defined by the U.S. Bureau of Census indicating the state and county codes">
					County FIPS&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_CountyFIPS" size="50" name="Census_CountyFIPS" value="<?php echo $Census_CountyFIPS ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Geographic region defined for the census survey">
					Census Tract&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_CensusTract" size="50" name="Census_CensusTract" value="<?php echo $Census_CensusTract ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Smallest geographic unit used by the Census Bureau for census surveys">
					Census Block&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_CensusBlock" size="50" name="Census_CensusBlock" value="<?php echo $Census_CensusBlock ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Code which matches the ZIP +4 code with the Census bureau's official name for that physical location">
					Place Code&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_PlaceCode" size="50" name="Census_PlaceCode" value="<?php echo $Census_PlaceCode ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Census Bureau's official name for the ZIP +4 code">
					Place Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_PlaceName" size="50" name="Census_PlaceName" value="<?php echo $Census_PlaceName ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Five-digit code for the specific Core Based Statistical Area (CBSA) associated witht he location described by the submitted ZIP">
					CBSA Code&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_CBSACode" size="50" name="Census_CBSACode" value="<?php echo $Census_CBSACode ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The official U.S. Census Bureau name for the Core Based Statistical Area (CBSA)">
					CBSA Title&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_CBSATitle" size="50" name="Census_CBSATitle" value="<?php echo $Census_CBSATitle ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The level description for the determined CBSA code; Either metropolitan or micropolitan">
					CBSA Level&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_CBSALevel" size="50" name="Census_CBSALevel" value="<?php echo $Census_CBSALevel ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The numeric code for a sub-division of a CBSA, if existent">
					CBSA Division Code&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_CBSADivCode" size="50" name="Census_CBSADivCode" value="<?php echo $Census_CBSADivCode ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The official U.S. Census Bureau name for the sub-division of the CBSA, if existent">
					CBSA Division Title&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_CBSADivTitle" size="50" name="Census_CBSADivTitle" value="<?php echo $Census_CBSADivTitle ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The level description for the sub-division of the CBSA, if existent">
					CBSA Division Level&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_CBSADivLevel" size="50" name="Census_CBSADivLevel" value="<?php echo $Census_CBSADivLevel ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The congressional district the address belongs to">
					Congressional District&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="Census_CongrDist" size="50" name="Census_CongrDist" value="<?php echo $Census_CongrDist ?>">
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