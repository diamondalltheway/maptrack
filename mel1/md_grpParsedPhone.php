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
			<td bgColor=#66E0C2 align="center" colSpan="2">Parsed Phone Results</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Area code of the phone number">
					Area Code&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="ParsedPhone_AreaCode" size="50" name="ParsedPhone_AreaCode" value="<?php echo $ParsedPhone_AreaCode ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="After an area code split, the new area code field will return the corrected area code for the phone number">
					New Area Code&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="ParsedPhone_NewAreaCode" size="50" name="ParsedPhone_NewAreaCode" value="<?php echo $ParsedPhone_NewAreaCode ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="First three digits after the area code">
					Phone Prefix&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="ParsedPhone_Prefix" size="50" name="ParsedPhone_Prefix" value="<?php echo $ParsedPhone_Prefix ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The next four digits after the prefix">
					Phone Suffix&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="ParsedPhone_Suffix" size="50" name="ParsedPhone_Suffix" value="<?php echo $ParsedPhone_Suffix ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The extension, if existent">
					Phone Extension&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="ParsedPhone_Extension" size="50" name="ParsedPhone_Extension" value="<?php echo $ParsedPhone_Extension ?>">
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