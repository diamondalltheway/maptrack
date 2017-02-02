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
			<td bgColor=#66E0C2 align="center" colSpan="2">Parsed Email Results</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The domain is the name entered after the '@' and before '.' (i.e. 'yahoo', 'hotmail', etc.)">
					Domain Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="ParsedEmail_Domain" size="50" name="ParsedEmail_Domain" value="<?php echo $ParsedEmail_Domain ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The mailbox is the name entered before the '@'">
					Mailbox Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="ParsedEmail_Mailbox" size="50" name="ParsedEmail_Mailbox" value="<?php echo $ParsedEmail_Mailbox ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The top level domain is the name entered after the '.' (i.e. 'com', 'net', 'org', etc.)">
					Top Level Domain&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="ParsedEmail_TLDName" size="50" name="ParsedEmail_TLDName" value="<?php echo $ParsedEmail_TLDName ?>">
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